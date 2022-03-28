<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PostImageTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    private const MY_USER_ID = 1;
    private const OTHER_USER_ID = 2;
    private const NOT_EXISTING_ID = 100000;

    private const MY_POST_ID = 1;
    private const OTHER_POST_ID = 11;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_store_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ];
        $this->post('/api/posts/'.self::MY_POST_ID.'/image', $data)
            ->assertStatus(201);
    }

    public function test_store_failure_wrong_user()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ];
        $this->post('/api/posts/'.self::NOT_EXISTING_ID.'/image', $data)
            ->assertStatus(404);
    }

    public function test_store_failure_no_image()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->post('/api/posts/'.self::MY_POST_ID.'/image')
            ->assertStatus(302);
    }

    public function test_store_failure_unauthorized()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ];
        $this->post('/api/posts/'.self::OTHER_POST_ID.'/image', $data)
            ->assertStatus(403);
    }

    public function test_show_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->get('/api/posts/'.self::MY_USER_ID.'/image')
            ->assertStatus(200);
    }

    public function test_show_failure_non_existing_post()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->get('/api/posts/'.self::NOT_EXISTING_ID.'/image')
            ->assertStatus(404);
    }

    public function test_destroy_failure_non_existing_post()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->delete('/api/posts/'.self::NOT_EXISTING_ID.'/image')
            ->assertStatus(404);
    }

    public function test_destroy_failure_unauthenticated()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->delete('/api/posts/'.self::OTHER_POST_ID.'/image')
            ->assertStatus(403);
    }

    public function test_destroy_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->delete('/api/posts/'.self::MY_POST_ID.'/image')
            ->assertStatus(204);
    }
}

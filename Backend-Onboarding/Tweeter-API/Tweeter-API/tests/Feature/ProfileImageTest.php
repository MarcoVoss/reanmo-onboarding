<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProfileImageTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    private const MY_USER_ID = 1;
    private const OTHER_USER_ID = 2;
    private const NOT_EXISTING_ID = 100000;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_update_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ];
        $this->put('/api/profiles/'.self::MY_USER_ID.'/image', $data)
            ->assertStatus(201);
    }

    public function test_update_failure_wrong_user()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ];
        $this->put('/api/profiles/'.self::NOT_EXISTING_ID.'/image', $data)
            ->assertStatus(404);
    }

    public function test_update_failure_no_image()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->put('/api/profiles/'.self::MY_USER_ID.'/image')
            ->assertStatus(302);
    }

    public function test_update_failure_unauthorized()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ];
        $this->put('/api/profiles/'.self::OTHER_USER_ID.'/image', $data)
            ->assertStatus(403);
    }

    public function test_show_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->get('/api/profiles/'.self::MY_USER_ID.'/image')
            ->assertStatus(200);
    }

    public function test_show_failure_non_existing_user()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->get('/api/profiles/'.self::NOT_EXISTING_ID.'/image')
            ->assertStatus(404);
    }

    public function test_destroy_failure_non_existing_user()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->delete('/api/profiles/'.self::NOT_EXISTING_ID.'/image')
            ->assertStatus(404);
    }

    public function test_destroy_failure_unauthenticated()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->delete('/api/profiles/'.self::OTHER_USER_ID.'/image')
            ->assertStatus(403);
    }

    public function test_destroy_success()
    {
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->delete('/api/profiles/'.self::MY_USER_ID.'/image')
            ->assertStatus(204);
    }
}

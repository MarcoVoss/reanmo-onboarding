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

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_store_success()
    {
        $this->be(User::find(1));
        $data = [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ];
        $this->post('/api/profiles/1/image', $data)
            ->assertStatus(201);
    }

    public function test_store_failure_wrong_user()
    {
        $this->be(User::find(1));
        $data = [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ];
        $this->post('/api/profiles/10000/image', $data)
            ->assertStatus(404);
    }

    public function test_store_failure_no_image()
    {
        $this->be(User::find(1));
        $this->post('/api/profiles/1/image')
            ->assertStatus(302);
    }

    public function test_store_failure_unauthorized()
    {
        $this->be(User::find(1));
        $data = [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ];
        $this->post('/api/profiles/2/image', $data)
            ->assertStatus(403);
    }

    public function test_show_success()
    {
        $this->be(User::find(1));
        $this->get('/api/profiles/1/image')
            ->assertStatus(200);
    }

    public function test_show_failure_non_existing_user()
    {
        $this->be(User::find(1));
        $this->get('/api/profiles/1000000/image')
            ->assertStatus(404);
    }

    public function test_destroy_failure_non_existing_user()
    {
        $this->be(User::find(1));
        $this->delete('/api/profiles/1000000/image')
            ->assertStatus(404);
    }

    public function test_destroy_failure_unauthenticated()
    {
        $this->be(User::find(1));
        $this->delete('/api/profiles/2/image')
            ->assertStatus(403);
    }

    public function test_destroy_success()
    {
        $this->be(User::find(1));
        $this->delete('/api/profiles/1/image')
            ->assertStatus(204);
    }
}

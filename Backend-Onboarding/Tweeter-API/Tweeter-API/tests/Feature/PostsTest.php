<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_index()
    {
        $this->be(User::find(1));
        $response = $this->get('/api/posts');
        $response->assertStatus(200);
    }

    public function test_show_failure()
    {
        $this->be(User::find(1));
        $response = $this->get('/api/posts/0');
        $response->assertStatus(404);
    }

    public function test_show_success()
    {
        $this->be(User::find(1));
        $response = $this->get('/api/posts/1');
        $response->assertStatus(200);
    }

    public function test_update_failure_unauthenticated()
    {
        $this->be(User::find(1));
        $data = [
            'message' => 'Text'
        ];
        $response = $this->put('/api/posts/40', $data);
        $response->assertStatus(403);
    }

    public function test_update_failure_missing_data()
    {
        $this->be(User::find(1));
        $data = [];
        $response = $this->put('/api/posts/1', $data);
        $response->assertStatus(302);
    }

    public function test_update_success()
    {
        $this->be(User::find(1));
        $data = [
            'message' => 'Text'
        ];
        $response = $this->put('/api/posts/1', $data);
        $response->assertStatus(200);
    }

    public function test_store_success()
    {
        $this->be(User::find(1));
        $data = [
            'message' => 'Text'
        ];
        $response = $this->post('/api/posts', $data);
        $response->assertStatus(201);
    }

    public function test_store_failure_missing_data()
    {
        $this->be(User::find(1));
        $data = [];
        $response = $this->post('/api/posts', $data);
        $response->assertStatus(302);
    }

    public function test_destroy_failure()
    {
        $this->be(User::find(1));
        $response = $this->delete('/api/posts/30');
        $response->assertStatus(403);
    }

    public function test_destroy_success()
    {
        $this->be(User::find(1));
        $response = $this->delete('/api/posts/1');
        $response->assertStatus(204);
    }
}

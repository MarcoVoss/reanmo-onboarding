<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentsTest extends TestCase
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
            'post_id' => '1',
            'message' => 'Test',
        ];
        $this->post('/api/comments', $data)
            ->assertStatus(201);
    }

    public function test_store_failure_post_does_not_exist()
    {
        $this->be(User::find(1));
        $data = [
            'post_id' => '10000',
            'message' => 'Test',
        ];
        $this->post('/api/comments', $data)
            ->assertStatus(302);
    }

    public function test_store_failure_missing_message()
    {
        $this->be(User::find(1));
        $data = [
            'post_id' => '1',
        ];
        $this->post('/api/comments', $data)
            ->assertStatus(302);
    }

    public function test_store_failure_no_data_presented()
    {
        $this->be(User::find(1));
        $data = [];
        $this->post('/api/comments', $data)
            ->assertStatus(302);
    }

    public function test_update_success()
    {
        $this->be(User::find(1));
        $data = [
            'message' => 'Test',
        ];
        $this->put('/api/comments/1', $data)
            ->assertStatus(200);
    }

    public function test_update_failure_missing_message()
    {
        $this->be(User::find(1));
        $data = [
            'post_id' => '1',
        ];
        $this->put('/api/comments/1', $data)
            ->assertStatus(302);
    }

    public function test_update_failure_wrong_comment_id()
    {
        $this->be(User::find(1));
        $data = [
            'message' => 'Test',
        ];
        $this->put('/api/comments/10000', $data)
            ->assertStatus(404);
    }

    public function test_update_failure_unauthorized()
    {
        $this->be(User::find(1));
        $data = [
            'message' => 'Test',
        ];
        $this->put('/api/comments/11', $data)
            ->assertStatus(403);
    }

    public function test_destroy_failure_wrong_id()
    {
        $user = User::find(1);
        $this->be($user);
        $this->delete("/api/comments/500")
            ->assertStatus(404);
    }

    public function test_destroy_failure_unauthenticated()
    {
        $user = User::find(1);
        $this->be($user);
        $this->delete("/api/comments/11")
            ->assertStatus(403);
    }

    public function test_destroy_success()
    {
        $user = User::find(1);
        $this->be($user);
        $this->delete("/api/comments/1")
            ->assertStatus(204);
    }
}

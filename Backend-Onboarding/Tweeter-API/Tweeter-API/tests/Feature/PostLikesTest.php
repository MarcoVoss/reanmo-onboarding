<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostLikesTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_index_success()
    {
        $this->be(User::find(1));
        $this->get('/api/posts/1/likes')
            ->assertStatus(200);
    }

    public function test_index_failure_wrong_comment_id()
    {
        $this->be(User::find(1));
        $this->get('/api/posts/10000/likes')
            ->assertStatus(404);
    }

    public function test_store_success()
    {
        $this->be(User::find(1));
        $this->post('/api/posts/1/likes')
            ->assertStatus(201);
    }

    public function test_store_failure_wrong_id()
    {
        $this->be(User::find(1));
        $this->post('/api/posts/10000/likes')
            ->assertStatus(404);
    }

    public function test_destroy_success()
    {
        $this->be(User::find(1));
        $this->delete('/api/posts/1/likes')
            ->assertStatus(204);
    }

    public function test_destroy_failure_wrong_id()
    {
        $this->be(User::find(1));
        $this->delete('/api/posts/10000/likes')
            ->assertStatus(404);
    }
}

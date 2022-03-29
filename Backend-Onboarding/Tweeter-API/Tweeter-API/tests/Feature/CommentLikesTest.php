<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentLikesTest extends TestCase
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
        $this->post('/api/comments/1/like')
            ->assertStatus(201);
    }

    public function test_store_failure_wrong_id()
    {
        $this->be(User::find(1));
        $this->post('/api/comments/10000/like')
            ->assertStatus(404);
    }
}

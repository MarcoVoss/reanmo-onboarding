<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostCommentTest extends TestCase
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
        $this->get('/api/posts/1/comments')
            ->assertStatus(200);
    }

    public function test_index_failure_non_existing_post()
    {
        $this->be(User::find(1));
        $this->get('/api/posts/10000/comments')
            ->assertStatus(404);
    }
}

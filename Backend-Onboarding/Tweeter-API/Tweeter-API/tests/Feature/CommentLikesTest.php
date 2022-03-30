<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentLikesTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    private User $user;
    private User $otherUser;
    private Comment $comment;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->user = User::find(1);
        $this->otherUser = User::find(2);
        $this->comment = Comment::find(1);
    }

    public function test_store_success()
    {
        $this->be($this->user);
        $this->post('/api/comments/'.$this->comment->id.'/like')
            ->assertStatus(201)
            ->assertJson([
                'id' => $this->comment->id,
                'message' => $this->comment->message,
                'user' => [
                    "id" => $this->comment->user->id,
                ],
                'likes' => $this->comment->likes->count(),
            ]);
    }

    public function test_store_failure_wrong_id()
    {
        $this->be($this->user);
        $notExistingId = -1;
        $this->post('/api/comments/'.$notExistingId.'/like')
            ->assertStatus(404);
    }
}

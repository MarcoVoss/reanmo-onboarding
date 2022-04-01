<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
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

    public function test_CreatesAndRemovesLike()
    {
        $user = User::factory()->create();
        $post = $user->posts()->create([
            "message" => "Test"
        ]);
        $comment = $post->comments()->create([
            "user_id" => $user->id,
            "message" => "Comment",
        ]);
        $this->be($user);
        $this->post('/api/comments/'.$comment->id.'/like')
            ->assertStatus(201)
            ->assertJson([
                'id' => $comment->id,
                'message' => $comment->message,
                'user' => [
                    "id" => $comment->user->id,
                ],
                'likes_count' => 1,
            ]);
        $this->post('/api/comments/'.$comment->id.'/like')
            ->assertStatus(201)
            ->assertJson([
                'id' => $comment->id,
                'message' => $comment->message,
                'user' => [
                    "id" => $comment->user->id,
                ],
                'likes_count' => 0,
            ]);
        self::assertNotNull($user->commentLikes);
    }
}

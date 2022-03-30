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
    
    public function test_CanReadCommentsByPost()
    {
        $user = User::factory()->create();
        $post = $user->posts()->create([
            "message" => "MyPost",
        ]);
        for($i = 0; $i < 10; $i++){
            $post->comments()->create([
                "message" => $i,
                "user_id" => $user->id,
            ]);
        }
        $this->be($user);
        $this->get("/api/posts/$post->id/comments")
            ->assertOk()
            ->assertJsonCount(10);
    }
}

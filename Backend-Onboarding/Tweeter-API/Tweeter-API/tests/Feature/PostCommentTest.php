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

    public function test_CanCreateCommentOnExistingPost()
    {
        $user = User::factory()->create();
        $post = $user->posts()->create([
            "message" => "Test"
        ]);

        $this->be($user);
        $this->post('/api/posts/'.$post->id.'/comments', [
            'message' => 'Test',
        ])->assertCreated()
            ->assertJsonStructure([
                "message",
                "user"
            ])
            ->assertJsonPath("likes", 0)
            ->assertStatus(201);
    }

    public function test_CantStoreWithMissingBody()
    {
        $user = User::factory()->create();
        $this->be($user);
        $post = $user->posts()->create([
            "message" => "Test"
        ]);
        $this->post('/api/posts/'.$post->id.'/comments')
            ->assertStatus(302);
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

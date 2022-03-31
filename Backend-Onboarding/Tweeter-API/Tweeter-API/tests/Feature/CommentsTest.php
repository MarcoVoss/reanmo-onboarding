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

    public function test_PostBelongsToIsWorking()
    {
        $user = User::factory()->create();
        $comment = $user->posts()->create([
            "user_id" => $user->id,
            "message" => "Test"
        ])->comments()->create([
            "user_id" => $user->id,
            "message" => "Test"
        ]);
        self::assertNotNull($comment->post);
        self::assertNotNull($user->comments);
    }

    public function test_CanDestroyOwnComment()
    {
        $user = User::factory()->create();
        $comment = $user->posts()->create([
            "user_id" => $user->id,
            "message" => "Test"
        ])->comments()->create([
            "user_id" => $user->id,
            "message" => "Test"
        ]);
        $this->be($user);
        $this->delete("/api/comments/".$comment->id)
            ->assertStatus(204);
    }

    public function test_CantDestroyOtherUsersComment()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $comment = $otherUser->posts()->create([
            "user_id" => $otherUser->id,
            "message" => "Test"
        ])->comments()->create([
            "user_id" => $otherUser->id,
            "message" => "Test"
        ]);
        $this->be($user);
        $this->delete("/api/comments/".$comment->id)
            ->assertStatus(403);
    }

    public function test_CanCreateCommentOnExistingPost()
    {
        $user = User::factory()->create();
        $post = $user->posts()->create([
            "message" => "Test"
        ]);

        $this->be($user);
        $this->post('/api/comments', [
            'post_id' => $post->id,
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
        $this->be(User::factory()->create());
        $this->post('/api/comments')
            ->assertStatus(302);
    }

    public function test_CanUpdateComment()
    {
        $user = User::factory()->create();
        $comment = $user->posts()->create([
            "user_id" => $user->id,
            "message" => "Test"
        ])->comments()->create([
            "user_id" => $user->id,
            "message" => "Test"
        ]);
        $this->be($user);
        $data = [
            'message' => 'Test',
        ];
        $this->put('/api/comments/'.$comment->id, $data)
            ->assertOk()
            ->assertJsonStructure([
                "message",
                "user"
            ])
            ->assertJsonPath("likes", $comment->likes->count());
    }

    public function test_CantUpdateWithMissingBody()
    {
        $user = User::factory()->create();
        $comment = $user->posts()->create([
            "user_id" => $user->id,
            "message" => "Test"
        ])->comments()->create([
            "user_id" => $user->id,
            "message" => "Test"
        ]);
        $this->be($user);
        $this->put('/api/comments/'.$comment->id)
            ->assertStatus(302);
    }

    public function test_CantUpdateOthersPost()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $comment = $otherUser->posts()->create([
            "user_id" => $otherUser->id,
            "message" => "Test"
        ])->comments()->create([
            "user_id" => $otherUser->id,
            "message" => "Test"
        ]);
        $this->be($user);
        $data = [
            'message' => 'Test',
        ];
        $this->put('/api/comments/'.$comment->id, $data)
            ->assertForbidden();
    }
}

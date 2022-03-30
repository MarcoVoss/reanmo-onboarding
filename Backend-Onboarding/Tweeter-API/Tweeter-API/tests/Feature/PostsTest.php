<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    private const MY_USER_ID = 1;
    private const MY_POST_ID = 1;
    private const OTHER_POST_ID = 20;
    private const NOT_EXISTING_ID = 100000;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_CanPost()
    {
        $this->be(User::factory()->create());
        $this->post('/api/posts', [
            'message' => 'Text'
        ])->assertStatus(201);
    }

    public function test_CanNotPostWithoutBody()
    {
        $this->be(User::factory()->create());
        $this->post('/api/posts', )
            ->assertStatus(302);
    }

    public function test_CanUpdatePost()
    {
        $user = User::factory()->create();
        $post = $user->posts()->create([
            "message" => "Before"
        ]);
        $this->be($user);
        $this->put('/api/posts/'.$post->id, [
            'message' => 'After'
        ])->assertStatus(200)
            ->assertJsonPath("message", "After");
    }

    public function test_CanNotUpdateWithoutBody()
    {
        $user = User::factory()->create();
        $post = $user->posts()->create([
            "message" => "Before"
        ]);
        $this->be($user);
        $this->put('/api/posts/'.$post->id)
            ->assertStatus(302);
    }

    public function test_CanNotUpdateOthersPost()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $post = $otherUser->posts()->create([
            "message" => "Before"
        ]);
        $this->be($user);
        $this->put('/api/posts/'.$post->id, [
            'message' => 'Text'
        ])->assertStatus(403);
    }

    public function test_CanDeletePost()
    {
        $user = User::factory()->create();
        $this->be($user);
        $post = $user->posts()->create([
            "message" => "Before"
        ]);
        $this->delete('/api/posts/'.$post->id)
            ->assertStatus(204);
    }

    public function test_CanNotDeleteOthersPost()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $this->be($user);
        $post = $otherUser->posts()->create([
            "message" => "Before"
        ]);
        $this->delete('/api/posts/'.$post->id)
            ->assertStatus(403);
    }

    public function test_CanSeeSinglePost()
    {
        $user = User::factory()->create();
        $this->be($user);
        $post = $user->posts()->create([
            "message" => "Test"
        ]);

        $this->get('/api/posts/'.$post->id)
            ->assertStatus(200);

        $otherUser = User::factory()->create();
        $otherPost = $otherUser->posts()->create([
            "message" => "Test"
        ]);

        $this->get('/api/posts/'.$otherPost->id)
            ->assertStatus(200);
    }
}

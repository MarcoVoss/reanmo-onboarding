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

    public function test_CanStoreAndRemoveLikes()
    {
        $user = User::factory()->create();
        $post = $user->posts()->create([
            "message" => "Test"
        ]);
        $this->be($user);
        $this->post('/api/posts/'.$post->id.'/like')
            ->assertStatus(201)
            ->assertJsonPath("likes", 1);

        $this->post('/api/posts/'.$post->id.'/like')
            ->assertStatus(201)
            ->assertJsonPath("likes", 0);
        self::assertNotNull($user->postLikes);
    }
}

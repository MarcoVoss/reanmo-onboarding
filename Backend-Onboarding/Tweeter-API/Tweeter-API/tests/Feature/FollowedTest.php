<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FollowedTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_CanFollowAndUnfollow()
    {
        $otherUser = User::factory()->create();
        $this->be(User::factory()->create());

        $this->post("/api/profile/follows/".$otherUser->id)
            ->assertStatus(201)
            ->assertJsonPath("follows", true);
        $this->post("/api/profile/follows/".$otherUser->id)
            ->assertStatus(201)
            ->assertJsonPath("follows", false);
    }

    public function test_CantFollowHimself()
    {
        $user = User::factory()->create();
        $this->be($user);
        $this->post("/api/profile/follows/".$user->id)
            ->assertStatus(403);
    }
}

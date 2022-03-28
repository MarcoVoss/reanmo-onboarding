<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowerTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_index_success()
    {
        $user = User::first();
        $this->be($user);
        $this->get("/api/profiles/{$user->id}/followers")
            ->assertStatus(200);
    }

    public function test_index_failure_wrong_user()
    {
        $this->be(User::find(1));
        $this->get('/api/profiles/100000/followers')
            ->assertStatus(404);
    }

    public function test_store_success()
    {
        $user = User::find(1);
        $this->be($user);
        $this->post("/api/profiles/{$user->id}/followers/3")
            ->assertStatus(201);
    }

    public function test_store_failure_wrong_base_user()
    {
        $user = User::find(1);
        $this->be($user);
        $this->post("/api/profiles/100000/followers/{$user->id}")
            ->assertStatus(404);
    }

    public function test_store_failure_wrong_follows_user()
    {
        $user = User::find(1);
        $this->be(User::find(1));
        $this->post("/api/profiles/{$user->id}/followers/100000")
            ->assertStatus(404);
    }

//    public function test_store_failure_follows_himself()
//    {
//        $user = User::find(1);
//        $this->be($user);
//        $this->post("/profiles/{$user->id}/followers/{$user->id}")
//            ->assertStatus(302);
//    }

    public function test_destroy_failure_wrong_base_user()
    {
        $user = User::find(1);
        $this->be($user);
        $this->delete("/api/profiles/100000/followers/4")
            ->assertStatus(404);
    }

    public function test_destroy_failure_wrong_follows_user()
    {
        $user = User::find(1);
        $this->be($user);
        $this->delete("/api/profiles/{$user->id}/followers/100000")
            ->assertStatus(404);
    }

    public function test_destroy_success()
    {
        $user = User::first();
        $follower = User::find(2);
        $this->be($user);
        $this->delete("/api/profiles/{$user->id}/followers/{$follower->id}")
            ->assertStatus(204);
    }
}

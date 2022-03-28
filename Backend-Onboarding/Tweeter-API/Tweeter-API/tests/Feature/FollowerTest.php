<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowerTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    private const MY_USER_ID = 1;
    private const OTHER_USER_ID = 2;
    private const NOT_EXISTING_ID = 100000;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_index_success()
    {
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->get("/api/profiles/{$user->id}/followers")
            ->assertStatus(200);
    }

    public function test_index_failure_wrong_user()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->get('/api/profiles/'.self::NOT_EXISTING_ID.'/followers')
            ->assertStatus(404);
    }

    public function test_store_success()
    {
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->post("/api/profiles/{$user->id}/followers/".self::OTHER_USER_ID)
            ->assertStatus(201);
    }

    public function test_store_failure_wrong_base_user()
    {
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->post("/api/profiles/".self::NOT_EXISTING_ID."/followers/{$user->id}")
            ->assertStatus(404);
    }

    public function test_store_failure_wrong_follows_user()
    {
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->post("/api/profiles/{$user->id}/followers/".self::NOT_EXISTING_ID)
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
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->delete("/api/profiles/".self::NOT_EXISTING_ID."/followers/".self::OTHER_USER_ID)
            ->assertStatus(404);
    }

    public function test_destroy_failure_wrong_follows_user()
    {
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->delete("/api/profiles/{$user->id}/followers/".self::NOT_EXISTING_ID)
            ->assertStatus(404);
    }

    public function test_destroy_success()
    {
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->delete("/api/profiles/{$user->id}/followers/".self::OTHER_USER_ID)
            ->assertStatus(204);
    }
}

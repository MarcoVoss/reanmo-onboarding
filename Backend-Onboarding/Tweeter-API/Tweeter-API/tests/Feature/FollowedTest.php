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

    private const MY_USER_ID = 1;
    private const NOT_EXISTING_ID = 100000;
    private const OTHER_USER_ID = 2;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_store_success()
    {
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->post("/api/profile/follows/".self::OTHER_USER_ID)
            ->assertStatus(201);
    }

    public function test_store_failure_wrong_follows_user()
    {
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->post("/api/profile/follows/".self::NOT_EXISTING_ID)
            ->assertStatus(404);
    }

//    public function test_store_failure_follows_himself()
//    {
//        $user = User::find(1);
//        $this->be($user);
//        $this->post("/profiles/{$user->id}/follows/{$user->id}")
//            ->assertStatus(302);
//    }
}

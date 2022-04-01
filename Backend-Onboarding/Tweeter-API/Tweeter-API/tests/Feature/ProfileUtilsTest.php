<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileUtilsTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_search_success()
    {
        $this->be(User::factory()->create());
        $this->get('/api/search/test')
            ->assertStatus(200);
    }

    public function test_search_failure_missing_parameter()
    {
        $this->be(User::factory()->create());
        $this->get('/api/search/')
            ->assertStatus(404);
    }

    public function test_news_success()
    {
        $user = User::factory()->create();
        $puma = User::factory()->create();
        $puma->posts()->create([
            "message" => "Test"
        ]);
        $adidas = User::factory()->create();
        $adidas->posts()->create([
            "message" => "Test"
        ]);
        $user->followed()->syncWithoutDetaching([$puma->id, $adidas->id]);

        $this->be($user);
        $this->get('/api/profile/news')
            ->assertStatus(200)
            ->assertJsonCount(2);
    }

    public function test_CanSeeOwnPosts()
    {
        $user = User::factory()->create();
        for($i = 0; $i < 10; $i++) {
            $user->posts()->create([
                "message" => $i
            ]);
        }
        $this->be($user);
        $this->get('/api/profile/home')
            ->assertStatus(200)
            ->assertJsonCount($user->posts()->count());
    }
}

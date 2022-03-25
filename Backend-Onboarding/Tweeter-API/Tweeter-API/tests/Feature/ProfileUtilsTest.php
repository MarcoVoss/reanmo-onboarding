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
        $this->be(User::find(1));
        $this->get('/api/search/test')
            ->assertStatus(200);
    }

    public function test_search_failure_missing_parameter()
    {
        $this->be(User::find(1));
        $this->get('/api/search/')
            ->assertStatus(404);
    }

    public function test_news_success()
    {
        $this->be(User::find(1));
        $this->get('/api/news')
            ->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostLikesTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    private const MY_USER_ID = 1;
    private const NOT_EXISTING_ID = 100000;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_store_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->post('/api/posts/'.self::MY_USER_ID.'/like')
            ->assertStatus(201);
    }

    public function test_store_failure_wrong_id()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->post('/api/posts/'.self::NOT_EXISTING_ID.'/like')
            ->assertStatus(404);
    }
}

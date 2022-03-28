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

    public function test_index_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->get('/api/posts/'.self::MY_USER_ID.'/likes')
            ->assertStatus(200);
    }

    public function test_index_failure_wrong_comment_id()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->get('/api/posts/'.self::NOT_EXISTING_ID.'/likes')
            ->assertStatus(404);
    }

    public function test_store_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->post('/api/posts/'.self::MY_USER_ID.'/likes')
            ->assertStatus(201);
    }

    public function test_store_failure_wrong_id()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->post('/api/posts/'.self::NOT_EXISTING_ID.'/likes')
            ->assertStatus(404);
    }

    public function test_destroy_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->delete('/api/posts/'.self::MY_USER_ID.'/likes')
            ->assertStatus(204);
    }

    public function test_destroy_failure_wrong_id()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->delete('/api/posts/'.self::NOT_EXISTING_ID.'/likes')
            ->assertStatus(404);
    }
}

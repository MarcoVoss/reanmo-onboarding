<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostCommentTest extends TestCase
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
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->get("/api/posts/$user->id/comments")
            ->assertStatus(200);
    }

    public function test_index_failure_non_existing_post()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->get('/api/posts/'.self::NOT_EXISTING_ID.'/comments')
            ->assertStatus(404);
    }
}

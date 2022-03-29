<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    private const MY_USER_ID = 1;
    private const NOT_EXISTING_ID = 10000000;
    private const MY_COMMENT_ID = 1;
    private const OTHER_COMMENT_ID = 20;
    private const EXISTING_POST_ID = 1;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_store_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'post_id' => self::EXISTING_POST_ID,
            'message' => 'Test',
        ];
        $this->post('/api/comments', $data)
            ->assertStatus(201);
    }

    public function test_store_failure_post_does_not_exist()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'post_id' => self::NOT_EXISTING_ID,
            'message' => 'Test',
        ];
        $this->post('/api/comments', $data)
            ->assertStatus(302);
    }

    public function test_store_failure_missing_message()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'post_id' => self::EXISTING_POST_ID,
        ];
        $this->post('/api/comments', $data)
            ->assertStatus(302);
    }

    public function test_store_failure_no_data_presented()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [];
        $this->post('/api/comments', $data)
            ->assertStatus(302);
    }

    public function test_update_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'message' => 'Test',
        ];
        $this->put('/api/comments/'.self::MY_COMMENT_ID, $data)
            ->assertStatus(200);
    }

    public function test_update_failure_missing_message()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'post_id' => self::EXISTING_POST_ID,
        ];
        $this->put('/api/comments/'.self::MY_COMMENT_ID, $data)
            ->assertStatus(302);
    }

    public function test_update_failure_wrong_comment_id()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'message' => 'Test',
        ];
        $this->put("/api/comments/".self::NOT_EXISTING_ID, $data)
            ->assertStatus(404);
    }

    public function test_update_failure_unauthorized()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'message' => 'Test',
        ];
        $this->put("/api/comments/".self::OTHER_COMMENT_ID, $data)
            ->assertStatus(403);
    }

    public function test_destroy_failure_wrong_id()
    {
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->delete("/api/comments/".self::NOT_EXISTING_ID)
            ->assertStatus(404);
    }

    public function test_destroy_failure_unauthenticated()
    {
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->delete("/api/comments/".self::OTHER_COMMENT_ID)
            ->assertStatus(403);
    }

    public function test_destroy_success()
    {
        $user = User::find(self::MY_USER_ID);
        $this->be($user);
        $this->delete("/api/comments/".self::MY_COMMENT_ID)
            ->assertStatus(204);
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    private const MY_USER_ID = 1;
    private const MY_POST_ID = 1;
    private const OTHER_POST_ID = 20;
    private const NOT_EXISTING_ID = 100000;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_index()
    {
        $this->be(User::find(self::MY_USER_ID));
        $response = $this->get('/api/posts');
        $response->assertStatus(200);
    }

    public function test_show_failure()
    {
        $this->be(User::find(self::MY_USER_ID));
        $response = $this->get('/api/posts/'.self::NOT_EXISTING_ID);
        $response->assertStatus(404);
    }

    public function test_show_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $response = $this->get('/api/posts/'.self::MY_POST_ID);
        $response->assertStatus(200);
    }

    public function test_update_failure_unauthenticated()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'message' => 'Text'
        ];
        $response = $this->put('/api/posts/'.self::OTHER_POST_ID, $data);
        $response->assertStatus(403);
    }

    public function test_update_failure_missing_data()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [];
        $response = $this->put('/api/posts/'.self::MY_POST_ID, $data);
        $response->assertStatus(302);
    }

    public function test_update_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'message' => 'Text'
        ];
        $response = $this->put('/api/posts/'.self::MY_POST_ID, $data);
        $response->assertStatus(200);
    }

    public function test_store_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'message' => 'Text'
        ];
        $response = $this->post('/api/posts', $data);
        $response->assertStatus(201);
    }

    public function test_store_failure_missing_data()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [];
        $response = $this->post('/api/posts', $data);
        $response->assertStatus(302);
    }

    public function test_destroy_failure()
    {
        $this->be(User::find(self::MY_USER_ID));
        $response = $this->delete('/api/posts/'.self::OTHER_POST_ID);
        $response->assertStatus(403);
    }

//    public function test_destroy_success()
//    {
//        $this->be(User::find(self::MY_USER_ID));
//        $response = $this->delete('/api/posts/'.self::MY_POST_ID);
//        $response->assertStatus(204);
//    }
}

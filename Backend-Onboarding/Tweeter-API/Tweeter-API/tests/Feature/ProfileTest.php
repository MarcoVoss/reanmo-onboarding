<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
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

    public function loginWithFakeUser()
    {
        $this->be(User::find(self::MY_USER_ID));
    }

    public function test_profile_index_reachable()
    {
        $this->loginWithFakeUser();
        $response = $this->get('/api/profiles');
        $response->assertStatus(200);
    }

    public function test_profile_show_users_success()
    {
        $this->loginWithFakeUser();
        $response = $this->get('/api/profiles/');
        $response->assertStatus(200);
    }

    public function test_profile_show_user_failure()
    {
        $this->loginWithFakeUser();
        $response = $this->get('/api/profiles/'.self::NOT_EXISTING_ID);
        $response->assertStatus(404);
    }

    public function test_profile_show_user_success()
    {
        $this->loginWithFakeUser();
        $response = $this->get('/api/profiles/'.self::MY_USER_ID);
        $response->assertStatus(200);
    }

    public function test_update_success()
    {
        $this->loginWithFakeUser();
        $data = [
            'name' => 'Marco'
        ];
        $response = $this->put('/api/profiles/'.self::MY_USER_ID, $data);
        $response->assertStatus(200);
    }

    public function test_update_wrong_data()
    {
        $this->loginWithFakeUser();
        $data = [
            'name' => '5',
            'password' => 'd',
            'email' => 'll',
            'image_id' => 'f',
        ];
        $response = $this->put('/api/profiles/'.self::MY_USER_ID, $data);
        $response->assertStatus(302);
    }

    public function test_update_wrong_user()
    {
        $this->loginWithFakeUser();
        $data = [];
        $response = $this->put('/api/profiles/'.self::OTHER_USER_ID, $data);
        $response->assertStatus(403);
    }

    public function test_destroy_wrong_user()
    {
        $this->loginWithFakeUser();
        $response = $this->delete('/api/profiles/'.self::OTHER_USER_ID);
        $response->assertStatus(403);
    }

    public function test_destroy_success()
    {
        $this->loginWithFakeUser();
        $response = $this->delete('/api/profiles/'.self::MY_USER_ID);
        $response->assertStatus(204);
    }
}

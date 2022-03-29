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

    public function test_update_success()
    {
        $this->loginWithFakeUser();
        $data = [
            'name' => 'Marco'
        ];
        $response = $this->put('/api/profile', $data);
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
        $response = $this->put('/api/profile', $data);
        $response->assertStatus(302);
    }

    public function test_destroy_success()
    {
        $this->loginWithFakeUser();
        $response = $this->delete('/api/profile');
        $response->assertStatus(204);
    }
}

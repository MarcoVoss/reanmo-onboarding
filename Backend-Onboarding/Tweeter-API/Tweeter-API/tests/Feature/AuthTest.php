<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_user_registration_success() {
        $data = [
            'name' => 'Marco',
            'email' => 'marco@gmx.de',
            'password' => '#1LKNnmeE',
            'password_confirmation' => '#1LKNnmeE'
        ];
        $response = $this->post('/api/register', $data);
        $response->assertStatus(201);
    }

    public function test_user_registration_failure_missing_password_confirmation() {
        $data = [
            'name' => 'Marco',
            'email' => 'marco@gmx.de',
            'password' => '#1LKNnmeE',
        ];
        $response = $this->post('/api/register', $data);
        $response->assertStatus(302);
    }

    public function test_user_registration_failure_wrong_email() {
        $data = [
            'name' => 'Marco',
            'email' => 'marco_gmx_de',
            'password' => '#1LKNnmeE',
            'password_confirmation' => '#1LKNnmeE',
        ];
        $response = $this->post('/api/register', $data);
        $response->assertStatus(302);
    }

    public function test_user_duplicate_mail() {
        $data = [
            'name' => 'Marco',
            'email' => 'test@gmx.de',
            'image' => 'some/where',
            'password' => '#1LKNnmeE',
            'password_confirmation' => '#1LKNnmeE'
        ];
        $response = $this->post('/api/register', $data);
        $response->assertStatus(201);
        $response = $this->post('/api/register', $data);
        $response->assertStatus(302);
    }

    public function test_login_success() {
        $this->test_user_registration_success();
        $data = [
            'email' => 'marco@gmx.de',
            'password' => '#1LKNnmeE',
        ];
        $response = $this->post('/api/login', $data);
        $response->assertStatus(200);
    }

    public function test_login_wrong_credentials() {
        $user = User::find(1);
        $this->be($user);
        $data = [
            'email' => $user->email,
            'password' => 'nix'
        ];
        $response = $this->post('/api/login', $data);
        $response->assertStatus(401);
    }

    public function test_not_enough_credentials() {
        $data = [
            'password' => 'bla',
        ];
        $response = $this->post('/api/login', $data);
        $response->assertStatus(302);
    }

    public function test_logout() {
        $this->be(User::find(1));
        $this->post('/api/logout')->assertStatus(204);
    }
}

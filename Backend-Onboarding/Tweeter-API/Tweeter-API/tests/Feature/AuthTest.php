<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_registration_success() {
        $data = [
            'name' => 'Marco',
            'email' => 'marco@gmx.de',
            'image' => 'some/where',
            'password' => '!1password',
            'password_confirmation' => '!1password'
        ];
        $response = $this->post('/api/register', $data);
        $response->assertStatus(201);
    }

    public function test_user_registration_failure_missing_password_confirmation() {
        $data = [
            'name' => 'Marco',
            'email' => 'marco@gmx.de',
            'password' => '!1password',
        ];
        $response = $this->post('/api/register', $data);
        $response->assertStatus(302);
    }

    public function test_user_registration_failure_wrong_email() {
        $data = [
            'name' => 'Marco',
            'email' => 'marco_gmx_de',
            'password' => '!1password',
            'password_confirmation' => '!1password',
            'image' => 'some/where',
        ];
        $response = $this->post('/api/register', $data);
        $response->assertStatus(302);
    }

    public function test_user_duplicate_mail() {
        $data = [
            'name' => 'Marco',
            'email' => 'test@gmx.de',
            'image' => 'some/where',
            'password' => '!1password',
            'password_confirmation' => '!1password'
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
            'password' => '!1password',
        ];
        $response = $this->post('/api/login', $data);
        $response->assertStatus(200);
    }

    public function test_login_wrong_credentials() {
        $data = [
            'email' => 'bla@gmx.de',
            'password' => 'bla',
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
}

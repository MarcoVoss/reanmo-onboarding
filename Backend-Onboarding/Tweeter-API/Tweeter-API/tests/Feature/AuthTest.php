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
            'password' => 'password',
            'password_confirmation' => 'password'
        ];
        $response = $this->post('/api/register', $data);
        $response->assertStatus(201);
    }

    public function test_user_registration_failure_missing_password_confirmation() {
        $data = [
            'name' => 'Marco',
            'email' => 'marco@gmx.de',
            'password' => 'password',
        ];
        $response = $this->post('/api/register', $data);
        $response->assertStatus(302);
    }

    public function test_user_registration_failure_wrong_email() {
        $data = [
            'name' => 'Marco',
            'email' => 'marco_gmx_de',
            'password' => 'password',
            'password_confirmation' => 'password',
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
            'password' => 'password',
            'password_confirmation' => 'password'
        ];
        $response = $this->post('/api/register', $data);
        $response->assertStatus(201);

        $response = $this->post('/api/register', $data);
        $response->assertStatus(302);
    }
}

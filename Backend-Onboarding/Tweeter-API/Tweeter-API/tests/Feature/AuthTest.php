<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    private ?User $user = null;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->user = User::factory()->makeOne();
    }

    private function generateUserLoginData(User $user)
    {
        return [
            'email' => $user->email,
            'password' => $user->password,
        ];
    }

    private function generateUserRegisterData(User $user)
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password
        ];
    }


    public function test_user_registration_success() {

        $response = $this->post('/api/register', $this->generateUserRegisterData($this->user));
        $response->assertStatus(201);
    }

    public function test_user_registration_failure_missing_password_confirmation() {
        $data = $this->generateUserRegisterData($this->user);
        unset($data['password_confirmation']);
        $response = $this->post('/api/register', $data);
        $response->assertStatus(302);
    }

    public function test_user_registration_failure_wrong_email() {
        $data = $this->generateUserRegisterData($this->user);
        $data['email'] = 'marco_gmx_de';
        $response = $this->post('/api/register', $data);
        $response->assertStatus(302);
    }

    public function test_user_duplicate_mail() {
        $data = $this->generateUserRegisterData($this->user);
        $response = $this->post('/api/register', $data);
        $response->assertStatus(201);
        $response = $this->post('/api/register', $data);
        $response->assertStatus(302);
    }

    public function test_login_success() {
        $this->test_user_registration_success();
        $data = $this->generateUserLoginData($this->user);
        $response = $this->post('/api/login', $data);
        $response->assertStatus(200);
        $this->assertIsString($response['token']);
        $response->assertJson([
            "user" => [
                "name" => $this->user->name,
                "email" => $this->user->email
            ],
        ]);
        $this->assertIsInt($response["user"]["id"]);
        $this->assertIsString($response["token"]);
    }

    public function test_login_wrong_credentials() {
        $user = User::find(1);
        $this->be($user);
        $data = $this->generateUserLoginData($this->user);
        $data['password'] = 'nix';
        $response = $this->post('/api/login', $data);
        $response->assertStatus(401);
    }

    public function test_not_enough_credentials() {
        $response = $this->post('/api/login');
        $response->assertStatus(302);
    }

    public function test_logout() {
        $this->be($this->user);
        $this->post('/api/logout')->assertStatus(204);
    }
}

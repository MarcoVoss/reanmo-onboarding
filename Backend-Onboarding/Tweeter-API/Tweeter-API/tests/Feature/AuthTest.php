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

    public function test_CanRegister()
    {
        $user = User::factory()->makeOne();
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password
        ];
        $this->post("/api/register", $data)
            ->assertCreated();
    }

    public function test_CanLogin()
    {
        $user = User::factory()->create();
        $response = $this->post("/api/login", [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertOk()
            ->assertJson([
            "user" => [
                "name" => $user->name,
                "email" => $user->email
            ],
        ]);
        $this->assertIsString($response['token']);
        $this->assertIsInt($response["user"]["id"]);
        $this->assertIsString($response["token"]);
    }

    public function test_CantRegisterWithoutBody()
    {
        $this->post('/api/register')
            ->assertStatus(302);
    }

    public function test_user_registration_failure_missing_password_confirmation() {
        $response = $this->post('/api/register', [
            'name' => 'Name',
            'email' => 'no_mail.de',
            'password' => 'badPassword',
            'password_confirmation' => 'badPassword'
        ])->assertStatus(302);
    }

    public function test_ItDoesNotAllowDuplicatedEmail() {
        $user = User::factory()->makeOne();
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password
        ];
        $this->post("/api/register", $data)
            ->assertCreated();
        $this->post("/api/register", $data)
            ->assertStatus(302);
    }

    public function test_CantLoginWithWrongCredentials() {
        $user = User::factory()->makeOne();
        $this->post("/api/login", [
            'email' => $user->email,
            'password' => 'password',
        ])->assertStatus(401);
    }

    public function test_CantLoginWithoutCredentials() {
        $this->post("/api/login")
            ->assertStatus(302);
    }

    public function test_ItDoesNotAllowLoginWithoutBody() {
        $this->post('/api/login')
            ->assertStatus(302);
    }

    public function test_LogoutSuccess() {
        $user = User::factory()->create();
        $this->be($user);
        $this->post('/api/logout')->assertStatus(204);
    }
}

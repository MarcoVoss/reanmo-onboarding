<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_CanResetPassword()
    {
        $password = "1TtPassIt!";
        $newPassword = "1TtPassIt!";
        $user = User::create([
            'name' => "Marco",
            'email' => "marcovoss.wichtig@gmx.de",
            'password' => bcrypt($password),
            'image_id' => null
        ]);
        $this->be($user);
        $this->put("/api/password-reset", [
            'current' => $password,
            'password' => $newPassword,
            'password_confirmation' => $newPassword
        ])->assertOk();
    }

    public function test_CantResetPasswordWithWrongCurrent()
    {
        $password = "1TtPassIt!";
        $newPassword = "1TtPassIt!";
        $user = User::create([
            'name' => "Marco",
            'email' => "marcovoss.wichtig@gmx.de",
            'password' => bcrypt($password),
            'image_id' => null
        ]);
        $this->be($user);
        $this->put("/api/password-reset", [
            'current' => "ThisIsWrong",
            'password' => $newPassword,
            'password_confirmation' => $newPassword
        ])->assertStatus(401);
    }

    public function test_CantResetPasswordWithMissingBody()
    {
        $password = "1TtPassIt!";
        $user = User::create([
            'name' => "Marco",
            'email' => "marcovoss.wichtig@gmx.de",
            'password' => bcrypt($password),
            'image_id' => null
        ]);
        $this->be($user);
        $this->put("/api/password-reset")
            ->assertStatus(302);
    }
}

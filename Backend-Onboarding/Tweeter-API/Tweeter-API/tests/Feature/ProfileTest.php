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

    public function test_CanUpdateData()
    {
        $user = User::factory()->create();
        $this->be($user);
        $this->put('/api/profile', [
            'name' => 'Marco'
        ])->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'follows' =>  false,
            ])
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'image',
                'follows',
            ]);
    }

    public function test_CanDeleteProfile()
    {
        $user = User::factory()->create();
        $this->be($user);
        $this->delete('/api/profile')
            ->assertStatus(204);
    }
}

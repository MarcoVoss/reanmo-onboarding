<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProfileImageTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_CanUploadProfileImage()
    {
        $this->be(User::factory()->create());
        $this->put('/api/profile/image', [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ])->assertStatus(201);
    }

    public function test_CanDeleteProfileImage()
    {
        $this->be(User::factory()->create());
        $this->put('/api/profile/image', [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ])->assertStatus(201);
        $this->put('/api/profile/image')
            ->assertStatus(204);
    }

    public function test_CanNotUploadOtherFile()
    {
        $this->be(User::factory()->create());
        $this->put('/api/profile/image', [
            'image' => UploadedFile::fake()->create("Test.txt"),
        ])->assertStatus(302);
    }
}

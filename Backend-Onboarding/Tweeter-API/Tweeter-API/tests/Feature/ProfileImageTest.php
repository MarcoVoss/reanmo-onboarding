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

    private const MY_USER_ID = 1;
    private const OTHER_USER_ID = 2;
    private const NOT_EXISTING_ID = 100000;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_update_success()
    {
        $this->be(User::find(self::MY_USER_ID));
        $data = [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ];
        $this->put('/api/profile/image', $data)
            ->assertStatus(201);
    }

    public function test_update_success_no_image()
    {
        $this->be(User::find(self::MY_USER_ID));
        $this->put('/api/profile/image')
            ->assertStatus(204);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PostImageTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_CanUploadImage()
    {
        $user = User::factory()->create();
        $post = $user->posts()->create([
            "message" => "Test"
        ]);
        $this->be($user);
        $this->put('/api/posts/'.$post->id.'/image', [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ])->assertCreated();
        $this->put('/api/posts/'.$post->id.'/image')
            ->assertStatus(204);
    }

    public function test_ImageToPostsRelationWorks()
    {
        $user = User::factory()->create();
        $post = $user->posts()->create([
            "message" => "Test"
        ]);
        $this->be($user);
        $image = Image::create([
            "path" => "Leer",
        ]);
        $post->image()->associate($image);
        $post->save();
        $this->assertCount(1, $image->posts);
    }

    public function test_CanNotUpdateOthersImage()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $post = $otherUser->posts()->create([
            "message" => "Test"
        ]);
        $this->be($user);
        $this->put('/api/posts/'.$post->id.'/image', [
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ])->assertStatus(403);
        $this->put('/api/posts/'.$post->id.'/image')
            ->assertStatus(403);
    }
}

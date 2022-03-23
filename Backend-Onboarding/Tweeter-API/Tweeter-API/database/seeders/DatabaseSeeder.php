<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

use Database\Factories\CommentFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create();
        Post::factory(10)->create();
        Comment::factory(10)->create();
        Image::factory(10)->create();
    }
}

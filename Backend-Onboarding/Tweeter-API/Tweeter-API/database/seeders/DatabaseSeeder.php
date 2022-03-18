<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\PostLike;
use App\Models\Follower;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create();
        Post::factory(10)->create();
        Comment::factory(10)->create();
        CommentLike::factory(10)->create();
        PostLike::factory(10)->create();
        Follower::factory(10)->create();
    }
}

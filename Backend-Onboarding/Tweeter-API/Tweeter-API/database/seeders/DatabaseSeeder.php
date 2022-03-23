<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $users = User::factory(10)->create();
        $posts = Post::factory(10)->create();
        $comments = Comment::factory(10)->create();
        $images = Image::factory(10)->create();
        foreach ($users as $user) {
            $user->commentLikes()->saveMany($comments);
            $user->postLikes()->saveMany($posts);
            $user->save(['image' => $images->random()]);
            $user->comments()->saveMany(Comment::factory(10)->create());
            $user->follower()->saveMany($users);
        }
    }
}

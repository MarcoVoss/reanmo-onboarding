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
        $posts = [];
        $comments = [];
//        $images = Image::factory(10)->create();
        foreach ($users as $user) {
            $posts = array_merge($posts, $this->createPosts($user, 10));
            $comments = array_merge($comments, $this->createComments($user, $posts[0], 10));

//            $user->commentLikes()->saveMany($comments);
//            $user->postLikes()->saveMany($posts);
//            $user->save(['image' => $images->random()]);
//            $user->comments()->saveMany(Comment::factory(10)->create());
//            $user->follower()->saveMany($users);
        }
    }

    private function createPosts($user, $count){
        $posts = [];
        for ($i = 0; $i < $count; $i++) {
            $posts[] = $user->posts()->create([
                'message' => 'Test',
                'user_id' => $user->id,
            ]);
        }
        return $posts;
    }

    private function createComments($user, $post, $count){
        $comments = [];
        for ($i = 0; $i < $count; $i++) {
            $comments[] = $post->comments()->create([
                'message' => 'Test',
                'post_id' => $post->id,
                'user_id' => $user->id,
            ]);
        }
        return $comments;
    }
}

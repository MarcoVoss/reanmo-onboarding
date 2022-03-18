<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostLikeFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'post_id' => Post::factory()
        ];
    }
}

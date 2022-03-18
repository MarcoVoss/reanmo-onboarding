<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentLikeFactory extends Factory
{
    public function definition()
    {
        return [
            'comment_id' => Comment::factory(),
            'user_id' => User::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowerFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'follower_id' => User::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PostFactory extends Factory
{
    public function definition()
    {
        return [
            'message' => $this->faker->sentence(),
            'user_id' => User::factory(),
        ];
    }
}

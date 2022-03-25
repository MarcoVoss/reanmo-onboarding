<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PostFactory extends Factory
{
    public function definition()
    {
        return [
            'message' => $this->faker->sentence(),
            'image_id' => Image::factory(),
        ];
    }
}

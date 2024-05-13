<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->company,
            'short_description'=>fake()->paragraph,
            'long_description'=>fake()->paragraph,
            'author'=>1,
            'thumbnail'=> 'thumbnails/N2OGj6wxlR9bQicQYkQBPh17HOyN6vCNtk8zpFGW.png',
            'category_id'=>fake()->numberBetween(1,9)
        ];
    }
}

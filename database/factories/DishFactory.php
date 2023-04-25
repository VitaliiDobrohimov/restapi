<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserController>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'name' => fake()->unique()->name(),
            'image'=> fake()->filePath(),
            'url'=> fake()->imageUrl,
           'composition' => fake()->text,
            'calories' => fake()->randomNumber(),
            'cost' => fake()->numberBetween(1000,10000),
            'category_id' => fake()->numberBetween(1,9),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

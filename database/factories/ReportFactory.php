<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserController>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'created_at' => now(),
            'updated_at' => now(),
            'total_cost' => fake()->numberBetween(1000,9999999),
            'total_orders' => fake()->numberBetween(1,500),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */

}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserController>
 */
class ResetPasswordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email'=>fake()->email,
            'pin_code' => fake()->numberBetween(1000,9999999),
            'expires_at'=>Carbon::now()->addHour(),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */

}

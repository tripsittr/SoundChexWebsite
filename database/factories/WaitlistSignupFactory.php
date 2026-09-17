<?php

namespace Database\Factories;

use App\Models\WaitlistSignup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WaitlistSignup>
 */
class WaitlistSignupFactory extends Factory
{
    /**
     * @return array{email: string}
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
           
                'name' => $this->faker->name(),
                'user_name' => $this->faker->userName(),
                'email' => $this->faker->unique()->safeEmail(),
                'password' => Hash::make('password'), // Hashed password
                'created_at' => now(),
                'updated_at' => now(),
           
        ];
    }
}

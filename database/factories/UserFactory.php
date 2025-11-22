<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
            // 'remember_token' dan 'email_verified_at' sudah dihapus - BENAR
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     * Karena kolom 'email_verified_at' tidak ada, method ini bisa dihapus
     */
    // public function unverified(): static
    // {
    //     return $this->state(fn (array $attributes) => [
    //         // kosong karena kolom tidak ada
    //     ]);
    // }
}
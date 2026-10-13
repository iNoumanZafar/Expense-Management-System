<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the users table with 30 users.
     *
     * Every user's password is: password
     */
    public function run(): void
    {
        // Fixed accounts, so you always know one admin and one user login
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'user_type' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'user_type' => 'user',
        ]);

        // 28 random users with a random user type and join date
        User::factory(28)
            ->state(function () {
                $joinedAt = fake()->dateTimeBetween('-6 months', 'now');

                return [
                    'user_type' => fake()->randomElement(['admin', 'user']),
                    'created_at' => $joinedAt,
                    'updated_at' => $joinedAt,
                ];
            })
            ->create();
    }
}

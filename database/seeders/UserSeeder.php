<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create the Admin only if it does not already exist
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => 'password',
                'user_type' => 'admin',
            ]
        );

        // Create the Test User only if it does not already exist
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Test User',
                'password' => 'password',
                'user_type' => 'user',
            ]
        );

        // Create 28 random users only if you still need them.
        // Remove this block if you have already created your 28 test users.
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

        // Allocate a random monthly budget to every user
        // who does not already have one.
        User::whereNull('monthly_budget')
            ->each(function (User $user) {
                $user->update([
                    'monthly_budget' => fake()->randomFloat(
                        2,
                        10000,
                        100000
                    ),
                ]);
            });
    }
}

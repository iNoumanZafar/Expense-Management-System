<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // The order matters:
        // 1. Categories first, because every expense needs a category
        // 2. Users next, because every expense needs a user
        // 3. Expenses last (they also set each user's budget)
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            ExpenseSeeder::class,
        ]);
    }
}

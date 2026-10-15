<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Add the default expense categories.
     * Safe to run again: a category that already exists (same name) is skipped.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Food', 'description' => 'Groceries, restaurants, take-away, snacks and drinks.'],
            ['name' => 'Travel', 'description' => 'Flights, train and bus tickets, hotels and holiday costs.'],
            ['name' => 'Transport', 'description' => 'Fuel, taxis, ride apps, public transport, parking and tolls.'],
            ['name' => 'Rent', 'description' => 'Monthly house or flat rent and property maintenance charges.'],
            ['name' => 'Utilities', 'description' => 'Electricity, gas, water and other household bills.'],
            ['name' => 'Internet & Phone', 'description' => 'Mobile packages, phone bills, broadband and Wi-Fi.'],
            ['name' => 'Shopping', 'description' => 'Clothes, shoes, accessories and general purchases.'],
            ['name' => 'Health', 'description' => 'Doctor visits, medicines, lab tests and hospital bills.'],
            ['name' => 'Education', 'description' => 'School or university fees, courses, books and stationery.'],
            ['name' => 'Entertainment', 'description' => 'Movies, events, games, hobbies and outings.'],
            ['name' => 'Subscriptions', 'description' => 'Streaming services, apps, software and memberships.'],
            ['name' => 'Household', 'description' => 'Cleaning supplies, furniture, appliances and home repairs.'],
            ['name' => 'Personal Care', 'description' => 'Salon, barber, cosmetics, toiletries and gym.'],
            ['name' => 'Gifts & Donations', 'description' => 'Presents for family and friends, charity and zakat.'],
            ['name' => 'Insurance', 'description' => 'Health, car, home and life insurance payments.'],
            ['name' => 'Other', 'description' => 'Any expense that does not fit in the other categories.'],
        ];

        foreach ($categories as $category) {
            // Find by name; only create it if it does not exist yet
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}

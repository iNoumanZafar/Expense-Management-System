<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Recipe for ONE fake expense.
 * The title and amount always fit the category.
 *
 * @extends Factory<Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * For each category: [possible titles, min amount, max amount]
     * The names must match the names in CategorySeeder.
     */
    protected array $presets = [
        // Everyday spending
        'Food' => [['Groceries', 'Lunch', 'Dinner out', 'Take-away', 'Snacks', 'Coffee'], 200, 3000],
        'Transport' => [['Fuel', 'Taxi', 'Ride app', 'Bus ticket', 'Parking'], 150, 2500],
        'Shopping' => [['Clothes', 'Shoes', 'Online order'], 800, 8000],
        'Health' => [['Medicines', 'Doctor visit', 'Lab test'], 300, 5000],
        'Entertainment' => [['Movie tickets', 'Outing with friends', 'Game'], 500, 4000],
        'Personal Care' => [['Barber', 'Salon', 'Toiletries'], 300, 3000],
        'Other' => [['Stationery', 'Courier', 'Miscellaneous'], 100, 1500],

        // Monthly bills (the seeder adds these on fixed days)
        'Rent' => [['House rent'], 15000, 30000],
        'Utilities' => [['Electricity bill', 'Gas bill', 'Water bill'], 1500, 8000],
        'Internet & Phone' => [['Internet bill', 'Mobile package'], 1000, 3000],
    ];

    /**
     * Categories for a normal day. Food is listed 3 times
     * and Transport 2 times, so they are picked more often.
     */
    protected array $everyday = [
        'Food', 'Food', 'Food', 'Transport', 'Transport',
        'Shopping', 'Health', 'Entertainment', 'Personal Care', 'Other',
    ];

    /**
     * The default recipe: a random everyday expense.
     */
    public function definition(): array
    {
        $categoryName = fake()->randomElement($this->everyday);

        return $this->fieldsFor($categoryName);
    }

    /**
     * A named state for a chosen category.
     * Example: Expense::factory()->forCategory('Rent')->create([...])
     */
    public function forCategory(string $categoryName): static
    {
        return $this->state(fn () => $this->fieldsFor($categoryName));
    }

    /**
     * Build the columns for one expense in the given category.
     */
    protected function fieldsFor(string $categoryName): array
    {
        // Unpack the preset, e.g. $titles = [...], $min = 200, $max = 3000
        [$titles, $min, $max] = $this->presets[$categoryName];

        return [
            // The seeder will pass user_id and expense_date itself.
            // These two are only used if you call the factory on its own.
            'user_id' => User::factory(),
            'expense_date' => fake()->dateTimeBetween('-6 months', 'now'),

            'category_id' => Category::where('name', $categoryName)->value('id'),
            'title' => fake()->randomElement($titles),
            'amount' => fake()->randomFloat(2, $min, $max),   // 2 decimal places
            'description' => fake()->optional(0.3)->sentence(), // 30% get a note, the rest null
        ];
    }
}

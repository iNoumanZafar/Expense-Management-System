<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Give every normal user about 6 months of demo expenses, up to today.
     * Safe to run again: a user who already has expenses is skipped.
     */
    public function run(): void
    {
        // Only normal users get expenses, not admins
        $users = User::where('user_type', 'user')->get();

        foreach ($users as $user) {
            // Skip users who already have expenses (no double data)
            if (Expense::where('user_id', $user->id)->exists()) {
                continue;
            }

            // Start on the 1st of the month, 6 months ago
            // (dates depend on now(), so "this month" always has data)
            $day = now()->subMonths(6)->startOfMonth();

            // Go day by day until today (never a future date)
            while ($day->lte(today())) {
                // These columns are the same for every expense of this day
                $fields = [
                    'user_id' => $user->id,
                    'expense_date' => $day->toDateString(),
                ];

                // Monthly bills on fixed days
                if ($day->day === 1) {
                    Expense::factory()->forCategory('Rent')->create($fields);
                }
                if ($day->day === 10) {
                    Expense::factory()->forCategory('Utilities')->create($fields);
                }
                if ($day->day === 15) {
                    Expense::factory()->forCategory('Internet & Phone')->create($fields);
                }

                // 0 to 3 random everyday expenses (0 = a day with no spending)
                $count = fake()->numberBetween(0, 3);
                Expense::factory($count)->create($fields);

                $day->addDay();
            }

            // Give the user a budget that fits their own spending.
            // Total of the 6 full months before this one, divided by 6 = average per month
            $spentBefore = Expense::where('user_id', $user->id)
                ->where('expense_date', '<', now()->startOfMonth())
                ->sum('amount');
            $averagePerMonth = $spentBefore / 6;

            // Budget = average x 0.9 to 1.3, so some users stay under and some go over.
            // round(..., -3) rounds to the nearest 1000, e.g. 84317 -> 84000
            $user->monthly_budget = round($averagePerMonth * fake()->randomFloat(2, 0.9, 1.3), -3);
            $user->save();
        }
    }
}

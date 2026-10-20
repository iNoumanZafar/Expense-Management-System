<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // Show the user dashboard
    public function index()
    {
        // Card 1: total of this user's expenses in the current month
        $spentThisMonth = Expense::where('user_id', auth()->id())
            ->whereYear('expense_date', now()->year)
            ->whereMonth('expense_date', now()->month)
            ->sum('amount');

        // Card 2: the user's own budget (null if not set yet)
        $budget = auth()->user()->monthly_budget;

        // Card 3: what is left, and how much of the budget is used (in %)
        $remaining = null;
        $percentUsed = 0;

        if ($budget > 0) {
            $remaining = $budget - $spentThisMonth;
            $percentUsed = round($spentThisMonth / $budget * 100);
        }

        // Card 4: all of this user's expenses dated today
        $todayExpenses = Expense::where('user_id', auth()->id())
            ->whereDate('expense_date', today())
            ->get();
        $start = Carbon::now()->startOfMonth();
        $daysInMonth = Carbon::now()->daysInMonth;

          // Get total expenses for each day
        $expenses = Expense::where('user_id', auth()->id())
            ->whereBetween('expense_date', [
                $start->toDateString(),
                Carbon::now()->toDateString(),
            ])
            ->selectRaw('DAY(expense_date) as day, SUM(amount) as total')
            ->groupBy('day')
            ->pluck('total', 'day');

         // Prepare chart data
        $dailySpendingLabels = range(1, $daysInMonth);
        $dailySpendingData = [];

        foreach ($dailySpendingLabels as $day) {
            $dailySpendingData[] = (float) ($expenses[$day] ?? 0);
        }
        return view('user.dashboard', [
            'spentThisMonth' => $spentThisMonth,
            'remaining' => $remaining,
            'percentUsed' => $percentUsed,
            'todayExpenses' => $todayExpenses,
            'dailySpendingLabels' => $dailySpendingLabels,
            'dailySpendingData' => $dailySpendingData,
        ]);
    }

    // Save the user's monthly budget
    public function updateBudget(Request $request)
    {
        $validated = $request->validate([
            'monthly_budget' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],
        ]);

        // Save it on the logged-in user
        $request->user()->update([
            'monthly_budget' => $validated['monthly_budget'],
        ]);

        return redirect()->route('user.dashboard')->with(
            'success',
            'Budget saved successfully.'
        );
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Expense;


class ExpenseController extends Controller
{
    // Show all expenses of the logged-in user
    public function index()
    {
        $expenses = Expense::where('user_id', auth()->id())
            ->with('category')
            ->latest('expense_date')
            ->get();

        return view('user.expenses', [
            'expenses' => $expenses,
        ]);
    }

    // Show the Add Expense form
    public function create()
    {
        return view('user.add-expense', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
    // Save the expense
      
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01', 'max:9999999999.99'],
            'expense_date' => ['required', 'date', 'before_or_equal:today'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        Expense::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'amount' => $validated['amount'],
            'expense_date' => $validated['expense_date'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->back()->with(
            'success',
            'Expense added successfully.'
        );
    }

    // Show the Edit Expense form
    public function edit($id)
    {
        // Find the expense by its id (shows a 404 page if it does not exist)
        $expense = Expense::findOrFail($id);

        // Users can only edit their own expenses
        abort_if($expense->user_id !== auth()->id(), 403);

        return view('user.edit-expense', [
            'expense' => $expense,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    // Save the changes
    public function update(Request $request, Expense $expense)
    {
        // Users can only update their own expenses
        abort_if($expense->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01', 'max:9999999999.99'],
            'expense_date' => ['required', 'date', 'before_or_equal:today'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $expense->update([
            'title' => $validated['title'],
            'amount' => $validated['amount'],
            'expense_date' => $validated['expense_date'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('user.expenses.index')->with(
            'success',
            'Expense updated successfully.'
        );
    }

    // Delete the expense (soft delete: the row stays in the database with deleted_at filled)
    public function destroy($id)
    {
        // Find the expense by its id (shows a 404 page if it does not exist)
        $expense = Expense::findOrFail($id);

        // Users can only delete their own expenses
        abort_if($expense->user_id !== auth()->id(), 403);

        $expense->delete();

        return redirect()->route('user.expenses.index')->with(
            'success',
            'Expense deleted successfully.'
        );
    }

}

<x-app-layout>
<div class="dash-wrap">

    @include('user.sidebar', [
        'tipTitle' => 'Edit expense',
        'tipText' => 'Fix a wrong amount, date or category. The change is saved right away.',
    ])

    {{-- This page needs 2 variables from the controller:
         $expense    = the expense to edit
         $categories = all categories for the dropdown --}}


    <!-- ===== Page content (right side) ===== -->
    <div class="dash-page">

        <!-- ===== Page banner ===== -->
        <div class="dash-welcome">
            <div>
                <p class="dash-date">{{ now()->format('l, d F Y') }}</p>
                <h1>Edit expense</h1>
                <p>Change the details of "{{ $expense->title }}" and save.</p>
            </div>

            <div>
                <a href="{{ route('user.expenses.index') }}" class="btn-white">&larr; Back to expenses</a>
            </div>
        </div>


        <!-- ===== Edit form (left) + saved details (right) ===== -->
        <div class="dash-grid">

            <!-- Edit form -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>Expense details</h2>
                        <p class="dash-muted">Fields with * are required</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('user.expenses.update', $expense) }}">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">Title *</label>
                        <input id="title" type="text" name="title" value="{{ old('title', $expense->title) }}"
                               placeholder="e.g. Groceries" required maxlength="255"
                               class="form-input @error('title') is-invalid @enderror">
                        @error('title')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amount + date side by side -->
                    <div class="form-row">

                        <!-- Amount -->
                        <div class="form-group">
                            <label for="amount">Amount *</label>
                            <div class="input-prefix">
                                <span>$</span>
                                <input id="amount" type="number" name="amount" value="{{ old('amount', $expense->amount) }}"
                                       placeholder="0.00" required min="0.01" step="0.01"
                                       class="form-input @error('amount') is-invalid @enderror">
                            </div>
                            @error('amount')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date (no future dates) -->
                        <div class="form-group">
                            <label for="expense_date">Date *</label>
                            <input id="expense_date" type="date" name="expense_date"
                                   value="{{ old('expense_date', $expense->expense_date->toDateString()) }}"
                                   required max="{{ now()->toDateString() }}"
                                   class="form-input @error('expense_date') is-invalid @enderror">
                            @error('expense_date')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Category (the saved one is selected) -->
                    <div class="form-group">
                        <label for="category_id">Category *</label>
                        <select id="category_id" name="category_id" required
                                class="form-input @error('category_id') is-invalid @enderror">
                            <option value="">Choose a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $expense->category_id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description <span class="dash-muted">(optional)</span></label>
                        <textarea id="description" name="description" rows="3" maxlength="1000"
                                  placeholder="e.g. Weekly shopping from the market"
                                  class="form-input @error('description') is-invalid @enderror">{{ old('description', $expense->description) }}</textarea>
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Save + Cancel -->
                    <div class="form-actions">
                        <button type="submit" class="register-btn">Update expense</button>
                        <a href="{{ route('user.expenses.index') }}" class="btn-cancel">Cancel</a>
                    </div>
                </form>
            </div>

            <!-- What is saved right now -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>Saved details</h2>
                        <p class="dash-muted">Before your changes</p>
                    </div>
                </div>

                <ul class="setting-list">
                    <li>
                        <span class="setting-key">Title</span>
                        <div class="expense-info"><p>{{ $expense->title }}</p></div>
                    </li>
                    <li>
                        <span class="setting-key">Amount</span>
                        <div class="expense-info"><p>${{ number_format($expense->amount, 2) }}</p></div>
                    </li>
                    <li>
                        <span class="setting-key">Date</span>
                        <div class="expense-info"><p>{{ $expense->expense_date->format('d M Y') }}</p></div>
                    </li>
                    <li>
                        <span class="setting-key">Category</span>
                        <div class="expense-info"><p>{{ $expense->category?->name ?? 'Uncategorized' }}</p></div>
                    </li>
                    <li>
                        <span class="setting-key">Added</span>
                        <div class="expense-info"><p>{{ $expense->created_at?->format('d M Y, h:i A') }}</p></div>
                    </li>
                    <li>
                        <span class="setting-key">Updated</span>
                        <div class="expense-info"><p>{{ $expense->updated_at?->format('d M Y, h:i A') }}</p></div>
                    </li>
                </ul>
            </div>

        </div>

    </div>

</div>
</x-app-layout>

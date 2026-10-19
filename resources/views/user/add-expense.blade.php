<x-app-layout>
<div class="dash-wrap">

    @include('user.sidebar', [
        'tipTitle' => 'Add expense',
        'tipText' => 'Save every expense on the day you spend it, so nothing is forgotten.',
    ])


    <!-- ===== Page content (right side) ===== -->
    <div class="dash-page">

        <!-- ===== Page banner ===== -->
        <div class="dash-welcome">
            <div>
                <p class="dash-date">{{ now()->format('l, d F Y') }}</p>
                <h1>Add an expense</h1>
                <p>Write down what you spent, how much, and on which day.</p>
            </div>

            <div>
                <a href="{{ route('user.dashboard') }}" class="btn-white">&larr; Back to dashboard</a>
            </div>
        </div>


        <!-- ===== Green message after saving ===== -->
        @if (session('success'))
            <div class="dash-alert">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif


        <!-- ===== Add expense form (left) + tips (right) ===== -->
        <div class="dash-grid">

            <!-- Add expense form -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>Expense details</h2>
                        <p class="dash-muted">Fields with * are required</p>
                    </div>
                </div>

                @if (count($categories ?? []) > 0)

                    <form method="POST" action="{{ route('user.expenses.store') }}">
                        @csrf

                        <!-- Title -->
                        <div class="form-group">
                            <label for="title">Title *</label>
                            <input id="title" type="text" name="title" value="{{ old('title') }}"
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
                                    <input id="amount" type="number" name="amount" value="{{ old('amount') }}"
                                           placeholder="0.00" required min="0.01" step="0.01"
                                           class="form-input @error('amount') is-invalid @enderror">
                                </div>
                                @error('amount')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date (today by default, no future dates) -->
                            <div class="form-group">
                                <label for="expense_date">Date *</label>
                                <input id="expense_date" type="date" name="expense_date" value="{{ old('expense_date', now()->toDateString()) }}"
                                       required max="{{ now()->toDateString() }}"
                                       class="form-input @error('expense_date') is-invalid @enderror">
                                @error('expense_date')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category_id">Category *</label>
                            <select id="category_id" name="category_id" required
                                    class="form-input @error('category_id') is-invalid @enderror">
                                <option value="">Choose a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
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
                                      class="form-input @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="register-btn">Save expense</button>
                    </form>

                @else
                    <!-- Shown when the admin has not added any categories yet -->
                    <div class="setting-empty">
                        <span class="stat-icon icon-orange">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.5 0 1 .2 1.4.6l7 7a2 2 0 010 2.8l-7 7a2 2 0 01-2.8 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                        </span>
                        <p>No categories yet</p>
                        <small>An admin needs to add categories before you can add an expense.</small>
                    </div>
                @endif
            </div>

            <!-- Tips + the categories the user can pick from -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>Quick tips</h2>
                        <p class="dash-muted">For clean and useful records</p>
                    </div>
                </div>

                <ul class="expense-list">
                    <li>
                        <span class="preview-icon icon-travel">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.4-9.4a2 2 0 112.8 2.8L11.8 15H9v-2.8l8.6-8.6z"/></svg>
                        </span>
                        <div class="expense-info">
                            <p>Use a short title</p>
                            <small>"Groceries" or "Fuel" is easier to find later.</small>
                        </div>
                    </li>
                    <li>
                        <span class="preview-icon icon-save">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.7 0-3 .9-3 2s1.3 2 3 2 3 .9 3 2-1.3 2-3 2m0-8c1.1 0 2.1.4 2.6 1M12 8V7m0 1v8m0 0v1m0-1c-1.1 0-2.1-.4-2.6-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <div class="expense-info">
                            <p>Enter the exact amount</p>
                            <small>Cents are allowed, for example 84.20.</small>
                        </div>
                    </li>
                    <li>
                        <span class="preview-icon icon-bills">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </span>
                        <div class="expense-info">
                            <p>Pick the right date</p>
                            <small>It is today by default. Future dates are not allowed.</small>
                        </div>
                    </li>
                    <li>
                        <span class="preview-icon icon-food">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.5 0 1 .2 1.4.6l7 7a2 2 0 010 2.8l-7 7a2 2 0 01-2.8 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                        </span>
                        <div class="expense-info">
                            <p>Choose a category</p>
                            <small>Your reports group spending by category.</small>
                        </div>
                    </li>
                </ul>

                <!-- Categories added by the admin -->
                @if (count($categories ?? []) > 0)
                    <p class="tips-heading">Available categories</p>
                    <div class="chip-list">
                        @foreach ($categories as $category)
                            <span class="dash-badge">{{ $category->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

    </div>

</div>
</x-app-layout>

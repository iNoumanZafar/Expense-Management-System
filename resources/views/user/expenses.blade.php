<x-app-layout>
<div class="dash-wrap">

    @include('user.sidebar')


    <!-- ===== Page content (right side) ===== -->
    <div class="dash-page">

        <!-- ===== Page banner ===== -->
        <div class="dash-welcome">
            <div>
                <p class="dash-date">{{ now()->format('l, d F Y') }}</p>
                <h1>My expenses</h1>
                <p>Every expense you have added, newest first.</p>
            </div>

            <div>
                <a href="{{ route('user.expenses.create') }}" class="btn-white">+ Add Expense</a>
            </div>
        </div>


        <!-- ===== Green message after saving ===== -->
        @if (session('success'))
            <div class="dash-alert">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif


        <!-- ===== All expenses ===== -->
        <div class="dash-card">
            <div class="dash-card-head">
                <div>
                    <h2>All expenses</h2>
                    <p class="dash-muted">{{ count($expenses) }} {{ Str::plural('expense', count($expenses)) }}</p>
                </div>
                <span class="dash-badge">Total ${{ number_format($expenses->sum('amount'), 2) }}</span>
            </div>

            @if (count($expenses) > 0)
                <!-- The wrapper lets the table scroll sideways on small phones -->
                <div class="table-wrap">
                    <table class="expense-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th class="text-right">Amount</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                                <tr>
                                    <td class="dash-muted">{{ $expense->expense_date->format('d M Y') }}</td>
                                    <td class="expense-title">{{ $expense->title }}</td>
                                    <td>
                                        <!-- The category can be empty if an admin deleted it -->
                                        <span class="dash-badge">{{ $expense->category?->name ?? 'Uncategorized' }}</span>
                                    </td>
                                    <td class="dash-muted">{{ $expense->description ?: '-' }}</td>
                                    <td class="expense-amount text-right">-${{ number_format($expense->amount, 2) }}</td>

                                    <!-- Edit + Delete buttons -->
                                    <td>
                                        <div class="table-actions">

                                            <a href="{{ route('user.expenses.edit', $expense) }}" class="action-btn action-edit" title="Edit expense">
                                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.4-9.4a2 2 0 112.8 2.8L11.8 15H9v-2.8l8.6-8.6z"/></svg>
                                                Edit
                                            </a>

                                            {{-- The SweetAlert popup (bottom of this page) asks before this form is sent --}}
                                            <form method="POST" action="{{ route('user.expenses.destroy', $expense) }}" class="delete-expense-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn action-delete" title="Delete expense">
                                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.9 12.1A2 2 0 0116.1 21H7.9a2 2 0 01-2-1.9L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Shown when the user has not added any expenses yet -->
                <div class="setting-empty">
                    <span class="stat-icon icon-indigo">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </span>
                    <p>No expenses yet</p>
                    <small>Press "+ Add Expense" to add your first one.</small>
                </div>
            @endif
        </div>

    </div>

</div>

{{-- Page scripts: added to @stack('scripts') in the layout, so only this page loads them --}}
@push('scripts')
    <!-- SweetAlert2 (the .all. file already includes its CSS) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.26.25/sweetalert2.all.min.js"></script>

    <script>
        // Ask "are you sure?" before any delete form is sent
        document.querySelectorAll('.delete-expense-form').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                // Stop the form for now
                event.preventDefault();

                Swal.fire({
                    title: 'Delete this expense?',
                    text: 'It will be removed from your list.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    reverseButtons: true,
                }).then(function (result) {
                    // Only send the form when the user clicked "Yes"
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
</x-app-layout>

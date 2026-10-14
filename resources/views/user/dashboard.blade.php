<x-app-layout>
<div class="dash-wrap">

    <!-- ===== Sidebar menu (left side) ===== -->
    <aside class="dash-sidebar">
        <p class="sidebar-heading">Menu</p>

        <nav class="sidebar-menu">
            <a href="{{ route('user.dashboard') }}" class="active">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10-3a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"/></svg>
                Dashboard
            </a>
            <a href="#">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Expenses
            </a>
            <a href="#">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.5 0 1 .2 1.4.6l7 7a2 2 0 010 2.8l-7 7a2 2 0 01-2.8 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                Categories
            </a>
            <a href="#">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 7h6m0 10v-3m-3 3v-6m-3 6v-1m6-9a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2"/></svg>
                Budget
            </a>
            <a href="#">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 3.1A9 9 0 1020.9 13H11V3.1z"/><path d="M20.5 9H15V3.5A9 9 0 0120.5 9z"/></svg>
                Reports
            </a>
            <a href="{{ route('profile.edit') }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profile
            </a>
        </nav>

        <!-- Small tip box at the bottom of the sidebar -->
        <div class="sidebar-tip">
            <p>Tip</p>
            <small>Add your expenses every day to keep your budget on track.</small>
        </div>
    </aside>


    <!-- ===== Page content (right side) ===== -->
    <div class="dash-page">

        <!-- NOTE: all numbers on this page are sample data for the design.
             They will come from the database in the next steps. -->

        <!-- ===== Welcome banner ===== -->
        <div class="dash-welcome">
            <div>
                <p class="dash-date">{{ now()->format('l, d F Y') }}</p>
                <h1>Hello, {{ Auth::user()->name }} &#128075;</h1>
                <p>Here is how your money is doing this month.</p>
            </div>

            <div class="dash-welcome-actions">
                <a href="#" class="btn-white">+ Add Expense</a>
            </div>
        </div>


        <!-- ===== Stat cards ===== -->
        <div class="dash-stats">

            <!-- Card 1: Spent this month -->
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Spent this month</p>
                    <span class="stat-icon icon-indigo">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </span>
                </div>
                <p class="stat-value">$1,248.50</p>
                <p class="stat-note"><span class="trend-good">&#9660; 12%</span> vs last month</p>
            </div>

            <!-- Card 2: Monthly budget -->
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Monthly budget</p>
                    <span class="stat-icon icon-violet">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 7h6m0 10v-3m-3 3v-6m-3 6v-1m6-9a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2"/></svg>
                    </span>
                </div>
                <p class="stat-value">$2,000.00</p>
                <p class="stat-note">Set for October</p>
            </div>

            <!-- Card 3: Remaining -->
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Remaining</p>
                    <span class="stat-icon icon-green">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </span>
                </div>
                <p class="stat-value">$751.50</p>

                <!-- Small budget bar -->
                <div class="progress stat-progress">
                    <div class="progress-bar" style="width: 62%"></div>
                </div>
                <p class="stat-note">62% of budget used</p>
            </div>

            <!-- Card 4: Spent today -->
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Spent today</p>
                    <span class="stat-icon icon-orange">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </span>
                </div>
                <p class="stat-value">$84.20</p>
                <p class="stat-note">2 expenses today</p>
            </div>

        </div>


        <!-- ===== Row 1: daily spending chart + category chart ===== -->
        <div class="dash-grid">

            <!-- Daily spending (column chart) -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>Daily spending</h2>
                        <p class="dash-muted">October 1 &ndash; 14</p>
                    </div>
                    <span class="dash-badge">Avg $89 / day</span>
                </div>

                <div class="chart-box chart-tall">
                    <canvas id="dailyChart" role="img" aria-label="Column chart of daily spending for October 1 to 14"></canvas>
                </div>
            </div>

            <!-- Spending by category (bar chart) -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>By category</h2>
                        <p class="dash-muted">This month</p>
                    </div>
                </div>

                <div class="chart-box chart-tall">
                    <canvas id="categoryChart" role="img" aria-label="Bar chart of spending by category this month"></canvas>
                </div>
            </div>

        </div>


        <!-- ===== Row 2: recent expenses + last 6 months chart ===== -->
        <div class="dash-grid">

            <!-- Recent expenses -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <h2>Recent expenses</h2>
                    <a href="#" class="dash-link">View all &rarr;</a>
                </div>

                <ul class="expense-list">
                    <li>
                        <span class="preview-icon icon-food">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.3 2.3c-.6.6-.2 1.7.7 1.7H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </span>
                        <div class="expense-info">
                            <p>Groceries</p>
                            <small>Food &middot; Today</small>
                        </div>
                        <span class="expense-amount">-$84.20</span>
                    </li>
                    <li>
                        <span class="preview-icon icon-travel">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h8m-8 4h8m-5 9l-3-3H6a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2h-2l-3 3z"/></svg>
                        </span>
                        <div class="expense-info">
                            <p>Fuel</p>
                            <small>Travel &middot; Yesterday</small>
                        </div>
                        <span class="expense-amount">-$45.00</span>
                    </li>
                    <li>
                        <span class="preview-icon icon-bills">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </span>
                        <div class="expense-info">
                            <p>Electricity bill</p>
                            <small>Bills &middot; 12 Oct 2026</small>
                        </div>
                        <span class="expense-amount">-$120.00</span>
                    </li>
                    <li>
                        <span class="preview-icon icon-food">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.3 2.3c-.6.6-.2 1.7.7 1.7H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </span>
                        <div class="expense-info">
                            <p>Restaurant dinner</p>
                            <small>Food &middot; 11 Oct 2026</small>
                        </div>
                        <span class="expense-amount">-$62.50</span>
                    </li>
                    <li>
                        <span class="preview-icon icon-save">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4.3 6.3a4 4 0 000 5.7L12 19.7l7.7-7.7a4 4 0 00-5.7-5.7L12 8.3l-2.3-2a4 4 0 00-5.4 0z"/></svg>
                        </span>
                        <div class="expense-info">
                            <p>Pharmacy</p>
                            <small>Health &middot; 10 Oct 2026</small>
                        </div>
                        <span class="expense-amount">-$28.75</span>
                    </li>
                </ul>
            </div>

            <!-- Last 6 months (line chart) -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>Last 6 months</h2>
                        <p class="dash-muted">Total spent per month</p>
                    </div>
                </div>

                <div class="chart-box">
                    <canvas id="monthlyChart" role="img" aria-label="Line chart of total spending per month for the last 6 months"></canvas>
                </div>
            </div>

        </div>

    </div>

</div>


    <!-- Chart.js and the dashboard charts (only loaded on this page) -->
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
        <script src="{{ asset('js/dashboard.js') }}"></script>
    @endpush
</x-app-layout>

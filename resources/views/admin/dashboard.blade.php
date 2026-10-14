<x-app-layout>
<div class="dash-wrap">

    <!-- ===== Sidebar menu (left side) ===== -->
    <aside class="dash-sidebar">
        <p class="sidebar-heading">Admin menu</p>

        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="active">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10-3a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"/></svg>
                Dashboard
            </a>
            <a href="#">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.4-1.8M17 20H7m10 0v-2c0-.7-.1-1.3-.4-1.8M7 20H2v-2a3 3 0 015.4-1.8M7 20v-2c0-.7.1-1.3.4-1.8m0 0a5 5 0 019.2 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Users
            </a>
            <a href="#">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.5 0 1 .2 1.4.6l7 7a2 2 0 010 2.8l-7 7a2 2 0 01-2.8 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                Categories
            </a>
            <a href="#">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                All Expenses
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

        <!-- Small info box at the bottom of the sidebar -->
        <div class="sidebar-tip">
            <p>Admin area</p>
            <small>Only admins can see this page. Manage users, categories and reports from here.</small>
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
                <h1>Welcome back, {{ Auth::user()->name }}</h1>
                <p>Here is what is happening across the app today.</p>
            </div>

            <div>
                <a href="#" class="btn-white">Manage Users</a>
            </div>
        </div>


        <!-- ===== Stat cards ===== -->
        <div class="dash-stats">

            <!-- Card 1: Total users -->
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Total users</p>
                    <span class="stat-icon icon-indigo">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.4-1.8M17 20H7m10 0v-2c0-.7-.1-1.3-.4-1.8M7 20H2v-2a3 3 0 015.4-1.8M7 20v-2c0-.7.1-1.3.4-1.8m0 0a5 5 0 019.2 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </span>
                </div>
                <p class="stat-value">1,284</p>
                <p class="stat-note"><span class="trend-good">&#9650; 8%</span> vs last month</p>
            </div>

            <!-- Card 2: New users this month -->
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">New this month</p>
                    <span class="stat-icon icon-violet">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    </span>
                </div>
                <p class="stat-value">96</p>
                <p class="stat-note">Signed up in October</p>
            </div>

            <!-- Card 3: Expenses recorded -->
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Expenses recorded</p>
                    <span class="stat-icon icon-green">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </span>
                </div>
                <p class="stat-value">18,530</p>
                <p class="stat-note">642 added this week</p>
            </div>

            <!-- Card 4: Total amount tracked -->
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Amount tracked</p>
                    <span class="stat-icon icon-orange">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </span>
                </div>
                <p class="stat-value">$412.6K</p>
                <p class="stat-note">By all users, all time</p>
            </div>

        </div>


        <!-- ===== Row 1: new users chart + category chart ===== -->
        <div class="dash-grid">

            <!-- New users per month (column chart) -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>New users</h2>
                        <p class="dash-muted">Sign-ups per month, last 6 months</p>
                    </div>
                    <span class="dash-badge">+412 total</span>
                </div>

                <div class="chart-box chart-tall">
                    <canvas id="adminUsersChart" role="img" aria-label="Column chart of new user sign-ups per month for the last 6 months"></canvas>
                </div>
            </div>

            <!-- Spending by category, all users (bar chart) -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>Top categories</h2>
                        <p class="dash-muted">All users, this month</p>
                    </div>
                </div>

                <div class="chart-box chart-tall">
                    <canvas id="adminCategoryChart" role="img" aria-label="Bar chart of total spending by category for all users this month"></canvas>
                </div>
            </div>

        </div>


        <!-- ===== Row 2: latest users + expenses activity chart ===== -->
        <div class="dash-grid">

            <!-- Latest registered users -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <h2>Latest users</h2>
                    <a href="#" class="dash-link">View all &rarr;</a>
                </div>

                <ul class="expense-list">
                    <li>
                        <span class="user-avatar">A</span>
                        <div class="expense-info">
                            <p>Ayesha Khan</p>
                            <small>ayesha@example.com &middot; Today</small>
                        </div>
                        <span class="role-badge">User</span>
                    </li>
                    <li>
                        <span class="user-avatar">B</span>
                        <div class="expense-info">
                            <p>Bilal Ahmed</p>
                            <small>bilal@example.com &middot; Yesterday</small>
                        </div>
                        <span class="role-badge">User</span>
                    </li>
                    <li>
                        <span class="user-avatar">S</span>
                        <div class="expense-info">
                            <p>Sara Malik</p>
                            <small>sara@example.com &middot; 12 Oct 2026</small>
                        </div>
                        <span class="role-badge role-admin">Admin</span>
                    </li>
                    <li>
                        <span class="user-avatar">U</span>
                        <div class="expense-info">
                            <p>Usman Tariq</p>
                            <small>usman@example.com &middot; 11 Oct 2026</small>
                        </div>
                        <span class="role-badge">User</span>
                    </li>
                    <li>
                        <span class="user-avatar">H</span>
                        <div class="expense-info">
                            <p>Hina Raza</p>
                            <small>hina@example.com &middot; 10 Oct 2026</small>
                        </div>
                        <span class="role-badge">User</span>
                    </li>
                </ul>
            </div>

            <!-- Expenses added per day (line chart) -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>Activity</h2>
                        <p class="dash-muted">Expenses added per day, last 7 days</p>
                    </div>
                </div>

                <div class="chart-box">
                    <canvas id="adminActivityChart" role="img" aria-label="Line chart of the number of expenses added per day for the last 7 days"></canvas>
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

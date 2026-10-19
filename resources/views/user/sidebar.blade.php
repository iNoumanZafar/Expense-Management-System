{{-- ===== User sidebar menu (left side) =====
     Shared by every user page:  @include('user.sidebar')
     The link of the page you are on gets the "active" class automatically.
     Optional: change the tip box at the bottom with
     @include('user.sidebar', ['tipTitle' => '...', 'tipText' => '...'])
     NOTE: this must be a Blade comment. Inside an HTML comment Blade would
     still run the @include above and the sidebar would include itself forever. --}}
<aside class="dash-sidebar">
    <p class="sidebar-heading">Menu</p>

    <nav class="sidebar-menu">
        <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10-3a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"/></svg>
            Dashboard
        </a>
        <!-- user.expenses.* = every expenses route (index, create, store, ...) -->
        <a href="{{ route('user.expenses.index') }}" class="{{ request()->routeIs('user.expenses.*') ? 'active' : '' }}">
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
        <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Profile
        </a>
    </nav>

    <!-- Small tip box at the bottom of the sidebar -->
    <div class="sidebar-tip">
        <p>{{ $tipTitle ?? 'Tip' }}</p>
        <small>{{ $tipText ?? 'Add your expenses every day to keep your budget on track.' }}</small>
    </div>
</aside>

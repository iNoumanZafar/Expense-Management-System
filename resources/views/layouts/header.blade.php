<header class="header">
    <div class="header-inner">

        <!-- Logo and app name -->
        <a href="{{ auth()->check() ? route('dashboard') : url('/') }}" class="header-logo">
            <img src="{{ asset('assets/fav-icon.png') }}" alt="Logo">
            <span>{{ config('app.name') }}</span>
        </a>

        <!-- Menu links (only for logged in users) -->
        @auth
            <nav class="header-menu">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('admin.dashboard', 'user.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">Profile</a>
            </nav>
        @endauth

        <!-- User name and logout button -->
        <div class="header-user">
            @auth
                <span>Hi, {{ Auth::user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="header-login">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="logout-btn">Get Started</a>
                @endif
            @endauth
        </div>

    </div>
</header>

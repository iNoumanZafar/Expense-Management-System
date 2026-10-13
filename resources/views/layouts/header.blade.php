<header class="header">
    <div class="header-inner">

        <!-- Logo and app name -->
        <a href="{{ route('dashboard') }}" class="header-logo">
            <img src="{{ asset('assets/fav-icon.png') }}" alt="Logo">
            <span>{{ config('app.name') }}</span>
        </a>

        <!-- Menu links -->
        <nav class="header-menu">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">Profile</a>
        </nav>

        <!-- User name and logout button -->
        <div class="header-user">
            @auth
                <span>Hi, {{ Auth::user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>

    </div>
</header>

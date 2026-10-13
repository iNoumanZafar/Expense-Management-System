<x-app-layout>
    <div class="register-page">
        <div class="register-box">

            <!-- Left side: welcome panel (hidden on small screens) -->
            <div class="register-side">
                <h1>Welcome back!</h1>
                <p>Log in to see your expenses, check your budget and keep your savings on track.</p>

                <ul class="register-features">
                    <li>
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        All your expenses, right where you left them
                    </li>
                    <li>
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        See how much is left in this month's budget
                    </li>
                    <li>
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        Your data is private and secure
                    </li>
                </ul>
            </div>

            <!-- Right side: login form -->
            <div class="register-main">
                <h2 class="register-title">Log in to your account</h2>
                <p class="register-subtitle">Enter your email and password to continue.</p>

                <!-- Session status (for example after a password reset) -->
                @if (session('status'))
                    <div class="auth-status">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               placeholder="you@example.com" required autofocus autocomplete="username">
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-wrap">
                            <input id="password" type="password" name="password"
                                   class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                   placeholder="Enter your password" required autocomplete="current-password">
                            <button type="button" class="password-toggle" data-target="password">Show</button>
                        </div>
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember me and forgot password -->
                    <div class="login-options">
                        <label for="remember_me" class="remember-me">
                            <input id="remember_me" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="register-btn">Log In</button>
                </form>

                <p class="register-login">
                    Don't have an account?
                    <a href="{{ route('register') }}">Create one</a>
                </p>
            </div>

        </div>
    </div>
</x-app-layout>

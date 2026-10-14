<x-app-layout>
    <div class="register-page">
        <div class="register-box">

            <!-- Left side: welcome panel (hidden on small screens) -->
            <div class="register-side">
                <h1>Take control of your money.</h1>
                <p>Create a free account and start tracking your daily expenses in minutes.</p>

                <ul class="register-features">
                    <li>
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        Track every expense in one place
                    </li>
                    <li>
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        Set monthly budgets and stick to them
                    </li>
                    <li>
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        See where your money goes with clear reports
                    </li>
                </ul>
            </div>

            <!-- Right side: register form -->
            <div class="register-main">
                <h2 class="register-title">Create your account</h2>
                <p class="register-subtitle">Fill in the details below to get started.</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                               class="form-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               placeholder="John Doe" required autofocus autocomplete="name">
                        @error('name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               placeholder="you@example.com" required autocomplete="username">
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
                                   placeholder="At least 8 characters" required autocomplete="new-password">
                            <button type="button" class="password-toggle" data-target="password">Show</button>
                        </div>
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="password-wrap">
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                   class="form-input {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                   placeholder="Repeat your password" required autocomplete="new-password">
                            <button type="button" class="password-toggle" data-target="password_confirmation">Show</button>
                        </div>
                        @error('password_confirmation')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="register-btn">Create Account</button>
                </form>

                <p class="register-login">
                    Already have an account?
                    <a href="{{ route('login') }}">Log in</a>
                </p>
            </div>

        </div>
    </div>
</x-app-layout>

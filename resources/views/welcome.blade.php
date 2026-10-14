<x-app-layout>

    <!-- ===== Hero section ===== -->
    <section class="hero">
        <div class="hero-inner">

            <!-- Left side: text and buttons -->
            <div class="hero-text">
                <span class="hero-badge">Smart money management</span>

                <h1>
                    Take control of your
                    <span class="hero-highlight">expenses</span>
                    and save more every month
                </h1>

                <p>
                    Record your daily spending, set a monthly budget and see exactly
                    where your money goes. Simple, fast and private.
                </p>

                <div class="hero-buttons">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">Open Dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn-primary">Start for free</a>
                        <a href="{{ route('login') }}" class="btn-outline">I have an account</a>
                    @endauth
                </div>

                <!-- Small trust points -->
                <ul class="hero-points">
                    <li>
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        Free to use
                    </li>
                    <li>
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        No credit card
                    </li>
                    <li>
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        Private &amp; secure
                    </li>
                </ul>
            </div>

            <!-- Right side: example dashboard card -->
            <div class="hero-preview">
                <div class="preview-card">

                    <!-- Total spent -->
                    <div class="preview-head">
                        <div>
                            <p class="preview-label">Spent this month</p>
                            <p class="preview-amount">$1,248.50</p>
                        </div>
                        <span class="preview-tag">-12% vs last month</span>
                    </div>

                    <!-- Budget progress bar -->
                    <div class="preview-budget">
                        <div class="preview-budget-row">
                            <span>Monthly budget</span>
                            <span>$1,248 / $2,000</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 62%"></div>
                        </div>
                    </div>

                    <!-- Recent expenses -->
                    <p class="preview-subtitle">Recent expenses</p>
                    <ul class="preview-list">
                        <li>
                            <span class="preview-icon icon-food">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.3 2.3c-.6.6-.2 1.7.7 1.7H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </span>
                            <div class="preview-info">
                                <p>Groceries</p>
                                <small>Today</small>
                            </div>
                            <span class="preview-price">-$84.20</span>
                        </li>
                        <li>
                            <span class="preview-icon icon-travel">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h8m-8 4h8m-5 9l-3-3H6a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2h-2l-3 3z"/></svg>
                            </span>
                            <div class="preview-info">
                                <p>Fuel</p>
                                <small>Yesterday</small>
                            </div>
                            <span class="preview-price">-$45.00</span>
                        </li>
                        <li>
                            <span class="preview-icon icon-bills">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </span>
                            <div class="preview-info">
                                <p>Electricity bill</p>
                                <small>2 days ago</small>
                            </div>
                            <span class="preview-price">-$120.00</span>
                        </li>
                    </ul>
                </div>

                <!-- Small floating card -->
                <div class="preview-float">
                    <span class="preview-icon icon-save">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </span>
                    <div>
                        <small>Saved this month</small>
                        <p>$751.50</p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- ===== Features section ===== -->
    <section id="features" class="section">
        <div class="section-inner">

            <div class="section-head">
                <span class="section-tag">Features</span>
                <h2>Everything you need to manage your money</h2>
                <p>Simple tools that help you understand your spending and build better habits.</p>
            </div>

            <div class="features-grid">

                <!-- Feature 1 -->
                <div class="feature-card">
                    <span class="feature-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                    </span>
                    <h3>Quick expense entry</h3>
                    <p>Add an expense in seconds with amount, category, date and a short note.</p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card">
                    <span class="feature-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.5 0 1 .2 1.4.6l7 7a2 2 0 010 2.8l-7 7a2 2 0 01-2.8 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                    </span>
                    <h3>Smart categories</h3>
                    <p>Group your spending into food, bills, travel and more to see the full picture.</p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card">
                    <span class="feature-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 7h6m0 10v-3m-3 3v-6m-3 6v-1m6-9a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2"/></svg>
                    </span>
                    <h3>Monthly budget</h3>
                    <p>Set a budget for the month and always know how much you have left to spend.</p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card">
                    <span class="feature-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 3.1A9 9 0 1020.9 13H11V3.1z"/><path d="M20.5 9H15V3.5A9 9 0 0120.5 9z"/></svg>
                    </span>
                    <h3>Clear reports</h3>
                    <p>Easy summaries show where your money goes each week and month.</p>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card">
                    <span class="feature-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                    <h3>Private &amp; secure</h3>
                    <p>Your account is protected and only you can see your expenses.</p>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card">
                    <span class="feature-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </span>
                    <h3>Works everywhere</h3>
                    <p>Use it on your phone, tablet or computer from any browser.</p>
                </div>

            </div>
        </div>
    </section>


    <!-- ===== How it works section ===== -->
    <section id="how-it-works" class="section section-light">
        <div class="section-inner">

            <div class="section-head">
                <span class="section-tag">How it works</span>
                <h2>Start saving in 3 easy steps</h2>
                <p>No setup, no learning curve. You can be ready in under a minute.</p>
            </div>

            <div class="steps-grid">
                <div class="step-card">
                    <span class="step-number">1</span>
                    <h3>Create an account</h3>
                    <p>Sign up for free with just your name, email and a password.</p>
                </div>
                <div class="step-card">
                    <span class="step-number">2</span>
                    <h3>Add your expenses</h3>
                    <p>Write down what you spend each day and pick a category for it.</p>
                </div>
                <div class="step-card">
                    <span class="step-number">3</span>
                    <h3>Track and save</h3>
                    <p>Check your dashboard, stay under budget and watch your savings grow.</p>
                </div>
            </div>

        </div>
    </section>


    <!-- ===== Call to action ===== -->
    <section class="section">
        <div class="section-inner">
            <div class="cta-box">
                <h2>Ready to take control of your money?</h2>
                <p>Join today and see where every penny goes.</p>

                @auth
                    <a href="{{ route('dashboard') }}" class="btn-white">Go to Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="btn-white">Create free account</a>
                @endauth
            </div>
        </div>
    </section>

</x-app-layout>

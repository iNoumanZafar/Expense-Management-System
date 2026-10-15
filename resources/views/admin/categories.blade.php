<x-app-layout>
<div class="dash-wrap">

    @include('admin.sidebar', [
        'tipTitle' => 'Categories',
        'tipText' => 'Users pick one of these categories when they add an expense.',
    ])


    <!-- ===== Page content (right side) ===== -->
    <div class="dash-page">

        <!-- ===== Page banner ===== -->
        <div class="dash-welcome">
            <div>
                <p class="dash-date">Admin &middot; Categories</p>
                <h1>Expense categories</h1>
                <p>Add the categories users can choose from, like Food, Travel or Bills.</p>
            </div>
        </div>


        <!-- ===== Green message after saving ===== -->
        @if (session('success'))
            <div class="dash-alert">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif


        <!-- ===== Saved categories (left) + add a category form (right) ===== -->
        <div class="dash-grid">

            <!-- Saved categories list -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>All categories</h2>
                        <p class="dash-muted">Every category saved so far</p>
                    </div>
                    <span class="dash-badge">{{ count($categories ?? []) }} total</span>
                </div>

                @if (count($categories ?? []) > 0)
                    <ul class="setting-list">
                        @foreach ($categories as $category)
                            <li>
                                <!-- First letter of the category name -->
                                <span class="user-avatar">{{ strtoupper(substr($category->name, 0, 1)) }}</span>
                                <div class="expense-info">
                                    <p>{{ $category->name }}</p>
                                    <small class="setting-value">{{ filled($category->description) ? $category->description : 'No description' }}</small>
                                </div>
                                <span class="dash-muted">{{ $category->created_at?->format('d M Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <!-- Shown when no categories are saved yet -->
                    <div class="setting-empty">
                        <span class="stat-icon icon-indigo">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.5 0 1 .2 1.4.6l7 7a2 2 0 010 2.8l-7 7a2 2 0 01-2.8 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                        </span>
                        <p>No categories yet</p>
                        <small>Use the form to add your first category.</small>
                    </div>
                @endif
            </div>

            <!-- Add a new category -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>Add a category</h2>
                        <p class="dash-muted">Each name can only be used once</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                               placeholder="e.g. Food" required maxlength="255"
                               class="form-input @error('name') is-invalid @enderror">
                        @error('name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description <span class="dash-muted">(optional)</span></label>
                        <textarea id="description" name="description" rows="4" placeholder="e.g. Groceries, restaurants and snacks"
                                  class="form-input @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="register-btn">Save category</button>
                </form>
            </div>

        </div>

    </div>

</div>
</x-app-layout>

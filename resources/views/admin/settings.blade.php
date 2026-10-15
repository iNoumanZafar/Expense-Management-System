<x-app-layout>
<div class="dash-wrap">

    @include('admin.sidebar', [
        'tipTitle' => 'App settings',
        'tipText' => 'Settings saved here are used across the whole app, for every user.',
    ])


    <!-- ===== Page content (right side) ===== -->
    <div class="dash-page">

        <!-- ===== Page banner ===== -->
        <div class="dash-welcome">
            <div>
                <p class="dash-date">Admin &middot; Settings</p>
                <h1>App settings</h1>
                <p>Save the values the app uses, like the app name or the currency.</p>
            </div>
        </div>


        <!-- ===== Green message after saving ===== -->
        @if (session('success'))
            <div class="dash-alert">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif


        <!-- ===== Saved settings (left) + add a setting form (right) ===== -->
        <div class="dash-grid">

            <!-- Saved settings list -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>Saved settings</h2>
                        <p class="dash-muted">Every key and the value stored for it</p>
                    </div>
                    <span class="dash-badge">{{ count($settings ?? []) }} total</span>
                </div>

                @if (count($settings ?? []) > 0)
                    <ul class="setting-list">
                        @foreach ($settings as $setting)
                            <li>
                                <span class="setting-key">{{ $setting->key }}</span>
                                <div class="expense-info">
                                    <p class="setting-value">{{ filled($setting->value) ? $setting->value : 'No value' }}</p>
                                    <small>Updated {{ $setting->updated_at?->format('d M Y') }}</small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <!-- Shown when no settings are saved yet -->
                    <div class="setting-empty">
                        <span class="stat-icon icon-indigo">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10.3 4.3c.4-1.8 3-1.8 3.4 0a1.7 1.7 0 002.6 1.1c1.5-.9 3.3.8 2.4 2.4a1.7 1.7 0 001 2.5c1.8.5 1.8 3 0 3.4a1.7 1.7 0 00-1 2.6c.9 1.5-.9 3.3-2.4 2.4a1.7 1.7 0 00-2.6 1c-.4 1.8-3 1.8-3.4 0a1.7 1.7 0 00-2.5-1c-1.6.9-3.3-.9-2.4-2.4a1.7 1.7 0 00-1.1-2.6c-1.8-.4-1.8-3 0-3.4a1.7 1.7 0 001.1-2.5c-.9-1.6.8-3.3 2.4-2.4 1 .6 2.3.1 2.5-1.1z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </span>
                        <p>No settings saved yet</p>
                        <small>Use the form to add your first setting.</small>
                    </div>
                @endif
            </div>

            <!-- Add a new setting -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>Add a setting</h2>
                        <p class="dash-muted">Each key can only be saved once</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.settings.store') }}">
                    @csrf

                    <!-- Key -->
                    <div class="form-group">
                        <label for="key">Key</label>
                        <input id="key" type="text" name="key" value="{{ old('key') }}"
                               list="setting-keys" placeholder="e.g. currency" required maxlength="255"
                               class="form-input @error('key') is-invalid @enderror">

                        <!-- Suggestions shown while typing the key -->
                        <datalist id="setting-keys">
                            <!-- These names must match the footer -->
                            <option value="facebook">
                            <option value="twitter">
                            <option value="instagram">
                            <option value="linkedin">
                            <option value="github">
                        </datalist>

                        <p class="setting-hint">For footer links use <code>facebook</code>, <code>twitter</code>, <code>instagram</code>, <code>linkedin</code> or <code>github</code>.</p>
                        @error('key')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Value -->
                    <div class="form-group">
                        <label for="value">Value</label>
                        <textarea id="value" name="value" rows="4" placeholder="e.g. https://facebook.com/yourpage"
                                  class="form-input @error('value') is-invalid @enderror">{{ old('value') }}</textarea>
                        @error('value')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="register-btn">Save setting</button>
                </form>
            </div>

        </div>

    </div>

</div>
</x-app-layout>

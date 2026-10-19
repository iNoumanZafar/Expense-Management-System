<x-app-layout>
<div class="dash-wrap">

    @include('admin.sidebar', [
        'tipTitle' => 'Rooms',
        'tipText' => 'Each room holds up to 4 members. Assign users to rooms from the Users page.',
    ])


    {{-- NOTE: this page uses sample data for the design.
         Later the controller will pass $rooms from the database
         (each room with: name, capacity, members). --}}
    @php
        $rooms = $rooms ?? [
            ['name' => 'Room 1',  'capacity' => 4, 'members' => ['Ali Hassan', 'Bilal Ahmed', 'Usman Tariq', 'Hamza Ali']],
            ['name' => 'Room 2',  'capacity' => 4, 'members' => ['Zain Malik', 'Faisal Iqbal', 'Saad Khan']],
            ['name' => 'Room 3',  'capacity' => 4, 'members' => ['Ahmed Raza', 'Imran Shah', 'Kashif Noor', 'Talha Aziz']],
            ['name' => 'Room 4',  'capacity' => 4, 'members' => ['Junaid Akhtar', 'Waqas Butt']],
            ['name' => 'Room 5',  'capacity' => 4, 'members' => []],
            ['name' => 'Room 6',  'capacity' => 4, 'members' => ['Noman Zafar', 'Asad Mehmood', 'Haris Javed', 'Owais Qureshi']],
            ['name' => 'Room 7',  'capacity' => 4, 'members' => ['Shahid Afridi']],
            ['name' => 'Room 8',  'capacity' => 4, 'members' => ['Danish Ali', 'Fahad Mustafa', 'Rizwan Haider']],
            ['name' => 'Room 9',  'capacity' => 4, 'members' => ['Umer Farooq', 'Adeel Anwar', 'Sohail Abbas', 'Nadeem Akram']],
            ['name' => 'Room 10', 'capacity' => 4, 'members' => []],
            ['name' => 'Room 11', 'capacity' => 4, 'members' => ['Yasir Nawaz', 'Babar Azam']],
            ['name' => 'Room 12', 'capacity' => 4, 'members' => ['Arslan Riaz', 'Moiz Khan', 'Taimoor Ali', 'Huzaifa Saleem']],
        ];

        // Totals for the stat cards
        $totalBeds = collect($rooms)->sum('capacity');
        $occupiedBeds = collect($rooms)->sum(fn ($room) => count($room['members']));
        $fullRooms = collect($rooms)->filter(fn ($room) => count($room['members']) >= $room['capacity'])->count();
    @endphp


    <!-- ===== Page content (right side) ===== -->
    <div class="dash-page">

        <!-- ===== Page banner ===== -->
        <div class="dash-welcome">
            <div>
                <p class="dash-date">Admin &middot; Rooms</p>
                <h1>Hostel rooms</h1>
                <p>See who lives in each room and how many beds are still free.</p>
            </div>

            <div>
                <a href="{{ route('admin.users.index') }}" class="btn-white">Assign users</a>
            </div>
        </div>


        <!-- ===== Green message after saving ===== -->
        @if (session('success'))
            <div class="dash-alert">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif


        <!-- ===== Stat cards ===== -->
        <div class="dash-stats">

            <!-- Card 1: Total rooms -->
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Total rooms</p>
                    <span class="stat-icon icon-indigo">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </span>
                </div>
                <p class="stat-value">{{ count($rooms) }}</p>
                <p class="stat-note">{{ $totalBeds }} beds in total</p>
            </div>

            <!-- Card 2: Occupied beds -->
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Occupied beds</p>
                    <span class="stat-icon icon-violet">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.4-1.8M17 20H7m10 0v-2c0-.7-.1-1.3-.4-1.8M7 20H2v-2a3 3 0 015.4-1.8M7 20v-2c0-.7.1-1.3.4-1.8m0 0a5 5 0 019.2 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </span>
                </div>
                <p class="stat-value">{{ $occupiedBeds }}</p>

                <!-- Small occupancy bar -->
                <div class="progress stat-progress">
                    <div class="progress-bar" style="width: {{ $totalBeds > 0 ? round($occupiedBeds / $totalBeds * 100) : 0 }}%"></div>
                </div>
                <p class="stat-note">{{ $totalBeds > 0 ? round($occupiedBeds / $totalBeds * 100) : 0 }}% of beds used</p>
            </div>

            <!-- Card 3: Free beds -->
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Free beds</p>
                    <span class="stat-icon icon-green">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                    </span>
                </div>
                <p class="stat-value">{{ $totalBeds - $occupiedBeds }}</p>
                <p class="stat-note">Ready for new members</p>
            </div>

            <!-- Card 4: Full rooms -->
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Full rooms</p>
                    <span class="stat-icon icon-orange">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                </div>
                <p class="stat-value">{{ $fullRooms }}</p>
                <p class="stat-note">No free beds left</p>
            </div>

        </div>


        <!-- ===== Rooms list (left) + add a room form (right) ===== -->
        <div class="dash-grid">

            <!-- All rooms, with a search box and status filter (Alpine.js) -->
            <div class="dash-card" x-data="{ search: '', filter: 'all' }">
                <div class="dash-card-head">
                    <div>
                        <h2>All rooms</h2>
                        <p class="dash-muted">Members and free beds in every room</p>
                    </div>
                    <span class="dash-badge">{{ count($rooms) }} total</span>
                </div>

                <!-- Search + filter buttons -->
                <div class="list-toolbar">
                    <input type="search" x-model="search" placeholder="Search room or member..." class="form-input list-search">

                    <div class="filter-tabs">
                        <button type="button" @click="filter = 'all'" :class="{ 'active': filter === 'all' }">All</button>
                        <button type="button" @click="filter = 'available'" :class="{ 'active': filter === 'available' }">Available</button>
                        <button type="button" @click="filter = 'full'" :class="{ 'active': filter === 'full' }">Full</button>
                        <button type="button" @click="filter = 'empty'" :class="{ 'active': filter === 'empty' }">Empty</button>
                    </div>
                </div>

                @if (count($rooms) > 0)
                    <div class="room-grid">
                        @foreach ($rooms as $room)
                            @php
                                $count = count($room['members']);
                                $status = $count === 0 ? 'empty' : ($count >= $room['capacity'] ? 'full' : 'available');

                                // Text the search box looks through: room name + member names
                                $searchText = strtolower($room['name'].' '.collect($room['members'])->implode(' '));
                            @endphp

                            <div class="room-card"
                                 x-show="(filter === 'all' || filter === '{{ $status }}') && @js($searchText).includes(search.toLowerCase())">

                                <div class="room-head">
                                    <div>
                                        <p class="room-name">{{ $room['name'] }}</p>
                                        <small class="dash-muted">{{ $count }} / {{ $room['capacity'] }} members</small>
                                    </div>
                                    <span class="room-status status-{{ $status }}">{{ ucfirst($status) }}</span>
                                </div>

                                <!-- Occupancy bar -->
                                <div class="progress room-progress">
                                    <div class="progress-bar" style="width: {{ $room['capacity'] > 0 ? round($count / $room['capacity'] * 100) : 0 }}%"></div>
                                </div>

                                <!-- One row per bed: member name, or an empty bed -->
                                <ul class="room-members">
                                    @for ($bed = 0; $bed < $room['capacity']; $bed++)
                                        @if (isset($room['members'][$bed]))
                                            <li>
                                                <span class="mini-avatar">{{ strtoupper(substr($room['members'][$bed], 0, 1)) }}</span>
                                                {{ $room['members'][$bed] }}
                                            </li>
                                        @else
                                            <li class="bed-free">
                                                <span class="mini-avatar">+</span>
                                                Free bed
                                            </li>
                                        @endif
                                    @endfor
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Shown when no rooms are saved yet -->
                    <div class="setting-empty">
                        <span class="stat-icon icon-indigo">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        </span>
                        <p>No rooms yet</p>
                        <small>Use the form to add your first room.</small>
                    </div>
                @endif
            </div>

            <!-- Add a new room -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>Add a room</h2>
                        <p class="dash-muted">Each room name can only be used once</p>
                    </div>
                </div>

                {{-- TODO: set action to route('admin.rooms.store') and remove onsubmit
                     once the rooms table and controller are ready. --}}
                <form method="POST" action="#" onsubmit="event.preventDefault()">
                    @csrf

                    <!-- Room name -->
                    <div class="form-group">
                        <label for="name">Room name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                               placeholder="e.g. Room 13" required maxlength="255"
                               class="form-input @error('name') is-invalid @enderror">
                        @error('name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Capacity -->
                    <div class="form-group">
                        <label for="capacity">Capacity <span class="dash-muted">(beds)</span></label>
                        <input id="capacity" type="number" name="capacity" value="{{ old('capacity', 4) }}"
                               min="1" max="20" required
                               class="form-input @error('capacity') is-invalid @enderror">
                        <p class="setting-hint">Most rooms in the hostel have <code>4</code> beds.</p>
                        @error('capacity')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="register-btn">Save room</button>
                </form>
            </div>

        </div>

    </div>

</div>
</x-app-layout>

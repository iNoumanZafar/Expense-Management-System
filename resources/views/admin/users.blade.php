<x-app-layout>
<div class="dash-wrap">

    @include('admin.sidebar', [
        'tipTitle' => 'Users',
        'tipText' => 'Pick a room for each user. A full room (4/4) cannot take more members.',
    ])


    {{-- NOTE: this page uses sample data for the design.
         Later the controller will pass $users (with their room)
         and $rooms (with a members count) from the database. --}}
    @php
        $rooms = $rooms ?? [
            ['id' => 1,  'name' => 'Room 1',  'capacity' => 4, 'members_count' => 4],
            ['id' => 2,  'name' => 'Room 2',  'capacity' => 4, 'members_count' => 3],
            ['id' => 3,  'name' => 'Room 3',  'capacity' => 4, 'members_count' => 4],
            ['id' => 4,  'name' => 'Room 4',  'capacity' => 4, 'members_count' => 2],
            ['id' => 5,  'name' => 'Room 5',  'capacity' => 4, 'members_count' => 0],
            ['id' => 7,  'name' => 'Room 7',  'capacity' => 4, 'members_count' => 1],
            ['id' => 8,  'name' => 'Room 8',  'capacity' => 4, 'members_count' => 3],
            ['id' => 10, 'name' => 'Room 10', 'capacity' => 4, 'members_count' => 0],
        ];

        $users = $users ?? [
            ['id' => 1, 'name' => 'Ali Hassan',    'email' => 'ali@example.com',    'room_id' => 1],
            ['id' => 2, 'name' => 'Zain Malik',    'email' => 'zain@example.com',   'room_id' => 2],
            ['id' => 3, 'name' => 'Ahmed Raza',    'email' => 'ahmed@example.com',  'room_id' => 3],
            ['id' => 4, 'name' => 'Junaid Akhtar', 'email' => 'junaid@example.com', 'room_id' => 4],
            ['id' => 5, 'name' => 'Shahid Afridi', 'email' => 'shahid@example.com', 'room_id' => 7],
            ['id' => 6, 'name' => 'Danish Ali',    'email' => 'danish@example.com', 'room_id' => 8],
            ['id' => 7, 'name' => 'Kamran Akmal',  'email' => 'kamran@example.com', 'room_id' => null],
            ['id' => 8, 'name' => 'Sarfraz Ahmed', 'email' => 'sarfraz@example.com','room_id' => null],
            ['id' => 9, 'name' => 'Imad Wasim',    'email' => 'imad@example.com',   'room_id' => null],
        ];

        $roomsById = collect($rooms)->keyBy('id');
        $unassigned = collect($users)->whereNull('room_id')->count();
        $freeRooms = collect($rooms)->filter(fn ($room) => $room['members_count'] < $room['capacity']);
    @endphp


    <!-- ===== Page content (right side) ===== -->
    <div class="dash-page">

        <!-- ===== Page banner ===== -->
        <div class="dash-welcome">
            <div>
                <p class="dash-date">Admin &middot; Users</p>
                <h1>Users &amp; rooms</h1>
                <p>Put every hostel member in a room so expenses can be shared room-wise.</p>
            </div>

            <div>
                <a href="{{ route('admin.rooms.index') }}" class="btn-white">View rooms</a>
            </div>
        </div>


        <!-- ===== Green message after saving ===== -->
        @if (session('success'))
            <div class="dash-alert">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif


        <!-- ===== Users list (left) + free rooms (right) ===== -->
        <div class="dash-grid">

            <!-- All users, with a search box and filter (Alpine.js) -->
            <div class="dash-card" x-data="{ search: '', filter: 'all' }">
                <div class="dash-card-head">
                    <div>
                        <h2>All users</h2>
                        <p class="dash-muted">Choose a room and press Save</p>
                    </div>
                    <span class="dash-badge">{{ count($users) }} total</span>
                </div>

                <!-- Search + filter buttons -->
                <div class="list-toolbar">
                    <input type="search" x-model="search" placeholder="Search name or email..." class="form-input list-search">

                    <div class="filter-tabs">
                        <button type="button" @click="filter = 'all'" :class="{ 'active': filter === 'all' }">All</button>
                        <button type="button" @click="filter = 'assigned'" :class="{ 'active': filter === 'assigned' }">In a room</button>
                        <button type="button" @click="filter = 'unassigned'" :class="{ 'active': filter === 'unassigned' }">No room ({{ $unassigned }})</button>
                    </div>
                </div>

                @if (count($users) > 0)
                    <ul class="setting-list">
                        @foreach ($users as $user)
                            @php
                                $currentRoom = $roomsById->get($user['room_id']);
                                $state = $currentRoom ? 'assigned' : 'unassigned';
                                $searchText = strtolower($user['name'].' '.$user['email']);
                            @endphp

                            <li class="assign-row"
                                x-show="(filter === 'all' || filter === '{{ $state }}') && @js($searchText).includes(search.toLowerCase())">

                                <!-- First letter of the user's name -->
                                <span class="user-avatar">{{ strtoupper(substr($user['name'], 0, 1)) }}</span>

                                <div class="expense-info">
                                    <p>{{ $user['name'] }}</p>
                                    <small>{{ $user['email'] }}</small>
                                </div>

                                {{-- TODO: set action to the assign-room route and remove onsubmit
                                     once the rooms table and controller are ready. --}}
                                <form method="POST" action="#" onsubmit="event.preventDefault()" class="assign-form">
                                    @csrf

                                    <select name="room_id" class="form-input assign-select" aria-label="Room for {{ $user['name'] }}">
                                        <option value="">No room</option>
                                        @foreach ($rooms as $room)
                                            @php
                                                $isCurrent = $user['room_id'] === $room['id'];
                                                $isFull = $room['members_count'] >= $room['capacity'];
                                            @endphp
                                            {{-- A full room can't be picked, unless the user is already in it --}}
                                            <option value="{{ $room['id'] }}" @selected($isCurrent) @disabled($isFull && ! $isCurrent)>
                                                {{ $room['name'] }} ({{ $room['members_count'] }}/{{ $room['capacity'] }}){{ $isFull && ! $isCurrent ? ' - full' : '' }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="btn-save-sm">Save</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <!-- Shown when there are no users yet -->
                    <div class="setting-empty">
                        <span class="stat-icon icon-indigo">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.4-1.8M17 20H7m10 0v-2c0-.7-.1-1.3-.4-1.8M7 20H2v-2a3 3 0 015.4-1.8M7 20v-2c0-.7.1-1.3.4-1.8m0 0a5 5 0 019.2 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </span>
                        <p>No users yet</p>
                        <small>Users will show here after they register.</small>
                    </div>
                @endif
            </div>

            <!-- Rooms that still have free beds -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2>Rooms with free beds</h2>
                        <p class="dash-muted">Where new members can go</p>
                    </div>
                    <span class="dash-badge">{{ $freeRooms->count() }} rooms</span>
                </div>

                @if ($freeRooms->count() > 0)
                    <ul class="setting-list">
                        @foreach ($freeRooms as $room)
                            <li>
                                <span class="stat-icon icon-green">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                </span>
                                <div class="expense-info">
                                    <p>{{ $room['name'] }}</p>
                                    <small>{{ $room['members_count'] }} / {{ $room['capacity'] }} members</small>
                                </div>
                                <span class="room-status status-available">{{ $room['capacity'] - $room['members_count'] }} free</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="setting-empty">
                        <p>All rooms are full</p>
                        <small>Add a new room from the Rooms page.</small>
                    </div>
                @endif

                <!-- Users still waiting for a room -->
                @if ($unassigned > 0)
                    <p class="assign-warning">
                        {{ $unassigned }} {{ Str::plural('user', $unassigned) }} still {{ $unassigned === 1 ? 'has' : 'have' }} no room.
                        They won't show under any room when someone adds an expense.
                    </p>
                @endif
            </div>

        </div>

    </div>

</div>
</x-app-layout>

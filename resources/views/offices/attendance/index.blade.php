@extends('layouts.app')

@section('content')
<style>
    .dashboard-container {
        display: flex;
        min-height: 100vh;
    }
    .sidebar {
        width: 260px;
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .sidebar .logo {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
    }
    .sidebar .logo img {
        width: 36px;
        height: 36px;
    }
    .sidebar .logo span {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
    }
    .sidebar .nav {
        display: flex;
        flex-direction: column;
        margin-top: 8px;
        flex: 1;
    }
    .sidebar .nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        font-size: 0.95rem;
        color: #374151;
        text-decoration: none;
        transition: all 0.2s;
        border-left: 3px solid transparent;
        font-weight: 500;
    }
    .sidebar .nav a:hover {
        background: #f9fafb;
        color: #111827;
    }
    .sidebar .nav a.active {
        background: #f9fafb;
        color: #111827;
        border-left: 3px solid #3b82f6;
    }
    .sidebar .nav a .icon {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .sidebar .profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        border-top: 1px solid #e5e7eb;
        cursor: pointer;
        position: relative;
    }
    .sidebar .profile .avatar {
        width: 36px;
        height: 36px;
        background: #e5e7eb;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #374151;
    }
    .sidebar .profile-details {
        display: flex;
        flex-direction: column;
        font-size: 0.85rem;
    }
    .sidebar .profile-details .name {
        font-weight: 600;
        color: #111827;
        font-size: 0.9rem;
        letter-spacing: 0.05em;
    }
    .sidebar .profile-details .username {
        font-size: 0.75rem;
        color: #6b7280;
        letter-spacing: 0.05em;
    }
    #logoutMenu {
        display: none;
        position: absolute;
        bottom: 60px;
        left: 20px;
        background: #fff;
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        padding: 24px 20px 16px 20px;
        min-width: 220px;
        z-index: 100;
        text-align: center;
    }
    #logoutMenu a,
    #logoutMenu button {
        display: block;
        width: 100%;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 8px;
        padding: 8px 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border: none;
        transition: background 0.2s, box-shadow 0.2s;
        text-align: center;
        cursor: pointer;
    }
    #logoutMenu a {
        background: #4f8ef7;
        color: #fff;
        text-decoration: none;
    }
    #logoutMenu a:hover {
        background: #2563eb;
    }
    #logoutMenu button {
        background: linear-gradient(90deg, #ef4444, #dc2626);
        color: #fff;
    }
    #logoutMenu button:hover {
        background: linear-gradient(90deg, #b91c1c, #dc2626);
        box-shadow: 0 4px 16px rgba(239,68,68,0.15);
    }
    .main-content {
        flex: 1;
        background: #f9fafb;
        display: flex;
        flex-direction: column;
        padding: 20px;
    }
</style>
<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div>
            <div class="logo">
                <img src="/images/assistracklogo.png" alt="Logo">
                <span>Assistrack Portal</span>
            </div>
            <nav class="nav">
                <a href="{{ route('offices.dashboard') }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="14" width="7" height="7" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" rx="1"/>
                        </svg>
                    </span>
                    Dashboard
                </a>
                <a href="{{ route('offices.studentlists.index') }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="7" r="4" />
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        </svg>
                    </span>
                    Student List
                </a>
                <a href="{{ route('attendance.index') }}" class="active">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 11l3 3L22 4"/>
                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                        </svg>
                    </span>
                    Attendance
                </a>
                <a href="{{ route('tasks.index') }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"/>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                            <path d="M9 14l2 2 4-4"/>
                        </svg>
                    </span>
                    Tasks
                </a>
            </nav>
        </div>
        <!-- Profile -->
        <div class="profile" id="profileDropdown">
            @if(auth()->user()->profile_photo)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="{{ auth()->user()->name }}" class="avatar" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=667eea&color=fff&size=36" alt="{{ auth()->user()->name }}" class="avatar" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
            @endif
            <div class="profile-details">
                <span class="name">{{ auth()->user()->name }}</span>
                <span class="username">{{ auth()->user()->username }}</span>
            </div>
            <div style="margin-left:auto; display:flex; flex-direction:column; gap:2px; align-items:center;">
                <button id="logoutUp" style="background:none;border:none;cursor:pointer;padding:0;" title="Show Logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                </button>
                <button id="logoutDown" style="background:none;border:none;cursor:pointer;padding:0;" title="Hide Logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </div>
        </div>
        <div id="logoutMenu">
            <a href="{{ route('profile.edit') }}">Settings</a>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </aside>
    <!-- Main Content -->
    <section class="main-content">
        <!-- ...existing DTR content (header, form, records, stats) goes here... -->
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .fade-in {
                animation: fadeIn 0.3s ease-in;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .pulse-animation {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: .5; }
            }
        </style>
        <div class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">
            <div class="container mx-auto p-4 max-w-7xl fade-in">
                <!-- Header Section -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-indigo-700">Daily Time Record (DTR)</h1>
                        <p class="text-sm text-gray-500">Track student attendance by ID number</p>
                    </div>
                    <div class="text-right">
                        <span id="currentDate" class="block text-md text-gray-700 font-semibold"></span>
                        <span id="currentTime" class="block text-lg text-indigo-600 font-bold"></span>
                    </div>
                </div>

                <!-- Attendance Form -->
                @if($errors->has('id_number'))
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded shadow fade-in">
                        <strong>Error:</strong> {{ $errors->first('id_number') }}
                    </div>
                @endif
                <form id="attendanceForm" method="POST" action="{{ route('attendance.store') }}" class="bg-white rounded-lg shadow p-6 mb-8 flex flex-col md:flex-row items-center gap-4">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto flex-1">
                        <input type="text" name="id_number" id="idNumber" value="{{ old('id_number') }}" class="border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 w-full md:w-48" placeholder="Enter Student ID" required autofocus>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" name="action" value="in" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow">Time In</button>
                        <button type="submit" name="action" value="out" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2 rounded shadow">Time Out</button>
                    </div>
                </form>

                <!-- Success Message -->
                @if(session('success'))
                    <div id="successAlert" class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow fade-in">
                        {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            var alert = document.getElementById('successAlert');
                            if (alert) alert.style.display = 'none';
                        }, 3000);
                    </script>
                @endif

                <!-- Stats Section -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white rounded-lg shadow p-4 text-center">
                        <div class="text-3xl font-bold text-indigo-600">{{ $stats['total'] ?? 0 }}</div>
                        <div class="text-gray-500">Total Records</div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 text-center">
                        <div class="text-3xl font-bold text-green-600">{{ $stats['clock_ins'] ?? 0 }}</div>
                        <div class="text-gray-500">Time Ins</div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 text-center">
                        <div class="text-3xl font-bold text-purple-600">{{ $stats['clock_outs'] ?? 0 }}</div>
                        <div class="text-gray-500">Time Outs</div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 text-center">
                        <div class="text-3xl font-bold text-blue-600">{{ $stats['unique_users'] ?? 0 }}</div>
                        <div class="text-gray-500">Unique Students</div>
                    </div>
                </div>

                <!-- Today's Attendance Records -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-indigo-700 mb-4">Today's Attendance Records</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-indigo-50 text-indigo-700">
                                    <th class="px-4 py-2 text-left">#</th>
                                    <th class="px-4 py-2 text-left">ID Number</th>
                                    <th class="px-4 py-2 text-left">Name</th>
                                    <th class="px-4 py-2 text-left">Time In</th>
                                    <th class="px-4 py-2 text-left">Time Out</th>
                                    <th class="px-4 py-2 text-left">Total Hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($todayRecords as $i => $record)
                                    <tr class="border-b hover:bg-indigo-50">
                                        <td class="px-4 py-2">{{ $i + 1 }}</td>
                                        <td class="px-4 py-2 font-mono">{{ $record['id_number'] }}</td>
                                        <td class="px-4 py-2">{{ $record['name'] ?? '-' }}</td>
                                        <td class="px-4 py-2">
                                            @if($record['time_in'])
                                                <span class="inline-block px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-semibold">
                                                    {{ \Carbon\Carbon::parse($record['time_in'])->format('h:i:s A') }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            @if($record['time_out'])
                                                <span class="inline-block px-2 py-1 rounded bg-purple-100 text-purple-700 text-xs font-semibold">
                                                    {{ \Carbon\Carbon::parse($record['time_out'])->format('h:i:s A') }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            @if($record['total_hours'])
                                                {{ number_format($record['total_hours'], 2) }}
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-6 text-center text-gray-400">No attendance records yet for today.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</div>
<script>
    // Update real-time clock
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        });
        const dateString = now.toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        document.getElementById('currentTime').textContent = timeString;
        document.getElementById('currentDate').textContent = dateString;
    }
    // Initialize clock
    updateClock();
    setInterval(updateClock, 1000);

    // Real-time attendance records update (AJAX polling)
    function fetchAttendanceRecords() {
        fetch("{{ route('attendance.index') }}?ajax=1")
            .then(response => response.text())
            .then(html => {
                // Extract only the table body from the returned HTML
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTbody = doc.querySelector('.bg-white.shadow table tbody');
                if (newTbody) {
                    const table = document.querySelector('.bg-white.shadow table');
                    const oldTbody = table.querySelector('tbody');
                    oldTbody.innerHTML = newTbody.innerHTML;
                }
            });
    }
    setInterval(fetchAttendanceRecords, 30000);

    // Clear form after submission
    const form = document.getElementById('attendanceForm');
    form.addEventListener('submit', function() {
        setTimeout(() => {
            document.getElementById('idNumber').value = '';
            document.getElementById('userName').value = '';
            document.getElementById('idNumber').focus();
        }, 100);
    });
    // Auto-focus on ID number field when page loads
    window.addEventListener('load', function() {
        document.getElementById('idNumber').focus();
    });
    // Add enter key support for quick time in
    document.getElementById('idNumber').addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && this.value.trim() !== '') {
            e.preventDefault();
            // Trigger time in button
            const timeInBtn = form.querySelector('button[value="in"]');
            timeInBtn.click();
        }
    });
</script>
@endsection
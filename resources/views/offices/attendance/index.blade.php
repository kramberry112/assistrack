@extends('layouts.app')

@section('page-title')
    ATTENDANCE (DTR)
@endsection

@section('page-icon')
    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2">
        <path d="M9 11l3 3L22 4"/>
        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
    </svg>
@endsection

@section('header-actions')
    <div class="text-right">
        <span id="currentDate" class="block text-sm text-gray-700 font-semibold"></span>
        <span id="currentTime" class="block text-md text-indigo-600 font-bold"></span>
    </div>
@endsection

@section('content')
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
<div style="padding: 32px; background: #f9fafb; min-height: calc(100vh - 80px);">
    <div style="max-width: 1200px; margin: 0 auto;">

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
                                            @if($record['time_out'])
                                                @if(isset($record['accumulated_hours']) && $record['accumulated_hours'] > 0)
                                                    <span class="font-semibold text-indigo-700">{{ number_format($record['accumulated_hours'], 2) }} hrs</span>
                                                @else
                                                    <span class="text-gray-400">0.00 hrs</span>
                                                @endif
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
@extends('layouts.app')

@section('page-title')
    <i class="bi bi-people-fill" style="margin-right: 8px;"></i>
    Attendance Report
@endsection

@section('content')
<style>
    .content-wrapper {
        background: #fff !important;
    }
</style>
<div style="padding: 24px; background: #fff; min-height: calc(100vh - 76px);">
        <!-- Date Filter Form -->
        <form method="GET" action="{{ route('head.reports.attendance') }}" class="mb-6 flex items-center gap-3">
            <label for="date" class="text-sm font-medium text-gray-700">Select Date:</label>
            <input type="date" id="date" name="date" value="{{ request('date', now()->format('Y-m-d')) }}" 
                   class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition">
                View Report
            </button>
        </form>

        <!-- Attendance Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <tr>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">#</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">ID Number</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">Name</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">Designated Office</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">Date</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">Time In</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">Time Out</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">Total Hours</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($records as $i => $record)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900">
                                {{ $i + 1 }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900">
                                {{ $record['id_number'] }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900">
                                {{ $record['name'] ?? '-' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-600">
                                {{ $record['office'] ?? '-' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900">
                                {{ $record['date'] ?? (isset($record['time_in']) ? \Carbon\Carbon::parse($record['time_in'])->format('M d, Y') : '-') }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900">
                                @if($record['time_in'])
                                    {{ \Carbon\Carbon::parse($record['time_in'])->format('h:i A') }}
                                @else
                                    <span class="text-gray-400 font-bold">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900">
                                @if($record['time_out'])
                                    {{ \Carbon\Carbon::parse($record['time_out'])->format('h:i A') }}
                                @else
                                    <span class="text-gray-400 font-bold">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900">
                                @if($record['total_hours'])
                                    {{ number_format($record['total_hours'], 2) }} hrs
                                @else
                                    <span class="text-gray-400 font-bold">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm">
                                @php $status = $record['status'] ?? '-' @endphp
                                @if($status !== '-')
                                    <span class="inline-flex px-2 py-1 text-xs font-bold rounded
                                        @if(strtolower($status) == 'present') bg-green-100 text-green-800
                                        @elseif(strtolower($status) == 'late') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $status }}
                                    </span>
                                @else
                                    <span class="text-gray-400 font-bold">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-8 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">No attendance records found</p>
                                <p class="text-xs text-gray-400">Records will appear here once students clock in</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</div>
@endsection

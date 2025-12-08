@extends('layouts.app')

@section('page-title')
    <i class="bi bi-people-fill" style="margin-right: 8px;"></i>
    Attendance Report
@endsection

@section('content')
<style>
    /* Prevent horizontal scroll */
    * {
        box-sizing: border-box;
    }
    
    html, body {
        overflow-x: hidden;
        max-width: 100vw;
    }
    
    .content-wrapper {
        background: #fff !important;
    }
    .admin-content-wrapper {
        background: #fff !important;
    }
    
    /* Ensure containers don't overflow */
    .overflow-x-auto {
        max-width: 100%;
        overflow: auto;
    }
    
    /* Hide mobile cards by default */
    .mobile-attendance-cards {
        display: none;
    }
    
    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        /* Container adjustments */
        div[style*="padding: 24px"] {
            padding: 8px !important;
            max-width: 100vw !important;
            overflow: hidden !important;
        }
        
        /* Date filter form - mobile friendly */
        .mb-6 {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 12px !important;
            margin-bottom: 16px !important;
            padding: 0 !important;
        }
        
        .mb-6 label {
            font-size: 0.9rem !important;
            margin-bottom: 4px !important;
            display: block !important;
        }
        
        .mb-6 input[type="date"] {
            width: 100% !important;
            padding: 12px 8px !important;
            font-size: 1rem !important;
            border-radius: 8px !important;
            border: 1px solid #d1d5db !important;
        }
        
        .mb-6 button {
            width: 100% !important;
            padding: 12px !important;
            font-size: 1rem !important;
            border-radius: 8px !important;
            margin-top: 8px !important;
            background: #2563eb !important;
            color: #fff !important;
            border: none !important;
        }
        
        .mb-6 button:hover {
            background: #1d4ed8 !important;
        }
        
        /* Hide table on mobile */
        .overflow-x-auto {
            display: none !important;
        }
        
        /* Show mobile cards instead */
        .mobile-attendance-cards {
            display: block !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        .attendance-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 100%;
            overflow: hidden;
        }
        
        .attendance-card-header {
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .attendance-card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 4px 0;
            word-wrap: break-word;
        }
        
        .attendance-card-subtitle {
            font-size: 0.8rem;
            color: #6b7280;
            margin: 0;
        }
        
        .attendance-card-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .attendance-detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px 0;
        }
        
        .attendance-detail-label {
            font-size: 0.8rem;
            color: #6b7280;
            font-weight: 500;
            flex-shrink: 0;
        }
        
        .attendance-detail-value {
            font-size: 0.85rem;
            color: #111827;
            font-weight: 600;
            text-align: right;
            word-wrap: break-word;
            max-width: 60%;
        }
        
        .status-badge-mobile {
            display: inline-flex;
            align-items: center;
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 500;
        }
        
        .status-present { background: #d1fae5; color: #065f46; }
        .status-late { background: #fef3c7; color: #92400e; }
        .status-absent { background: #fee2e2; color: #991b1b; }
        .status-default { background: #f3f4f6; color: #374151; }
    }
    
    /* Ultra mobile (small phones) */
    @media (max-width: 480px) {
        div[style*="padding: 24px"] {
            padding: 4px !important;
        }
        
        .attendance-card {
            padding: 12px !important;
            margin-bottom: 8px !important;
        }
        
        .attendance-card-title {
            font-size: 0.9rem !important;
        }
        
        .attendance-card-subtitle {
            font-size: 0.75rem !important;
        }
        
        .attendance-detail-label,
        .attendance-detail-value {
            font-size: 0.75rem !important;
        }
        
        .mb-6 input[type="date"],
        .mb-6 button {
            padding: 10px 6px !important;
        }
    }
</style>
<div style="padding: 24px; background: #fff; min-height: calc(100vh - 76px);">
        <!-- Filter Bar -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
            <!-- Date Filter Form -->
            <form method="GET" action="{{ route('admin.attendance.report') }}" class="flex items-center gap-3" style="flex: 1; min-width: 300px;">
                <label for="date" class="text-sm font-medium text-gray-700">Select Date:</label>
                <input type="date" id="date" name="date" value="{{ request('date', now()->format('Y-m-d')) }}" 
                       class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition">
                    View Report
                </button>
            </form>
            
            <!-- Filter Button -->
            <button onclick="toggleFilters()" class="filter-btn" style="display: flex; align-items: center; gap: 6px; background: #6366f1; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 500;">
                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filters
            </button>
        </div>
        
        <!-- Filter Panel -->
        <div id="filterPanel" style="display: none; background: #f8f9fa; border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px;">Office</label>
                    <select id="officeFilter" onchange="applyFilters()" style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
                        <option value="">All Offices</option>
                        <option value="ACADS">ACADS</option>
                        <option value="ALUMNI OFFICE">ALUMNI OFFICE</option>
                        <option value="ARCHIVING">ARCHIVING</option>
                        <option value="ARZATECH">ARZATECH</option>
                        <option value="CANTEEN">CANTEEN</option>
                        <option value="CLINIC">CLINIC</option>
                        <option value="FINANCE">FINANCE</option>
                        <option value="GUIDANCE">GUIDANCE</option>
                        <option value="HRD">HRD</option>
                        <option value="KUWAGO">KUWAGO</option>
                        <option value="LCR">LCR</option>
                        <option value="LIBRARY">LIBRARY</option>
                        <option value="LINKAGES">LINKAGES</option>
                        <option value="MARKETING">MARKETING</option>
                        <option value="OPEN LAB">OPEN LAB</option>
                        <option value="PRESIDENT'S OFFICE">PRESIDENT'S OFFICE</option>
                        <option value="QUEUING">QUEUING</option>
                        <option value="QUALITY ASSURANCE">QUALITY ASSURANCE</option>
                        <option value="REGISTRAR">REGISTRAR</option>
                        <option value="SAO">SAO</option>
                        <option value="SBA FACULTY">SBA FACULTY</option>
                        <option value="SIHM FACULTY">SIHM FACULTY</option>
                        <option value="SITE FACULTY">SITE FACULTY</option>
                        <option value="SOE FACULTY">SOE FACULTY</option>
                        <option value="SOH FACULTY">SOH FACULTY</option>
                        <option value="SOHS FACULTY">SOHS FACULTY</option>
                        <option value="SOC FACULTY">SOC FACULTY</option>
                        <option value="SPORTS AND CULTURE">SPORTS AND CULTURE</option>
                        <option value="STE DEAN'S OFFICE">STE DEAN'S OFFICE</option>
                        <option value="STE FACULTY">STE FACULTY</option>
                        <option value="STEEDS">STEEDS</option>
                        <option value="XACTO">XACTO</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px;">Status</label>
                    <select id="statusFilter" onchange="applyFilters()" style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
                        <option value="">All Status</option>
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>
                        <option value="Incomplete">Incomplete</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px;">Search</label>
                    <input type="text" id="searchFilter" oninput="applyFilters()" placeholder="Search by name or ID..." style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
                </div>
                <div style="display: flex; align-items: flex-end;">
                    <button onclick="clearFilters()" style="background: #6b7280; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 14px; width: 100%;">
                        Clear Filters
                    </button>
                </div>
            </div>
        </div>

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
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                {{ $i + 1 }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                {{ $record['id_number'] }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                {{ $record['name'] ?? '-' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                {{ $record['office'] ?? '-' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                {{ $record['date'] ?? (isset($record['time_in']) ? \Carbon\Carbon::parse($record['time_in'])->format('M d, Y') : '-') }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                @if($record['time_in'])
                                    {{ \Carbon\Carbon::parse($record['time_in'])->format('h:i A') }}
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                @if($record['time_out'])
                                    {{ \Carbon\Carbon::parse($record['time_out'])->format('h:i A') }}
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                @if($record['total_hours'])
                                    {{ number_format($record['total_hours'], 2) }} hrs
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm">
                                @php $status = $record['status'] ?? '-' @endphp
                                @if($status !== '-')
                                    <span class="inline-flex px-2 py-1 text-xs rounded
                                        @if(strtolower($status) == 'present') bg-green-100 text-green-800
                                        @elseif(strtolower($status) == 'late') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $status }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
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
            <div id="noResultsMessage" style="display: none; padding: 48px 20px; text-align: center; color: #9ca3af; background: white;">
                <svg style="width: 48px; height: 48px; margin: 0 auto 16px; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <p style="font-size: 16px; font-weight: 500;">No matching records found</p>
                <p style="font-size: 14px; color: #6b7280; margin-top: 8px;">Try adjusting your filters</p>
            </div>
        </div>
        
        <!-- Mobile Cards View -->
        <div class="mobile-attendance-cards">
            @forelse($records as $i => $record)
                <div class="attendance-card">
                    <div class="attendance-card-header">
                        <h3 class="attendance-card-title">{{ $record['name'] ?? 'N/A' }}</h3>
                        <p class="attendance-card-subtitle">ID: {{ $record['id_number'] }}</p>
                    </div>
                    
                    <div class="attendance-card-details">
                        <div class="attendance-detail-item">
                            <span class="attendance-detail-label">Office:</span>
                            <span class="attendance-detail-value">{{ $record['office'] ?? '-' }}</span>
                        </div>
                        
                        <div class="attendance-detail-item">
                            <span class="attendance-detail-label">Date:</span>
                            <span class="attendance-detail-value">{{ $record['date'] ?? (isset($record['time_in']) ? \Carbon\Carbon::parse($record['time_in'])->format('M d, Y') : '-') }}</span>
                        </div>
                        
                        <div class="attendance-detail-item">
                            <span class="attendance-detail-label">Time In:</span>
                            <span class="attendance-detail-value">
                                @if($record['time_in'])
                                    {{ \Carbon\Carbon::parse($record['time_in'])->format('h:i A') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        
                        <div class="attendance-detail-item">
                            <span class="attendance-detail-label">Time Out:</span>
                            <span class="attendance-detail-value">
                                @if($record['time_out'])
                                    {{ \Carbon\Carbon::parse($record['time_out'])->format('h:i A') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        
                        <div class="attendance-detail-item">
                            <span class="attendance-detail-label">Total Hours:</span>
                            <span class="attendance-detail-value">
                                @if($record['total_hours'])
                                    {{ number_format($record['total_hours'], 2) }} hrs
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        
                        <div class="attendance-detail-item">
                            <span class="attendance-detail-label">Status:</span>
                            <span class="attendance-detail-value">
                                @php $status = $record['status'] ?? '-' @endphp
                                @if($status !== '-')
                                    <span class="status-badge-mobile 
                                        @if(strtolower($status) == 'present') status-present
                                        @elseif(strtolower($status) == 'late') status-late
                                        @elseif(strtolower($status) == 'absent') status-absent
                                        @else status-default
                                        @endif">
                                        {{ $status }}
                                    </span>
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="attendance-card">
                    <div style="text-align: center; padding: 24px;">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">No attendance records found</p>
                        <p class="text-xs text-gray-400">Records will appear here once students clock in</p>
                    </div>
                </div>
            @endforelse
        </div>
</div>

<script>
function toggleFilters() {
    const panel = document.getElementById('filterPanel');
    panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
}

function applyFilters() {
    const officeFilter = document.getElementById('officeFilter').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
    const searchFilter = document.getElementById('searchFilter').value.toLowerCase();
    
    // Filter desktop table rows
    const tableRows = document.querySelectorAll('.overflow-x-auto tbody tr');
    tableRows.forEach(row => {
        const office = row.cells[3]?.textContent.toLowerCase() || '';
        const status = row.cells[8]?.textContent.toLowerCase() || '';
        const name = row.cells[2]?.textContent.toLowerCase() || '';
        const idNumber = row.cells[1]?.textContent.toLowerCase() || '';
        
        const officeMatch = !officeFilter || office.includes(officeFilter);
        const statusMatch = !statusFilter || status.includes(statusFilter);
        const searchMatch = !searchFilter || name.includes(searchFilter) || idNumber.includes(searchFilter);
        
        row.style.display = (officeMatch && statusMatch && searchMatch) ? '' : 'none';
    });
    
    // Check if any rows are visible
    const visibleRows = Array.from(tableRows).filter(row => row.style.display !== 'none');
    const noResultsMsg = document.getElementById('noResultsMessage');
    const table = document.querySelector('.overflow-x-auto table');
    if (visibleRows.length === 0 && tableRows.length > 0) {
        if (noResultsMsg) noResultsMsg.style.display = 'block';
        if (table) table.style.display = 'none';
    } else {
        if (noResultsMsg) noResultsMsg.style.display = 'none';
        if (table) table.style.display = 'table';
    }
    
    // Filter mobile cards
    const mobileCards = document.querySelectorAll('.mobile-attendance-cards .attendance-card');
    mobileCards.forEach(card => {
        const office = card.querySelector('.attendance-detail-value:nth-of-type(2)')?.textContent.toLowerCase() || '';
        const status = card.querySelector('.attendance-detail-value:last-child')?.textContent.toLowerCase() || '';
        const name = card.querySelector('.attendance-card-title')?.textContent.toLowerCase() || '';
        const idNumber = card.querySelector('.attendance-card-subtitle')?.textContent.toLowerCase() || '';
        
        const officeMatch = !officeFilter || office.includes(officeFilter);
        const statusMatch = !statusFilter || status.includes(statusFilter);
        const searchMatch = !searchFilter || name.includes(searchFilter) || idNumber.includes(searchFilter);
        
        card.style.display = (officeMatch && statusMatch && searchMatch) ? '' : 'none';
    });
}

function clearFilters() {
    document.getElementById('officeFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('searchFilter').value = '';
    applyFilters();
}

// Populate office dropdown with unique offices
</script>

@endsection
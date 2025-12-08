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
    
    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        /* Container adjustments */
        div[style*="padding: 24px"] {
            padding: 16px !important;
        }
        
        /* Date filter form - mobile friendly */
        .mb-6 {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 12px !important;
            margin-bottom: 20px !important;
        }
        
        .mb-6 label {
            font-size: 0.9rem !important;
            margin-bottom: 4px !important;
        }
        
        .mb-6 input[type="date"] {
            width: 100% !important;
            padding: 12px !important;
            font-size: 1rem !important;
            border: 1px solid #d1d5db !important;
            border-radius: 8px !important;
        }
        
        .mb-6 button {
            width: 100% !important;
            padding: 14px 16px !important;
            font-size: 1rem !important;
            background-color: #2563eb !important;
            color: white !important;
            border: none !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
        }
        
        .mb-6 button:hover {
            background-color: #1d4ed8 !important;
        }
        
        /* Hide table on mobile */
        .overflow-x-auto table {
            display: none;
        }
        
        /* Show mobile cards instead */
        .mobile-attendance-cards {
            display: block !important;
        }
        
        .attendance-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        
        .attendance-card-header {
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .attendance-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 4px 0;
        }
        
        .attendance-card-subtitle {
            font-size: 0.85rem;
            color: #6b7280;
            margin: 0;
        }
        
        .attendance-card-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .attendance-detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .attendance-detail-label {
            font-size: 0.85rem;
            color: #6b7280;
            font-weight: 500;
        }
        
        .attendance-detail-value {
            font-size: 0.85rem;
            color: #111827;
            font-weight: 600;
            text-align: right;
        }
        
        .status-badge {
            font-size: 0.75rem !important;
            padding: 4px 8px !important;
        }
        
        /* Empty state */
        .empty-attendance-state {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
        }
        
        .empty-attendance-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
    
    @media (max-width: 480px) {
        div[style*="padding: 24px"] 
            padding: 12px !important;
        }
        
        .attendance-card {
            padding: 16px !important;
            margin-bottom: 12px !important;
        }
        
        .attendance-card-title {
            font-size: 1rem !important;
            line-height: 1.3 !important;
        }
        
        .attendance-card-subtitle {
            font-size: 0.8rem !important;
        }
        
        .attendance-detail-item {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 4px !important;
        }
        
        .attendance-detail-value {
            text-align: left !important;
        }
        
        .status-badge {
            font-size: 0.7rem !important;
            padding: 3px 8px !important;
        }
    
    /* Desktop - hide mobile cards */
    .mobile-attendance-cards {
        display: none;
    }
</style>
<div style="padding: 24px; background: #fff; min-height: calc(100vh - 76px); overflow-x: hidden;">
        <!-- Top Controls -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
            <!-- Date Filter Form -->
            <form method="GET" action="{{ route('head.reports.attendance') }}" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                <label for="date" class="text-sm font-medium text-gray-700">Select Date:</label>
                <input type="date" id="date" name="date" value="{{ request('date', now()->format('Y-m-d')) }}" 
                       class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="submit" style="background-color: #2563eb; color: white; padding: 8px 16px; border-radius: 8px; font-size: 0.875rem; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#1d4ed8'" onmouseout="this.style.backgroundColor='#2563eb'">
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
        
        <!-- No Results Message -->
        <div id="noResults" style="display: none; text-align: center; padding: 40px; background: #f9fafb; border-radius: 8px; margin-bottom: 20px;">
            <svg style="width: 48px; height: 48px; margin: 0 auto 16px; color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p style="color: #6b7280; font-size: 14px; margin: 0;">No matching records found</p>
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
                    <tr id="noResults" style="display: none;">
                        <td colspan="9" style="text-align: center; padding: 40px; background: #f9fafb;">
                            <svg style="width: 48px; height: 48px; margin: 0 auto 16px; color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p style="color: #6b7280; font-size: 14px; margin: 0;">No matching records found</p>
                        </td>
                    </tr>
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

<script>
function toggleFilters() {
    const panel = document.getElementById('filterPanel');
    panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
}

function applyFilters() {
    const officeFilter = document.getElementById('officeFilter').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
    const searchFilter = document.getElementById('searchFilter').value.toLowerCase();
    
    const tables = document.querySelectorAll('.overflow-x-auto table tbody');
    let visibleCount = 0;
    
    tables.forEach(table => {
        const rows = table.querySelectorAll('tr');
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length <= 1) return; // Skip empty row
        
        const office = cells[3]?.textContent.trim().toLowerCase() || '';
        const status = cells[8]?.textContent.trim().toLowerCase() || '';
        const name = cells[2]?.textContent.trim().toLowerCase() || '';
        const idNumber = cells[1]?.textContent.trim().toLowerCase() || '';
        
        const officeMatch = !officeFilter || office.includes(officeFilter);
        const statusMatch = !statusFilter || status.includes(statusFilter);
        const searchMatch = !searchFilter || name.includes(searchFilter) || idNumber.includes(searchFilter);
        
            if (officeMatch && statusMatch && searchMatch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Show/hide no results message
    const noResults = document.getElementById('noResults');
    if (visibleCount === 0) {
        noResults.style.display = 'table-row';
    } else {
        noResults.style.display = 'none';
    }
}

function clearFilters() {
    document.getElementById('officeFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('searchFilter').value = '';
    applyFilters();
}
</script>
@endsection

@extends('layouts.app')

@section('page-title')
    <i class="bi bi-people-fill" style="margin-right: 8px;"></i>
    Attendance Report
@endsection

@section('content')
<style>
    .content-wrapper { background: #fff !important; }
    .admin-content-wrapper { background: #fff !important; }
    .reports-table { width: 100%; border-collapse: collapse; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
    .reports-table thead tr { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .reports-table th { padding: 18px 16px; text-align: left; font-weight: 600; color: #ffffff; font-size: 14px; border: none; text-transform: uppercase; letter-spacing: 0.5px; }
    .reports-table th:first-child { border-top-left-radius: 8px; }
    .reports-table th:last-child { border-top-right-radius: 8px; }
    .reports-table tbody tr { border-bottom: 1px solid #e9ecef; transition: background-color 0.2s ease; }
    .reports-table tbody tr:last-child { border-bottom: none; }
    .reports-table tbody tr:hover { background-color: #f8f9fa; }
    .reports-table td { padding: 18px 16px; color: #495057; font-size: 14px; }
    .empty-state { text-align: center; padding: 40px 20px; color: #6c757d; }
    .empty-state-icon { font-size: 48px; margin-bottom: 16px; opacity: 0.5; }
    .empty-state-text { font-size: 16px; font-weight: 500; }
    .status-badge { display: inline-block; padding: 4px 12px; border-radius: 12px; font-weight: 600; font-size: 13px; }
    .mobile-attendance-cards { display: none; }
</style>
<div style="padding: 24px; background: #fff; min-height: calc(100vh - 76px);">
    <!-- Date Filter Form and Filter Button -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <form method="GET" action="{{ route('offices.reports.attendance') }}" class="flex items-center gap-3">
            <label for="date" class="text-sm font-medium text-gray-700">Select Date:</label>
            <input type="date" id="date" name="date" value="{{ request('date', now()->format('Y-m-d')) }}" 
                   class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition">
                View Report
            </button>
        </form>
        
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
                <label style="display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px;">School Year</label>
                <select id="schoolYearFilter" onchange="applyFilters()" style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
                    <option value="">All School Years</option>
                    @foreach($availableSchoolYears as $year)
                        <option value="{{ $year }}" {{ $selectedSchoolYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px;">Semester</label>
                <select id="semesterFilter" onchange="applyFilters()" style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
                    <option value="">All Semesters</option>
                    @foreach($availableSemesters as $semester)
                        <option value="{{ $semester }}" {{ $selectedSemester == $semester ? 'selected' : '' }}>{{ $semester }}</option>
                    @endforeach
                </select>
            </div>
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
                    <option value="Late">Late</option>
                    <option value="Absent">Absent</option>
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
    <table class="reports-table">
        <thead>
            <tr>
                <th>#</th>
                <th>ID Number</th>
                <th>Name</th>
                <th>Designated Office</th>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Total Hours</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($records as $i => $record)
                <tr data-school-year="{{ $record['school_year'] ?? '' }}" data-semester="{{ $record['semester'] ?? '' }}" data-office="{{ $record['office'] ?? '' }}">
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $record['id_number'] }}</td>
                    <td>{{ $record['name'] ?? '-' }}</td>
                    <td>{{ $record['office'] ?? '-' }}</td>
                    <td>{{ $record['date'] ?? (isset($record['time_in']) ? \Carbon\Carbon::parse($record['time_in'])->format('M d, Y') : '-') }}</td>
                    <td>
                        @if($record['time_in'])
                            {{ \Carbon\Carbon::parse($record['time_in'])->format('h:i A') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($record['time_out'])
                            {{ \Carbon\Carbon::parse($record['time_out'])->format('h:i A') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($record['total_hours'])
                            {{ number_format($record['total_hours'], 2) }} hrs
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @php $status = $record['status'] ?? '-' @endphp
                        @if($status !== '-')
                            <span class="status-badge" style="background-color: 
                                @if(strtolower($status) == 'present') #d4edda; color: #155724;
                                @elseif(strtolower($status) == 'late') #fff3cd; color: #856404;
                                @else #e2e3e5; color: #383d41;
                                @endif">
                                {{ $status }}
                            </span>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">
                        <div class="empty-state">
                            <div class="empty-state-icon">📅</div>
                            <div class="empty-state-text">No attendance records found for the selected date</div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- ...existing mobile cards code... -->
</div>

<script>
// Filter functions
function toggleFilters() {
    const panel = document.getElementById('filterPanel');
    panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
}

function applyFilters() {
    const schoolYearValue = document.getElementById('schoolYearFilter').value.toLowerCase();
    const semesterValue = document.getElementById('semesterFilter').value.toLowerCase();
    const officeValue = document.getElementById('officeFilter').value.toLowerCase();
    const statusValue = document.getElementById('statusFilter').value.toLowerCase();
    const searchValue = document.getElementById('searchFilter').value.toLowerCase();
    const table = document.querySelector('.reports-table tbody');
    const rows = table.getElementsByTagName('tr');
    
    let visibleCount = 0;
    for (let row of rows) {
        if (row.querySelector('.empty-state')) continue;
        
        const cells = row.getElementsByTagName('td');
        const schoolYear = (row.getAttribute('data-school-year') || '').toLowerCase();
        const semester = (row.getAttribute('data-semester') || '').toLowerCase();
        const office = (row.getAttribute('data-office') || '').toLowerCase();
        const idNumber = cells[1]?.textContent.toLowerCase() || '';
        const name = cells[2]?.textContent.toLowerCase() || '';
        const statusCell = cells[8];
        const status = statusCell?.textContent.trim().toLowerCase() || '';
        
        const matchesSchoolYear = !schoolYearValue || schoolYear.includes(schoolYearValue);
        const matchesSemester = !semesterValue || semester.includes(semesterValue);
        const matchesOffice = !officeValue || office.includes(officeValue);
        const matchesStatus = !statusValue || status.includes(statusValue);
        const matchesSearch = !searchValue || idNumber.includes(searchValue) || name.includes(searchValue);
        
        if (matchesSchoolYear && matchesSemester && matchesOffice && matchesStatus && matchesSearch) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    }
    
    // Show/hide no results message
    updateNoResultsMessage(table, visibleCount);
}

function clearFilters() {
    document.getElementById('schoolYearFilter').value = '';
    document.getElementById('semesterFilter').value = '';
    document.getElementById('officeFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('searchFilter').value = '';
    applyFilters();
}

function updateNoResultsMessage(table, visibleCount) {
    let noResultsRow = table.querySelector('.no-results-row');
    
    if (visibleCount === 0) {
        if (!noResultsRow) {
            noResultsRow = document.createElement('tr');
            noResultsRow.className = 'no-results-row';
            noResultsRow.innerHTML = `
                <td colspan="9" style="text-align: center; padding: 40px; color: #6b7280;">
                    <svg style="width: 48px; height: 48px; margin: 0 auto 12px; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <div style="font-size: 16px; font-weight: 500;">No matching records found</div>
                    <div style="font-size: 14px; margin-top: 4px;">Try adjusting your filters</div>
                </td>
            `;
            table.appendChild(noResultsRow);
        }
        noResultsRow.style.display = '';
    } else if (noResultsRow) {
        noResultsRow.style.display = 'none';
    }
}
</script>
<script>
// Auto-apply filters on page load if session values exist
document.addEventListener('DOMContentLoaded', function() {
    const schoolYear = '{{ $selectedSchoolYear }}';
    const semester = '{{ $selectedSemester }}';
    
    if (schoolYear || semester) {
        applyFilters();
    }
});
</script>
@endsection
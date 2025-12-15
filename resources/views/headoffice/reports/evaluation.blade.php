@extends('layouts.app')

@section('page-title')
    <i class="bi bi-graph-up-arrow" style="margin-right: 8px;"></i>
    Evaluation Report
@endsection

@section('content')
@php
    // Get filters from session (set by dashboard)
    $selectedSchoolYear = $schoolYear ?? session('head_school_year');
    $selectedSemester = $semester ?? session('head_semester');
    
    // Get distinct school years from students table
    $availableSchoolYears = \App\Models\Student::distinct()
        ->whereNotNull('school_year')
        ->pluck('school_year')
        ->sort()
        ->values();
    
    // Available semesters
    $availableSemesters = ['1st Semester', '2nd Semester', 'Summer'];
@endphp
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
        
        .main-content-card {
            padding: 20px !important;
            margin: 0 !important;
        }
        
        /* Hide table on mobile */
        .reports-table {
            display: none;
        }
        
        /* Show mobile cards instead */
        .mobile-evaluation-cards {
            display: block !important;
        }
        
        .evaluation-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        
        .evaluation-card-header {
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .evaluation-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 8px 0;
        }
        
        .evaluation-card-subtitle {
            font-size: 0.9rem;
            color: #6b7280;
            margin: 0;
        }
        
        .evaluation-card-details {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .evaluation-detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .evaluation-detail-label {
            font-size: 0.9rem;
            color: #6b7280;
            font-weight: 500;
        }
        
        .evaluation-detail-value {
            font-size: 0.9rem;
            color: #111827;
            font-weight: 600;
        }
        
        .evaluation-actions {
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid #f3f4f6;
        }
        
        .evaluation-action-button {
            width: 100% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            padding: 12px 16px !important;
            font-size: 0.9rem !important;
        }
        
        /* Empty state */
        .empty-evaluation-state {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
        }
        
        .empty-evaluation-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
    }
    
    @media (max-width: 480px) {
        div[style*="padding: 24px"] {
            padding: 12px !important;
        }
        
        .evaluation-card {
            padding: 16px !important;
        }
        
        .evaluation-card-title {
            font-size: 1rem !important;
        }
    }
    
    /* Desktop - hide mobile cards */
    .mobile-evaluation-cards {
        display: none;
    }
</style>
<div style="padding: 24px; background: #fff; min-height: calc(100vh - 76px);">
    
    <!-- Filter Button -->
    <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
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
                    @foreach($availableSemesters as $sem)
                        <option value="{{ $sem }}" {{ $selectedSemester == $sem ? 'selected' : '' }}>{{ $sem }}</option>
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

<style>
    .page-header {
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 600;
        color: #7c3aed;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .main-content-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .reports-table {
        width: 100%;
        border-collapse: collapse;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    
    .reports-table thead tr {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .reports-table th {
        padding: 18px 16px;
        text-align: left;
        font-weight: 600;
        color: #ffffff;
        font-size: 14px;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .reports-table th:first-child {
        border-top-left-radius: 8px;
    }

    .reports-table th:last-child {
        border-top-right-radius: 8px;
    }
    
    .reports-table tbody tr {
        border-bottom: 1px solid #e9ecef;
        transition: background-color 0.2s ease;
    }

    .reports-table tbody tr:last-child {
        border-bottom: none;
    }
    
    .reports-table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .reports-table td {
        padding: 18px 16px;
        color: #495057;
        font-size: 14px;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .empty-state-text {
        font-size: 16px;
        font-weight: 500;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        margin-right: 4px;
    }

    .btn-primary {
        background: #6366f1;
        color: #ffffff;
    }

    .btn-primary:hover {
        background: #4f46e5;
    }

    .btn-warning {
        background: #f59e0b;
        color: #ffffff;
    }

    .btn-warning:hover {
        background: #d97706;
    }

    .btn-danger {
        background: #ef4444;
        color: #ffffff;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .btn-sm {
        padding: 4px 8px;
        font-size: 11px;
    }
</style>

    <table class="reports-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Office</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr id="noResults" style="display: none;">
                <td colspan="3" style="text-align: center; padding: 40px; background: #f9fafb;">
                    <svg style="width: 48px; height: 48px; margin: 0 auto 16px; color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p style="color: #6b7280; font-size: 14px; margin: 0;">No matching records found</p>
                </td>
            </tr>
            @forelse($evaluations as $evaluation)
                <tr data-school-year="{{ $evaluation->school_year ?? '' }}" 
                    data-semester="{{ $evaluation->semester ?? '' }}" 
                    data-office="{{ $evaluation->department }}" 
                    data-student-name="{{ $evaluation->student->student_name ?? '' }}">
                    <td>
                        <div class="text-sm font-medium text-gray-900">
                            {{ $evaluation->student->student_name ?? 'N/A' }}
                        </div>
                        <div class="text-xs text-gray-500">
                            Student ID: {{ $evaluation->student->id_number ?? 'N/A' }}
                        </div>
                    </td>
                    <td>
                        <span class="text-sm text-gray-700">{{ $evaluation->department }}</span>
                        <div class="text-xs text-gray-500">
                            Evaluated by: {{ $evaluation->evaluator->name ?? 'Unknown' }}
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('head.evaluations.view', $evaluation->id) }}" class="btn btn-primary btn-sm">
                            <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View
                        </a>
                        <div class="text-xs text-gray-500 mt-1">
                            Avg: {{ $evaluation->average_rating }}/5
                        </div>
                    </td>
                </tr>
            @empty
                <tr id="emptyState">
                    <td colspan="3">
                        <div class="empty-state">
                            <div class="empty-state-icon">📊</div>
                            <div class="empty-state-text">No evaluation records found</div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- Mobile Card View -->
    <div class="mobile-evaluation-cards">
        @forelse($evaluations as $evaluation)
            <div class="evaluation-card" 
                 data-school-year="{{ $evaluation->school_year ?? '' }}" 
                 data-semester="{{ $evaluation->semester ?? '' }}" 
                 data-office="{{ $evaluation->department }}" 
                 data-student-name="{{ $evaluation->student->student_name ?? '' }}">
                <div class="evaluation-card-header">
                    <h3 class="evaluation-card-title">{{ $evaluation->student->student_name ?? 'N/A' }}</h3>
                    <p class="evaluation-card-subtitle">Student ID: {{ $evaluation->student->id_number ?? 'N/A' }}</p>
                </div>
                <div class="evaluation-card-details">
                    <div class="evaluation-detail-item">
                        <span class="evaluation-detail-label">Department</span>
                        <span class="evaluation-detail-value">{{ $evaluation->department }}</span>
                    </div>
                    <div class="evaluation-detail-item">
                        <span class="evaluation-detail-label">Evaluated by</span>
                        <span class="evaluation-detail-value">{{ $evaluation->evaluator->name ?? 'Unknown' }}</span>
                    </div>
                    <div class="evaluation-detail-item">
                        <span class="evaluation-detail-label">Average Rating</span>
                        <span class="evaluation-detail-value">
                            <span style="display: inline-block; padding: 4px 12px; background: #dcfce7; color: #166534; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">
                                Avg: {{ $evaluation->average_rating }}/5
                            </span>
                        </span>
                    </div>
                </div>
                <div class="evaluation-actions">
                    <a href="{{ route('head.evaluations.view', $evaluation->id) }}" 
                       class="evaluation-action-button"
                       style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 8px; padding: 10px 20px; display: inline-flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M1.42.682a.5.5 0 1 1 .658.756L.646 2.146A.5.5 0 1 1 .354 1.854l1.066-.772zM8 1a3.5 3.5 0 0 1 3.5 3.5c0 .729-.195 1.4-.518 1.983l.493.493a1.5 1.5 0 0 1 0 2.121L9.121 11.45a1.5 1.5 0 0 1-2.121 0L1.854 6.304a.5.5 0 0 1 .292-.801L3.5 5.25A3.5 3.5 0 0 1 8 1z"/>
                        </svg>
                        View
                    </a>
                </div>
            </div>
        @empty
            <div class="empty-evaluation-state">
                <div class="empty-evaluation-icon">📊</div>
                <div>No evaluation records found</div>
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
    const schoolYearFilter = document.getElementById('schoolYearFilter').value.toLowerCase();
    const semesterFilter = document.getElementById('semesterFilter').value.toLowerCase();
    const officeFilter = document.getElementById('officeFilter').value.toLowerCase();
    const searchFilter = document.getElementById('searchFilter').value.toLowerCase();
    
    // Filter desktop table rows
    const tables = document.querySelectorAll('.reports-table tbody');
    let visibleCount = 0;
    
    tables.forEach(table => {
        const rows = table.querySelectorAll('tr[data-student-name]');
        rows.forEach(row => {
            const schoolYear = row.getAttribute('data-school-year')?.toLowerCase() || '';
            const semester = row.getAttribute('data-semester')?.toLowerCase() || '';
            const office = row.getAttribute('data-office')?.toLowerCase() || '';
            const studentName = row.getAttribute('data-student-name')?.toLowerCase() || '';
            
            const schoolYearMatch = !schoolYearFilter || schoolYear === schoolYearFilter;
            const semesterMatch = !semesterFilter || semester === semesterFilter;
            const officeMatch = !officeFilter || office.includes(officeFilter);
            const searchMatch = !searchFilter || studentName.includes(searchFilter);
            
            if (schoolYearMatch && semesterMatch && officeMatch && searchMatch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Filter mobile cards
    const cards = document.querySelectorAll('.evaluation-card');
    let mobileVisibleCount = 0;
    
    cards.forEach(card => {
        const schoolYear = card.getAttribute('data-school-year')?.toLowerCase() || '';
        const semester = card.getAttribute('data-semester')?.toLowerCase() || '';
        const office = card.getAttribute('data-office')?.toLowerCase() || '';
        const studentName = card.getAttribute('data-student-name')?.toLowerCase() || '';
        
        const schoolYearMatch = !schoolYearFilter || schoolYear === schoolYearFilter;
        const semesterMatch = !semesterFilter || semester === semesterFilter;
        const officeMatch = !officeFilter || office.includes(officeFilter);
        const searchMatch = !searchFilter || studentName.includes(searchFilter);
        
        if (schoolYearMatch && semesterMatch && officeMatch && searchMatch) {
            card.style.display = '';
            mobileVisibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    // Show/hide no results message
    const noResults = document.getElementById('noResults');
    const emptyState = document.getElementById('emptyState');
    
    if (visibleCount === 0 && mobileVisibleCount === 0) {
        noResults.style.display = 'table-row';
        if (emptyState) emptyState.style.display = 'none';
    } else {
        noResults.style.display = 'none';
        if (emptyState) emptyState.style.display = 'none';
    }
}

function clearFilters() {
    document.getElementById('schoolYearFilter').value = '';
    document.getElementById('semesterFilter').value = '';
    document.getElementById('officeFilter').value = '';
    document.getElementById('searchFilter').value = '';
    
    // Show empty state again if there are no records
    const emptyState = document.getElementById('emptyState');
    const rows = document.querySelectorAll('tr[data-student-name]');
    if (emptyState && rows.length === 0) {
        emptyState.style.display = 'table-row';
    }
    
    applyFilters();
}
</script>
@endsection
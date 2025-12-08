@extends('layouts.app')

@section('page-title')
    <i class="bi bi-award-fill" style="margin-right: 8px;"></i>
    Grades Report
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
    .mobile-grade-cards { display: none; }
</style>
<div style="padding: 24px; background: #fff; min-height: calc(100vh - 76px);">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-6" role="alert">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    @endif
    
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
                <label style="display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px;">Year Level</label>
                <select id="yearFilter" onchange="applyFilters()" style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; background: white;">
                    <option value="">All Years</option>
                    <option value="first year">First Year</option>
                    <option value="second year">Second Year</option>
                    <option value="third year">Third Year</option>
                    <option value="fourth year">Fourth Year</option>
                </select>
            </div>
            <div>
                <label style="display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px;">Semester</label>
                <select id="semesterFilter" onchange="applyFilters()" style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; background: white;">
                    <option value="">All Semesters</option>
                    <option value="1st semester">1st Semester</option>
                    <option value="2nd semester">2nd Semester</option>
                    <option value="summer">Summer</option>
                </select>
            </div>
            <div>
                <label style="display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px;">Search</label>
                <input type="text" id="searchFilter" oninput="applyFilters()" placeholder="Search by name..." style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
            </div>
            <div style="display: flex; align-items: flex-end;">
                <button onclick="clearFilters()" style="background: #6b7280; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 14px; width: 100%;">
                    Clear Filters
                </button>
            </div>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="reports-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Year Level</th>
                    <th>Semester</th>
                    <th>Subjects</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    @forelse($grades as $grade)
                        <tr style="transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='#ffffff'">
                            <td style="padding: 16px 20px; color: #111827; font-weight: 500;">
                                {{ $grade->student_name }}
                            </td>
                            <td style="padding: 16px 20px; color: #6b7280;">
                                {{ $grade->year_level }}
                            </td>
                            <td style="padding: 16px 20px; color: #6b7280;">
                                {{ $grade->semester }}
                            </td>
                            <td style="padding: 16px 20px;">
                                @php
                                    $subjects = is_array($grade->subjects) ? $grade->subjects : (is_string($grade->subjects) ? json_decode($grade->subjects, true) : []);
                                    $subjectCount = is_array($subjects) ? count($subjects) : 0;
                                @endphp
                                <span style="display: inline-block; padding: 4px 12px; background: #dbeafe; color: #1e40af; border-radius: 20px; font-size: 13px; font-weight: 600;">
                                    {{ $subjectCount }} {{ $subjectCount === 1 ? 'Subject' : 'Subjects' }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px;">
                                <a href="{{ route('offices.reports.grade-details-fullpage', ['id' => $grade->id]) }}"
                                   style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #6366f1; color: #ffffff; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; transition: all 0.2s ease;"
                                   onmouseover="this.style.backgroundColor='#4f46e5'"
                                   onmouseout="this.style.backgroundColor='#6366f1'">
                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 48px 20px; text-align: center; color: #9ca3af;">
                                <svg style="width: 48px; height: 48px; margin: 0 auto 16px; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p style="font-size: 16px; font-weight: 500;">No grades records found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Mobile Cards View -->
        <div class="mobile-grade-cards">
            @forelse($grades as $grade)
                <div class="grade-card">
                    <div class="grade-card-header">
                        <h3 class="grade-card-title">{{ $grade->student_name }}</h3>
                    </div>
                    <div class="grade-card-details">
                        <div class="grade-detail-item">
                            <span class="grade-detail-label">Year Level:</span>
                            <span class="grade-detail-value">{{ $grade->year_level }}</span>
                        </div>
                        <div class="grade-detail-item">
                            <span class="grade-detail-label">Semester:</span>
                            <span class="grade-detail-value">{{ $grade->semester }}</span>
                        </div>
                        <div class="grade-detail-item">
                            <span class="grade-detail-label">Subjects:</span>
                            <span class="grade-detail-value">
                                @php
                                    $subjects = is_array($grade->subjects) ? $grade->subjects : (is_string($grade->subjects) ? json_decode($grade->subjects, true) : []);
                                    $subjectCount = is_array($subjects) ? count($subjects) : 0;
                                @endphp
                                <span style="display: inline-block; padding: 4px 12px; background: #dbeafe; color: #1e40af; border-radius: 20px; font-size: 13px; font-weight: 600;">
                                    {{ $subjectCount }} {{ $subjectCount === 1 ? 'Subject' : 'Subjects' }}
                                </span>
                            </span>
                        </div>
                        <a href="{{ route('admin.grades.show', $grade->id) }}" class="mobile-action-btn">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Details
                        </a>
                    </div>
                </div>
            @empty
                <div class="grade-card">
                    <div style="text-align: center; padding: 24px;">
                        <svg style="width: 48px; height: 48px; margin: 0 auto 16px; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p style="font-size: 16px; font-weight: 500; color: #9ca3af; margin: 0;">No grades records found</p>
                    </div>
                </div>
            @endforelse
        </div>
</div>

<script>
// Filter functions
function toggleFilters() {
    const panel = document.getElementById('filterPanel');
    panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
}

function applyFilters() {
    const yearValue = document.getElementById('yearFilter').value.toLowerCase();
    const semesterValue = document.getElementById('semesterFilter').value.toLowerCase();
    const searchValue = document.getElementById('searchFilter').value.toLowerCase();
    const table = document.querySelector('.reports-table tbody');
    const rows = table.getElementsByTagName('tr');
    
    let visibleCount = 0;
    for (let row of rows) {
        if (row.querySelector('td[colspan]')) continue;
        
        const cells = row.getElementsByTagName('td');
        const name = cells[0]?.textContent.toLowerCase() || '';
        const year = cells[1]?.textContent.toLowerCase() || '';
        const semester = cells[2]?.textContent.toLowerCase() || '';
        
        const matchesYear = !yearValue || year.includes(yearValue);
        const matchesSemester = !semesterValue || semester.includes(semesterValue);
        const matchesSearch = !searchValue || name.includes(searchValue);
        
        if (matchesYear && matchesSemester && matchesSearch) {
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
    document.getElementById('yearFilter').value = '';
    document.getElementById('semesterFilter').value = '';
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
                <td colspan="5" style="text-align: center; padding: 40px; color: #6b7280;">
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
@endsection
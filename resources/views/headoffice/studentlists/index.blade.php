@extends('layouts.app')

@section('page-title')
    <i class="bi bi-people" style="margin-right: 8px;"></i>
    Student List
@endsection

@section('content')
<style>
    .content-card {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .content-header {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 16px 20px;
        border-bottom: 1px solid #e5e7eb;
        background: #f9fafb;
        font-size: 0.95rem;
        color: #374151;
        font-weight: 600;
    }
    /* Student List */
    .studentlist-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #111827;
        margin: 16px 24px 4px 24px;
    }
    .studentlist-desc {
        font-size: 0.95rem;
        color: #6b7280;
        margin-bottom: 12px;
        padding: 0 24px;
    }
    .table-container {
        width: 100%;
        padding: 0 24px 24px 24px;
        overflow-x: auto;
    }
    .student-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
    }
    .student-table thead th {
        background: #f3f4f6;
        color: #111827;
        font-size: 0.9rem;
        font-weight: 600;
        padding: 12px 16px;
        text-align: left;
    }
    .student-table tbody td {
        font-size: 0.9rem;
        color: #374151;
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
    }
    .student-table tbody tr:hover td {
        background: #f9fafb;
    }
    .student-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Filter Dropdown Styles */
    .filter-container {
        position: relative;
        display: inline-block;
    }

    .filter-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 18px;
        background: #3b82f6;
        color: #fff;
        border: none;
        border-radius: 18px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
    }

    .filter-button:hover {
        background: #2563eb;
    }

    .filter-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        min-width: 200px;
        z-index: 50;
        padding: 8px 0;
    }

    .filter-dropdown.show {
        display: block;
    }

    .filter-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 16px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #374151;
        cursor: pointer;
        transition: background 0.2s;
    }

    .filter-label:hover {
        background: #f9fafb;
    }

    .filter-options {
        display: none;
        background: #f9fafb;
        border-top: 1px solid #e5e7eb;
        padding: 8px 0;
    }

    .filter-options.show {
        display: block;
    }

    .filter-option {
        padding: 8px 32px;
        font-size: 0.85rem;
        color: #374151;
        cursor: pointer;
        transition: background 0.2s;
    }

    .filter-option:hover {
        background: #f3f4f6;
    }

    .filter-option.selected {
        background: #dbeafe;
        color: #2563eb;
        font-weight: 600;
    }

    .filter-clear {
        padding: 8px 16px;
        margin: 8px 16px 4px 16px;
        background: #ef4444;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
        width: calc(100% - 32px);
    }

    .filter-clear:hover {
        background: #dc2626;
    }
</style>

<!-- Main Content -->
<div class="content-card">
            <div style="display: flex; flex-direction: row; align-items: flex-start; padding: 0 24px; margin-bottom: 12px;">
                <div style="flex: 1 1 auto;">
                    <div class="studentlist-title" style="margin-bottom:0;">Student Official List</div>
                    <div class="studentlist-desc" style="margin-bottom:0;">This list contains Official Student Assistants of Universidad de Dagupan</div>
                </div>
                <div style="flex: 0 0 auto; display: flex; align-items: center; gap: 8px; margin-top: 16px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div class="filter-container">
                            <button class="filter-button" id="filterDropdownBtn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                                </svg>
                                Filter
                            </button>
                            <div class="filter-dropdown" id="filterDropdownMenu">
                                <div class="filter-label cascading-label" data-cascade="course">
                                    <span>Course</span>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                                <div class="filter-cascade filter-cascade-course">
                                    <div class="filter-option" data-filter="course" data-value="">All Courses</div>
                                    <div class="filter-option" data-filter="course" data-value="SOH">SOH</div>
                                    <div class="filter-option" data-filter="course" data-value="STE">STE</div>
                                    <div class="filter-option" data-filter="course" data-value="SBA">SBA</div>
                                    <div class="filter-option" data-filter="course" data-value="SOHS">SOHS</div>
                                    <div class="filter-option" data-filter="course" data-value="SOE">SOE</div>
                                    <div class="filter-option" data-filter="course" data-value="SITE">SITE</div>
                                    <div class="filter-option" data-filter="course" data-value="SIHM">SIHM</div>
                                    <div class="filter-option" data-filter="course" data-value="SOC">SOC</div>
                                </div>
                                <div class="filter-label cascading-label" data-cascade="year">
                                    <span>Year Level</span>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                                <div class="filter-cascade filter-cascade-year">
                                    <div class="filter-option" data-filter="year_level" data-value="">All Years</div>
                                    <div class="filter-option" data-filter="year_level" data-value="First Year">First Year</div>
                                    <div class="filter-option" data-filter="year_level" data-value="Second Year">Second Year</div>
                                    <div class="filter-option" data-filter="year_level" data-value="Third Year">Third Year</div>
                                    <div class="filter-option" data-filter="year_level" data-value="Fourth Year">Fourth Year</div>
                                    <div class="filter-option" data-filter="year_level" data-value="Fifth Year">Fifth Year</div>
                                </div>
                                <div class="filter-label cascading-label" data-cascade="office">
                                    <span>Office</span>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                                <div class="filter-cascade filter-cascade-office" style="max-height: 250px; overflow-y: auto;">
                                    <div class="filter-option" data-filter="office" data-value="">All Offices</div>
                                    <div class="filter-option" data-filter="office" data-value="LIBRARY">LIBRARY</div>
                                    <div class="filter-option" data-filter="office" data-value="ACADS">ACADS</div>
                                    <div class="filter-option" data-filter="office" data-value="REGISTRAR">REGISTRAR</div>
                                    <div class="filter-option" data-filter="office" data-value="CANTEEN">CANTEEN</div>
                                    <div class="filter-option" data-filter="office" data-value="KUWAGO">KUWAGO</div>
                                    <div class="filter-option" data-filter="office" data-value="QUEUING">QUEUING</div>
                                    <div class="filter-option" data-filter="office" data-value="HRD">HRD</div>
                                    <div class="filter-option" data-filter="office" data-value="SAO">SAO</div>
                                    <div class="filter-option" data-filter="office" data-value="GUIDANCE">GUIDANCE</div>
                                    <div class="filter-option" data-filter="office" data-value="CLINIC">CLINIC</div>
                                    <div class="filter-option" data-filter="office" data-value="OPEN LAB">OPEN LAB</div>
                                    <div class="filter-option" data-filter="office" data-value="LINKAGES">LINKAGES</div>
                                    <div class="filter-option" data-filter="office" data-value="XACTO">XACTO</div>
                                    <div class="filter-option" data-filter="office" data-value="SITE FACULTY">SITE FACULTY</div>
                                    <div class="filter-option" data-filter="office" data-value="SOHS FACULTY">SOHS FACULTY</div>
                                    <div class="filter-option" data-filter="office" data-value="SOH FACULTY">SOH FACULTY</div>
                                    <div class="filter-option" data-filter="office" data-value="STE FACULTY">STE FACULTY</div>
                                    <div class="filter-option" data-filter="office" data-value="SOC FACULTY">SOC FACULTY</div>
                                    <div class="filter-option" data-filter="office" data-value="SBA FACULTY">SBA FACULTY</div>
                                    <div class="filter-option" data-filter="office" data-value="SOE FACULTY">SOE FACULTY</div>
                                    <div class="filter-option" data-filter="office" data-value="SIHM FACULTY">SIHM FACULTY</div>
                                    <div class="filter-option" data-filter="office" data-value="STE DEAN'S OFFICE">STE DEAN'S OFFICE</div>
                                    <div class="filter-option" data-filter="office" data-value="FINANCE">FINANCE</div>
                                    <div class="filter-option" data-filter="office" data-value="LCR">LCR</div>
                                    <div class="filter-option" data-filter="office" data-value="STEEDS">STEEDS</div>
                                    <div class="filter-option" data-filter="office" data-value="SPORTS AND CULTURE">SPORTS AND CULTURE</div>
                                    <div class="filter-option" data-filter="office" data-value="QUALITY ASSURANCE">QUALITY ASSURANCE</div>
                                    <div class="filter-option" data-filter="office" data-value="ARCHIVING">ARCHIVING</div>
                                    <div class="filter-option" data-filter="office" data-value="PRESIDENT'S OFFICE">PRESIDENT'S OFFICE</div>
                                    <div class="filter-option" data-filter="office" data-value="MARKETING">MARKETING</div>
                                    <div class="filter-option" data-filter="office" data-value="ALUMNI OFFICE">ALUMNI OFFICE</div>
                                </div>
                                <button class="filter-clear" onclick="clearFilters()">Clear Filters</button>
                            </div>
                        </div>
                        <form method="GET" action="" style="display: flex; align-items: center; gap: 8px;">
                            <input type="text" name="keyword" id="headStudentSearchBar" value="{{ request('keyword') }}" placeholder="Search students..." style="padding: 7px 12px; border-radius: 6px; border: 1px solid #bbb; font-size: 15px;">
                            <button type="submit" style="padding: 7px 18px; border-radius: 6px; background: #2563eb; color: #fff; border: none; font-size: 15px; cursor: pointer;">Search</button>
                        </form>
                    </div>
                    <span style="font-size:1rem;color:#374151;padding:6px 18px;border-radius:18px;background:#f3f4f6;display:inline-flex;align-items:center;gap:12px;">
                        @if ($students->onFirstPage())
                        <span style="color:#d1d5db;cursor:not-allowed;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                            </svg>
                        </span>
                        @else
                        <a href="{{ $students->previousPageUrl() }}" style="color:#2563eb;text-decoration:none;display:inline-flex;align-items:center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                            </svg>
                        </a>
                        @endif
                        <span style="font-size:1rem;color:#374151;">Page {{ $students->currentPage() }} of {{ $students->lastPage() }}</span>
                        @if ($students->hasMorePages())
                        <a href="{{ $students->nextPageUrl() }}" style="color:#2563eb;text-decoration:none;display:inline-flex;align-items:center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </a>
                        @else
                        <span style="color:#d1d5db;cursor:not-allowed;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span>
                        @endif
                    </span>
                </div>
            </div>
            <div class="table-container" style="margin-top:0;">
                <table class="student-table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Student ID</th>
                            <th>Designated Office</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->student_name }}</td>
                                <td>{{ $student->course }}</td>
                                <td>{{ $student->year_level }}</td>
                                <td>{{ $student->id_number }}</td>
                                <td>{{ $student->designated_office ?? 'N/A' }}</td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter dropdown functionality
    const filterBtn = document.getElementById('filterDropdownBtn');
    const filterMenu = document.getElementById('filterDropdownMenu');
    
    filterBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        filterMenu.classList.toggle('show');
    });
    
    // Close filter dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!filterMenu.contains(e.target) && e.target !== filterBtn) {
            filterMenu.classList.remove('show');
        }
    });
    
    // Cascading submenu logic for filter
    const cascadeLabels = document.querySelectorAll('.cascading-label');
    const cascades = {
        course: document.querySelector('.filter-cascade-course'),
        year: document.querySelector('.filter-cascade-year'),
        office: document.querySelector('.filter-cascade-office')
    };
    Object.values(cascades).forEach(c => c.style.display = 'none');

    cascadeLabels.forEach(label => {
        label.addEventListener('click', function(e) {
            e.stopPropagation();
            const type = label.getAttribute('data-cascade');
            // Toggle submenu: close if open, open if closed
            const isOpen = cascades[type].style.display === 'block';
            Object.values(cascades).forEach(c => c.style.display = 'none');
            if (!isOpen) {
                cascades[type].style.display = 'block';
            }
        });
    });

    // Hide submenu when clicking outside filter dropdown
    document.addEventListener('click', function(e) {
        if (!filterMenu.contains(e.target) && e.target !== filterBtn) {
            Object.values(cascades).forEach(c => c.style.display = 'none');
        }
    });

    // Filter option selection
    document.querySelectorAll('.filter-option').forEach(option => {
        option.addEventListener('click', function(e) {
            e.stopPropagation();
            const filterType = this.getAttribute('data-filter');
            const filterValue = this.getAttribute('data-value');
            // Remove selected class from siblings
            this.parentElement.querySelectorAll('.filter-option').forEach(sib => sib.classList.remove('selected'));
            this.classList.add('selected');
            applyFilter(filterType, filterValue);
        });
    });
    
    // Apply filter function
    window.applyFilter = function(filterType, filterValue) {
        const url = new URL(window.location.href);
        if (filterValue === '') {
            url.searchParams.delete(filterType);
        } else {
            url.searchParams.set(filterType, filterValue);
        }
        window.location.href = url.toString();
    };
    
    // Clear filters function
    window.clearFilters = function() {
        window.location.href = window.location.pathname;
    };

    // Search bar functionality
    const searchBar = document.getElementById('headStudentSearchBar');
    const originalUrl = "{{ route('head.student.list') }}";
    searchBar.addEventListener('input', function() {
        if (searchBar.value.trim() === '') {
            window.location.href = originalUrl;
        }
    });
});
</script>
@endsection

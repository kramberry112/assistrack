@extends('layouts.app')

@section('content')
<style>
    .content-card {
        flex: 1;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 0;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
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


        @if(session('success'))
            <div style="background:#10b981;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:16px;">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background:#ef4444;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:16px;">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <div class="content-card">
            <div class="content-header">
                <span class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </span>
                Student Official List
            </div>
            
            <div style="display: flex; flex-direction: row; align-items: flex-start; padding: 0 24px; margin-bottom: 12px;">
                <div style="flex: 1 1 auto;">
                    <div class="studentlist-title" style="margin-bottom:0;">Student Official List</div>
                    <div class="studentlist-desc" style="margin-bottom:0;">This list contains Official Student Assistants of Universidad de Dagupan</div>
                </div>
                
                <div style="flex: 0 0 auto; display: flex; align-items: center; gap: 8px; margin-top: 16px;">
                    <!-- Filter Button -->
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
                    
                    <!-- Search Bar -->
                    <form method="GET" action="" style="display: flex; align-items: center; gap: 8px;">
                        <input type="text" name="keyword" id="studentSearchBar" value="{{ request('keyword') }}" placeholder="Search students..." style="padding: 7px 12px; border-radius: 6px; border: 1px solid #bbb; font-size: 15px;">
                        <button type="submit" style="padding: 7px 18px; border-radius: 6px; background: #2563eb; color: #fff; border: none; font-size: 15px; cursor: pointer;">Search</button>
                    </form>
                    
                    <!-- Pagination -->
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
            
            <div class="table-container">
                <table class="student-table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Student ID</th>
                            <th>Designated Office</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student->student_name }}</td>
                            <td>{{ $student->course }}</td>
                            <td>{{ $student->year_level }}</td>
                            <td>{{ $student->id_number }}</td>
                            <td style="overflow: visible; position: relative;">
                                <div class="searchable-dropdown" style="position:relative; width:180px; overflow: visible;">
                                    <div style="position:relative;">
                                        <input type="text" class="office-combo-input" value="{{ $student->designated_office }}" placeholder="Select or search office..." style="width:100%;padding:6px 32px 6px 10px;border-radius:5px;border:1px solid #bbb;font-size:14px;" autocomplete="off" readonly data-student-id="{{ $student->id }}">
                                        <span class="office-combo-arrow" style="position:absolute;top:8px;right:10px;width:18px;height:18px;pointer-events:auto;cursor:pointer;display:flex;align-items:center;justify-content:center;z-index:100;background:#fff;">
                                            <svg width="18" height="18" viewBox="0 0 24 24">
                                                <path d="M7 10l5 5 5-5" stroke="#555" stroke-width="2" fill="none" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="office-combo-list" style="display:none;position:absolute;top:40px;left:0;width:100%;background:#fff;border:1px solid #bbb;border-radius:5px;box-shadow:0 8px 32px rgba(0,0,0,0.18);z-index:9999;max-height:220px;overflow-y:auto;">
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">LIBRARY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">ACADS</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">REGISTRAR</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">CANTEEN</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">KUWAGO</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">QUEUING</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">HRD</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SAO</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">GUIDANCE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">CLINIC</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">OPEN LAB</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">LINKAGES</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">XACTO</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SITE FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SOHS FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SOH FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">STE FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SOC FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SBA FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SOE FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SIHM FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">STE DEAN'S OFFICE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">FINANCE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">LCR</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">STEEDS</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SPORTS AND CULTURE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">QUALITY ASSURANCE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">ARCHIVING</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">PRESIDENT'S OFFICE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">MARKETING</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">ALUMNI OFFICE</div>
                                    </div>
                                </div>
                            </td>
                            <td class="action-cell">
                                <a href="{{ route('students.show', $student->id) }}" style="background:#3b82f6;color:#fff;padding:6px 12px;border-radius:4px;text-decoration:none;margin-right:4px;">View</a>
                                
                                @if($student->user_id)
                                    <span style="background:#10b981;color:#fff;padding:6px 12px;border-radius:4px;margin-right:4px;font-size:12px;">Account Created</span>
                                @else
                                    <form method="POST" action="{{ route('students.createAccount', $student->id) }}" style="display:inline-block; margin-right:4px;">
                                        @csrf
                                        <button type="submit" onclick="return confirm('Create account for {{ $student->student_name }}?')" style="background:#10b981;color:#fff;border:none;padding:6px 12px;border-radius:4px;cursor:pointer;font-size:12px;">Create Account</button>
                                    </form>
                                @endif
                                
                                <form method="POST" action="{{ route('students.delete', $student->id) }}" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this student?')" style="background:#ef4444;color:#fff;border:none;padding:6px 12px;border-radius:4px;cursor:pointer;font-size:12px;">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </div>
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
    const searchBar = document.getElementById('studentSearchBar');
    const originalUrl = "{{ route('student.list') }}";
    searchBar.addEventListener('input', function() {
        if (searchBar.value.trim() === '') {
            window.location.href = originalUrl;
        }
    });

    // Custom searchable dropdown for Designated Office
    document.querySelectorAll('.searchable-dropdown').forEach(function(dropdownDiv) {
        const input = dropdownDiv.querySelector('.office-combo-input');
        const list = dropdownDiv.querySelector('.office-combo-list');
        const arrow = dropdownDiv.querySelector('.office-combo-arrow');
        let portalList = null;
        
        function showList() {
            if (!portalList) {
                portalList = list.cloneNode(true);
                portalList.classList.add('office-combo-list-portal');
                document.body.appendChild(portalList);
                portalList.style.position = 'fixed';
                portalList.style.zIndex = '99999';
                portalList.style.background = '#fff';
                portalList.style.border = '1px solid #bbb';
                portalList.style.borderRadius = '5px';
                portalList.style.boxShadow = '0 8px 32px rgba(0,0,0,0.18)';
                portalList.style.maxHeight = '224px';
                portalList.style.overflowY = 'auto';
                portalList.style.width = dropdownDiv.offsetWidth + 'px';
                
                const rect = input.getBoundingClientRect();
                portalList.style.left = rect.left + 'px';
                portalList.style.top = (rect.bottom + 2) + 'px';
                
                input.addEventListener('input', function() {
                    Array.from(portalList.children).forEach(function(item) {
                        item.style.display = item.textContent.toLowerCase().includes(input.value.toLowerCase()) ? '' : 'none';
                    });
                });
                
                Array.from(portalList.children).forEach(function(item) {
                    item.addEventListener('mousedown', function(e) {
                        e.preventDefault();
                        input.value = item.textContent;
                        hideList();
                        input.setAttribute('readonly', true);
                        
                        // AJAX PATCH request to save office
                        const studentId = input.getAttribute('data-student-id');
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        fetch(`/students/${studentId}/office`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({ designated_office: item.textContent })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                input.value = data.office;
                            }
                        });
                    });
                });
            }
            portalList.style.display = 'block';
            input.removeAttribute('readonly');
            input.focus();
        }
        
        function hideList() {
            if (portalList) portalList.style.display = 'none';
            input.setAttribute('readonly', true);
        }
        
        input.addEventListener('focus', showList);
        input.addEventListener('blur', function() { setTimeout(hideList, 150); });
        arrow.addEventListener('mousedown', function(e) {
            e.preventDefault();
            if (portalList && portalList.style.display === 'block') {
                hideList();
            } else {
                showList();
            }
        });
    });
});
</script>
@endsection
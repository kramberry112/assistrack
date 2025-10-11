@extends('layouts.app')

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f3f4f6;
    }

    .dashboard-container {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
        width: 260px;
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: fixed;
        height: 100vh;
        left: 0;
        top: 0;
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
    }

    /* Profile */
    .sidebar .profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        border-top: 1px solid #e5e7eb;
        cursor: pointer;
    }

    .sidebar .profile .avatar {
        width: 36px;
        height: 36px;
        background: #e5e7eb;
        border-radius: 50%;
        object-fit: cover;
    }

    .sidebar .profile-details {
        display: flex;
        flex-direction: column;
        font-size: 0.85rem;
        flex: 1;
    }
    
    .sidebar .profile-details .name {
        font-weight: 600;
        color: #111827;
        font-size: 0.9rem;
    }
    
    .sidebar .profile-details .username {
        font-size: 0.75rem;
        color: #6b7280;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        margin-left: 260px;
        background: #f9fafb;
        display: flex;
        flex-direction: column;
        padding: 20px;
    }

    .content-card {
        flex: 1;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        overflow: hidden;
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

    .header-wrapper {
        padding: 20px 24px 0;
    }

    .studentlist-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 4px;
    }

    .studentlist-desc {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 16px;
    }

    .toolbar {
        display: flex;
        align-items: center;
        gap: 16px;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    /* Filter Dropdown */
    .filter-container {
        position: relative;
    }

    .filter-button {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.9rem;
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
        top: 100%;
        left: 0;
        margin-top: 8px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        min-width: 220px;
        z-index: 50;
        padding: 8px 0;
    }

    .filter-dropdown.show {
        display: block;
    }

    .filter-label {
        padding: 10px 16px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #374151;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: background 0.2s;
    }

    .filter-label:hover {
        background: #f9fafb;
    }

    .filter-cascade {
        display: none;
    }

    .filter-cascade.show {
        display: block;
    }

    .filter-cascade.filter-cascade-office {
        max-height: 250px;
        overflow-y: auto;
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

    .filter-option.active {
        background: #eff6ff;
        color: #3b82f6;
        font-weight: 500;
    }

    .filter-clear {
        margin: 8px 12px;
        padding: 8px 12px;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 0.85rem;
        cursor: pointer;
        width: calc(100% - 24px);
        font-weight: 500;
    }

    .filter-clear:hover {
        background: #dc2626;
    }

    .search-container {
        display: flex;
        gap: 8px;
    }

    .search-input {
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.9rem;
        width: 220px;
        outline: none;
    }

    .search-input:focus {
        border-color: #3b82f6;
    }

    .search-btn {
        padding: 8px 20px;
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
    }

    .search-btn:hover {
        background: #2563eb;
    }

    .pagination-controls {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pagination-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #f3f4f6;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #2563eb;
    }

    .pagination-btn:disabled {
        color: #d1d5db;
        cursor: not-allowed;
    }

    .pagination-text {
        background: #f3f4f6;
        color: #374151;
        border-radius: 50px;
        padding: 8px 18px;
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* Table */
    .table-container {
        flex: 1;
        overflow: auto;
        padding: 24px;
    }

    .student-table {
        width: 100%;
        border-collapse: collapse;
    }

    .student-table thead {
        background: #f9fafb;
    }

    .student-table thead th {
        padding: 12px 16px;
        text-align: left;
        font-size: 0.85rem;
        font-weight: 600;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
    }

    .student-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.2s;
    }

    .student-table tbody tr:hover {
        background: #f9fafb;
    }

    .student-table tbody td {
        padding: 14px 16px;
        font-size: 0.9rem;
        color: #374151;
    }

    .action-cell {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .action-cell a,
    .action-cell button {
        padding: 6px 14px;
        background: #f3f4f6;
        color: #374151;
        border: none;
        border-radius: 4px;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }

    .action-cell a:hover {
        background: #e5e7eb;
    }

    .action-cell .delete-btn {
        background: #ef4444;
        color: white;
    }

    .action-cell .delete-btn:hover {
        background: #dc2626;
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
                <a href="{{ route('offices.dashboard') }}" class="{{ request()->routeIs('offices.dashboard') ? 'active' : '' }}">
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
                <a href="{{ route('offices.studentlists.index') }}" class="{{ request()->routeIs('offices.studentlists.index') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="7" r="4" />
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        </svg>
                    </span>
                    Student List
                </a>
                <a href="{{ route('attendance.index') }}">
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
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="{{ auth()->user()->name }}" class="avatar">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=667eea&color=fff&size=36" alt="{{ auth()->user()->name }}" class="avatar">
            @endif
            <div class="profile-details">
                <span class="name">{{ auth()->user()->name }}</span>
                <span class="username">{{ auth()->user()->username }}</span>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <section class="main-content">
        <div class="content-card">
            <div class="content-header">
                <span class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
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
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div class="filter-container">
                            <form id="filterForm" method="GET" action="{{ route('offices.studentlists.index') }}">
                                <button type="button" class="filter-button" id="filterDropdownBtn">
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
                                        <div class="filter-option active" data-filter="course" data-value="">All Courses</div>
                                        <div class="filter-option" data-filter="course" data-value="BSIT">BSIT</div>
                                        <div class="filter-option" data-filter="course" data-value="BSCS">BSCS</div>
                                        <div class="filter-option" data-filter="course" data-value="BSBA">BSBA</div>
                                        <div class="filter-option" data-filter="course" data-value="BSN">BSN</div>
                                        <div class="filter-option" data-filter="course" data-value="BSED">BSED</div>
                                        <div class="filter-option" data-filter="course" data-value="BEED">BEED</div>
                                        <div class="filter-option" data-filter="course" data-value="BSHM">BSHM</div>
                                        <div class="filter-option" data-filter="course" data-value="BSTM">BSTM</div>
                                    </div>
                                    <div class="filter-label cascading-label" data-cascade="year">
                                        <span>Year Level</span>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </div>
                                    <div class="filter-cascade filter-cascade-year">
                                        <div class="filter-option active" data-filter="year_level" data-value="">All Years</div>
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
                                    <div class="filter-cascade filter-cascade-office">
                                        <div class="filter-option active" data-filter="office" data-value="">All Offices</div>
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
                                    <button type="button" class="filter-clear" onclick="clearFilters()">Clear Filters</button>
                                </div>
                                <input type="hidden" name="course" id="filterCourse" value="{{ request('course') }}">
                                <input type="hidden" name="year_level" id="filterYear" value="{{ request('year_level') }}">
                                <input type="hidden" name="office" id="filterOffice" value="{{ request('office') }}">
                            </form>
                        </div>
                        <form method="GET" action="{{ route('offices.studentlists.index') }}" style="display: flex; align-items: center; gap: 8px;">
                            <input type="text" name="search" id="officeStudentSearchBar" value="{{ request('search') }}" placeholder="Search students..." style="padding: 7px 12px; border-radius: 6px; border: 1px solid #bbb; font-size: 15px;">
                            <button type="submit" style="padding: 7px 18px; border-radius: 6px; background: #2563eb; color: #fff; border: none; font-size: 15px; cursor: pointer;">Search</button>
                        </form>
                    </div>
                    <div class="pagination-controls">
                        @if ($students->onFirstPage())
                            <button class="pagination-btn" disabled>
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                            </button>
                        @else
                            <a href="{{ $students->previousPageUrl() }}" class="pagination-btn" style="text-decoration: none;">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                            </a>
                        @endif
                        <span class="pagination-text">Page {{ $students->currentPage() }} of {{ $students->lastPage() }}</span>
                        @if ($students->hasMorePages())
                            <a href="{{ $students->nextPageUrl() }}" class="pagination-btn" style="text-decoration: none;">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                            </a>
                        @else
                            <button class="pagination-btn" disabled>
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                            </button>
                        @endif
                    </div>
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
                        @forelse($students as $student)
                        <tr>
                            <td>{{ $student->student_name }}</td>
                            <td>{{ $student->course }}</td>
                            <td>{{ $student->year_level }}</td>
                            <td>{{ $student->id_number }}</td>
                            <td>{{ $student->designated_office }}</td>
                            <td class="action-cell" style="text-align: center; vertical-align: middle;">
                                <a href="{{ route('evaluation.show', $student->id) }}" class="btn btn-primary">Evaluation</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #6b7280;">
                                No students found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('officeStudentSearchBar');
    var searchForm = searchInput ? searchInput.form : null;
    if (searchInput && searchForm) {
        searchInput.addEventListener('input', function() {
            if (searchInput.value === '') {
                searchForm.submit();
            }
        });
    }
});
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
</script>

@endsection
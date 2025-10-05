@extends('layouts.app')

@section('content')
<style>
    /* Action cell layout: View left, Add to Student List right */
    .applicants-table td.action-cell {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 0;
        padding-right: 16px;
    }
    .applicants-table td.action-cell a {
        background: #f3f4f6;
        color: #2563eb;
        border: none;
        padding: 4px 10px;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        font-weight: 500;
    }
    .applicants-table td.action-cell form button {
        background: #2563eb;
        color: #fff;
        border: none;
        padding: 4px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
    }
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
    .sidebar {
        width: 260px;
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
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
    }
    .sidebar .nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        font-size: 0.95rem;
        color: #374151;
        text-decoration: none;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
        font-weight: 500;
    }
    .sidebar .nav a:hover {
        background: #f3f4f6;
        color: #111827;
    }
    .sidebar .nav a.active {
        background: #f9fafb;
        color: #111827;
        border-left: 3px solid #3b82f6;
        font-weight: 600;
    }
    .sidebar .nav a .icon {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .sidebar .profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        border-top: 1px solid #e5e7eb;
        cursor: pointer;
        position: relative;
    }
    .sidebar .profile .avatar {
        width: 36px;
        height: 36px;
        background: #e5e7eb;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #374151;
    }
    .sidebar .profile-details {
        display: flex;
        flex-direction: column;
        font-size: 0.85rem;
    }
    .sidebar .profile-details .name {
        font-weight: 600;
        color: #111827;
        font-size: 0.9rem;
        letter-spacing: 0.05em;
    }
    .sidebar .profile-details .username {
        font-size: 0.75rem;
        color: #6b7280;
        letter-spacing: 0.05em;
    }
    /* Logout dropdown */
    #logoutMenu {
        display: none;
        position: absolute;
        bottom: 60px;
        left: 20px;
        background: #fff;
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        padding: 24px 20px 16px 20px;
        min-width: 220px;
        z-index: 100;
        text-align: center;
    }

    #logoutMenu a,
    #logoutMenu button {
        display: block;
        width: 100%;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 8px;
        padding: 8px 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border: none;
        transition: background 0.2s, box-shadow 0.2s;
        text-align: center;
        cursor: pointer;
    }

    #logoutMenu a {
        background: #4f8ef7;
        color: #fff;
        text-decoration: none;
    }

    #logoutMenu a:hover {
        background: #2563eb;
    }

    #logoutMenu button {
        background: linear-gradient(90deg, #ef4444, #dc2626);
        color: #fff;
    }

    #logoutMenu button:hover {
        background: linear-gradient(90deg, #b91c1c, #dc2626);
        box-shadow: 0 4px 16px rgba(239,68,68,0.15);
    }
    .main-content {
        flex: 1;
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
        padding: 0;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
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
    .applicants-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #111827;
        margin: 16px 24px 4px 24px;
    }
    .applicants-desc {
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
    .applicants-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
    }
    .applicants-table thead th {
        background: #f3f4f6;
        color: #111827;
        font-size: 0.9rem;
        font-weight: 600;
        padding: 12px 16px;
        text-align: left;
    }
    .applicants-table tbody td {
        font-size: 0.9rem;
        color: #374151;
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
    }
    .applicants-table tbody tr:hover td {
        background: #f9fafb;
    }
    .applicants-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Filter Button and Dropdown Styles */
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
    
    .filter-section {
        padding: 8px 16px;
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
<div class="dashboard-container">
    <aside class="sidebar">
        <div>
            <div class="logo">
                <img src="/images/assistracklogo.png" alt="Logo">
                <span>Assistrack Portal</span>
            </div>
            <nav class="nav">
                <a href="{{ route('Admin') }}">
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
                <a href="{{ route('student.list') }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </span>
                    Student List
                </a>
                    <a href="{{ route('applicants.list') }}" class="active">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="m22 21-3-3 3-3"/>
                        </svg>
                    </span>
                    New Applicants
                </a>
                @include('admin.sidebar-reports-dropdown')
            </nav>
        </div>
        <!-- Profile -->
        <div class="profile" id="profileDropdown">
            @if(auth()->user()->profile_photo)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="{{ auth()->user()->name }}" class="avatar" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=667eea&color=fff&size=36" alt="{{ auth()->user()->name }}" class="avatar" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
            @endif
            <div class="profile-details">
                <span class="name">{{ auth()->user()->name }}</span>
                <span class="username">{{ auth()->user()->username }}</span>
            </div>
            <div style="margin-left:auto; display:flex; flex-direction:column; gap:2px; align-items:center;">
                <button id="logoutUp" style="background:none;border:none;cursor:pointer;padding:0;" title="Show Logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                </button>
                <button id="logoutDown" style="background:none;border:none;cursor:pointer;padding:0;" title="Hide Logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </div>
        </div>

        <div id="logoutMenu">
            <a href="{{ route('profile.edit') }}" style="display:block;margin-bottom:8px;text-align:center;background:#3b82f6;color:#fff;border:none;border-radius:6px;padding:8px 12px;font-size:0.9rem;font-weight:500;cursor:pointer;text-decoration:none;transition:background 0.2s;">Settings</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </aside>

    <section class="main-content">
        <div class="content-card">
            <div class="content-header">
                <span class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="m22 21-3-3 3-3"/>
                    </svg>
                </span>
                <span style="font-weight:600; font-size:1.1rem;">New Applicants</span>
            </div>
            <div style="display: flex; flex-direction: row; align-items: center; padding: 0 24px; margin-bottom: 12px;">
                <div style="flex: 1 1 auto;">
                    <div class="applicants-title" style="margin-bottom:0;">New Applicants</div>
                    <div class="applicants-desc" style="margin-bottom:0;">This page contains new applicants for student assistantship.</div>
                </div>
                <div style="flex: 0 0 auto; display: flex; align-items: center; gap: 8px; justify-content: flex-end;">
                    <!-- Filter Button -->
                    <div class="filter-container">
                        <button class="filter-button" id="filterButton">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                            </svg>
                            Filter
                        </button>
                        
                        <div class="filter-dropdown" id="filterDropdown">
                            <div class="filter-label cascading-label" data-cascade="course">
                                <span>Course</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                            <div class="filter-cascade filter-cascade-course">
                                <div class="filter-option" data-filter="course" data-value="">All Courses</div>
                                <div class="filter-option" data-filter="course" data-value="BSIT">BSIT</div>
                                <div class="filter-option" data-filter="course" data-value="BSCS">BSCS</div>
                                <div class="filter-option" data-filter="course" data-value="BSIS">BSIS</div>
                                <div class="filter-option" data-filter="course" data-value="BSBA">BSBA</div>
                                <div class="filter-option" data-filter="course" data-value="BSA">BSA</div>
                            </div>
                            <div class="filter-label cascading-label" data-cascade="year">
                                <span>Year Level</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                            <div class="filter-cascade filter-cascade-year">
                                <div class="filter-option" data-filter="year" data-value="">All Years</div>
                                <div class="filter-option" data-filter="year" data-value="First Year">First Year</div>
                                <div class="filter-option" data-filter="year" data-value="Second Year">Second Year</div>
                                <div class="filter-option" data-filter="year" data-value="Third Year">Third Year</div>
                                <div class="filter-option" data-filter="year" data-value="Fourth Year">Fourth Year</div>
                                <div class="filter-option" data-filter="year" data-value="Fifth Year">Fifth Year</div>
                            </div>
                            <button class="filter-clear" onclick="clearFilters()">Clear Filters</button>
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <span style="font-size:1rem;color:#374151;padding:6px 18px;border-radius:18px;background:#f3f4f6;display:inline-flex;align-items:center;gap:12px;">
                        @if ($applications->onFirstPage())
                            <span style="color:#d1d5db;cursor:not-allowed;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>
                            </span>
                        @else
                            <a href="{{ $applications->previousPageUrl() }}" style="color:#2563eb;text-decoration:none;display:inline-flex;align-items:center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>
                            </a>
                        @endif
                        <span style="font-size:1rem;color:#374151;">Page {{ $applications->currentPage() }} of {{ $applications->lastPage() }}</span>
                        @if ($applications->hasMorePages())
                            <a href="{{ $applications->nextPageUrl() }}" style="color:#2563eb;text-decoration:none;display:inline-flex;align-items:center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
                            </a>
                        @else
                            <span style="color:#d1d5db;cursor:not-allowed;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
                            </span>
                        @endif
                    </span>
                </div>
            </div>
            <div class="table-container">
                <table class="applicants-table">
                    <thead>
                        <tr>
                            <th>Applicant Name</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Student ID</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $applicant)
                            <tr>
                                <td>{{ $applicant->student_name }}</td>
                                <td>{{ $applicant->course }}</td>
                                <td>{{ $applicant->year_level }}</td>
                                <td>{{ $applicant->id_number }}</td>
                                <td>Pending</td>
                                <td class="action-cell">
                                    <a href="{{ route('applications.show', $applicant->id) }}">View</a>
                                    <form method="POST" action="{{ route('studentlist.add', $applicant->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit">Add to Student List</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profile = document.getElementById('profileDropdown');
    const menu = document.getElementById('logoutMenu');
    profile.addEventListener('click', function(e) {
        e.stopPropagation();
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });
    document.addEventListener('click', function() {
        if (menu.style.display === 'block') menu.style.display = 'none';
    });
    
    // Redirect to login page after logout
    const logoutForm = menu.querySelector('form');
    if (logoutForm) {
        logoutForm.addEventListener('submit', function() {
            setTimeout(function() {
                window.location.href = '/login';
            }, 500);
        });
    }
    
    // Cascading submenu logic for filter
    const filterButton = document.getElementById('filterButton');
    const filterDropdown = document.getElementById('filterDropdown');
    const cascadeLabels = document.querySelectorAll('.cascading-label');
    const cascades = {
        course: document.querySelector('.filter-cascade-course'),
        year: document.querySelector('.filter-cascade-year')
    };
    Object.values(cascades).forEach(c => c.style.display = 'none');

    // Show dropdown when filter button is clicked
    filterButton.addEventListener('click', function(e) {
        e.stopPropagation();
        filterDropdown.classList.toggle('show');
        // Hide all submenus when opening dropdown
        Object.values(cascades).forEach(c => c.style.display = 'none');
    });

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

    // Hide dropdown and submenus when clicking outside
    document.addEventListener('click', function(e) {
        if (!filterDropdown.contains(e.target) && e.target !== filterButton) {
            filterDropdown.classList.remove('show');
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
});

function toggleFilterSection(sectionId) {
    const section = document.getElementById(sectionId);
    section.classList.toggle('show');
}

function applyFilter(filterType, filterValue) {
    // Get current URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    
    // Update or remove filter parameter
    if (filterValue === '') {
        urlParams.delete(filterType);
    } else {
        urlParams.set(filterType, filterValue);
    }
    
    // Reload page with new filters
    window.location.search = urlParams.toString();
}

function clearFilters() {
    // Remove all filter parameters from URL
    window.location.href = window.location.pathname;
}
</script>
@endsection
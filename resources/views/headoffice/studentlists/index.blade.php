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
    /* Profile */
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
    /* Main Content */
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

<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div>
            <div class="logo">
                <img src="/images/assistracklogo.png" alt="Logo">
                <span>Assistrack Portal</span>
            </div>
            <nav class="nav">
                <a href="{{ route('Head') }}">
                    <span class="icon">
                        <!-- Dashboard Icon -->
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="14" width="7" height="7" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" rx="1"/>
                        </svg>
                    </span>
                    Dashboard
                </a>
                <a href="{{ route('head.student.list') }}" class="active">
                    <span class="icon">
                        <!-- Student Icon -->
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </span>
                    Student List
                </a>
                <a href="{{ route('head.reports.list') }}">
                    <span class="icon">
                        <!-- Reports Icon -->
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <line x1="9" y1="9" x2="15" y2="9"/>
                            <line x1="9" y1="15" x2="15" y2="15"/>
                        </svg>
                    </span>
                    Reports
                </a>
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
                                <td>{{ $student->designated_office ?? 'N/A' }}</td>
                                </td>
                                <td class="action-cell">
                                    <a href="{{ route('head.students.show', $student->id) }}">View</a>
                                    <form method="POST" action="{{ route('students.delete', $student->id) }}" style="display:inline-block; margin-left:8px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this student?')" style="background:#ef4444;color:#fff;border:none;padding:6px 12px;border-radius:4px;cursor:pointer;">Delete</button>
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
    // Profile dropdown
    const profile = document.getElementById('profileDropdown');
    const logoutMenu = document.getElementById('logoutMenu');
    profile.addEventListener('click', function(e) {
        e.stopPropagation();
        logoutMenu.style.display = logoutMenu.style.display === 'block' ? 'none' : 'block';
    });
    document.addEventListener('click', function() {
        if (logoutMenu.style.display === 'block') logoutMenu.style.display = 'none';
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
});
</script>
@endsection

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
                <a href="{{ route('Admin') }}">
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
                <a href="{{ route('student.list') }}" class="active">
                    <span class="icon">
                        <!-- Student Icon -->
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </span>
                    Student List
                </a>
                <a href="{{ route('applicants.list') }}">
                    <span class="icon">
                        <!-- Applicants Icon -->
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
            <a href="{{ route('profile.edit') }}">Settings</a>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
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
            <div style="width: 100%; margin-bottom: 12px; position: relative; padding: 0 24px;">
                <div>
                    <div class="studentlist-title" style="margin-bottom:0;">Student Official List</div>
                    <div class="studentlist-desc" style="margin-bottom:0;">This list contains Official Student Assistants of Universidad de Dagupan</div>
                    {{-- Google-style filter dropdown --}}
                    <div style="padding: 0 24px; margin-bottom: 12px; position: relative;">
                        <button id="filterDropdownBtn" style="padding: 7px 18px; border-radius: 6px; background: #2563eb; color: #fff; border: none; font-size: 15px; cursor: pointer;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:6px;">
                                <line x1="4" y1="21" x2="4" y2="14"></line>
                                <line x1="4" y1="10" x2="4" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12" y2="3"></line>
                                <line x1="20" y1="21" x2="20" y2="16"></line>
                                <line x1="20" y1="12" x2="20" y2="3"></line>
                                <line x1="1" y1="14" x2="7" y2="14"></line>
                                <line x1="9" y1="8" x2="15" y2="8"></line>
                                <line x1="17" y1="16" x2="23" y2="16"></line>
                            </svg>
                            Filter
                        </button>
                            <div id="filterDropdownMenu" style="display:none;position:absolute;top:40px;left:0;z-index:1000;background:#fff;border:1px solid #e5e7eb;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);min-width:220px;">
                            <div class="filter-menu-item" style="padding:10px 18px;cursor:pointer;position:relative;">
                        Course
                        <div class="filter-submenu" style="display:none;position:absolute;top:0;left:100%;background:#fff;border:1px solid #e5e7eb;border-radius:8px;min-width:180px;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                            <div class="filter-submenu-item" data-filter="course" data-value="BSIT" style="padding:8px 18px;cursor:pointer;">BSIT</div>
                            <div class="filter-submenu-item" data-filter="course" data-value="BSCS" style="padding:8px 18px;cursor:pointer;">BSCS</div>
                            <div class="filter-submenu-item" data-filter="course" data-value="BSBA" style="padding:8px 18px;cursor:pointer;">BSBA</div>
                            <div class="filter-submenu-item" data-filter="course" data-value="BSN" style="padding:8px 18px;cursor:pointer;">BSN</div>
                            <div class="filter-submenu-item" data-filter="course" data-value="BSED" style="padding:8px 18px;cursor:pointer;">BSED</div>
                            <div class="filter-submenu-item" data-filter="course" data-value="BEED" style="padding:8px 18px;cursor:pointer;">BEED</div>
                            <div class="filter-submenu-item" data-filter="course" data-value="BSHM" style="padding:8px 18px;cursor:pointer;">BSHM</div>
                            <div class="filter-submenu-item" data-filter="course" data-value="BSTM" style="padding:8px 18px;cursor:pointer;">BSTM</div>
                        </div>
                    </div>
                    <div class="filter-menu-item" style="padding:10px 18px;cursor:pointer;position:relative;">
                        Year Level
                        <div class="filter-submenu" style="display:none;position:absolute;top:0;left:100%;background:#fff;border:1px solid #e5e7eb;border-radius:8px;min-width:180px;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                            <div class="filter-submenu-item" data-filter="year_level" data-value="First Year" style="padding:8px 18px;cursor:pointer;">First Year</div>
                            <div class="filter-submenu-item" data-filter="year_level" data-value="Second Year" style="padding:8px 18px;cursor:pointer;">Second Year</div>
                            <div class="filter-submenu-item" data-filter="year_level" data-value="Third Year" style="padding:8px 18px;cursor:pointer;">Third Year</div>
                            <div class="filter-submenu-item" data-filter="year_level" data-value="Fourth Year" style="padding:8px 18px;cursor:pointer;">Fourth Year</div>
                            <div class="filter-submenu-item" data-filter="year_level" data-value="Fifth Year" style="padding:8px 18px;cursor:pointer;">Fifth Year</div>
                        </div>
                    </div>
                    <div class="filter-menu-item" style="padding:10px 18px;cursor:pointer;position:relative;">
                        Office
                            <div class="filter-submenu" style="display:none;position:absolute;top:0;left:100%;background:#fff;border:1px solid #e5e7eb;border-radius:8px;min-width:180px;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                                <div style="max-height: 294px; overflow-y: auto;">
                                    <div class="filter-submenu-item" data-filter="office" data-value="LIBRARY" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">LIBRARY</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="ACADS" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">ACADS</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="REGISTRAR" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">REGISTRAR</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="CANTEEN" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">CANTEEN</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="KUWAGO" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">KUWAGO</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="QUEUING" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">QUEUING</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="HRD" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">HRD</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="SAO" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">SAO</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="GUIDANCE" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">GUIDANCE</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="CLINIC" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">CLINIC</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="OPEN LAB" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">OPEN LAB</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="LINKAGES" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">LINKAGES</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="XACTO" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">XACTO</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="SITE FACULTY" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">SITE FACULTY</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="SOHS FACULTY" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">SOHS FACULTY</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="SOH FACULTY" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">SOH FACULTY</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="STE FACULTY" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">STE FACULTY</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="SOC FACULTY" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">SOC FACULTY</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="SBA FACULTY" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">SBA FACULTY</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="SOE FACULTY" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">SOE FACULTY</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="SIMH FACULTY" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">SIMH FACULTY</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="SITE DEAN'S OFFICE" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">SITE DEAN'S OFFICE</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="FINANCE" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">FINANCE</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="LCR" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">LCR</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="STEEDS" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">STEEDS</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="SPORTS AND CULTURE" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">SPORTS AND CULTURE</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="QUALITY ASSURANCE" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">QUALITY ASSURANCE</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="ARCHIVING" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">ARCHIVING</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="PRESIDENT'S OFFICE" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">PRESIDENT'S OFFICE</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="MARKETING" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">MARKETING</div>
                                    <div class="filter-submenu-item" data-filter="office" data-value="ALUMNI OFFICE" style="padding:10px 22px;cursor:pointer;font-size:14px;transition:background 0.15s;">ALUMNI OFFICE</div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('filterDropdownBtn');
    const menu = document.getElementById('filterDropdownMenu');
    const items = menu.querySelectorAll('.filter-menu-item');
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });
    items.forEach(function(item) {
        item.addEventListener('mouseenter', function() {
            menu.querySelectorAll('.filter-submenu').forEach(sub => sub.style.display = 'none');
            const submenu = item.querySelector('.filter-submenu');
            if(submenu) submenu.style.display = 'block';
        });
        item.addEventListener('mouseleave', function() {
            const submenu = item.querySelector('.filter-submenu');
            if(submenu) submenu.style.display = 'none';
        });
    });
    menu.querySelectorAll('.filter-submenu-item').forEach(function(subitem) {
        subitem.addEventListener('click', function() {
            const filter = subitem.getAttribute('data-filter');
            const value = subitem.getAttribute('data-value');
            const url = new URL(window.location.href);
            url.searchParams.set(filter, value);
            window.location.href = url.toString();
        });
    });
    document.addEventListener('click', function(e) {
        if(!menu.contains(e.target) && e.target !== btn) menu.style.display = 'none';
    });
});
</script>
                </div>
                <div style="position: absolute; top: 0; right: 24px; display: flex; align-items: center; gap: 8px; height: 100%;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <form method="GET" action="" style="display: flex; align-items: center; gap: 8px;">
                            <input type="text" name="keyword" id="studentSearchBar" value="{{ request('keyword') }}" placeholder="Search students..." style="padding: 7px 12px; border-radius: 6px; border: 1px solid #bbb; font-size: 15px;">
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var searchBar = document.getElementById('studentSearchBar');
                            var originalUrl = "{{ route('student.list') }}";
                            searchBar.addEventListener('input', function() {
                                if (searchBar.value.trim() === '') {
                                    window.location.href = originalUrl;
                                }
                            });
                        });
                        </script>
                            <button type="submit" style="padding: 7px 18px; border-radius: 6px; background: #2563eb; color: #fff; border: none; font-size: 15px; cursor: pointer;">Search</button>
                        </form>
                        <span style="font-size:1rem;color:#374151;padding:6px 18px;border-radius:18px;background:#f3f4f6;display:inline-flex;align-items:center;gap:12px;">
                            @if ($students->onFirstPage())
                                <span style="color:#d1d5db;cursor:not-allowed;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>
                                </span>
                            @else
                                <a href="{{ $students->previousPageUrl() }}" style="color:#2563eb;text-decoration:none;display:inline-flex;align-items:center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>
                                </a>
                            @endif
                            <span style="font-size:1rem;color:#374151;">Page {{ $students->currentPage() }} of {{ $students->lastPage() }}</span>
                            @if ($students->hasMorePages())
                                <a href="{{ $students->nextPageUrl() }}" style="color:#2563eb;text-decoration:none;display:inline-flex;align-items:center;">
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
                                <td style="overflow: visible; position: relative;">
                                    <div class="searchable-dropdown" style="position:relative; width:180px; overflow: visible;">
                                        <div style="position:relative;">
                                            <input type="text" class="office-combo-input" value="{{ $student->designated_office }}" placeholder="Select or search office..." style="width:100%;padding:6px 32px 6px 10px;border-radius:5px;border:1px solid #bbb;font-size:14px;" autocomplete="off" readonly data-student-id="{{ $student->id }}">
                                            <span class="office-combo-arrow" style="position:absolute;top:8px;right:10px;width:18px;height:18px;pointer-events:auto;cursor:pointer;display:flex;align-items:center;justify-content:center;z-index:100;background:#fff;">
                                                <svg width="18" height="18" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="#555" stroke-width="2" fill="none"/></svg>
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
                                    <a href="{{ route('students.show', $student->id) }}">View</a>
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
    // Custom searchable dropdown for Designated Office
    document.querySelectorAll('.searchable-dropdown').forEach(function(dropdownDiv) {
        const input = dropdownDiv.querySelector('.office-combo-input');
        const list = dropdownDiv.querySelector('.office-combo-list');
        const items = Array.from(list.querySelectorAll('.office-combo-item'));
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
                        var studentId = input.getAttribute('data-student-id');
                        var token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
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

    // Filter dropdown logic
    document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('filterDropdownBtn');
    const menu = document.getElementById('filterDropdownMenu');
    const items = menu.querySelectorAll('.filter-menu-item');
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });
    items.forEach(function(item) {
        item.addEventListener('mouseenter', function() {
            menu.querySelectorAll('.filter-submenu').forEach(sub => sub.style.display = 'none');
            const submenu = item.querySelector('.filter-submenu');
            if(submenu) submenu.style.display = 'block';
        });
        item.addEventListener('mouseleave', function() {
            const submenu = item.querySelector('.filter-submenu');
            if(submenu) submenu.style.display = 'none';
        });
    });
    menu.querySelectorAll('.filter-submenu-item').forEach(function(subitem) {
        subitem.addEventListener('click', function() {
            const filter = subitem.getAttribute('data-filter');
            const value = subitem.getAttribute('data-value');
            const url = new URL(window.location.href);
            url.searchParams.set(filter, value);
            window.location.href = url.toString();
        });
    });
    document.addEventListener('click', function(e) {
        if(!menu.contains(e.target) && e.target !== btn) menu.style.display = 'none';
    });
});

    // Sidebar profile dropdown logic (settings/logout)
    var profile = document.getElementById('profileDropdown');
    var menu = document.getElementById('logoutMenu');
    profile.addEventListener('click', function(e) {
        e.stopPropagation();
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });
    document.addEventListener('click', function() {
        if (menu.style.display === 'block') menu.style.display = 'none';
    });
});
</script>
@endsection

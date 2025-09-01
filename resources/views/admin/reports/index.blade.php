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
    }
    .sidebar .profile-details .username {
        font-size: 0.8rem;
        color: #6b7280;
    }
    #logoutMenu {
        display: none;
        position: absolute;
        bottom: 60px;
        left: 20px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        padding: 10px;
        z-index: 20;
        min-width: 160px;
    }
    #logoutMenu button {
        width: 100%;
        background: #ef4444;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 8px 12px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
    }
    #logoutMenu button:hover {
        background: #dc2626;
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
    .reports-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #111827;
        margin: 16px 24px 4px 24px;
    }
    .reports-desc {
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
    .reports-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
    }
    .reports-table thead th {
        background: #f3f4f6;
        color: #111827;
        font-size: 0.9rem;
        font-weight: 600;
        padding: 12px 16px;
        text-align: left;
    }
    .reports-table tbody td {
        font-size: 0.9rem;
        color: #374151;
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
    }
    .reports-table tbody tr:hover td {
        background: #f9fafb;
    }
    .reports-table tbody tr:last-child td {
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
                <a href="{{ route('dashboard') }}">
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
                <a href="{{ route('student.list') }}">
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
                <a href="{{ route('reports.list') }}" class="active">
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
        <div class="profile" id="profileDropdown">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #ddd; display: flex; align-items: center; justify-content: center; font-weight: 600;">LA</div>
                <div style="display: flex; flex-direction: column;">
                    <span class="name" style="font-size: 0.9rem; font-weight: 600; letter-spacing: 0.05em;">Admin Full name</span>
                    <span class="username" style="font-size: 0.75rem; letter-spacing: 0.05em; color: #555;">Admin username</span>
                </div>
                <div style="display: flex; flex-direction: column; align-items: center; gap: 2px; margin-left: auto;">
                    <button id="logoutUp" style="background:none;border:none;cursor:pointer;padding:0;" title="Show Logout">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </button>
                    <button id="logoutDown" style="background:none;border:none;cursor:pointer;padding:0;" title="Hide Logout">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                </div>
            </div>
            <div id="logoutMenu">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <section class="main-content">
        <div class="content-card">
            <div class="content-header">
                <span class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <line x1="9" y1="9" x2="15" y2="9"/>
                        <line x1="9" y1="15" x2="15" y2="15"/>
                    </svg>
                </span>
                Reports
            </div>
            <div class="reports-title">Reports</div>
            <div class="reports-desc">This list contains of the students and their reports</div>
            <div class="table-container">
                <table class="reports-table">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Block and Course</th>
                            <th>Assigned Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Reports rows go here -->
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
});
</script>
@endsection

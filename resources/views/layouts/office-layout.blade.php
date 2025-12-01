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
        flex-shrink: 0;
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
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Reports dropdown styles */
    .parent-toggle:hover { 
        background-color: #F3F4F6; 
    }

    .parent-toggle.active {
        background-color: #f9fafb !important;
        color: #111827 !important;
        border-left: 3px solid #3b82f6 !important;
    }

    .nav-treeview .nav-link:hover { 
        background-color: #F3F4F6; 
    }

    .nav-treeview .nav-link.active { 
        background-color: #EFF6FF !important; 
        color: #2563EB !important; 
        font-weight: 500 !important; 
    }

    .nav-item { 
        list-style: none; 
    }

    .nav-treeview {
        list-style: none; 
        padding: 0; 
        margin: 0;
    }

    .nav-treeview .nav-link {
        display: flex; 
        align-items: center; 
        padding: 10px 20px 10px 52px; 
        color: #6B7280; 
        text-decoration: none; 
        transition: background-color 0.2s;
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

    #logoutMenu {
        position: fixed;
        bottom: 80px;
        left: 20px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        padding: 8px;
        width: 180px;
        z-index: 99999;
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s, opacity 0.2s;
    }
    
    #logoutMenu.show {
        visibility: visible;
        opacity: 1;
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
        width: calc(100% - 260px);
        margin: 0;
        padding: 0;
    }



    /* Page Header */
    .page-header {
        background: #fff;
        border-bottom: 1px solid #e5e7eb;
        padding: 20px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 50;
        width: 100%;
        box-sizing: border-box;
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .header-title h1 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2563eb;
        letter-spacing: 0.3px;
        margin: 0;
        text-transform: uppercase;
    }

    .page-content {
        flex: 1;
        padding: 20px 30px;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .dashboard-container {
            flex-direction: column;
        }
        
        .sidebar {
            width: 100%;
            position: static;
            height: auto;
        }
        
        .main-content {
            padding: 16px;
        }
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
                <a href="{{ route('offices.studentlists.index') }}" class="{{ request()->routeIs('offices.studentlists.*') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="7" r="4" />
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        </svg>
                    </span>
                    Student List
                </a>
                <a href="{{ route('attendance.index') }}" class="{{ request()->routeIs('attendance.*') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 11l3 3L22 4"/>
                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                        </svg>
                    </span>
                    Attendance
                </a>
                <a href="{{ route('tasks.index') }}" class="{{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"/>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                            <path d="M9 14l2 2 4-4"/>
                        </svg>
                    </span>
                    Tasks
                </a>
                <!-- Reports Dropdown -->
                <div style="padding:0; margin:0; list-style:none;">
                    <div class="nav-item">
                        <a href="#" class="nav-link parent-toggle {{ request()->routeIs('offices.reports.*') ? 'active' : '' }}" style="display: flex; align-items: center; padding: 12px 20px; color: #374151; text-decoration: none; transition: background-color 0.2s;">
                            <i class="nav-icon bi bi-file-earmark-text" style="margin-right: 12px; font-size: 1.25rem;"></i>
                            <p class="parent-label" style="margin: 0; font-size: 0.95rem; font-weight: bold; flex: 1;">Reports</p>
                            <i class="nav-arrow bi bi-chevron-right" style="font-size: 0.75rem; transition: transform 0.3s;"></i>
                        </a>
                        <ul class="nav nav-treeview" style="display:none;">
                            <li class="nav-item">
                                <a href="{{ route('offices.reports.attendance') }}" class="nav-link report-link {{ request()->routeIs('offices.reports.attendance') ? 'active' : '' }}" data-url="{{ route('offices.reports.attendance') }}" data-name="Attendance">
                                    <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                                    <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Attendance</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('offices.reports.evaluation') }}" class="nav-link report-link {{ request()->routeIs('offices.reports.evaluation') ? 'active' : '' }}" data-url="{{ route('offices.reports.evaluation') }}" data-name="Evaluation">
                                    <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                                    <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Evaluation</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('offices.reports.tasks') }}" class="nav-link report-link {{ request()->routeIs('offices.reports.tasks') ? 'active' : '' }}" data-url="{{ route('offices.reports.tasks') }}" data-name="Tasks">
                                    <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                                    <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Tasks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('offices.reports.grades') }}" class="nav-link report-link {{ request()->routeIs('offices.reports.grades') ? 'active' : '' }}" data-url="{{ route('offices.reports.grades') }}" data-name="Grades">
                                    <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                                    <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Grades</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
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
    <main class="main-content">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-title" style="display:flex;align-items:center;gap:16px;">
                @yield('page-icon')
                <h1 style="font-size:1.5rem;font-weight:600;color:#2563eb;letter-spacing:0.5px;margin:0;text-transform:uppercase;">@yield('page-title', 'Office Portal')</h1>
            </div>
            
            <div style="display:flex;align-items:center;gap:16px;">
                @yield('header-actions')
            </div>
        </div>
        
        @yield('content')
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Profile dropdown functionality
    var profile = document.getElementById('profileDropdown');
    var menu = document.getElementById('logoutMenu');
    
    if (profile && menu) {
        profile.addEventListener('click', function(e) {
            e.stopPropagation();
            menu.classList.toggle('show');
        });
        
        document.addEventListener('click', function() {
            menu.classList.remove('show');
        });
    }

    // Sidebar reports dropdown logic
    const parentToggle = document.querySelector('.parent-toggle');
    const parentLabel = document.querySelector('.parent-label');
    const treeview = document.querySelector('.nav-treeview');
    const arrow = document.querySelector('.nav-arrow');

    if (parentToggle) {
        parentToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (treeview) {
                const currentDisplay = window.getComputedStyle(treeview).display;
                const isVisible = currentDisplay !== 'none';
                
                if (isVisible) {
                    treeview.style.display = 'none';
                    if (arrow) arrow.style.transform = 'rotate(0deg)';
                } else {
                    treeview.style.display = 'block';
                    if (arrow) arrow.style.transform = 'rotate(90deg)';
                }
            }
        });
    }

    // Auto-open dropdown if we're on a reports page
    if (window.location.pathname.includes('/offices/reports/')) {
        if (treeview) {
            treeview.style.display = 'block';
            if (arrow) arrow.style.transform = 'rotate(90deg)';
        }
        
        // Highlight active report link
        document.querySelectorAll('.report-link').forEach(function(link) {
            if (link.classList.contains('active')) {
                link.style.backgroundColor = '#EFF6FF';
                link.style.color = '#2563EB';
                link.style.fontWeight = '500';
            }
        });
    }

    // Report links functionality
    document.querySelectorAll('.report-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            // Remove active class from all report links
            document.querySelectorAll('.report-link').forEach(function(otherLink) {
                otherLink.classList.remove('active');
                otherLink.style.backgroundColor = '';
                otherLink.style.color = '';
                otherLink.style.fontWeight = '';
            });
            
            // Add active class to clicked link
            this.classList.add('active');
            this.style.backgroundColor = '#EFF6FF';
            this.style.color = '#2563EB';
            this.style.fontWeight = '500';
        });
    });
});
</script>

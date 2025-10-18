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
        height: 76px;
        box-sizing: border-box;
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
    
    .nav-treeview .nav-link:hover { 
        background-color: #F3F4F6; 
    }
    
    .nav-treeview .nav-link.active { 
        background-color: #EFF6FF; 
        color: #2563EB; 
        font-weight: 500; 
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

    /* Header */
    .main-header {
        background: #ffffff;
        border-bottom: 1px solid #e5e7eb;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        height: 76px;
        box-sizing: border-box;
    }

    .header-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #3b82f6;
        margin: 0;
    }

    .header-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .header-breadcrumb .separator {
        color: #d1d5db;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        background: transparent;
        display: flex;
        flex-direction: column;
    }

    .content-wrapper {
        flex: 1;
        padding: 0;
        background: #f9fafb;
    }

    .content-card {
        flex: 1;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    .admin-content-wrapper {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: transparent;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar {
            position: fixed;
            left: -260px;
            top: 0;
            height: 100vh;
            z-index: 1000;
            transition: left 0.3s ease;
        }

        .sidebar.active {
            left: 0;
        }

        .main-content {
            width: 100%;
        }

        .main-header {
            padding: 12px 16px;
        }

        .header-title {
            font-size: 1.25rem;
        }

        .header-breadcrumb {
            font-size: 0.75rem;
        }

        .content-wrapper {
            padding: 16px;
        }

        .mobile-menu-btn {
            display: block;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1001;
            background: #3b82f6;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
        }

        .dashboard-stats {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
        }
    }

    @media (min-width: 769px) {
        .mobile-menu-btn {
            display: none;
        }
    }
</style>

<div class="dashboard-container" style="overflow-x:hidden;">
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" onclick="toggleSidebar()">
        <i class="bi bi-list" style="font-size: 1.2rem;"></i>
    </button>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div>
            <div class="logo">
                <img src="/images/assistracklogo.png" alt="Logo">
                <span>Assistrack Portal</span>
            </div>
            <nav class="nav">
                <a href="{{ route('Admin') }}" class="{{ request()->routeIs('Admin') ? 'active' : '' }}">
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
                <a href="{{ route('student.list') }}" class="{{ request()->routeIs('student.list') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </span>
                    Student List
                </a>
                <a href="{{ route('applicants.list') }}" class="{{ request()->routeIs('applicants.list') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="m22 21-3-3 3-3"/>
                        </svg>
                    </span>
                    New Applicants
                </a>
                <a href="{{ route('admin.usermanagement') }}" class="{{ request()->routeIs('admin.usermanagement') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            <path d="M12 1v6"/>
                            <path d="M12 16v6"/>
                        </svg>
                    </span>
                    User Management
                </a>
                
                <!-- Reports Dropdown -->
                <div style="padding:0; margin:0; list-style:none;">
                    <div class="nav-item">
                        <a href="#" class="nav-link parent-toggle" style="display: flex; align-items: center; padding: 12px 20px; color: #374151; text-decoration: none; transition: background-color 0.2s;">
                            <i class="nav-icon bi bi-file-earmark-text" style="margin-right: 12px; font-size: 1.25rem;"></i>
                            <p class="parent-label" style="margin: 0; font-size: 0.95rem; font-weight: bold; flex: 1;">Reports</p>
                            <i class="nav-arrow bi bi-chevron-right" style="font-size: 0.75rem; transition: transform 0.3s;"></i>
                        </a>
                        <ul class="nav nav-treeview" style="display:none;">
                            <li class="nav-item">
                                <a href="/admin/reports/attendance" class="nav-link report-link" data-url="/admin/reports/attendance" data-name="Attendance">
                                    <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                                    <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Attendance</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/reports/evaluation" class="nav-link report-link" data-url="/admin/reports/evaluation" data-name="Evaluation">
                                    <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                                    <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Evaluation</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/reports/tasks" class="nav-link report-link" data-url="/admin/reports/tasks" data-name="Tasks">
                                    <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                                    <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Tasks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/reports/grades" class="nav-link report-link" data-url="/admin/reports/grades" data-name="Grades">
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
    <section class="main-content w-full">
        <!-- Header -->
        <header class="main-header">
            <div>
                <h1 class="header-title">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="header-actions">
                @yield('header-actions')
                <!-- Add any common header actions here -->
            </div>
        </header>
        
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="admin-content-wrapper">
                @yield('content')
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Profile dropdown functionality
    var profile = document.getElementById('profileDropdown');
    var menu = document.getElementById('logoutMenu');
    
    if (profile && menu) {
        profile.addEventListener('click', function(e) {
            e.stopPropagation();
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
        
        document.addEventListener('click', function() {
            if (menu.style.display === 'block') menu.style.display = 'none';
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
                const isVisible = treeview.style.display !== 'none';
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

    // Report links functionality (for AJAX loading if needed)
    document.querySelectorAll('.report-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            // Remove default AJAX behavior - let normal navigation work
            // You can add AJAX functionality here if needed later
        });
    });
});

// Mobile sidebar toggle
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
}

// Close sidebar when clicking outside on mobile
document.addEventListener('click', function(e) {
    const sidebar = document.getElementById('sidebar');
    const menuBtn = document.querySelector('.mobile-menu-btn');
    
    if (window.innerWidth <= 768 && sidebar && menuBtn) {
        if (!sidebar.contains(e.target) && !menuBtn.contains(e.target)) {
            sidebar.classList.remove('active');
        }
    }
});

// Close sidebar when navigation links are clicked on mobile
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const navLinks = document.querySelectorAll('.nav a');
    
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768 && sidebar) {
                sidebar.classList.remove('active');
            }
        });
    });
});
</script>
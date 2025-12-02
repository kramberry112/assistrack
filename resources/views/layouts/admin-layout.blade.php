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
        bottom: 70px;
        left: 50%;
        transform: translateX(-50%);
        background: #fff;
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        padding: 16px;
        min-width: 200px;
        max-width: 240px;
        z-index: 1000;
        text-align: center;
        width: auto;
    }
    
    /* Ensure sidebar has position relative for proper absolute positioning */
    .sidebar {
        position: relative;
    }

    #logoutMenu a,
    #logoutMenu button {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        height: 40px !important;
        min-height: 40px !important;
        max-height: 40px !important;
        border-radius: 6px !important;
        font-size: 0.9rem !important;
        font-weight: 500 !important;
        margin: 0 0 12px 0 !important;
        padding: 10px 16px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08) !important;
        border: none !important;
        outline: none !important;
        transition: background 0.2s, box-shadow 0.2s !important;
        text-align: center !important;
        cursor: pointer !important;
        box-sizing: border-box !important;
        line-height: 1.5 !important;
        text-decoration: none !important;
        font-family: inherit !important;
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

    #logoutMenu button:last-child,
    #logoutMenu form:last-child button {
        margin-bottom: 0 !important;
    }

    /* Header - FIXED ALIGNMENT */
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

    .header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .header-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2563eb;
        margin: 0;
        text-transform: uppercase;
        line-height: 1.5rem;
        display: flex;
        align-items: center;
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
        gap: 16px;
    }

    .notification-bell-container {
        position: relative;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notification-bell {
        width: 24px;
        height: 24px;
        display: block;
    }

    .notification-count {
        position: absolute;
        top: -6px;
        right: -6px;
        background: #ef4444;
        color: #fff;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 600;
        line-height: 1;
    }

    .notification-dropdown {
        display: none;
        position: absolute;
        top: 36px;
        right: 0;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        min-width: 260px;
        z-index: 99999;
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

    /* Mobile Hamburger Menu */
    .mobile-hamburger {
        display: none;
        flex-direction: column;
        cursor: pointer;
        padding: 4px;
        z-index: 1100;
        position: relative;
    }

    .mobile-hamburger span {
        width: 25px;
        height: 3px;
        background-color: #2563eb;
        margin: 3px 0;
        transition: 0.3s;
        border-radius: 2px;
    }

    /* Hide hamburger when sidebar is active */
    .sidebar.active ~ .main-content .mobile-hamburger {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    
    .mobile-hamburger {
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    /* Mobile Overlay */
    .mobile-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .mobile-overlay.active {
        display: block;
        opacity: 1;
    }

    /* Enhanced Mobile Responsive Styles */
    @media (max-width: 768px) {
        body {
            overflow-x: hidden !important;
        }

        body.sidebar-open {
            overflow: hidden !important;
            position: fixed !important;
            width: 100% !important;
        }

        .dashboard-container {
            width: 100% !important;
            max-width: 100vw !important;
            overflow-x: hidden !important;
        }

        .sidebar {
            position: fixed !important;
            top: 0 !important;
            left: -300px !important;
            width: 280px !important;
            height: calc(100vh - env(safe-area-inset-bottom, 0px)) !important;
            height: calc(100dvh - env(safe-area-inset-bottom, 0px)) !important;
            max-height: calc(100vh - env(safe-area-inset-bottom, 0px)) !important;
            z-index: 1000 !important;
            transition: transform 0.3s ease, left 0.3s ease !important;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15) !important;
            transform: translateX(0) !important;
            will-change: transform, left !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
        }

        .sidebar.active {
            left: 0 !important;
            transform: translateX(0) !important;
        }

        .main-content {
            width: 100% !important;
            max-width: 100vw !important;
            overflow-x: hidden !important;
            padding: 0 !important;
            margin: 0 !important;
            transition: transform 0.3s ease !important;
        }

        .mobile-hamburger {
            display: flex !important;
        }

        .mobile-menu-btn {
            display: none !important;
        }

        .main-header {
            padding: 12px 16px !important;
            width: 100% !important;
            max-width: 100vw !important;
            box-sizing: border-box !important;
            margin: 0 !important;
        }

        .header-title {
            font-size: 1.1rem !important;
            margin: 0 !important;
        }

        .header-breadcrumb {
            font-size: 0.75rem !important;
        }

        .content-wrapper {
            padding: 16px !important;
        }

        .dashboard-stats {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)) !important;
            gap: 12px !important;
        }
    }

    /* Mobile specific improvements */
    @media (max-width: 480px) {
        .sidebar {
            width: 260px !important;
            left: -260px !important;
            bottom: 20px !important;
            height: calc(100vh - 60px) !important;
            height: calc(100dvh - 60px) !important;
        }
        
        .main-header {
            padding: 8px 12px !important;
        }
        
        .header-title {
            font-size: 1rem !important;
        }
    }

    /* Ensure sidebar doesn't interfere with system UI */
    @media (max-width: 768px) and (display-mode: browser) {
        .sidebar {
            bottom: 20px !important;
            height: calc(100vh - 60px) !important;
        }
    }

    /* For phones with home indicator */
    @supports (bottom: env(safe-area-inset-bottom)) {
        @media (max-width: 768px) {
            .sidebar {
                bottom: calc(env(safe-area-inset-bottom, 0px) + 20px) !important;
                height: calc(100vh - env(safe-area-inset-bottom, 0px) - 60px) !important;
                padding-bottom: 0 !important;
            }
        }
    }

    /* Fix for mobile browsers with dynamic viewport */
    @media (max-width: 768px) {
        .sidebar {
            bottom: 20px !important;
            height: calc(100vh - 60px) !important;
            height: calc(var(--vh, 1vh) * 100 - 60px) !important;
            min-height: calc(100vh - 60px) !important;
            max-height: calc(100vh - 60px) !important;
            overflow-y: auto !important;
            -webkit-overflow-scrolling: touch !important;
            display: flex !important;
            flex-direction: column !important;
        }
        
        .sidebar > div:first-child {
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            min-height: 0 !important;
        }
        
        .sidebar .nav {
            flex: 1 !important;
            padding-bottom: 20px !important;
            min-height: 0 !important;
            overflow-y: auto !important;
        }
        
        .sidebar .profile {
            flex-shrink: 0 !important;
            margin-top: auto !important;
            margin-bottom: 10px !important;
            padding-bottom: 10px !important;
        }
        
        #logoutMenu {
            flex-shrink: 0 !important;
            margin-bottom: 10px !important;
        }
    }

    @media (min-width: 769px) {
        .mobile-menu-btn {
            display: none;
        }
    }
</style>

<div class="dashboard-container" style="overflow-x:hidden;">
    <!-- Mobile Overlay -->
    <!-- Mobile Sidebar Overlay -->
    <div class="mobile-sidebar-overlay" id="mobileSidebarOverlay"></div>
    
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
                <a href="{{ route('admin.sa-requests.index') }}" class="{{ request()->routeIs('admin.sa-requests.*') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="8.5" cy="7" r="4"/>
                            <polyline points="17,11 19,13 23,9"/>
                        </svg>
                    </span>
                    SA Requests
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
            <form method="POST" action="{{ route('logout') }}" style="margin:0;padding:0;display:block;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <section class="main-content w-full">
        <!-- Header - FIXED STRUCTURE -->
        <header class="main-header">
            <!-- Left side: Hamburger and Title -->
            <div class="header-left">
                <!-- Mobile Hamburger Menu -->
                <div class="mobile-hamburger" id="mobileHamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <h1 class="header-title">@yield('page-title', 'Dashboard')</h1>
            </div>
            
            <!-- Right side: Actions and Notification -->
            <div class="header-actions">
                @yield('header-actions')
                <!-- Notification Bell -->
                <div class="notification-bell-container" id="adminNotificationBellContainer">
                    <svg class="notification-bell" id="adminNotificationBell" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    <span class="notification-count" id="adminNotificationCount">0</span>
                </div>
                <div class="notification-dropdown" id="adminNotificationDropdown">
                    <div id="adminNotificationContent" style="padding:16px;">Loading...</div>
                </div>
            </div>
        </header>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Admin notification functionality
            function updateAdminNotificationCount() {
                fetch('/admin/notifications')
                    .then(response => response.json())
                    .then(data => {
                        const countSpan = document.getElementById('adminNotificationCount');
                        if (data.length > 0) {
                            countSpan.textContent = data.length;
                            countSpan.style.display = 'flex';
                        } else {
                            countSpan.textContent = '0';
                            countSpan.style.display = 'flex';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching notifications:', error);
                    });
            }

            // Mark all notifications as read function
            window.markAllNotificationsAsRead = function() {
                fetch('/admin/notifications/mark-all-read', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateAdminNotificationCount();
                        // Close dropdown
                        document.getElementById('adminNotificationDropdown').style.display = 'none';
                    }
                });
            };

            // Update notification count on page load and every 30 seconds
            updateAdminNotificationCount();
            setInterval(updateAdminNotificationCount, 30000);

            // Notification dropdown functionality
            const bellContainer = document.getElementById('adminNotificationBellContainer');
            const dropdown = document.getElementById('adminNotificationDropdown');
            const content = document.getElementById('adminNotificationContent');

            if (bellContainer && dropdown && content) {
                bellContainer.addEventListener('click', function(e) {
                    e.stopPropagation();
                    updateAdminNotificationCount();
                    if (dropdown.style.display === 'block') {
                        dropdown.style.display = 'none';
                    } else {
                        dropdown.style.display = 'block';
                        content.innerHTML = 'Loading...';
                        fetch('/admin/notifications')
                            .then(response => response.json())
                            .then(data => {
                                if (data.length === 0) {
                                    content.innerHTML = '<div style="color:#374151;font-weight:500;">No notifications.</div>';
                                } else {
                                    content.innerHTML = `
                                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;padding-bottom:8px;border-bottom:2px solid #e5e7eb;">
                                            <div style="font-weight:600;color:#111827;">Notifications (${data.length})</div>
                                            <button onclick="markAllNotificationsAsRead()" style="background:#3b82f6;color:white;border:none;padding:4px 8px;border-radius:4px;font-size:0.8rem;cursor:pointer;">
                                                Mark all as read
                                            </button>
                                        </div>
                                        ${data.map(n => `
                                            <div style="margin-bottom:12px;padding-bottom:12px;border-bottom:1px solid #e5e7eb;">
                                                <div style="font-weight:600;color:#2563eb;">${n.title}</div>
                                                <div style="color:#374151;">${n.message}</div>
                                                <div style="color:#6b7280;font-size:0.8rem;margin-top:4px;">${n.created_at}</div>
                                            </div>
                                        `).join('')}
                                    `;
                                    
                                    // Automatically mark all notifications as read after viewing
                                    setTimeout(() => {
                                        fetch('/admin/notifications/mark-all-read', {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                'Content-Type': 'application/json'
                                            }
                                        }).then(() => {
                                            // Update notification count after marking as read
                                            updateAdminNotificationCount();
                                        });
                                    }, 2000); // Mark as read after 2 seconds of viewing
                                }
                            });
                    }
                });
                document.addEventListener('click', function(e) {
                    if (!bellContainer.contains(e.target) && !dropdown.contains(e.target)) {
                        dropdown.style.display = 'none';
                    }
                });
            }
        });
        </script>
        
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
    if (window.location.pathname.includes('/admin/reports/')) {
        if (treeview) {
            treeview.style.display = 'block';
            if (arrow) arrow.style.transform = 'rotate(90deg)';
        }
    }

    // Report links functionality
    document.querySelectorAll('.report-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            // Normal navigation
        });
    });
});

// Enhanced mobile sidebar functionality matching student layout
// Fix for mobile viewport height (handles address bar and navigation bars on mobile browsers)
function setViewportHeight() {
    const actualHeight = Math.min(window.innerHeight, window.screen.height * 0.9);
    let vh = actualHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
    
    const sidebar = document.getElementById('sidebar');
    if (sidebar && window.innerWidth <= 768) {
        sidebar.style.height = `${actualHeight - 40}px`;
    }
}

setViewportHeight();
window.addEventListener('resize', setViewportHeight);
window.addEventListener('orientationchange', () => {
    setTimeout(setViewportHeight, 100);
});

// Mobile sidebar functionality matching student layout exactly
const mobileHamburger = document.getElementById('mobileHamburger');
const mobileSidebarOverlay = document.getElementById('mobileSidebarOverlay');
const sidebar = document.getElementById('sidebar');

if (mobileHamburger && mobileSidebarOverlay && sidebar) {
    // Toggle sidebar when hamburger is clicked
    mobileHamburger.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleMobileSidebar();
    });
    
    // Close sidebar when overlay is clicked
    mobileSidebarOverlay.addEventListener('click', function(e) {
        e.stopPropagation();
        closeMobileSidebar();
    });
    
    // Prevent sidebar from closing when clicking inside it
    sidebar.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
    // Close sidebar when window is resized to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            closeMobileSidebar();
        }
    });
    
    // Add keyboard support (ESC key to close sidebar)
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sidebar.classList.contains('active')) {
            closeMobileSidebar();
        }
    });
    
    // Close sidebar when clicking anywhere outside (tap anywhere to close)
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768 && sidebar.classList.contains('active')) {
            // Only close if clicking outside sidebar and hamburger
            if (!sidebar.contains(e.target) && !mobileHamburger.contains(e.target)) {
                closeMobileSidebar();
            }
        }
    });
    
    // Add touch support for better mobile experience
    let touchStartX = 0;
    let touchStartY = 0;
    
    document.addEventListener('touchstart', function(e) {
        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
    }, { passive: true });
    
    document.addEventListener('touchend', function(e) {
        const touchEndX = e.changedTouches[0].clientX;
        const touchEndY = e.changedTouches[0].clientY;
        const deltaX = touchEndX - touchStartX;
        const deltaY = touchEndY - touchStartY;
        
        // Only process horizontal swipes
        if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > 50) {
            if (deltaX > 0 && touchStartX < 50 && !sidebar.classList.contains('active')) {
                // Swipe right from left edge to open sidebar
                openMobileSidebar();
            } else if (deltaX < -50 && sidebar.classList.contains('active')) {
                // Swipe left to close sidebar
                closeMobileSidebar();
            }
        }
    }, { passive: true });
    
    function toggleMobileSidebar() {
        const isActive = sidebar.classList.contains('active');
        if (isActive) {
            closeMobileSidebar();
        } else {
            openMobileSidebar();
        }
    }
    
    function openMobileSidebar() {
        sidebar.classList.add('active');
        mobileSidebarOverlay.classList.add('active');
        mobileHamburger.classList.add('active');
        document.body.classList.add('sidebar-open');
        // Prevent scrolling on body
        document.body.style.overflow = 'hidden';
        document.body.style.position = 'fixed';
        document.body.style.width = '100%';
        
        // Adjust sidebar height to avoid phone navigation buttons
        if (window.innerWidth <= 768) {
            const availableHeight = Math.min(window.innerHeight, window.screen.height * 0.85);
            sidebar.style.height = `${availableHeight}px`;
            sidebar.style.maxHeight = `${availableHeight}px`;
        }
    }
    
    function closeMobileSidebar() {
        sidebar.classList.remove('active');
        mobileSidebarOverlay.classList.remove('active');
        mobileHamburger.classList.remove('active');
        document.body.classList.remove('sidebar-open');
        // Restore scrolling
        document.body.style.overflow = '';
        document.body.style.position = '';
        document.body.style.width = '';
    }
}

// Close sidebar when navigation links are clicked on mobile
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav a');
    
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768 && sidebar && sidebar.classList.contains('active')) {
                closeMobileSidebar();
            }
        });
    });
});
</script>
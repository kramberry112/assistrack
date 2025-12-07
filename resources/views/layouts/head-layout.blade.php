<style>
    /* Prevent horizontal scroll */
    * {
        box-sizing: border-box;
    }
    
    html, body {
        margin: 0;
        padding: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #ffffff;
        overflow-x: hidden;
        max-width: 100vw;
    }

    .dashboard-container {
        display: flex;
        min-height: 100vh;
        overflow-x: hidden;
        max-width: 100vw;
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

    /* Dropdown Styles */
    .dropdown {
        position: relative;
    }

    .dropdown-toggle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 20px;
        font-size: 0.95rem;
        color: #374151;
        text-decoration: none;
        transition: all 0.2s;
        border-left: 3px solid transparent;
        font-weight: 500;
        cursor: pointer;
    }

    .dropdown-toggle:hover {
        background: #f9fafb;
        color: #111827;
    }

    .dropdown-toggle.active {
        background: #f9fafb;
        color: #111827;
        border-left: 3px solid #3b82f6;
    }

    .dropdown-icon {
        transition: transform 0.2s ease;
        margin-left: auto;
    }

    .dropdown-toggle.open .dropdown-icon {
        transform: rotate(180deg);
    }

    .dropdown-menu {
        display: none;
        background: #f8fafc;
        border-left: 3px solid transparent;
        margin-left: 20px;
        border-radius: 0 8px 8px 0;
    }

    .dropdown-menu.open {
        display: block;
    }

    .dropdown-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 20px;
        font-size: 0.9rem;
        color: #64748b;
        text-decoration: none;
        transition: all 0.2s;
        border-left: 3px solid transparent;
        font-weight: 500;
    }

    .dropdown-menu a:hover {
        background: #e2e8f0;
        color: #475569;
    }

    .dropdown-menu a.active {
        background: #e2e8f0;
        color: #475569;
        border-left: 3px solid #3b82f6;
    }

    .dropdown-menu a .icon {
        width: 16px;
        height: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
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
    #headLogoutMenu {
        display: none;
        position: fixed;
        bottom: 70px;
        left: 20px;
        background: #fff;
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        padding: 24px 20px 16px 20px;
        min-width: 220px;
        z-index: 1001;
        text-align: center;
    }

    #headLogoutMenu a,
    #headLogoutMenu button {
        display: block;
        width: 100%;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 12px;
        padding: 12px 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border: none;
        transition: background 0.2s, box-shadow 0.2s;
        text-align: center;
        cursor: pointer;
    }
    
    #headLogoutMenu button {
        margin-bottom: 0;
    }

    #headLogoutMenu a {
        background: #4f8ef7;
        color: #fff;
        text-decoration: none;
    }

    #headLogoutMenu a:hover {
        background: #2563eb;
    }

    #headLogoutMenu button {
        background: linear-gradient(90deg, #ef4444, #dc2626) !important;
        color: #fff !important;
    }

    #headLogoutMenu button:hover {
        background: linear-gradient(90deg, #b91c1c, #dc2626) !important;
        box-shadow: 0 4px 16px rgba(239,68,68,0.15) !important;
    }

    /* Ensure Settings button stays blue */
    #headLogoutMenu a {
        background: #4f8ef7 !important;
        color: #fff !important;
        text-decoration: none !important;
    }

    #headLogoutMenu a:hover {
        background: #2563eb !important;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        background: transparent;
        display: flex;
        flex-direction: column;
        padding: 0;
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
        color: #2563eb;
        margin: 0;
        text-transform: uppercase;
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

    /* Content Area Protection */
    .content-area {
        flex: 1;
        padding: 30px;
        overflow-x: hidden;
        max-width: 100%;
        word-wrap: break-word;
        background: #fafafa;
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

    /* Mobile Hamburger Menu */
    .mobile-hamburger {
        display: none;
        flex-direction: column;
        cursor: pointer;
        padding: 4px;
        z-index: 1001;
    }

    .mobile-hamburger span {
        width: 25px;
        height: 3px;
        background-color: #2563eb;
        margin: 3px 0;
        transition: 0.3s;
        border-radius: 2px;
    }

    /* Mobile Hamburger Menu */
    .mobile-hamburger {
        display: none;
        flex-direction: column;
        cursor: pointer;
        padding: 4px;
        z-index: 1001;
    }

    .mobile-hamburger span {
        width: 25px;
        height: 3px;
        background-color: #2563eb;
        margin: 3px 0;
        transition: 0.3s;
        border-radius: 2px;
    }



    /* Mobile Overlay */
    .mobile-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .mobile-overlay.active {
        display: block;
        opacity: 1;
    }

    /* Responsive */
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
            display: flex !important;
            flex-direction: column !important;
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
            padding: 12px 16px;
            height: auto;
            min-height: 60px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .header-title {
            font-size: 1.1rem;
            word-wrap: break-word;
            flex: 1;
        }

        .header-actions {
            gap: 6px;
            flex-shrink: 0;
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

        /* Fix logout menu positioning on mobile to keep it in sidebar */
        #headLogoutMenu {
            position: fixed !important;
            bottom: 80px !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            z-index: 1100 !important;
            min-width: 180px !important;
            max-width: 200px !important;
            margin: 0 8px !important;
        }

        /* Ensure logout menu stays within sidebar bounds when sidebar is active */
        .sidebar.active #headLogoutMenu {
            left: 130px !important;
            transform: translateX(-50%) !important;
        }
        
        /* Sidebar navigation adjustments */
        .sidebar .nav a {
            padding: 10px 16px !important;
            font-size: 0.9rem !important;
        }
        
        /* Mobile dropdown reports styling */
        .sidebar .nav-item {
            width: 100% !important;
        }
        
        .sidebar .parent-toggle {
            padding: 12px 16px !important;
            font-size: 0.9rem !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }
        
        .sidebar .nav-treeview {
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        .sidebar .nav-treeview .nav-link {
            padding: 8px 16px 8px 32px !important;
            font-size: 0.85rem !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }
        
        .sidebar .nav-arrow {
            font-size: 0.7rem !important;
        }
        
        /* Touch-friendly mobile improvements */
        .sidebar .parent-toggle,
        .sidebar .nav-treeview .nav-link {
            min-height: 44px !important;
            display: flex !important;
            align-items: center !important;
            -webkit-tap-highlight-color: rgba(0,0,0,0.1) !important;
        }
        
        .sidebar .nav-treeview .nav-link:active,
        .sidebar .parent-toggle:active {
            background-color: #EFF6FF !important;
        }
        
        .sidebar .logo {
            padding: 16px !important;
        }
        
        .sidebar .logo span {
            font-size: 0.9rem !important;
        }
        
        .sidebar .nav {
            flex: 1 !important;
            padding-bottom: 80px !important;
            min-height: 0 !important;
            overflow-y: auto !important;
        }
        
        .sidebar .sidebar-top {
            flex-shrink: 0 !important;
            overflow: visible !important;
        }
        
        .sidebar .sidebar-bottom {
            flex-shrink: 0 !important;
            margin-top: auto !important;
            padding-bottom: 10px !important;
        }
        
        .sidebar > div:first-child {
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            min-height: 0 !important;
        }
        
        .sidebar .profile {
            position: absolute !important;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
            margin: 0 !important;
            padding: 12px 16px !important;
            background: #ffffff !important;
            border-top: 1px solid #e5e7eb !important;
        }
        
        /* Content area mobile adjustments */
        .content-area {
            padding: 16px 12px !important;
        }
        
        /* Tables and cards mobile responsive */
        .table-responsive {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
            max-width: 100% !important;
        }
        
        table {
            min-width: 600px !important;
        }
        
        .card, .content-card {
            margin: 0 0 16px 0 !important;
            border-radius: 8px !important;
            overflow: hidden !important;
        }
        
        /* Button adjustments */
        .btn {
            font-size: 0.8rem !important;
            padding: 8px 12px !important;
        }
        
        /* Form elements */
        .form-control, .form-select {
            font-size: 14px !important;
        }
    }

    @media (min-width: 769px) {
        .mobile-menu-btn {
            display: none;
        }
    }
    
    /* Ultra mobile (small phones) */
    @media (max-width: 480px) {
        .sidebar {
            max-width: 85vw !important;
        }
        
        .main-header {
            padding: 10px 12px !important;
            min-height: 50px !important;
        }
        
        .header-title {
            font-size: 1rem !important;
        }
        
        .sidebar .nav a {
            padding: 8px 12px !important;
            font-size: 0.85rem !important;
        }
        
        .sidebar .logo {
            padding: 12px !important;
        }
        
        .sidebar .logo span {
            font-size: 0.85rem !important;
        }
        
        .sidebar .profile {
            padding: 10px 12px !important;
            position: absolute;
            bottom: 60px;
            left: 0;
            right: 0;
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
            margin: 0 6px;
        }
        
        #headLogoutMenu {
            min-width: 160px !important;
            max-width: 180px !important;
            padding: 16px 12px 12px 12px !important;
        }
        

        
        /* Content area ultra mobile */
        .content-area {
            padding: 12px 8px !important;
        }
        
        .btn {
            font-size: 0.75rem !important;
            padding: 6px 8px !important;
        }
        
        .card, .content-card {
            margin: 0 0 12px 0 !important;
        }
    }
</style>

<div class="dashboard-container" style="overflow-x:hidden;">
    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay" onclick="closeSidebarHead()"></div>
    
    <!-- Sidebar -->
    <aside class="sidebar" id="headSidebar">
        <div>
            <div class="logo">
                <img src="/images/assistracklogo.png" alt="Logo">
                <span>Assistrack Portal</span>
            </div>
            <nav class="nav">
                <a href="{{ route('Head') }}" class="{{ request()->routeIs('Head') ? 'active' : '' }}">
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
                <a href="{{ route('head.student.list') }}" class="{{ request()->routeIs('head.student.list') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </span>
                    Student List
                </a>
                <!-- Reports Dropdown -->
                <div style="padding:0; margin:0; list-style:none;">
                    <div class="nav-item">
                        <a href="#" class="nav-link parent-toggle" style="display: flex; align-items: center; padding: 12px 20px; color: #374151; text-decoration: none; transition: background-color 0.2s;" id="headReportsDropdown">
                            <i class="nav-icon bi bi-file-earmark-text" style="margin-right: 12px; font-size: 1.25rem;"></i>
                            <p class="parent-label" style="margin: 0; font-size: 0.95rem; font-weight: bold; flex: 1;">Reports</p>
                            <i class="nav-arrow bi bi-chevron-right" style="font-size: 0.75rem; transition: transform 0.3s;"></i>
                        </a>
                        <ul class="nav nav-treeview" style="display:none;" id="headReportsMenu">
                            <li class="nav-item">
                                <a href="{{ route('head.reports.attendance') }}" class="nav-link report-link {{ request()->routeIs('head.reports.attendance') ? 'active' : '' }}" data-url="{{ route('head.reports.attendance') }}" data-name="Attendance">
                                    <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                                    <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Attendance</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('head.reports.evaluation') }}" class="nav-link report-link {{ request()->routeIs('head.reports.evaluation') ? 'active' : '' }}" data-url="{{ route('head.reports.evaluation') }}" data-name="Evaluation">
                                    <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                                    <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Evaluation</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('head.reports.tasks') }}" class="nav-link report-link {{ request()->routeIs('head.reports.tasks') ? 'active' : '' }}" data-url="{{ route('head.reports.tasks') }}" data-name="Tasks">
                                    <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                                    <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Tasks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('head.reports.grades') }}" class="nav-link report-link {{ request()->routeIs('head.reports.grades') ? 'active' : '' }}" data-url="{{ route('head.reports.grades') }}" data-name="Grades">
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
        <div class="profile" id="headProfileDropdown">
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
                <button id="headLogoutUp" style="background:none;border:none;cursor:pointer;padding:0;" title="Show Logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                </button>
                <button id="headLogoutDown" style="background:none;border:none;cursor:pointer;padding:0;" title="Hide Logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </div>
        </div>

        <div id="headLogoutMenu">
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
            <div style="display: flex; align-items: center; gap: 12px;">
                <!-- Mobile Hamburger Menu -->
                <div class="mobile-hamburger" id="mobileHamburger" onclick="toggleSidebarHead()">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <h1 class="header-title">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="header-actions">
                @yield('header-actions')
                <!-- Add any common header actions here -->
            </div>
        </header>
        
        <!-- Content -->
        @yield('content')
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Profile dropdown functionality
    var profile = document.getElementById('headProfileDropdown');
    var menu = document.getElementById('headLogoutMenu');
    
    if (profile && menu) {
        profile.addEventListener('click', function(e) {
            e.stopPropagation();
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
        
        document.addEventListener('click', function() {
            if (menu.style.display === 'block') menu.style.display = 'none';
        });
    }

    // Reports dropdown functionality - matches admin layout
    const parentToggle = document.querySelector('.parent-toggle');
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

    // Keep dropdown open if we're on a reports page
    if (window.location.pathname.includes('/head/reports/')) {
        if (treeview) {
            treeview.style.display = 'block';
            if (arrow) arrow.style.transform = 'rotate(90deg)';
        }
    }

    // Report links functionality (for AJAX loading if needed)
    document.querySelectorAll('.report-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            // Remove default AJAX behavior - let normal navigation work
            // You can add AJAX functionality here if needed later
        });
    });
});

// Mobile sidebar functionality
function toggleSidebarHead() {
    const sidebar = document.getElementById('headSidebar');
    const overlay = document.getElementById('mobileOverlay');
    const hamburger = document.getElementById('mobileHamburger');
    
    if (sidebar && sidebar.classList.contains('active')) {
        closeSidebarHead();
    } else {
        openSidebarHead();
    }
}

function openSidebarHead() {
    const sidebar = document.getElementById('headSidebar');
    const overlay = document.getElementById('mobileOverlay');
    const hamburger = document.getElementById('mobileHamburger');
    
    if (sidebar) sidebar.classList.add('active');
    if (overlay) overlay.classList.add('active');
    if (hamburger) hamburger.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeSidebarHead() {
    const sidebar = document.getElementById('headSidebar');
    const overlay = document.getElementById('mobileOverlay');
    const hamburger = document.getElementById('mobileHamburger');
    
    if (sidebar) sidebar.classList.remove('active');
    if (overlay) overlay.classList.remove('active');
    if (hamburger) hamburger.classList.remove('active');
    document.body.style.overflow = '';
}

// Close sidebar when clicking outside on mobile
document.addEventListener('click', function(e) {
    const sidebar = document.getElementById('headSidebar');
    const hamburger = document.getElementById('mobileHamburger');
    
    if (window.innerWidth <= 768 && sidebar && sidebar.classList.contains('active')) {
        if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
            closeSidebarHead();
        }
    }
});

// Close sidebar when navigation links are clicked on mobile
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.sidebar .nav a');
    
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                closeSidebarHead();
            }
        });
    });
});
</script>
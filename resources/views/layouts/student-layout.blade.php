<style>
    body {
        margin: 0;
        padding: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f3f4f6;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
    }
    
    * {
        box-sizing: border-box;
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
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .header-title h1 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2563eb;
        letter-spacing: 0.5px;
        margin: 0;
        text-transform: uppercase;
    }

    /* Notifications */
    .notification-bell-container {
        position: relative;
        display: inline-flex;
        align-items: center;
        cursor: pointer;
    }

    .notification-bell {
        width: 28px;
        height: 28px;
        color: #374151;
        transition: color 0.2s;
    }

    .notification-bell:hover {
        color: #2563eb;
    }

    .notification-count {
        position: absolute;
        top: -6px;
        right: -6px;
        background: #ef4444;
        color: #fff;
        border-radius: 50%;
        padding: 2px 7px;
        font-size: 0.85rem;
        font-weight: 700;
        display: inline-block;
        z-index: 10;
        min-width: 20px;
        text-align: center;
    }

    .notification-dropdown {
        display: none;
        position: fixed;
        top: 70px;
        right: 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
        min-width: 380px;
        max-width: 420px;
        max-height: 500px;
        overflow-y: auto;
        z-index: 9999;
        padding: 16px;
        border: 1px solid #e5e7eb;
        animation: slideDown 0.2s ease-out;
    }
    
    .notification-dropdown.show {
        display: block;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .community-notification:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
    }

    /* Mobile Hamburger Menu */
    .mobile-hamburger {
        display: none;
        flex-direction: column;
        cursor: pointer;
        padding: 8px;
        z-index: 1001;
        position: relative;
        background: none;
        border: none;
        width: 40px;
        height: 40px;
        justify-content: center;
        align-items: center;
        border-radius: 6px;
        transition: background-color 0.2s ease;
    }

    .mobile-hamburger:hover {
        background-color: #f3f4f6;
    }

    .mobile-hamburger span {
        width: 24px;
        height: 2px;
        background-color: #2563eb;
        margin: 2px 0;
        transition: all 0.3s ease;
        border-radius: 2px;
        display: block;
        transform-origin: center;
    }

    .mobile-hamburger.active span:nth-child(1) {
        transform: rotate(45deg) translate(0, 6px);
    }

    .mobile-hamburger.active span:nth-child(2) {
        opacity: 0;
        transform: scale(0);
    }

    .mobile-hamburger.active span:nth-child(3) {
        transform: rotate(-45deg) translate(0, -6px);
    }

    /* Mobile Overlay */
    .mobile-sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        backdrop-filter: blur(2px);
    }

    .mobile-sidebar-overlay.active {
        opacity: 1;
        visibility: visible;
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

        .notification-dropdown {
            right: 10px !important;
            left: 10px !important;
            min-width: auto !important;
            max-width: calc(100vw - 20px) !important;
            top: 70px !important;
            z-index: 9999 !important;
        }

        .page-header {
            padding: 12px 16px !important;
            width: 100% !important;
            max-width: 100vw !important;
            box-sizing: border-box !important;
            margin: 0 !important;
        }

        .header-title h1 {
            font-size: 1.1rem !important;
            margin: 0 !important;
        }

        .notification-bell {
            width: 22px !important;
            height: 22px !important;
        }

        .notification-dropdown {
            right: -50px !important;
            min-width: 280px !important;
        }
    }

    /* Mobile specific improvements */
    @media (max-width: 480px) {
        .sidebar {
            width: 260px !important;
            left: -260px !important;
            bottom: 20px !important;
            height: calc(100vh - 40px) !important;
            height: calc(100dvh - 40px) !important;
        }
        
        .page-header {
            padding: 8px 12px !important;
        }
        
        .header-title h1 {
            font-size: 1rem !important;
        }
    }

    /* Ensure sidebar doesn't interfere with system UI */
    @media (max-width: 768px) and (display-mode: browser) {
        .sidebar {
            bottom: 10px !important;
            height: calc(100vh - 20px) !important;
        }
    }

    /* For phones with home indicator */
    @supports (bottom: env(safe-area-inset-bottom)) {
        @media (max-width: 768px) {
            .sidebar {
                height: calc(100vh - env(safe-area-inset-bottom, 0px) - 40px) !important;
                padding-bottom: 0 !important;
            }
            
            .sidebar .sidebar-bottom {
                margin-bottom: env(safe-area-inset-bottom, 10px) !important;
            }
        }
    }

    /* Fix for mobile browsers with dynamic viewport */
    @media (max-width: 768px) {
        .sidebar {
            height: calc(100vh - env(safe-area-inset-bottom, 0px) - 20px) !important;
            height: calc(var(--vh, 1vh) * 100 - env(safe-area-inset-bottom, 0px) - 20px) !important;
            min-height: calc(100vh - env(safe-area-inset-bottom, 0px) - 20px) !important;
            max-height: calc(100vh - env(safe-area-inset-bottom, 0px) - 20px) !important;
            overflow-y: auto !important;
            -webkit-overflow-scrolling: touch !important;
        }
        
        .sidebar .nav {
            flex: 1 !important;
            padding-bottom: 20px !important;
            min-height: 0 !important;
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
        
        .sidebar .profile {
            margin-bottom: 10px !important;
        }
    }

    @media (min-width: 769px) {
        .mobile-hamburger {
            display: none !important;
        }
        
        .mobile-sidebar-overlay {
            display: none !important;
            visibility: hidden !important;
        }
        
        .sidebar {
            position: relative !important;
            left: 0 !important;
            transform: none !important;
            transition: none !important;
        }
        
        .sidebar .sidebar-top {
            flex: 1;
        }
        
        .sidebar .sidebar-bottom {
            flex-shrink: 0;
        }
        
        body.sidebar-open {
            overflow: auto !important;
            position: static !important;
            width: auto !important;
        }
    }

    /* Smooth scrolling and performance improvements */
    .sidebar {
        -webkit-overflow-scrolling: touch;
        overscroll-behavior: contain;
    }
    
    /* Prevent text selection during sidebar animation */
    .sidebar.active * {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }


</style>

<!-- Mobile Sidebar Overlay -->
<div class="mobile-sidebar-overlay" id="mobileSidebarOverlay"></div>

<div class="dashboard-container" style="overflow-x:hidden;">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-top">
            <div class="logo">
                <img src="/images/assistracklogo.png" alt="Logo">
                <span>Assistrack Portal</span>
            </div>
            <nav class="nav">
                <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
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
                <a href="{{ route('student.community') }}" class="{{ request()->routeIs('student.community') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                            <circle cx="9" cy="10" r="1"/>
                            <circle cx="15" cy="10" r="1"/>
                        </svg>
                    </span>
                    Community
                </a>
                <a href="{{ route('student.calendar') }}" class="{{ request()->routeIs('student.calendar') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <line x1="9" y1="9" x2="15" y2="9"/>
                            <line x1="9" y1="15" x2="15" y2="15"/>
                        </svg>
                    </span>
                    Calendar
                </a>
                <a href="{{ route('student.grades') }}" class="{{ request()->routeIs('student.grades') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="8" r="6" />
                            <rect x="9" y="14" width="6" height="6" rx="2" />
                            <path d="M12 12v2" />
                        </svg>
                    </span>
                    Grades
                </a>
            </nav>
        </div>

        <div class="sidebar-bottom">
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

            <div id="logoutMenu">
                <a href="{{ route('profile.edit') }}">Settings</a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <section class="main-content w-full">
        
        <!-- Page Header -->
        <div class="page-header">
                <div class="header-title" style="display:flex;align-items:center;gap:12px;">
                    <!-- Mobile Hamburger Menu -->
                    <div class="mobile-hamburger" id="mobileHamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    @yield('page-icon')
                    <h1 style="font-size:1.5rem;font-weight:600;color:#2563eb;letter-spacing:0.5px;margin:0;text-transform:uppercase;">@yield('page-title', 'Student Portal')</h1>
                </div>
                
                <div style="display:flex;align-items:center;gap:16px;">
                    @yield('header-actions')
                    <!-- Notifications -->
                    <div class="notification-bell-container" id="notificationBellContainer">
                    <svg class="notification-bell" id="notificationBell" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    <span class="notification-count" id="notificationCount">0</span>
                </div>
                <div class="notification-dropdown" id="notificationDropdown">
                    <div id="notificationContent">Loading...</div>
                </div>
            </div>
        </div>
        
        @yield('content')
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fix for mobile viewport height (handles address bar and navigation bars on mobile browsers)
    function setViewportHeight() {
        // Use the smaller of window.innerHeight and window.screen.height to account for navigation bars
        const actualHeight = Math.min(window.innerHeight, window.screen.height * 0.9);
        let vh = actualHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
        
        // Also set a CSS variable for safe bottom margin
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
    
    // Notification functionality
    function updateNotificationCount() {
        // Fetch community join requests, task notifications, community notifications, and SA assignment notifications
        Promise.all([
            fetch('/community/join-requests').then(response => response.json()).catch(() => []),
            fetch('/student/task-notifications').then(response => response.json()).catch(() => []),
            fetch('/student/community-notifications').then(response => response.json()).catch(() => []),
            fetch('/student/sa-notifications').then(response => response.json()).catch(() => [])
        ])
        .then(([communityRequests, taskNotifications, communityNotifications, saNotifications]) => {
            console.log('Notification fetch results:', {
                communityRequests: communityRequests.length,
                taskNotifications: taskNotifications.length,
                communityNotifications: communityNotifications.length,
                saNotifications: saNotifications.length,
                saNotificationsData: saNotifications
            });
            
            // Count only unread community notifications and SA notifications
            const unreadCommunityNotifications = communityNotifications.filter(n => !n.read_at);
            const unreadSaNotifications = saNotifications.filter(n => !n.read_at);
            const totalCount = communityRequests.length + taskNotifications.length + unreadCommunityNotifications.length + unreadSaNotifications.length;
            const countSpan = document.getElementById('notificationCount');
            if (totalCount > 0) {
                countSpan.textContent = totalCount;
                countSpan.style.display = 'inline-block';
            } else {
                countSpan.textContent = '0';
                countSpan.style.display = 'inline-block';
            }
        })
        .catch(error => {
            console.error('Error fetching notifications:', error);
        });
    }

    // Mark notification as read
    window.markNotificationAsRead = function(notificationId) {
        fetch(`/notifications/${notificationId}/read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the notification visually
                const notificationEl = document.querySelector(`.community-notification[data-notification-id="${notificationId}"]`);
                if (notificationEl) {
                    // Remove unread styling
                    notificationEl.style.boxShadow = 'none';
                    notificationEl.style.border = 'none';
                    // Remove unread indicators
                    const unreadDot = notificationEl.querySelector('span[style*="background:#3b82f6"]');
                    const newLabel = notificationEl.querySelector('div[style*="color:#3b82f6"]');
                    if (unreadDot) unreadDot.remove();
                    if (newLabel) newLabel.remove();
                }
                // Update notification count
                updateNotificationCount();
            }
        })
        .catch(error => {
            console.error('Error marking notification as read:', error);
        });
    };

    // Update notification count on page load and every 30 seconds
    updateNotificationCount();
    setInterval(updateNotificationCount, 30000);
    
    // Make updateNotificationCount available globally for real-time updates
    window.updateNotificationCount = updateNotificationCount;

    // Notification dropdown functionality
    const notificationBellContainer = document.getElementById('notificationBellContainer');
    const notificationDropdown = document.getElementById('notificationDropdown');
    const notificationContent = document.getElementById('notificationContent');

    if (notificationBellContainer && notificationDropdown && notificationContent) {
        notificationBellContainer.addEventListener('click', function(e) {
            e.stopPropagation();
            updateNotificationCount();
            
            if (notificationDropdown.style.display === 'block') {
                notificationDropdown.style.display = 'none';
            } else {
                notificationDropdown.style.display = 'block';
                notificationContent.innerHTML = 'Loading...';
                
                // Fetch community requests, task notifications, community join notifications, and SA assignment notifications
                Promise.all([
                    fetch('/community/join-requests').then(response => response.json()).catch(() => []),
                    fetch('/student/task-notifications').then(response => response.json()).catch(() => []),
                    fetch('/student/community-notifications').then(response => response.json()).catch(() => []),
                    fetch('/student/sa-notifications').then(response => response.json()).catch(() => [])
                ])
                .then(([communityRequests, taskNotifications, communityNotifications, saNotifications]) => {
                    if (communityRequests.length === 0 && taskNotifications.length === 0 && communityNotifications.length === 0 && saNotifications.length === 0) {
                        notificationContent.innerHTML = '<div style="color:#374151;font-weight:500;">No notifications.</div>';
                    } else {
                        let notificationHTML = '';
                        
                        // Add task notifications first (highest priority)
                        if (taskNotifications.length > 0) {
                            notificationHTML += '<div style="font-weight:700;color:#2563eb;margin-bottom:12px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Task Notifications</div>';
                            taskNotifications.forEach(task => {
                                const statusColor = task.verified ? '#22c55e' : (task.status === 'rejected' ? '#ef4444' : '#f59e42');
                                const statusText = task.verified ? 'Verified ✓' : (task.status === 'rejected' ? 'Rejected ✗' : 'Pending');
                                const statusIcon = task.verified ? '✅' : (task.status === 'rejected' ? '❌' : '⏳');
                                
                                notificationHTML += `
                                    <div style="margin-bottom:12px;padding:12px;background:#f8fafc;border-radius:8px;border-left:4px solid ${statusColor};">
                                        <div style="font-weight:600;color:#111827;display:flex;align-items:center;gap:8px;">
                                            <span>${statusIcon}</span>
                                            <span>${task.title}</span>
                                        </div>
                                        <div style="color:#6b7280;font-size:0.9rem;margin-top:4px;">Status: <span style="color:${statusColor};font-weight:600;">${statusText}</span></div>
                                        ${task.status === 'rejected' ? '<div style="color:#ef4444;font-size:0.85rem;margin-top:4px;font-style:italic;">This task was rejected and cannot be started.</div>' : ''}
                                        ${task.verified && !task.started_date ? '<div style="color:#22c55e;font-size:0.85rem;margin-top:4px;font-style:italic;">Task verified! You can now start working on it.</div>' : ''}
                                    </div>
                                `;
                            });
                        }
                        
                        // Add community join request notifications
                        if (communityNotifications.length > 0) {
                            if (taskNotifications.length > 0) {
                                notificationHTML += '<div style="font-weight:700;color:#2563eb;margin:16px 0 12px 0;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Community Updates</div>';
                            } else {
                                notificationHTML += '<div style="font-weight:700;color:#2563eb;margin-bottom:12px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Community Updates</div>';
                            }
                            
                            communityNotifications.forEach(notification => {
                                const isAccepted = notification.type === 'join_request_accepted';
                                const statusColor = isAccepted ? '#22c55e' : '#ef4444';
                                const statusIcon = isAccepted ? '🎉' : '❌';
                                const bgColor = isAccepted ? '#f0fdf4' : '#fef2f2';
                                
                                const isUnread = !notification.read_at;
                                const unreadStyle = isUnread ? 'box-shadow: 0 2px 8px rgba(59, 130, 246, 0.15); border: 1px solid #dbeafe;' : '';
                                
                                notificationHTML += `
                                    <div class="community-notification" data-notification-id="${notification.id}" style="margin-bottom:12px;padding:12px;background:${bgColor};border-radius:8px;border-left:4px solid ${statusColor};cursor:pointer;transition:all 0.2s;${unreadStyle}" onclick="markNotificationAsRead('${notification.id}')">
                                        <div style="font-weight:600;color:#111827;display:flex;align-items:center;gap:8px;">
                                            <span>${statusIcon}</span>
                                            <span>${isAccepted ? 'Join Request Accepted!' : 'Join Request Rejected'}</span>
                                            ${isUnread ? '<span style="background:#3b82f6;color:#fff;border-radius:50%;width:8px;height:8px;display:inline-block;margin-left:auto;"></span>' : ''}
                                        </div>
                                        <div style="color:#6b7280;font-size:0.9rem;margin-top:4px;">${notification.message}</div>
                                        <div style="color:#9ca3af;font-size:0.8rem;margin-top:4px;">${new Date(notification.created_at).toLocaleDateString()} ${new Date(notification.created_at).toLocaleTimeString()}</div>
                                        ${isUnread ? '<div style="color:#3b82f6;font-size:0.8rem;margin-top:4px;font-weight:600;">• New</div>' : ''}
                                    </div>
                                `;
                            });
                        }
                        
                        // Add SA assignment notifications
                        if (saNotifications.length > 0) {
                            if (taskNotifications.length > 0 || communityNotifications.length > 0) {
                                notificationHTML += '<div style="font-weight:700;color:#2563eb;margin:16px 0 12px 0;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">SA Assignments</div>';
                            } else {
                                notificationHTML += '<div style="font-weight:700;color:#2563eb;margin-bottom:12px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">SA Assignments</div>';
                            }
                            
                            saNotifications.forEach(notification => {
                                const isUnread = !notification.read_at;
                                const unreadStyle = isUnread ? 'box-shadow: 0 2px 8px rgba(59, 130, 246, 0.15); border: 1px solid #dbeafe;' : '';
                                
                                notificationHTML += `
                                    <div class="community-notification" data-notification-id="${notification.id}" style="margin-bottom:12px;padding:12px;background:#f0fdf4;border-radius:8px;border-left:4px solid #22c55e;cursor:pointer;transition:all 0.2s;${unreadStyle}" onclick="markNotificationAsRead('${notification.id}')">
                                        <div style="font-weight:600;color:#111827;display:flex;align-items:center;gap:8px;">
                                            <span>🎉</span>
                                            <span>Assigned as Student Assistant!</span>
                                            ${isUnread ? '<span style="background:#3b82f6;color:#fff;border-radius:50%;width:8px;height:8px;display:inline-block;margin-left:auto;"></span>' : ''}
                                        </div>
                                        <div style="color:#6b7280;font-size:0.9rem;margin-top:4px;"><strong>Office:</strong> ${notification.office}</div>
                                        <div style="color:#6b7280;font-size:0.85rem;margin-top:2px;">${notification.message}</div>
                                        <div style="color:#9ca3af;font-size:0.8rem;margin-top:4px;">${new Date(notification.created_at).toLocaleDateString()} ${new Date(notification.created_at).toLocaleTimeString()}</div>
                                        ${isUnread ? '<div style="color:#3b82f6;font-size:0.8rem;margin-top:4px;font-weight:600;">• New</div>' : ''}
                                    </div>
                                `;
                            });
                        }
                        
                        // Add community requests (for group owners)
                        if (communityRequests.length > 0) {
                            if (taskNotifications.length > 0 || communityNotifications.length > 0 || saNotifications.length > 0) {
                                notificationHTML += '<div style="font-weight:700;color:#2563eb;margin:16px 0 12px 0;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Pending Requests</div>';
                            } else {
                                notificationHTML += '<div style="font-weight:700;color:#2563eb;margin-bottom:12px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Pending Requests</div>';
                            }
                            notificationHTML += communityRequests.map(req => `
                                <div style="margin-bottom:12px;padding-bottom:12px;border-bottom:1px solid #e5e7eb;">
                                    <div style="font-weight:600;color:#2563eb;">${req.user.name} (@${req.user.username})</div>
                                    <div style="color:#374151;font-size:0.95rem;">wants to join your group.</div>
                                    <div style="margin-top:8px;display:flex;gap:8px;">
                                        <button class="accept-btn" data-request-id="${req.id}" data-user-id="${req.user.id}" style="background:#22c55e;color:#fff;border:none;border-radius:6px;padding:6px 16px;font-weight:600;cursor:pointer;">Accept</button>
                                        <button class="reject-btn" data-request-id="${req.id}" style="background:#ef4444;color:#fff;border:none;border-radius:6px;padding:6px 16px;font-weight:600;cursor:pointer;">Reject</button>
                                    </div>
                                </div>
                            `).join('');
                        }
                        
                        notificationContent.innerHTML = notificationHTML;
                            
                            // Add event listeners for accept/reject buttons
                            setTimeout(() => {
                                document.querySelectorAll('.accept-btn').forEach(function(btn) {
                                    btn.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        var reqId = btn.getAttribute('data-request-id');
                                        var userId = btn.getAttribute('data-user-id');
                                        
                                        fetch(`/community/join-request/${reqId}/action`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                'X-Requested-With': 'XMLHttpRequest'
                                            },
                                            body: JSON.stringify({ action: 'accept' })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                btn.closest('div').parentElement.innerHTML = '<span style="color:#22c55e;font-weight:600;">Accepted</span>';
                                                updateNotificationCount();
                                                setTimeout(() => {
                                                    notificationDropdown.style.display = 'none';
                                                }, 1000);
                                            }
                                        })
                                        .catch(error => console.error('Error:', error));
                                    });
                                });

                                document.querySelectorAll('.reject-btn').forEach(function(btn) {
                                    btn.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        var reqId = btn.getAttribute('data-request-id');
                                        
                                        fetch(`/community/join-request/${reqId}/action`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                'X-Requested-With': 'XMLHttpRequest'
                                            },
                                            body: JSON.stringify({ action: 'reject' })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                btn.closest('div').parentElement.innerHTML = '<span style="color:#ef4444;font-weight:600;">Rejected</span>';
                                                updateNotificationCount();
                                                setTimeout(() => {
                                                    notificationDropdown.style.display = 'none';
                                                }, 1000);
                                            }
                                        })
                                        .catch(error => console.error('Error:', error));
                                    });
                                });
                            }, 100);
                        }
                    })
                    .catch(error => {
                        notificationContent.innerHTML = '<div style="color:#ef4444;">Error loading notifications.</div>';
                        console.error('Error:', error);
                    });
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!notificationBellContainer.contains(event.target) && !notificationDropdown.contains(event.target)) {
                notificationDropdown.style.display = 'none';
            }
        });
    }

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
    
    // Mobile sidebar functionality
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
});
</script>
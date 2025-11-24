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
        position: absolute;
        top: 100%;
        right: 0;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        min-width: 380px;
        max-width: 420px;
        max-height: 500px;
        overflow-y: auto;
        z-index: 100;
        padding: 16px;
        border: 1px solid #e5e7eb;
        margin-top: 8px;
    }

    .community-notification:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
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

        .notification-dropdown {
            right: -100px;
            min-width: 280px;
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
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-title" style="display:flex;align-items:center;gap:16px;">
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
    // Notification functionality
    function updateNotificationCount() {
        // Fetch community join requests, task notifications, and community notifications
        Promise.all([
            fetch('/community/join-requests').then(response => response.json()).catch(() => []),
            fetch('/student/task-notifications').then(response => response.json()).catch(() => []),
            fetch('/student/community-notifications').then(response => response.json()).catch(() => [])
        ])
        .then(([communityRequests, taskNotifications, communityNotifications]) => {
            console.log('Notification fetch results:', {
                communityRequests: communityRequests.length,
                taskNotifications: taskNotifications.length,
                communityNotifications: communityNotifications.length,
                communityNotificationsData: communityNotifications
            });
            
            // Count only unread community notifications
            const unreadCommunityNotifications = communityNotifications.filter(n => !n.read_at);
            const totalCount = communityRequests.length + taskNotifications.length + unreadCommunityNotifications.length;
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
                
                // Fetch community requests, task notifications, and community join notifications
                Promise.all([
                    fetch('/community/join-requests').then(response => response.json()).catch(() => []),
                    fetch('/student/task-notifications').then(response => response.json()).catch(() => []),
                    fetch('/student/community-notifications').then(response => response.json()).catch(() => [])
                ])
                .then(([communityRequests, taskNotifications, communityNotifications]) => {
                    if (communityRequests.length === 0 && taskNotifications.length === 0 && communityNotifications.length === 0) {
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
                        
                        // Add community requests (for group owners)
                        if (communityRequests.length > 0) {
                            if (taskNotifications.length > 0 || communityNotifications.length > 0) {
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
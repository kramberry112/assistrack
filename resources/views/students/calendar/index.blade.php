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

        /* Main Content Area */
        .main-content {
            flex: 1;
            background: #f3f4f6;
            padding: 0;
            min-height: 100vh;
        }

        /* Header (copied from community page) */
        .community-header {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 20px 0;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .community-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2563eb;
            letter-spacing: 0.5px;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .notification-bell {
            width: 24px;
            height: 24px;
            color: #6b7280;
            cursor: pointer;
        }

        /* Calendar Styles */
        .calendar-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 32px;
            border-bottom: 1px solid #e5e7eb;
            background: white;
        }

        .calendar-nav {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-button {
            width: 36px;
            height: 36px;
            border: none;
            background: #f3f4f6;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .nav-button:hover {
            background: #e5e7eb;
        }

        .current-month {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin: 0 20px;
        }

        .view-toggles {
            display: flex;
            gap: 8px;
        }

        .view-toggle {
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            background: white;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .view-toggle.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .view-toggle:hover:not(.active) {
            background: #f9fafb;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
        }

        .calendar-header-cell {
            padding: 16px 8px;
            text-align: center;
            font-weight: 600;
            font-size: 0.875rem;
            color: #374151;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .calendar-cell {
            min-height: 120px;
            border-bottom: 1px solid #e5e7eb;
            border-right: 1px solid #e5e7eb;
            padding: 12px 8px;
            position: relative;
            background: white;
            transition: background 0.2s;
        }

        .calendar-cell:hover {
            background: #f9fafb;
        }

        .calendar-cell:nth-child(7n) {
            border-right: none;
        }

        .calendar-date {
            font-size: 0.875rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .calendar-cell.other-month .calendar-date {
            color: #9ca3af;
        }

        .calendar-cell.today {
            background: #fef3c7;
        }

        .calendar-cell.today .calendar-date {
            color: #d97706;
            background: #fbbf24;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        .calendar-events {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .calendar-event {
            font-size: 0.75rem;
            padding: 2px 6px;
            border-radius: 3px;
            background: #dbeafe;
            color: #1e40af;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .calendar-event.event-red {
            background: #fee2e2;
            color: #dc2626;
        }

        .calendar-event.event-green {
            background: #dcfce7;
            color: #16a34a;
        }

        .calendar-event.event-purple {
            background: #f3e8ff;
            color: #9333ea;
        }
        /* Week view styles */
        .week-view {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 16px 24px;
            margin-top: 24px;
        }
        .week-row {
            border: 2px solid #222;
            border-radius: 4px;
            margin-bottom: 8px;
            background: #fff;
            min-height: 80px;
            display: flex;
            align-items: flex-start;
        }
        .week-day {
            font-size: 1.1rem;
            font-weight: 500;
            color: #222;
            padding: 12px;
            flex: 1;
        }
    </style>

<body>
    <div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div>
            <div class="logo">
                <img src="/images/assistracklogo.png" alt="Logo">
                <span>Assistrack Portal</span>
            </div>
                <nav class="nav">
                    <a href="{{ route('student.dashboard') }}">
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
                    <a href="{{ route('student.community') }}">
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
                    <a href="{{ route('student.calendar') }}" class="active">
                        <span class="icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <line x1="9" y1="9" x2="15" y2="9"/>
                                <line x1="9" y1="15" x2="15" y2="15"/>
                            </svg>
                        </span>
                        Calendar
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
                <div style="margin-left:auto; display:flex; flex-direction:column; gap:4px; align-items:center; justify-content:center; height:60px;">
                    <svg id="logoutUp" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 15 12 9 18 15"></polyline>
                    </svg>
                    <svg id="logoutDown" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </div>

            <div id="logoutMenu">
                <a href="#settings">Settings</a>
                <button type="button">Logout</button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <div class="community-header">
                <div class="header-content">
                    <h1 class="community-title">CALENDAR</h1>
                    <div class="user-section">
                        <div id="notificationBellContainer" style="position:relative;display:inline-block;cursor:pointer;">
                            <svg class="notification-bell" id="notificationBell" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                            </svg>
                            <span id="notificationCount" style="position:absolute;top:-6px;right:-6px;background:#ef4444;color:#fff;border-radius:50%;padding:2px 7px;font-size:0.85rem;font-weight:700;display:inline-block;z-index:10;">0</span>
                        </div>
                        <div id="notificationDropdown" style="display:none;position:absolute;top:36px;right:0;background:#fff;border-radius:12px;box-shadow:0 4px 16px rgba(0,0,0,0.12);min-width:320px;z-index:100;padding:16px;">
                        <div id="notificationContent">Loading...</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="calendar-container">
                <div class="calendar-header">
                    <div class="calendar-nav">
                        <button class="nav-button" id="prevMonth">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </button>
                        <button class="nav-button" id="nextMonth">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                        <h2 class="current-month" id="currentMonth">January 2024</h2>
                    </div>
                    <div class="view-toggles">
                        <button class="view-toggle" id="weekToggle">Week</button>
                        <button class="view-toggle active" id="monthToggle">Month</button>
                    </div>
                </div>

                <div class="calendar-grid" id="calendarGrid">
                    <!-- Month view will be rendered here by JS -->
                </div>
                <div class="week-view" id="weekView" style="display:none;">
                    <!-- Week view will be rendered by JS -->
                </div>
            </div>
        </main>
    </div>

    <script>
        // Profile dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const profileDropdown = document.getElementById('profileDropdown');
            const logoutMenu = document.getElementById('logoutMenu');
            const logoutUp = document.getElementById('logoutUp');
            const logoutDown = document.getElementById('logoutDown');

            logoutDown.style.display = 'none';
            logoutUp.style.display = 'block';

            profileDropdown.addEventListener('click', function() {
                if (logoutMenu.style.display === 'block') {
                    logoutMenu.style.display = 'none';
                    logoutUp.style.display = 'block';
                    logoutDown.style.display = 'none';
                } else {
                    logoutMenu.style.display = 'block';
                    logoutUp.style.display = 'none';
                    logoutDown.style.display = 'block';
                }
            });

            document.addEventListener('click', function(event) {
                if (!profileDropdown.contains(event.target) && !logoutMenu.contains(event.target)) {
                    logoutMenu.style.display = 'none';
                    logoutUp.style.display = 'block';
                    logoutDown.style.display = 'none';
                }
            });
        });

        // Calendar functionality
        // Notification logic (copied from community)
        function updateNotificationCount() {
            fetch('/community/join-requests')
                .then(response => response.json())
                .then(data => {
                    const countSpan = document.getElementById('notificationCount');
                    if (data.length > 0) {
                        countSpan.textContent = data.length;
                        countSpan.style.display = 'inline-block';
                    } else {
                        countSpan.textContent = '0';
                        countSpan.style.display = 'inline-block';
                    }
                });
        }
        updateNotificationCount();
        setInterval(updateNotificationCount, 30000);
        const notificationBell = document.getElementById('notificationBell');
        const notificationBellContainer = document.getElementById('notificationBellContainer');
        const notificationDropdown = document.getElementById('notificationDropdown');
        const notificationContent = document.getElementById('notificationContent');
        notificationBellContainer.addEventListener('click', function(e) {
        updateNotificationCount();
        e.stopPropagation();
        if (notificationDropdown.style.display === 'block') {
            notificationDropdown.style.display = 'none';
        } else {
            notificationDropdown.style.display = 'block';
            fetch('/community/join-requests')
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        notificationContent.innerHTML = '<div style="color:#374151;font-weight:500;">No notifications.</div>';
                    } else {
                        notificationContent.innerHTML = data.map(req => `
                            <div style="margin-bottom:12px;padding-bottom:12px;border-bottom:1px solid #e5e7eb;">
                                <div style="font-weight:600;color:#2563eb;">${req.user.name} (@${req.user.username})</div>
                                <div style="color:#374151;font-size:0.95rem;">wants to join your group.</div>
                                <div style="margin-top:8px;display:flex;gap:8px;">
                                    <button class="accept-btn" data-request-id="${req.id}" data-user-id="${req.user.id}" style="background:#22c55e;color:#fff;border:none;border-radius:6px;padding:6px 16px;font-weight:600;">Accept</button>
                                    <button class="reject-btn" data-request-id="${req.id}" style="background:#ef4444;color:#fff;border:none;border-radius:6px;padding:6px 16px;font-weight:600;">Reject</button>
                                </div>
                            </div>
                        `).join('');
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
                                            location.reload();
                                        }
                                    });
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
                                        }
                                    });
                                });
                            });
                        }, 100);
                    }
                });
        }
    });
    document.addEventListener('click', function(event) {
        if (!notificationBell.contains(event.target) && !notificationDropdown.contains(event.target)) {
            notificationDropdown.style.display = 'none';
        }
    });
        // Calendar functionality with week/month toggle
        class Calendar {
            constructor() {
                this.currentDate = new Date();
                this.currentMonth = this.currentDate.getMonth();
                this.currentYear = this.currentDate.getFullYear();
                this.today = new Date();
                this.view = 'month';
                this.months = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];
                this.events = {};
                this.init();
                this.fetchTasks();
            }
            fetchTasks() {
                fetch('/student-tasks/month?year=' + this.currentYear + '&month=' + (this.currentMonth + 1))
                    .then(response => response.json())
                    .then(data => {
                        this.events = {};
                        data.forEach(task => {
                            const key = task.due_date;
                            if (!this.events[key]) this.events[key] = [];
                            this.events[key].push({
                                title: task.title + ' [' + task.priority.charAt(0).toUpperCase() + task.priority.slice(1) + ']',
                                type: this.getPriorityClass(task.priority)
                            });
                        });
                        this.render();
                    });
            }
            getPriorityClass(priority) {
                if (priority === 'critical') return 'event-red';
                if (priority === 'medium') return 'event-green';
                if (priority === 'not_urgent') return 'event-purple';
                return 'event-blue';
            }
            init() {
                this.render();
                this.bindEvents();
            }
            bindEvents() {
                document.getElementById('prevMonth').addEventListener('click', () => {
                    this.currentMonth--;
                    if (this.currentMonth < 0) {
                        this.currentMonth = 11;
                        this.currentYear--;
                    }
                    this.fetchTasks();
                });
                document.getElementById('nextMonth').addEventListener('click', () => {
                    this.currentMonth++;
                    if (this.currentMonth > 11) {
                        this.currentMonth = 0;
                        this.currentYear++;
                    }
                    this.fetchTasks();
                });
                document.getElementById('weekToggle').addEventListener('click', () => {
                    this.view = 'week';
                    document.getElementById('weekToggle').classList.add('active');
                    document.getElementById('monthToggle').classList.remove('active');
                    this.render();
                });
                document.getElementById('monthToggle').addEventListener('click', () => {
                    this.view = 'month';
                    document.getElementById('monthToggle').classList.add('active');
                    document.getElementById('weekToggle').classList.remove('active');
                    this.render();
                });
            }
            render() {
                const monthYear = `${this.months[this.currentMonth]} ${this.currentYear}`;
                document.getElementById('currentMonth').textContent = monthYear;
                if (this.view === 'month') {
                    document.getElementById('calendarGrid').style.display = '';
                    document.getElementById('weekView').style.display = 'none';
                    this.renderMonth();
                } else {
                    document.getElementById('calendarGrid').style.display = 'none';
                    document.getElementById('weekView').style.display = '';
                    this.renderWeek();
                }
            }
            renderMonth() {
                const firstDay = new Date(this.currentYear, this.currentMonth, 1);
                const startDate = new Date(firstDay);
                startDate.setDate(startDate.getDate() - firstDay.getDay());
                const calendarGrid = document.getElementById('calendarGrid');
                // Remove all children
                calendarGrid.innerHTML = '';
                // Header row
                const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                for (let d = 0; d < 7; d++) {
                    const header = document.createElement('div');
                    header.className = 'calendar-header-cell';
                    header.textContent = days[d];
                    calendarGrid.appendChild(header);
                }
                // Generate 6 weeks of calendar cells
                for (let week = 0; week < 6; week++) {
                    for (let day = 0; day < 7; day++) {
                        const cellDate = new Date(startDate);
                        cellDate.setDate(startDate.getDate() + (week * 7) + day);
                        const cell = this.createCalendarCell(cellDate);
                        calendarGrid.appendChild(cell);
                    }
                }
            }
            async renderWeek() {
                const weekView = document.getElementById('weekView');
                weekView.innerHTML = '';
                // Find the current week (Monday-Sunday)
                const today = new Date(this.currentYear, this.currentMonth, this.currentDate.getDate());
                let weekStart = new Date(today);
                // Set to Monday
                weekStart.setDate(today.getDate() - ((today.getDay() + 6) % 7));
                let weekEnd = new Date(weekStart);
                weekEnd.setDate(weekStart.getDate() + 6);
                const startStr = `${weekStart.getFullYear()}-${weekStart.getMonth() + 1}-${weekStart.getDate()}`;
                const endStr = `${weekEnd.getFullYear()}-${weekEnd.getMonth() + 1}-${weekEnd.getDate()}`;
                // Fetch week tasks
                let weekTasks = {};
                await fetch(`/student-tasks/week?start=${startStr}&end=${endStr}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(task => {
                            if (!weekTasks[task.due_date]) weekTasks[task.due_date] = [];
                            weekTasks[task.due_date].push({
                                title: task.title + ' [' + task.priority.charAt(0).toUpperCase() + task.priority.slice(1) + ']',
                                type: this.getPriorityClass(task.priority)
                            });
                        });
                    });
                const days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
                for (let i = 0; i < 7; i++) {
                    const row = document.createElement('div');
                    row.className = 'week-row';
                    const dayCell = document.createElement('div');
                    dayCell.className = 'week-day';
                    dayCell.textContent = days[i];
                    // Date for this day
                    let d = new Date(weekStart);
                    d.setDate(weekStart.getDate() + i);
                    const eventKey = `${d.getFullYear()}-${d.getMonth() + 1}-${d.getDate()}`;
                    if (weekTasks[eventKey]) {
                        const eventsDiv = document.createElement('div');
                        eventsDiv.className = 'calendar-events';
                        weekTasks[eventKey].forEach(event => {
                            const eventDiv = document.createElement('div');
                            eventDiv.className = `calendar-event ${event.type}`;
                            eventDiv.textContent = event.title;
                            eventsDiv.appendChild(eventDiv);
                        });
                        dayCell.appendChild(eventsDiv);
                    }
                    row.appendChild(dayCell);
                    weekView.appendChild(row);
                }
            }
            createCalendarCell(date) {
                const cell = document.createElement('div');
                cell.className = 'calendar-cell';
                const isCurrentMonth = date.getMonth() === this.currentMonth;
                const isToday = date.toDateString() === this.today.toDateString();
                if (!isCurrentMonth) {
                    cell.classList.add('other-month');
                }
                if (isToday) {
                    cell.classList.add('today');
                }
                const dateDiv = document.createElement('div');
                dateDiv.className = 'calendar-date';
                dateDiv.textContent = date.getDate().toString().padStart(2, '0');
                cell.appendChild(dateDiv);
                // Add events if any
                const eventKey = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
                if (this.events[eventKey]) {
                    const eventsDiv = document.createElement('div');
                    eventsDiv.className = 'calendar-events';
                    this.events[eventKey].forEach(event => {
                        const eventDiv = document.createElement('div');
                        eventDiv.className = `calendar-event ${event.type}`;
                        eventDiv.textContent = event.title;
                        eventsDiv.appendChild(eventDiv);
                    });
                    cell.appendChild(eventsDiv);
                }
                return cell;
            }
        }
        // Initialize calendar when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            new Calendar();
        });
    </script>
@endsection


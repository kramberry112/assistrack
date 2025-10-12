@extends('layouts.app')

@section('content')
<style>
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
        flex: 1;
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
    .main-content {
        flex: 1;
        background: #f9fafb;
        display: flex;
        flex-direction: column;
        padding: 20px;
    }
    
     /* Tasks Request Styles */
    .tasks-header {
        background: #ffffff;
        padding: 20px 30px;
        border-bottom: 2px solid #6366f1;
        margin: -20px -20px 20px -20px;
    }
    .tasks-header h1 {
        color: #6366f1;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }
    .tasks-controls {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        align-items: center;
    }
    .search-box {
        flex: 1;
        position: relative;
    }
    .search-box input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.95rem;
    }
    .search-box svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }
    .filter-dropdown {
        padding: 10px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.95rem;
        background: white;
        min-width: 200px;
    }
    .tasks-table {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .tasks-table table {
        width: 100%;
        border-collapse: collapse;
    }
    .tasks-table thead {
        background: #fce4ec;
    }
    .tasks-table th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
        color: #111827;
        font-size: 0.9rem;
        border-bottom: 1px solid #f3f4f6;
    }
    .tasks-table td {
        padding: 15px;
        color: #374151;
        font-size: 0.9rem;
        border-bottom: 1px solid #f3f4f6;
    }
    .tasks-table tbody tr:hover {
        background: #f9fafb;
    }
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }
    .status-completed {
        background: #d1fae5;
        color: #065f46;
    }
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    .btn-verify {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        background: #10b981;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-verify:hover {
        background: #059669;
    }
    .btn-reject {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-reject:hover {
        background: #dc2626;
    }
    .btn-view {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-view:hover {
        background: #2563eb;
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
                <a href="{{ route('offices.dashboard') }}">
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
                <a href="{{ route('offices.studentlists.index') }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="7" r="4" />
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        </svg>
                    </span>
                    Student List
                </a>
                <a href="{{ route('attendance.index') }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 11l3 3L22 4"/>
                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                        </svg>
                    </span>
                    Attendance
                </a>
                <a href="{{ route('tasks.index') }}" class="active">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"/>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                            <path d="M9 14l2 2 4-4"/>
                        </svg>
                    </span>
                    Tasks
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
    <main class="main-content">
        <div class="tasks-header">
            <h1>TASKS REQUEST</h1>
        </div>

        <div class="tasks-controls">
            <div class="search-box">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <input type="text" placeholder="Search Student" id="searchInput">
            </div>
            <select class="filter-dropdown" id="filterDropdown">
                <option value="">Filter by Type or Status</option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <div class="tasks-table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Task</th>
                        <th>Level of Priority</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tasks-tbody">
                    @foreach($tasks as $i => $task)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $task->user->name ?? 'Unknown' }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $task->priority)) }}</td>
                            <td>{{ \Carbon\Carbon::parse($task->due_date)->format('F d, Y') }}</td>
                            <td>
                                @if($task->status === 'rejected')
                                    <span class="status-badge" style="background:#fee2e2;color:#b91c1c;">Rejected</span>
                                @elseif($task->verified)
                                    <span class="status-badge status-completed">Verified</span>
                                @else
                                    <span class="status-badge status-pending">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if($task->status === 'rejected')
                                    <button class="btn-view" disabled style="background:#fee2e2;color:#b91c1c;cursor:not-allowed;">Rejected</button>
                                @elseif(!$task->verified)
                                    <button type="button" class="btn-verify" data-task-id="{{ $task->id }}">Verify</button>
                                    <button type="button" class="btn-reject" data-task-id="{{ $task->id }}">Reject</button>
                                @else
                                    <button class="btn-view" disabled>Verified</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    // Profile dropdown toggle
    const profileDropdown = document.getElementById('profileDropdown');
    const logoutMenu = document.getElementById('logoutMenu');
    const logoutUp = document.getElementById('logoutUp');
    const logoutDown = document.getElementById('logoutDown');

    logoutUp.addEventListener('click', (e) => {
        e.stopPropagation();
        logoutMenu.style.display = 'block';
    });

    logoutDown.addEventListener('click', (e) => {
        e.stopPropagation();
        logoutMenu.style.display = 'none';
    });

    document.addEventListener('click', (e) => {
        if (!profileDropdown.contains(e.target)) {
            logoutMenu.style.display = 'none';
        }
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.tasks-table tbody tr');
        
        rows.forEach(row => {
            const studentName = row.cells[1].textContent.toLowerCase();
            if (studentName.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Filter functionality
    const filterDropdown = document.getElementById('filterDropdown');
    filterDropdown.addEventListener('change', (e) => {
        const filterValue = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.tasks-table tbody tr');
        rows.forEach(row => {
            if (filterValue === '') {
                row.style.display = '';
            } else {
                const status = row.cells[4].textContent.toLowerCase();
                if (status.includes(filterValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    });

    // AJAX verification for tasks
    function attachVerifyHandlers() {
        document.querySelectorAll('.btn-verify').forEach(btn => {
            btn.onclick = function() {
                const taskId = this.getAttribute('data-task-id');
                fetch(`/tasks/${taskId}/verify`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    if (!response.ok) throw new Error('Verification failed');
                    return response.json();
                })
                .then(data => {
                    // Force refresh to avoid duplicate and update UI instantly
                    fetchTasks();
                    // Emit custom event for cross-tab/dashboard update
                    window.dispatchEvent(new CustomEvent('task-verified', { detail: { taskId } }));
                })
                .catch(() => {
                    alert('Failed to verify task.');
                });
            };
        });
    }

    // AJAX polling for new tasks
    function fetchTasks() {
        fetch('/tasks/ajax')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('tasks-tbody');
                tbody.innerHTML = '';
                data.forEach((task, i) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${i + 1}</td>
                        <td>${task.user_name ?? 'Unknown'}</td>
                        <td>${task.title}</td>
                        <td>${task.priority ? (task.priority.charAt(0).toUpperCase() + task.priority.slice(1).replace('_', ' ')) : ''}</td>
                        <td>${task.due_date_formatted}</td>
                        <td>
                            ${task.status === 'rejected' ? '<span class="status-badge" style="background:#fee2e2;color:#b91c1c;">Rejected</span>' : (task.verified ? '<span class="status-badge status-completed">Verified</span>' : '<span class="status-badge status-pending">Pending</span>')}
                        </td>
                        <td>
                            ${task.status === 'rejected'
                                ? `<button class='btn-view' disabled style='background:#fee2e2;color:#b91c1c;cursor:not-allowed;'>Rejected</button>`
                                : (!task.verified
                                    ? `<button type='button' class='btn-verify' data-task-id='${task.id}'>Verify</button> <button type='button' class='btn-reject' data-task-id='${task.id}'>Reject</button>`
                                    : `<button class='btn-view' disabled style='background:#93c5fd;color:#fff;cursor:not-allowed;'>Verified</button>`)}
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
                attachVerifyHandlers();
                attachRejectHandlers();
            });
    }

    // AJAX handler for Reject button (to be implemented in backend)
    function attachRejectHandlers() {
        document.querySelectorAll('.btn-reject').forEach(btn => {
            btn.onclick = function() {
                const taskId = this.getAttribute('data-task-id');
                const row = this.closest('tr');
                fetch(`/tasks/${taskId}/reject`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    if (!response.ok) throw new Error('Rejection failed');
                    return response.json();
                })
                .then(data => {
                    // Instantly update row status and button
                    if (data.success) {
                        row.querySelector('td:nth-child(6)').innerHTML = `<span class="status-badge" style="background:#fee2e2;color:#b91c1c;">Rejected</span>`;
                        row.querySelector('td:nth-child(7)').innerHTML = `<button class='btn-view' disabled style='background:#fee2e2;color:#b91c1c;cursor:not-allowed;'>Rejected</button>`;
                    } else {
                        alert('Failed to reject task.');
                    }
                })
                .catch(() => {
                    alert('Failed to reject task.');
                });
            };
        });
    }

    setInterval(fetchTasks, 5000); // Poll every 5 seconds
    window.addEventListener('DOMContentLoaded', function() {
        attachVerifyHandlers();
        attachRejectHandlers();
    });

    // Listen for custom event when a new task is created via AJAX
    window.addEventListener('student-task-created', function() {
        fetchTasks();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/pusher-js@7.2.2/dist/web/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.0/dist/echo.iife.js"></script>
<script src="/js/echo-office.js"></script>

@endsection
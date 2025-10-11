@extends('layouts.app')

@section('content')
<script>
window.currentUserId = {{ auth()->id() }};
</script>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f3f4f6;
    }
    .highlight {
        background: #fff59d;
        color: #d97706;
        padding: 0 2px;
        border-radius: 4px;
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

    /* Fixed Header */
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
        font-size: 2rem;
        font-weight: 700;
        color: #2d2e83;
        margin: 0;
        letter-spacing: 0.03em;
    }

    .header-stats {
        display: flex;
        gap: 32px;
        align-items: center;
    }

    .stat-item {
        text-align: center;
    }

    .stat-item .label {
        font-size: 1rem;
        color: #6b7280;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .stat-item .value {
        font-size: 1.5rem;
        font-weight: 700;
    }

    .stat-item .value.todo {
        color: #ef4444;
    }

    .stat-item .value.in-progress {
        color: #f59e42;
    }

    .stat-item .value.completed {
        color: #22c55e;
    }

    /* Content Area */
    .content-area {
        flex: 1;
        padding: 24px 32px;
    }

    .controls-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        background: #fff;
        padding: 20px 24px;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }

    .search-input {
        width: 280px;
        padding: 10px 16px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        font-size: 1rem;
        background: #f9fafb;
    }

    .controls-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .filter-btn, .create-btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        border: none;
        transition: all 0.2s;
    }

    .filter-btn {
        background: #f3f4f6;
        color: #374151;
    }

    .filter-btn:hover {
        background: #e5e7eb;
    }

    .create-btn {
        background: #2d2e83;
        color: #fff;
        box-shadow: 0 2px 8px rgba(45,46,131,0.15);
    }

    .create-btn:hover {
        background: #1e1f5a;
        box-shadow: 0 4px 16px rgba(45,46,131,0.25);
    }

    /* Tabs */
    .tabs-section {
        display: flex;
        align-items: center;
        gap: 32px;
        margin-bottom: 24px;
        padding: 0 4px;
    }

    .tab {
        font-weight: 600;
        color: #6b7280;
        cursor: pointer;
        padding: 12px 4px;
        border-bottom: 3px solid transparent;
        transition: all 0.2s;
        font-size: 1rem;
    }

    .tab:hover {
        color: #374151;
    }

    .tab.active {
        color: #2d2e83;
        border-bottom: 3px solid #7c83e7;
    }

    /* Tasks Container */
    .tasks-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    /* Create Task Modal - unchanged */
    #createTaskModal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0,0,0,0.18);
        z-index: 999;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: #fff;
        padding: 40px 36px;
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        width: 480px;
        max-width: 98vw;
    }

    .modal-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #2d2e83;
        margin-bottom: 24px;
        text-align: center;
        letter-spacing: 0.02em;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
        font-size: 1.1rem;
        display: block;
        margin-bottom: 6px;
    }

    .form-input, .form-textarea {
        width: 100%;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: #7c83e7;
    }

    .form-textarea {
        resize: vertical;
        overflow: auto;
    }

    .priority-dropdown {
        width: 100%;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        cursor: pointer;
        background: #fff;
        position: relative;
        font-size: 1rem;
    }

    .priority-options {
        display: none;
        position: absolute;
        top: 54px;
        left: 0;
        width: 100%;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        z-index: 10;
    }

    .priority-option {
        padding: 12px 16px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.2s;
    }

    .priority-option:hover {
        background: #f3f4f6;
    }

    .priority-option[data-value="critical"] {
        color: #ef4444;
    }

    .priority-option[data-value="medium"] {
        color: #f59e42;
    }

    .priority-option[data-value="not_urgent"] {
        color: #22c55e;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 14px;
        margin-top: 24px;
    }

    .btn-cancel, .btn-submit {
        padding: 10px 24px;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }

    .btn-cancel {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-cancel:hover {
        background: #d1d5db;
    }

    .btn-submit {
        background: #2d2e83;
        color: #fff;
        box-shadow: 0 2px 8px rgba(45,46,131,0.10);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-submit:hover {
        background: #1e1f5a;
        box-shadow: 0 4px 16px rgba(45,46,131,0.20);
    }

    .form-message {
        margin-bottom: 16px;
        font-size: 1rem;
        text-align: center;
    }

    /* Task Cards - unchanged styling */
    .task-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        padding: 28px 24px;
        transition: box-shadow 0.2s;
    }

    .task-card:hover {
        box-shadow: 0 6px 24px rgba(0,0,0,0.12);
    }

    .task-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .task-title {
        font-size: 1rem;
        font-weight: 700;
        color: #374151;
    }

    .task-status {
        font-size: 0.95rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 12px;
        color: #fff;
    }

    .task-status.todo {
        background: #ef4444;
        color: #fff;
    }

    .task-status.in_progress {
        background: #f59e42;
    }

    .task-status.completed {
        background: #22c55e;
    }

    .task-status.due {
        background: #7c83e7;
    }

    .task-description {
        color: #444;
        font-size: 1rem;
        margin-bottom: 10px;
        line-height: 1.5;
    }

    .task-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.98rem;
        color: #888;
        margin-bottom: 10px;
    }

    .task-date {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .task-progress {
        font-size: 1rem;
        font-weight: 600;
    }

    .task-actions {
        margin-top: 14px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .task-action {
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.2s;
    }

    .task-action.start {
        background: #7c83e7;
        color: #fff;
    }

    .task-action.start:hover {
        background: #6366f1;
    }

    .task-action.complete {
        background: #22c55e;
        color: #fff;
        box-shadow: 0 2px 8px rgba(34,197,94,0.12);
    }

    .task-action.complete:hover {
        background: #16a34a;
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
                <a href="{{ route('student.dashboard') }}" class="active">
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
                <a href="{{ route('student.calendar') }}">
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
            <a href="{{ route('profile.edit') }}">Settings</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <section class="main-content">
        <!-- Fixed Header -->
        <div class="page-header">
            <div style="display:flex;align-items:center;justify-content:space-between;width:100%;">
                <div class="header-title" style="display:flex;align-items:center;gap:16px;">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2d2e83" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                        <line x1="9" y1="9" x2="15" y2="9"/>
                        <line x1="9" y1="15" x2="15" y2="15"/>
                    </svg>
                    <h1 style="font-size:1.5rem;font-weight:700;color:#2563eb;letter-spacing:0.5px;">TASKS OVERVIEW</h1>
                </div>
                <div id="notificationBellContainer" style="position:relative;display:inline-block;cursor:pointer;margin-left:auto;">
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

        <!-- Content Area -->
        <div class="content-area">
            <!-- Controls -->
            <div class="controls-section">
                <input type="text" placeholder="Search" class="search-input">
                <div class="controls-right">
                    <button class="filter-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        Filter
                    </button>
                    <button id="createTaskBtn" class="create-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        Create Task
                    </button>
                </div>
            </div>

            <!-- Tabs -->
            <div class="tabs-section">
                <span id="tab-todo" class="tab active">To-Do ({{ count($grouped['todo']) }})</span>
                <span id="tab-in_progress" class="tab">In Progress ({{ count($grouped['in_progress']) }})</span>
                <span id="tab-completed" class="tab">Completed ({{ count($grouped['completed']) }})</span>
                <span id="tab-due" class="tab">Due ({{ count($grouped['due']) }})</span>
            </div>

            <!-- Tasks Grid -->
            <div id="tasks-container" class="tasks-grid">
                @foreach(['todo','in_progress','completed','due'] as $tab)
                    @foreach($grouped[$tab] as $task)
                        <div class="task-card" data-status="{{ $tab }}" data-task-id="{{ $task->id }}" style="display:{{ $tab == 'todo' ? '' : 'none' }};">
                            <div class="task-header">
                                <span class="task-title" style="font-size:1.1rem;font-weight:700;color:#111827;">{{ $task->title }}</span>
                                <span class="task-status {{ $tab }}" style="font-size:0.95rem;color:#6b7280;">
                                    @if($tab === 'todo')
                                        To-Do
                                    @elseif($tab === 'in_progress')
                                        In Progress
                                    @elseif($tab === 'completed')
                                        Completed
                                    @elseif($tab === 'due')
                                        Due
                                    @else
                                        {{ ucfirst(str_replace('_',' ', $tab)) }}
                                    @endif
                                </span>
                                @if($task->status === 'rejected')
                                    <span class="status-badge" style="background:#fee2e2;color:#b91c1c;margin-left:10px;">Rejected</span>
                                @elseif(isset($task->verified) && $task->verified)
                                    <span class="status-badge status-completed" style="margin-left:10px;">Verified</span>
                                @else
                                    <span class="status-badge status-pending" style="margin-left:10px;">Not Verified</span>
                                @endif
                            </div>
                            <div class="task-description" style="font-size:0.95rem;color:#6b7280;margin-bottom:12px;">{{ $task->description }}</div>
                            <div class="task-meta" style="display:grid;grid-template-columns:repeat(2,1fr);gap:8px;font-size:0.85rem;">
                                <div style="display:flex;align-items:center;gap:6px;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                                        <line x1="9" y1="9" x2="15" y2="9"/>
                                    </svg>
                                    <span style="color:#374151;">
                                        <span style="font-weight:500;">Due:</span>
                                        {{ \Carbon\Carbon::parse($task->due_date)->format('F d, Y') }}
                                    </span>
                                </div>
                                <div style="text-align:right;color:#374151;">
                                    @if($task->status == 'completed')100%@elseif($task->status == 'in_progress')0%@else&nbsp;@endif
                                </div>
                                @if(($task->status == 'in_progress' || $task->status == 'completed') && $task->started_date && $task->started_time)
                                    <div style="grid-column:1/-1;padding-top:8px;border-top:1px solid #e5e7eb;display:flex;align-items:center;gap:6px;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                                            <line x1="9" y1="9" x2="15" y2="9"/>
                                        </svg>
                                        <span style="color:#374151;">
                                            <span style="font-weight:600;">Started:</span>
                                            {{ \Carbon\Carbon::parse($task->started_date)->format('F d, Y') }}
                                            {{ date('g:i A', strtotime($task->started_time)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="task-actions">
                                @if($tab == 'todo')
                                    @if($task->status === 'rejected')
                                        <button class="task-action start" data-id="{{ $task->id }}" data-status="in_progress" disabled style="background:#e5e7eb;color:#888;cursor:not-allowed;">Start</button>
                                    @else
                                        <button class="task-action start" data-id="{{ $task->id }}" data-status="in_progress" data-verified="{{ $task->verified ? '1' : '0' }}" @if(!isset($task->verified) || !$task->verified) disabled style="background:#e5e7eb;color:#888;cursor:not-allowed;" @endif>Start</button>
                                    @endif
                                @elseif($task->status == 'in_progress')
                                    <button class="task-action complete" data-id="{{ $task->id }}" data-status="completed">Complete</button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        <!-- Create Task Modal -->
        <div id="createTaskModal">
            <div class="modal-content">
                <h2 class="modal-title">Create New Task</h2>
                <form id="createTaskForm" method="POST" action="{{ route('student.tasks.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="taskTitle" class="form-label">Title</label>
                        <textarea id="taskTitle" name="title" required class="form-textarea" style="min-height:40px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="taskDesc" class="form-label">Description</label>
                        <textarea id="taskDesc" name="description" required class="form-textarea" style="min-height:100px;"></textarea>
                    </div>
                    <div class="form-group" style="position:relative;">
                        <label for="taskPriority" class="form-label">Level of Priority</label>
                        <input type="hidden" id="taskPriority" name="priority" value="">
                        <div id="priorityDropdown" class="priority-dropdown">
                            <span id="prioritySelected" style="color:#9ca3af;">Select priority</span>
                            <svg style="float:right;" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="2">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                            <div id="priorityOptions" class="priority-options">
                                <div class="priority-option" data-value="critical">Critical</div>
                                <div class="priority-option" data-value="medium">Medium Importance</div>
                                <div class="priority-option" data-value="not_urgent">Not Urgent</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="taskDue" class="form-label">Due Date</label>
                        <input type="date" id="taskDue" name="due_date" required class="form-input">
                    </div>
                    <div id="taskFormMsg" class="form-message"></div>
                    <div class="modal-actions">
                        <button type="button" id="closeTaskModal" class="btn-cancel">Cancel</button>
                        <button id="submitTaskBtn" type="submit" class="btn-submit">
                            <span id="submitTaskText">Create</span>
                            <span id="submitTaskSpinner" style="display:none;">
                                <svg width="20" height="20" viewBox="0 0 50 50">
                                    <circle cx="25" cy="25" r="20" fill="none" stroke="#fff" stroke-width="5" stroke-linecap="round" stroke-dasharray="31.4 31.4" transform="rotate(-90 25 25)">
                                        <animateTransform attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="1s" repeatCount="indefinite"/>
                                    </circle>
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
                                            // Decrease notification count
                                            const countSpan = document.getElementById('notificationCount');
                                            let currentCount = parseInt(countSpan.textContent);
                                            if (!isNaN(currentCount) && currentCount > 0) {
                                                countSpan.textContent = currentCount - 1;
                                            }
                                            // Optionally close dropdown
                                            notificationDropdown.style.display = 'none';
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
                                            // Decrease notification count
                                            const countSpan = document.getElementById('notificationCount');
                                            let currentCount = parseInt(countSpan.textContent);
                                            if (!isNaN(currentCount) && currentCount > 0) {
                                                countSpan.textContent = currentCount - 1;
                                            }
                                            // Optionally close dropdown
                                            notificationDropdown.style.display = 'none';
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
        if (logoutMenu.style.display === 'block' && !profileDropdown.contains(event.target) && !logoutMenu.contains(event.target)) {
            logoutMenu.style.display = 'none';
            logoutUp.style.display = 'block';
            logoutDown.style.display = 'none';
        }
    });
    // Profile dropdown with up/down arrow logic (community style)
    const profileDropdown = document.getElementById('profileDropdown');
    const logoutMenu = document.getElementById('logoutMenu');
    const logoutUp = document.getElementById('logoutUp');
    const logoutDown = document.getElementById('logoutDown');

    // Initially hide the down arrow and show the up arrow
    if (logoutDown && logoutUp) {
        logoutDown.style.display = 'none';
        logoutUp.style.display = 'block';
    }

    if (profileDropdown && logoutMenu && logoutUp && logoutDown) {
        profileDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
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
    }

    // Custom Priority Dropdown
    var priorityDropdown = document.getElementById('priorityDropdown');
    var priorityOptions = document.getElementById('priorityOptions');
    var prioritySelected = document.getElementById('prioritySelected');
    var priorityInput = document.getElementById('taskPriority');
    
    if(priorityDropdown && priorityOptions && prioritySelected && priorityInput) {
        priorityDropdown.onclick = function(e) {
            e.stopPropagation();
            priorityOptions.style.display = priorityOptions.style.display === 'block' ? 'none' : 'block';
        };
        document.querySelectorAll('.priority-option').forEach(function(opt) {
            opt.onclick = function(e) {
                var val = this.getAttribute('data-value');
                var text = this.textContent;
                priorityInput.value = val;
                prioritySelected.textContent = text;
                prioritySelected.style.color = '#374151';
                setTimeout(function() {
                    priorityOptions.style.display = 'none';
                }, 0);
            };
        });
        document.addEventListener('click', function(e) {
            if(priorityOptions.style.display === 'block') priorityOptions.style.display = 'none';
        });
    }

    // Create Task Modal
    var createBtn = document.getElementById('createTaskBtn');
    var modal = document.getElementById('createTaskModal');
    var closeBtn = document.getElementById('closeTaskModal');
    var form = document.getElementById('createTaskForm');
    var submitBtn = document.getElementById('submitTaskBtn');
    var submitText = document.getElementById('submitTaskText');
    var submitSpinner = document.getElementById('submitTaskSpinner');
    var msgBox = document.getElementById('taskFormMsg');
    
    if(createBtn && modal && closeBtn && form && submitBtn && submitText && submitSpinner && msgBox) {
        createBtn.onclick = function(e) {
            e.preventDefault();
            modal.style.display = 'flex';
            msgBox.innerHTML = '';
            form.reset();
            prioritySelected.textContent = 'Select priority';
            prioritySelected.style.color = '#9ca3af';
            priorityInput.value = '';
            submitBtn.disabled = false;
            submitText.style.display = 'inline';
            submitSpinner.style.display = 'none';
        };
        
        closeBtn.onclick = function() {
            modal.style.display = 'none';
        };
        
        window.onclick = function(event) {
            if(event.target === modal) {
                modal.style.display = 'none';
            }
        };
        
        form.onsubmit = function(ev) {
            ev.preventDefault();
            submitBtn.disabled = true;
            submitText.style.display = 'none';
            submitSpinner.style.display = 'inline-block';
            msgBox.innerHTML = '';
            
            var formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': form.querySelector('[name=_token]').value
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success && data.task) {
                    msgBox.style.color = '#22c55e';
                    msgBox.innerHTML = 'Task created successfully!';

                    // Add new task card to To-Do tab
                    var container = document.getElementById('tasks-container');
                    var card = document.createElement('div');
                    card.className = 'task-card';
                    card.setAttribute('data-status', 'todo');
                    card.style.display = '';
                    card.innerHTML = `
                        <div class="task-header">
                            <span class="task-title">${data.task.title}</span>
                            <span class="task-status todo">To-Do</span>
                            <span class="status-badge status-pending" style="margin-left:10px;">Not Verified</span>
                        </div>
                        <div class="task-description">${data.task.description}</div>
                        <div class="task-meta">
                            <span class="task-date">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <line x="9" y="9" x2="15" y2="9"/>
                                </svg>
                                ${data.task.due_date}
                            </span>
                            <span class="task-progress">&nbsp;</span>
                        </div>
                        <div class="task-actions">
                            <button class="task-action start" data-id="${data.task.id}" data-status="in_progress" disabled style="background:#e5e7eb;color:#888;cursor:not-allowed;">Start</button>
                        </div>
                    `;
                    container.prepend(card);

                    // Update tab counts
                    updateTabCounts();

                    // Dispatch event for office tab instant update
                    window.dispatchEvent(new Event('student-task-created'));

                    setTimeout(function() {
                        modal.style.display = 'none';
                    }, 1200);
                    form.reset();
                } else if(data.success) {
                    msgBox.style.color = '#22c55e';
                    msgBox.innerHTML = 'Task created successfully!';
                    setTimeout(function() {
                        modal.style.display = 'none';
                    }, 1200);
                    form.reset();
                } else {
                    msgBox.style.color = '#ef4444';
                    msgBox.innerHTML = data.message || 'Failed to create task.';
                }
            })
            .catch(() => {
                msgBox.style.color = '#ef4444';
                msgBox.innerHTML = 'An error occurred. Please try again.';
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitText.style.display = 'inline';
                submitSpinner.style.display = 'none';
            });
        };
    }

    // Tab switching logic
    var tabs = document.querySelectorAll('.tab');
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            tabs.forEach(function(t) {
                t.classList.remove('active');
            });
            tab.classList.add('active');
            
            var status = tab.id.replace('tab-','');
            if (status === 'inprogress' || status === 'in_progress') status = 'in_progress';
            
            var cards = document.querySelectorAll('.task-card');
            cards.forEach(function(card) {
                card.style.display = card.getAttribute('data-status') === status ? '' : 'none';
            });
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!profileDropdown.contains(event.target) && !logoutMenu.contains(event.target)) {
            logoutMenu.style.display = 'none';
            if (logoutUp && logoutDown) {
                logoutUp.style.display = 'block';
                logoutDown.style.display = 'none';
            }
        }
    });

    // Function to update tab counts
    function updateTabCounts() {
        var todoCount = document.querySelectorAll('.task-card[data-status="todo"]').length;
        var inProgressCount = document.querySelectorAll('.task-card[data-status="in_progress"]').length;
        var completedCount = document.querySelectorAll('.task-card[data-status="completed"]').length;
        var dueCount = document.querySelectorAll('.task-card[data-status="due"]').length;
        
        var todoTab = document.getElementById('tab-todo');
        var inProgressTab = document.getElementById('tab-in_progress');
        var completedTab = document.getElementById('tab-completed');
        var dueTab = document.getElementById('tab-due');
        
        if(todoTab) todoTab.innerHTML = todoTab.innerHTML.replace(/\(\d+\)/, '(' + todoCount + ')');
        if(inProgressTab) inProgressTab.innerHTML = inProgressTab.innerHTML.replace(/\(\d+\)/, '(' + inProgressCount + ')');
        if(completedTab) completedTab.innerHTML = completedTab.innerHTML.replace(/\(\d+\)/, '(' + completedCount + ')');
        if(dueTab) dueTab.innerHTML = dueTab.innerHTML.replace(/\(\d+\)/, '(' + dueCount + ')');
        
        // Update header stats
        var todoStat = document.querySelector('.stat-item .value.todo');
        var inProgressStat = document.querySelector('.stat-item .value.in-progress');
        var completedStat = document.querySelector('.stat-item .value.completed');
        
        if(todoStat) todoStat.textContent = todoCount;
        if(inProgressStat) inProgressStat.textContent = inProgressCount;
        if(completedStat) completedStat.textContent = completedCount;
    }

    // Task status change logic
    document.getElementById('tasks-container').addEventListener('click', function(e) {
        if(e.target.classList.contains('task-action')) {
            var btn = e.target;
            var id = btn.getAttribute('data-id');
            var newStatus = btn.getAttribute('data-status');
            var card = btn.closest('.task-card');
            
            fetch('/student-tasks/' + id + '/status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    card.setAttribute('data-status', newStatus);

                    // Update task status badge
                    var statusBadge = card.querySelector('.task-status');
                    statusBadge.textContent = newStatus === 'in_progress' ? 'In Progress' : 'Completed';
                    statusBadge.className = 'task-status ' + newStatus;

                    // Update button
                    var actionBtn = card.querySelector('.task-action');
                    if (actionBtn) {
                        if (newStatus === 'in_progress') {
                            actionBtn.textContent = 'Complete';
                            actionBtn.setAttribute('data-status', 'completed');
                            actionBtn.className = 'task-action complete';
                        } else if (newStatus === 'completed') {
                            actionBtn.remove();
                        }
                    }

                    // Instantly update percentage
                    var progressSpan = card.querySelector('.task-progress');
                    if (progressSpan) {
                        progressSpan.textContent = newStatus === 'in_progress' ? '0%' : (newStatus === 'completed' ? '100%' : progressSpan.textContent);
                    }

                    // Show started date/time if available
                    if ((newStatus === 'in_progress' || newStatus === 'completed') && data.started_date && data.started_time) {
                        let startedRow = card.querySelector('.task-started-row');
                        if (!startedRow) {
                            startedRow = document.createElement('div');
                            startedRow.className = 'task-started-row';
                            startedRow.style.marginTop = '8px';
                            startedRow.style.paddingTop = '8px';
                            startedRow.style.borderTop = '1px solid #e5e7eb';
                            startedRow.style.display = 'flex';
                            startedRow.style.alignItems = 'center';
                            startedRow.style.gap = '8px';
                            startedRow.innerHTML = `
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" style="vertical-align:middle;">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <line x1="9" y1="9" x2="15" y2="9"/>
                                </svg>
                                <span style="font-weight:600;color:#059669;">Started:</span>
                                <span style="color:#059669;">${data.started_date}</span>
                                <span style="color:#059669;">${data.started_time}</span>
                            `;
                            card.querySelector('.task-meta').after(startedRow);
                        }
                    }

                    // Show/hide card based on active tab
                    var activeTab = document.querySelector('.tab.active').id.replace('tab-','');
                    if (activeTab === newStatus) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }

                    // Update tab counts and header stats
                    updateTabCounts();
                } else {
                    alert('Failed to update task status.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });

        // Search and highlight logic for task titles
        var searchInput = document.querySelector('.search-input');
        var tabs = document.querySelectorAll('.tab');
        var lastActiveTab = null;
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                var keyword = this.value.trim().toLowerCase();
                var cards = document.querySelectorAll('.task-card');
                var firstMatch = null;
                if (keyword) {
                    // Save last active tab and deactivate all tabs
                    if (!lastActiveTab) {
                        lastActiveTab = document.querySelector('.tab.active');
                    }
                    tabs.forEach(function(tab) { tab.classList.remove('active'); });
                    // Show only matching cards
                    cards.forEach(function(card) {
                        var titleSpan = card.querySelector('.task-title');
                        if (!titleSpan) return;
                        var originalTitle = titleSpan.getAttribute('data-original') || titleSpan.textContent;
                        if (!titleSpan.getAttribute('data-original')) {
                            titleSpan.setAttribute('data-original', originalTitle);
                        }
                        if (originalTitle.toLowerCase().includes(keyword)) {
                            card.style.display = '';
                            var regex = new RegExp('('+keyword.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')+')', 'gi');
                            titleSpan.innerHTML = originalTitle.replace(regex, '<span class="highlight">$1</span>');
                            if (!firstMatch) firstMatch = card;
                        } else {
                            card.style.display = 'none';
                            titleSpan.innerHTML = originalTitle;
                        }
                    });
                    if (firstMatch) {
                        firstMatch.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                } else {
                    // Restore tab filter and remove highlights
                    if (lastActiveTab) {
                        lastActiveTab.classList.add('active');
                    }
                    var activeTab = document.querySelector('.tab.active');
                    var status = activeTab ? activeTab.id.replace('tab-','') : 'todo';
                    if (status === 'inprogress' || status === 'in_progress') status = 'in_progress';
                    cards.forEach(function(card) {
                        var titleSpan = card.querySelector('.task-title');
                        if (!titleSpan) return;
                        var originalTitle = titleSpan.getAttribute('data-original') || titleSpan.textContent;
                        titleSpan.innerHTML = originalTitle;
                        if (card.getAttribute('data-status') === status) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                    lastActiveTab = null;
                }
            });
        }
});
</script>
@vite(['resources/js/app.js'])

@endsection
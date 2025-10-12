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

    /* Main Content */
    .main-content {
        flex: 1;
        background: #f3f4f6;
        padding: 0;
        min-height: 100vh;
    }

    /* Header */
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

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* Content Section */
    .content-section {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px;
        display: flex;
        gap: 40px;
        align-items: flex-start;
    }

    /* Community List */
    .community-list {
        flex: 2;
        background: #ffffff;
        border-radius: 12px;
        padding: 0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .community-item {
        padding: 24px;
        border-bottom: 1px solid #f3f4f6;
    }

    .community-item:last-child {
        border-bottom: none;
    }

    .community-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 4px;
    }

    .community-owner {
        font-size: 0.95rem;
        color: #6b7280;
        margin-bottom: 12px;
    }

    .community-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .member-count {
        background: #f3f4f6;
        color: #374151;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .join-btn {
        background: transparent;
        border: 1.5px solid #374151;
        color: #374151;
        padding: 6px 20px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .join-btn:hover {
        background: #374151;
        color: white;
    }

    /* Create Community Form */
    .create-community {
        flex: 1;
        background: #ffffff;
        border-radius: 12px;
        padding: 32px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        height: fit-content;
    }

    .form-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 24px;
        letter-spacing: 0.5px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        font-size: 0.9rem;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.95rem;
        background: #ffffff;
        outline: none;
        transition: border-color 0.2s;
        box-sizing: border-box;
    }

    .form-input:focus {
        border-color: #2563eb;
    }

    .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.95rem;
        background: #ffffff;
        outline: none;
        transition: border-color 0.2s;
        resize: vertical;
        min-height: 100px;
        box-sizing: border-box;
        font-family: inherit;
    }

    .form-textarea:focus {
        border-color: #2563eb;
    }

    .create-btn {
        background: transparent;
        border: 1.5px solid #374151;
        color: #374151;
        padding: 10px 24px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.2s;
        float: right;
    }

    .create-btn:hover {
        background: #374151;
        color: white;
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
                <a href="{{ route('student.community') }}" class="active">
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
                <a href="{{ route('student.grades') }}">
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
    <main class="main-content">
        <!-- Header -->
        <div class="community-header">
            <div class="header-content">
                <h1 class="community-title">COMMUNITY</h1>
                <div class="user-section" style="position:relative;">
                    <div id="notificationBellContainer" style="position:relative;display:inline-block;cursor:pointer;">
                        <svg class="notification-bell" id="notificationBell" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>
                        <span id="notificationCount" style="position:absolute;top:-6px;right:-6px;background:#ef4444;color:#fff;border-radius:50%;padding:2px 7px;font-size:0.85rem;font-weight:700;display:none;z-index:10;">0</span>
                    </div>
                    <div id="notificationDropdown" style="display:none;position:absolute;top:36px;right:0;background:#fff;border-radius:12px;box-shadow:0 4px 16px rgba(0,0,0,0.12);min-width:320px;z-index:100;padding:16px;">
                        <div id="notificationContent">Loading...</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content-section">
            <!-- Community List -->
            <div class="community-list">
                @foreach($groups as $group)
                    <div class="community-item">
                        <div class="community-name" style="font-size:1.2rem;font-weight:700;color:#2563eb;margin-bottom:4px;">{{ $group->name }}</div>
                        <div class="community-owner" style="font-size:0.95rem;color:#374151;margin-bottom:4px;">Created by: {{ $group->owner ? $group->owner->name : 'Unknown' }}</div>
                        <div class="community-description" style="font-size:0.95rem;color:#6b7280;margin-bottom:12px;">{{ $group->description }}</div>
                        <div class="community-meta">
                            <span class="member-count">{{ $group->members_count }} Member{{ $group->members_count == 1 ? '' : 's' }}</span>
                            @if(auth()->user() && $group->owner_id == auth()->user()->id)
                                <button class="view-btn" data-group-id="{{ $group->id }}" style="background: linear-gradient(90deg, #3b82f6, #2563eb); color: #fff; border: none; border-radius: 8px; padding: 10px 24px; font-weight: 600; font-size: 1rem; box-shadow: 0 2px 8px rgba(59,130,246,0.10); transition: background 0.2s, box-shadow 0.2s; letter-spacing: 0.05em; display: inline-flex; align-items: center; gap: 8px;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:4px;"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    View
                                </button>
                            @elseif(auth()->user() && $group->members->contains(auth()->user()))
                                <button class="view-btn" data-group-id="{{ $group->id }}" style="background: linear-gradient(90deg, #3b82f6, #2563eb); color: #fff; border: none; border-radius: 8px; padding: 10px 24px; font-weight: 600; font-size: 1rem; box-shadow: 0 2px 8px rgba(59,130,246,0.10); transition: background 0.2s, box-shadow 0.2s; letter-spacing: 0.05em; display: inline-flex; align-items: center; gap: 8px;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:4px;"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    View
                                </button>
                            @else
                                <button class="join-btn" data-group-id="{{ $group->id }}">JOIN</button>
                            @endif
                        </div>
                        <div class="chat-box" style="display:none; margin-top:12px; position:relative;" data-group-id="{{ $group->id }}">
                            <div style="background:#f9fafb;border-radius:12px;padding:16px;box-shadow:0 2px 8px rgba(0,0,0,0.10);width:100%;max-width:400px;position:relative;">
                                <div style="font-weight:700;color:#2563eb;margin-bottom:12px;font-size:1.1rem;display:flex;align-items:center;gap:8px;justify-content:space-between;">
                                    <span style="display:flex;align-items:center;gap:8px;">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><circle cx="9" cy="10" r="1"/><circle cx="15" cy="10" r="1"/></svg>
                                        Group Chat
                                    </span>
                                    <button class="minimize-chat" style="background:none;border:none;cursor:pointer;padding:0;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                    </button>
                                </div>
                                <div class="chat-messages" style="height:220px;overflow-y:auto;background:#fff;border-radius:8px;padding:12px;margin-bottom:10px;border:1px solid #e5e7eb;display:flex;flex-direction:column;gap:8px;scroll-behavior:smooth;">
                                    @if(isset($groupMessages[$group->id]))
                                        @foreach($groupMessages[$group->id] as $msg)
                                            @php
                                                $isMe = (auth()->user() && $msg->user_id == auth()->user()->id);
                                                $isSystem = Str::contains($msg->message, ['accepted you to the group', 'joined the group']);
                                            @endphp
                                            @if($isSystem)
                                                <div style="display:flex;justify-content:center;">
                                                    <span style="background:#e5e7eb;color:#2563eb;padding:8px 14px;border-radius:12px;font-size:1rem;max-width:80%;word-break:break-word;font-weight:600;">
                                                        {{ $msg->message }}
                                                    </span>
                                                </div>
                                            @elseif($isMe)
                                                <div style="display:flex;justify-content:flex-end;align-items:flex-end;gap:8px;">
                                                    <span style="background:#2563eb;color:#fff;padding:8px 14px;border-radius:16px 16px 0 16px;font-size:1rem;max-width:70%;word-break:break-word;">
                                                        {{ $msg->message }}
                                                    </span>
                                                </div>
                                            @else
                                                <div style="display:flex;align-items:flex-start;gap:8px;">
                                                    @if($msg->user && $msg->user->profile_photo)
                                                        <img src="{{ asset('storage/' . $msg->user->profile_photo) }}" alt="{{ $msg->user->name }}" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                                    @else
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($msg->user->name ?? 'User') }}&background=667eea&color=fff&size=32" alt="{{ $msg->user->name ?? 'User' }}" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                                    @endif
                                                    <div style="display:flex;flex-direction:column;align-items:flex-start;">
                                                        <span style="font-size:0.95rem;font-weight:600;color:#2563eb;margin-bottom:2px;">{{ explode(' ', $msg->user->name ?? 'User')[0] }}</span>
                                                        <span style="background:#e5e7eb;color:#2563eb;padding:8px 14px;border-radius:16px 16px 16px 0;font-size:1rem;max-width:320px;min-width:80px;word-break:break-word;display:inline-block;">
                                                            {{ $msg->message }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <form class="chat-form" style="display:flex;gap:8px;align-items:center;">
                                    <input type="text" class="chat-input" placeholder="Type a message..." style="flex:1;padding:10px 14px;border-radius:8px;border:1px solid #e5e7eb;font-size:1rem;">
                                    <button type="submit" style="background:#2563eb;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-weight:600;font-size:1rem;box-shadow:0 2px 8px rgba(45,46,131,0.10);">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Create Community Form -->
            <div class="create-community">
                <h2 class="form-title">CREATE COMMUNITY</h2>
                <form method="POST" action="{{ route('student.community.create') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-textarea" required></textarea>
                    </div>
                    <button type="submit" class="create-btn">Create</button>
                </form>
            </div>

            <!-- Join Request Modal -->
            <div id="joinRequestModal" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.25);align-items:center;justify-content:center;z-index:999;">
                <div style="background:#fff;border-radius:16px;padding:32px;min-width:320px;max-width:90vw;box-shadow:0 4px 32px rgba(0,0,0,0.18);display:flex;flex-direction:column;align-items:center;">
                    <div id="joinModalText" style="font-size:1.1rem;color:#2563eb;font-weight:600;margin-bottom:24px;text-align:center;">Do you want to send a join request to the group creator?</div>
                    <div style="display:flex;gap:16px;">
                        <button id="sendJoinRequestBtn" style="background:#2563eb;color:#fff;border:none;border-radius:8px;padding:10px 24px;font-weight:600;font-size:1rem;">Send Request</button>
                        <button id="cancelJoinRequestBtn" style="background:#ef4444;color:#fff;border:none;border-radius:8px;padding:10px 24px;font-weight:600;font-size:1rem;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
            <div class="chat-box" style="display:none; margin-top:12px;">
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to update notification count badge
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
    // Update notification count on page load and every 30 seconds
    updateNotificationCount();
    setInterval(updateNotificationCount, 30000);
    // --- All event listeners in one block ---
    // Notification bell dropdown for join requests
    const notificationBell = document.getElementById('notificationBell');
    const notificationBellContainer = document.getElementById('notificationBellContainer');
    const notificationDropdown = document.getElementById('notificationDropdown');
    const notificationContent = document.getElementById('notificationContent');
    notificationBellContainer.addEventListener('click', function(e) {
        updateNotificationCount();
        // Do NOT stop propagation here
        if (notificationDropdown.style.display === 'block') {
            notificationDropdown.style.display = 'none';
        } else {
            notificationDropdown.style.display = 'block';
            // Fetch pending join requests
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
                        // Attach Accept/Reject handlers
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
                                            // Show View button for accepted member
                                            document.querySelectorAll('.community-item').forEach(function(item) {
                                                var viewBtn = item.querySelector('.view-btn');
                                                var joinBtn = item.querySelector('.join-btn');
                                                if (joinBtn && joinBtn.getAttribute('data-group-id') === reqId) {
                                                    joinBtn.style.display = 'none';
                                                    if (viewBtn) viewBtn.style.display = '';
                                                }
                                            });
                                            // Optionally, refresh chatbox to show join message
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
    // Hide notification dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!notificationBell.contains(event.target) && !notificationDropdown.contains(event.target)) {
            notificationDropdown.style.display = 'none';
        }
    });

    // Profile dropdown logic
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

    // Modal logic for join request
    let selectedGroupId = null;
    const joinRequestModal = document.getElementById('joinRequestModal');
    const sendJoinRequestBtn = document.getElementById('sendJoinRequestBtn');
    const cancelJoinRequestBtn = document.getElementById('cancelJoinRequestBtn');
    const joinModalText = document.getElementById('joinModalText');
    document.querySelectorAll('.join-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            selectedGroupId = btn.getAttribute('data-group-id');
            if (joinRequestModal) {
                joinRequestModal.style.display = 'flex';
                joinRequestModal._triggerBtn = btn;
            }
        });
    });
    if (cancelJoinRequestBtn) {
        cancelJoinRequestBtn.addEventListener('click', function() {
            if (joinRequestModal) joinRequestModal.style.display = 'none';
            selectedGroupId = null;
            // Restore Send button and text for next use
            if (sendJoinRequestBtn) sendJoinRequestBtn.style.display = '';
            if (cancelJoinRequestBtn) cancelJoinRequestBtn.textContent = 'Cancel';
            if (joinModalText) joinModalText.textContent = 'Do you want to send a join request to the group creator?';
        });
    }
    if (sendJoinRequestBtn) {
        sendJoinRequestBtn.addEventListener('click', function() {
            if (!selectedGroupId) return;
            fetch('/community/join-request', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ group_id: selectedGroupId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (joinModalText) joinModalText.textContent = 'Your request has been sent. Please wait for approval.';
                    if (sendJoinRequestBtn) sendJoinRequestBtn.style.display = 'none';
                    if (cancelJoinRequestBtn) cancelJoinRequestBtn.textContent = 'Close';
                    if (joinRequestModal && joinRequestModal._triggerBtn) joinRequestModal._triggerBtn.style.display = 'none';
                } else {
                    if (joinModalText) joinModalText.textContent = data.message || 'Failed to send request.';
                }
            });
        });
    }

    // Show chat box on VIEW click for group owner
    function attachChatEventListeners() {
        document.querySelectorAll('.view-btn').forEach(function(btn) {
            btn.onclick = function(e) {
                e.preventDefault();
                var groupId = btn.getAttribute('data-group-id');
                var communityItem = btn.closest('.community-item');
                var chatBox = communityItem.querySelector('.chat-box[data-group-id="' + groupId + '"]');
                if (chatBox) chatBox.style.display = 'block';
            };
        });
        document.querySelectorAll('.minimize-chat').forEach(function(btn) {
            btn.onclick = function(e) {
                e.preventDefault();
                var chatBox = btn.closest('.chat-box');
                if (chatBox) {
                    chatBox.style.display = 'none';
                    var communityItem = chatBox.closest('.community-item');
                    if (communityItem) {
                        var joinBtn = communityItem.querySelector('.join-btn');
                        if (joinBtn) joinBtn.style.display = '';
                    }
                }
            };
        });
    }
    attachChatEventListeners();

    // Re-attach listeners after notification actions and reloads
    document.addEventListener('readystatechange', function() {
        if (document.readyState === 'complete') {
            attachChatEventListeners();
        }
    });

    // Send message in chat
    document.querySelectorAll('.chat-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var input = form.querySelector('.chat-input');
            var chatBox = form.closest('.chat-box');
            var messages = chatBox.querySelector('.chat-messages');
            var groupId = chatBox.getAttribute('data-group-id');
            var userName = document.querySelector('.sidebar .profile-details .name')?.textContent || 'You';
            if (input.value.trim() && groupId) {
                var msgDiv = document.createElement('div');
                msgDiv.innerHTML = `<div style="display:flex;justify-content:flex-end;"><span style="background:#2563eb;color:#fff;padding:8px 14px;border-radius:16px 16px 0 16px;font-size:1rem;max-width:70%;word-break:break-word;">${input.value}</span></div>`;
                messages.appendChild(msgDiv);
                messages.scrollTop = messages.scrollHeight;
                fetch('/community/send-message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ group_id: groupId, message: input.value })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        input.value = '';
                    }
                });
            }
        });
    });
});
</script>

@endsection
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
                <div class="user-section">
                    <svg class="notification-bell" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
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
                            <button class="join-btn" data-group-id="{{ $group->id }}">JOIN</button>
                        </div>
                        <!-- Replace the existing chat-box div with this fixed version -->
<div class="chat-box" style="display:none; margin-top:12px;" data-group-id="{{ $group->id }}">
    <div style="background:#f9fafb;border-radius:12px;padding:16px;box-shadow:0 2px 8px rgba(0,0,0,0.10);width:100%;max-width:400px;">
        <div style="font-weight:700;color:#2563eb;margin-bottom:12px;font-size:1.1rem;display:flex;align-items:center;gap:8px;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><circle cx="9" cy="10" r="1"/><circle cx="15" cy="10" r="1"/></svg>
            Group Chat
        </div>
        <div class="chat-messages" style="height:220px;overflow-y:auto;background:#fff;border-radius:8px;padding:12px;margin-bottom:10px;border:1px solid #e5e7eb;display:flex;flex-direction:column;gap:8px;scroll-behavior:smooth;">
            @if(isset($groupMessages[$group->id]))
                @foreach($groupMessages[$group->id] as $msg)
                    @php $isMe = (auth()->user() && $msg->user_id == auth()->user()->id); @endphp
                    @if($isMe)
                        <div style="display:flex;justify-content:flex-end;">
                            <span style="background:#2563eb;color:#fff;padding:8px 14px;border-radius:16px 16px 0 16px;font-size:1rem;max-width:70%;word-break:break-word;">{{ $msg->message }}</span>
                        </div>
                    @else
                        <div style="display:flex;justify-content:flex-start;align-items:center;gap:8px;">
                            <span style="background:#e5e7eb;color:#2563eb;padding:8px 14px;border-radius:16px 16px 16px 0;font-size:1rem;max-width:70%;word-break:break-word;">{{ $msg->user->name ?? 'User' }}: {{ $msg->message }}</span>
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
        </div>
            <div class="chat-box" style="display:none; margin-top:12px;">
                <div style="background:#f9fafb;border-radius:8px;padding:16px;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                    <div style="font-weight:600;color:#2563eb;margin-bottom:8px;">Group Chat</div>
                    <div class="chat-messages" style="height:120px;overflow-y:auto;background:#fff;border-radius:6px;padding:8px;margin-bottom:8px;border:1px solid #e5e7eb;"></div>
                    <form class="chat-form" style="display:flex;gap:8px;">
                        <input type="text" class="chat-input" placeholder="Type a message..." style="flex:1;padding:8px 12px;border-radius:6px;border:1px solid #e5e7eb;">
                        <button type="submit" style="background:#2563eb;color:#fff;border:none;border-radius:6px;padding:8px 16px;font-weight:600;">Send</button>
                    </form>
                </div>
            </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileDropdown = document.getElementById('profileDropdown');
    const logoutMenu = document.getElementById('logoutMenu');
    const logoutUp = document.getElementById('logoutUp');
    const logoutDown = document.getElementById('logoutDown');

    // Initially hide the down arrow and show the up arrow
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

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!profileDropdown.contains(event.target) && !logoutMenu.contains(event.target)) {
            logoutMenu.style.display = 'none';
            logoutUp.style.display = 'block';
            logoutDown.style.display = 'none';
        }
    });
    // Show chat box on JOIN click
    document.querySelectorAll('.join-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var groupId = btn.getAttribute('data-group-id');
            // AJAX join request
            fetch('/community/join', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ group_id: groupId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    btn.style.display = 'none';
                    // Optionally update member count in UI
                    var memberCountSpan = btn.closest('.community-item').querySelector('.member-count');
                    var count = parseInt(memberCountSpan.textContent) || 0;
                    memberCountSpan.textContent = (count + 1) + ' Member' + ((count + 1) === 1 ? '' : 's');
                    // Show chat box
                    var chatBox = btn.closest('.community-item').querySelector('.chat-box[data-group-id="' + groupId + '"]');
                    if (chatBox) chatBox.style.display = 'block';
                    // Attach Echo listener for this group
                    if (window.Echo && groupId) {
                        window.Echo.join('group.' + groupId)
                            .listen('GroupMessageSent', function(data) {
                                var messages = chatBox.querySelector('.chat-messages');
                                var msgDiv = document.createElement('div');
                                var isMe = (data.user.name === (document.querySelector('.sidebar .profile-details .name')?.textContent || ''));
                                if (isMe) {
                                    msgDiv.innerHTML = `<div style=\"display:flex;justify-content:flex-end;\"><span style=\"background:#2563eb;color:#fff;padding:8px 14px;border-radius:16px 16px 0 16px;font-size:1rem;max-width:70%;word-break:break-word;\">${data.message}</span></div>`;
                                } else {
                                    msgDiv.innerHTML = `<div style=\"display:flex;justify-content:flex-start;align-items:center;gap:8px;\"><span style=\"background:#e5e7eb;color:#2563eb;padding:8px 14px;border-radius:16px 16px 16px 0;font-size:1rem;max-width:70%;word-break:break-word;\">${data.user.name}: ${data.message}</span></div>`;
                                }
                                messages.appendChild(msgDiv);
                                messages.scrollTop = messages.scrollHeight;
                            });
                    }
                }
            });
        });
    });

    document.querySelectorAll('.chat-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var input = form.querySelector('.chat-input');
            var chatBox = form.closest('.chat-box');
            var messages = chatBox.querySelector('.chat-messages');
            var groupId = chatBox.getAttribute('data-group-id');
            var userName = document.querySelector('.sidebar .profile-details .name')?.textContent || 'You';
            if (input.value.trim() && groupId) {
                // Show own message immediately
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
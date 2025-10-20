@extends('layouts.app')

@section('page-title')
    COMMUNITY
@endsection

@section('page-icon')
    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2d2e83" stroke-width="2">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
        <circle cx="9" cy="7" r="4"/>
        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
    </svg>
@endsection

@section('content')

<!-- CSRF Token for AJAX requests -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    /* Community Specific Styles */

    .header-title {
        display: flex;
        align-items: center;
        gap: 16px;
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

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* Content Section */
    .content-section {
        padding: 32px;
        display: flex;
        gap: 32px;
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

<script>
document.addEventListener('DOMContentLoaded', function() {




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
        sendJoinRequestBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (!selectedGroupId) {
                console.error('No group selected');
                return;
            }
            
            console.log('Sending join request for group:', selectedGroupId);
            
            // Get CSRF token - try different methods
            let csrfToken = null;
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfInput = document.querySelector('input[name="_token"]');
            
            if (csrfMeta) {
                csrfToken = csrfMeta.getAttribute('content');
            } else if (csrfInput) {
                csrfToken = csrfInput.value;
            } else {
                // Try to get from Laravel's global
                csrfToken = window.Laravel && window.Laravel.csrfToken ? window.Laravel.csrfToken : null;
            }
            
            if (!csrfToken) {
                console.error('CSRF token not found');
                if (joinModalText) joinModalText.textContent = 'Error: Security token not found. Please refresh the page.';
                return;
            }
            
            // Disable button to prevent double-clicking
            sendJoinRequestBtn.disabled = true;
            const originalText = sendJoinRequestBtn.textContent;
            sendJoinRequestBtn.textContent = 'Sending...';
            
            fetch('/community/join-request', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ group_id: parseInt(selectedGroupId) })
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    if (joinModalText) joinModalText.textContent = 'Your request has been sent. Please wait for approval.';
                    if (sendJoinRequestBtn) sendJoinRequestBtn.style.display = 'none';
                    if (cancelJoinRequestBtn) cancelJoinRequestBtn.textContent = 'Close';
                    if (joinRequestModal && joinRequestModal._triggerBtn) joinRequestModal._triggerBtn.style.display = 'none';
                } else {
                    if (joinModalText) joinModalText.textContent = data.message || 'Failed to send request.';
                    // Re-enable button on error
                    sendJoinRequestBtn.disabled = false;
                    sendJoinRequestBtn.textContent = originalText;
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                if (joinModalText) joinModalText.textContent = 'Network error. Please try again.';
                // Re-enable button on error
                sendJoinRequestBtn.disabled = false;
                sendJoinRequestBtn.textContent = originalText;
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
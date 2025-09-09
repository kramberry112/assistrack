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
        padding: 20px;
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

    .content-header {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 16px 20px;
        border-bottom: 1px solid #e5e7eb;
        background: #fff;
        font-size: 0.95rem;
        color: #6b7280;
    }

    .welcome-section {
        flex: 1;
        padding: 24px;
    }

    .welcome-message {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
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
                <a href="{{ route('student.reports') }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <line x1="9" y1="9" x2="15" y2="9"/>
                            <line x1="9" y1="15" x2="15" y2="15"/>
                        </svg>
                    </span>
                    Reports
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
            <a href="{{ route('profile.edit') }}" style="display:block;margin-bottom:8px;text-align:center;background:#3b82f6;color:#fff;border:none;border-radius:6px;padding:8px 12px;font-size:0.9rem;font-weight:500;cursor:pointer;text-decoration:none;transition:background 0.2s;">Settings</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <section class="main-content">
        <div class="content-card">
            <div class="content-header" style="font-size:1.5rem;font-weight:600;color:#2d2e83;letter-spacing:0.03em;display:flex;align-items:center;justify-content:space-between;">
                <span>TASKS OVERVIEW</span>
                <button style="background:none;border:none;cursor:pointer;padding:0;">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#2d2e83" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                </button>
            </div>
            <div class="welcome-section" style="padding-top:16px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
                    <input type="text" placeholder="Search" style="width:260px;padding:8px 14px;border-radius:8px;border:1px solid #e5e7eb;font-size:1rem;">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <button style="background:#f3f4f6;border:none;padding:8px 18px;border-radius:8px;font-size:1rem;color:#374151;display:flex;align-items:center;gap:8px;cursor:pointer;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            Filter
                        </button>
                        <button id="createTaskBtn" style="background:#2d2e83;color:#fff;border:none;padding:8px 18px;border-radius:8px;font-size:1rem;font-weight:500;cursor:pointer;display:flex;align-items:center;gap:8px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            Create Task
                        </button>
                <!-- Create Task Modal -->
                <div id="createTaskModal" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.18);z-index:999;align-items:center;justify-content:center;">
                    <div style="background:#fff;padding:32px 28px;border-radius:12px;box-shadow:0 8px 32px rgba(0,0,0,0.12);width:420px;max-width:98vw;">
                        <h2 style="font-size:1.2rem;font-weight:600;color:#2d2e83;margin-bottom:18px;">Create Task</h2>
                        <form id="createTaskForm" method="POST" action="{{ route('student.tasks.store') }}">
                            @csrf
                            <div style="margin-bottom:14px;">
                                <label for="taskTitle" style="font-weight:500;color:#374151;">Title</label>
                                <textarea id="taskTitle" name="title" required style="width:100%;padding:8px 10px;border-radius:6px;border:1px solid #e5e7eb;margin-top:4px;min-height:40px;resize:vertical;overflow:auto;"></textarea>
                            </div>
                            <div style="margin-bottom:14px;">
                                <label for="taskDesc" style="font-weight:500;color:#374151;">Description</label>
                                <textarea id="taskDesc" name="description" required style="width:100%;padding:8px 10px;border-radius:6px;border:1px solid #e5e7eb;margin-top:4px;min-height:120px;"></textarea>
                            </div>
                            <div style="margin-bottom:14px;position:relative;">
                                <label for="taskPriority" style="font-weight:500;color:#374151;">Level of Priority</label>
                                <input type="hidden" id="taskPriority" name="priority" value="">
                                <div id="priorityDropdown" style="width:100%;padding:8px 10px;border-radius:6px;border:1px solid #e5e7eb;margin-top:4px;cursor:pointer;background:#fff;position:relative;">
                                    <span id="prioritySelected" style="color:#9ca3af;">Select priority</span>
                                    <svg style="float:right;" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    <div id="priorityOptions" style="display:none;position:absolute;top:44px;left:0;width:100%;background:#fff;border:1px solid #e5e7eb;border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,0.08);z-index:10;">
                                        <div class="priority-option" data-value="critical" style="padding:10px 14px;cursor:pointer;">Critical</div>
                                        <div class="priority-option" data-value="medium" style="padding:10px 14px;cursor:pointer;">Medium Importance</div>
                                        <div class="priority-option" data-value="not_urgent" style="padding:10px 14px;cursor:pointer;">Not Urgent</div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-bottom:18px;">
                                <label for="taskDue" style="font-weight:500;color:#374151;">Due Date</label>
                                <input type="date" id="taskDue" name="due_date" required style="width:100%;padding:8px 10px;border-radius:6px;border:1px solid #e5e7eb;margin-top:4px;">
                            </div>
                            <div id="taskFormMsg" style="margin-bottom:12px;font-size:1rem;"></div>
                            <div style="display:flex;justify-content:flex-end;gap:10px;">
                                <button type="button" id="closeTaskModal" style="background:#e5e7eb;color:#374151;border:none;padding:8px 18px;border-radius:8px;font-size:1rem;cursor:pointer;">Cancel</button>
                                <button id="submitTaskBtn" type="submit" style="background:#2d2e83;color:#fff;border:none;padding:8px 18px;border-radius:8px;font-size:1rem;font-weight:500;cursor:pointer;display:flex;align-items:center;gap:8px;">
                                    <span id="submitTaskText">Create</span>
                                    <span id="submitTaskSpinner" style="display:none;"><svg width="18" height="18" viewBox="0 0 50 50"><circle cx="25" cy="25" r="20" fill="none" stroke="#fff" stroke-width="5" stroke-linecap="round" stroke-dasharray="31.4 31.4" transform="rotate(-90 25 25)"><animateTransform attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="1s" repeatCount="indefinite"/></circle></svg></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
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
                            priorityOptions.style.display = 'none';
                        };
                    });
                    document.addEventListener('click', function(e) {
                        if(priorityOptions.style.display === 'block') priorityOptions.style.display = 'none';
                    });
                }
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
                                card.style.background = '#fff';
                                card.style.borderRadius = '12px';
                                card.style.boxShadow = '0 2px 8px rgba(0,0,0,0.04)';
                                card.style.padding = '18px 20px';
                                card.style.width = '260px';
                                card.style.display = '';
                                card.innerHTML = `
                                    <div style="background:#7c83e7;color:#fff;font-weight:600;border-radius:4px;padding:4px 12px;display:inline-block;margin-bottom:8px;">To-Do</div>
                                    <div style="font-weight:600;font-size:1.1rem;color:#222;margin-bottom:4px;">${data.task.title}</div>
                                    <div style="color:#444;font-size:0.98rem;margin-bottom:12px;">${data.task.description}</div>
                                    <div style="font-size:0.95rem;color:#888;margin-bottom:8px;">Priority: ${data.task.priority.replace('_',' ')}</div>
                                    <div style="display:flex;align-items:center;justify-content:space-between;font-size:0.95rem;color:#888;">
                                        <span><svg width='16' height='16' style='vertical-align:middle;margin-right:4px;' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2'><rect x='3' y='3' width='18' height='18' rx='2'/><line x1='9' y1='9' x2='15' y2='9'/></svg> ${data.task.due_date}</span>
                                        <span>0%</span>
                                    </div>
                                    <div style="margin-top:10px;display:flex;gap:8px;flex-wrap:wrap;">
                                        <button class="task-action" data-id="${data.task.id}" data-status="in_progress" style="background:#7c83e7;color:#fff;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">Start</button>
                                    </div>
                                `;
                                container.prepend(card);
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
            });
            </script>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:24px;margin-bottom:18px;">
                    <span id="tab-todo" class="tab active" style="font-weight:500;color:#374151;cursor:pointer;border-bottom:3px solid #7c83e7;padding-bottom:2px;">To-Do ({{ count($grouped['todo']) }})</span>
                    <span id="tab-in_progress" class="tab" style="font-weight:500;color:#374151;cursor:pointer;">In Progress ({{ count($grouped['in_progress']) }})</span>
                    <span id="tab-completed" class="tab" style="font-weight:500;color:#374151;cursor:pointer;">Completed ({{ count($grouped['completed']) }})</span>
                    <span id="tab-due" class="tab" style="font-weight:500;color:#374151;cursor:pointer;">Due ({{ count($grouped['due']) }})</span>
                </div>
                <div id="tasks-container" style="display:flex;flex-wrap:wrap;gap:24px;">
                    @foreach(['todo','in_progress','completed','due'] as $tab)
                        @foreach($grouped[$tab] as $task)
                            <div class="task-card" data-status="{{ $tab }}" style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:18px 20px;width:260px;display:{{ $tab == 'todo' ? '' : 'none' }};">
                                <div style="background:@if($tab=='critical')#ef4444;@else #7c83e7;@endif;color:#fff;font-weight:600;border-radius:4px;padding:4px 12px;display:inline-block;margin-bottom:8px;">
                                    {{ ucfirst(str_replace('_',' ', $tab)) }}
                                </div>
                                <div style="font-weight:600;font-size:1.1rem;color:#222;margin-bottom:4px;">{{ $task->title }}</div>
                                <div style="color:#444;font-size:0.98rem;margin-bottom:12px;">{{ $task->description }}</div>
                                <div style="font-size:0.95rem;color:#888;margin-bottom:8px;">Priority: {{ ucfirst(str_replace('_',' ', $task->priority)) }}</div>
                                <div style="display:flex;align-items:center;justify-content:space-between;font-size:0.95rem;color:#888;">
                                    <span><svg width="16" height="16" style="vertical-align:middle;margin-right:4px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x="9" y="9" x2="15" y2="9"/></svg> {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</span>
                                    <span>{{ $task->status == 'completed' ? '100%' : ($task->status == 'in_progress' ? '85%' : '0%') }}</span>
                                </div>
                                <div style="margin-top:10px;display:flex;gap:8px;flex-wrap:wrap;">
                                    @if($task->status == 'in_progress')
                                        <button style="background:#e5e7eb;color:#374151;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">File Organization</button>
                                        <button style="background:#e5e7eb;color:#374151;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">Material Handling</button>
                                        <button style="background:#e5e7eb;color:#374151;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">Assistance</button>
                                        <button style="background:#e5e7eb;color:#374151;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">Input Data</button>
                                    @endif
                                    @if($task->status == 'todo')
                                        <button class="task-action" data-id="{{ $task->id }}" data-status="in_progress" style="background:#7c83e7;color:#fff;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">Start</button>
                                    @elseif($task->status == 'in_progress')
                                        <button class="task-action" data-id="{{ $task->id }}" data-status="completed" style="background:#22c55e;color:#fff;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">Complete</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var profile = document.getElementById('profileDropdown');
    var menu = document.getElementById('logoutMenu');
    profile.addEventListener('click', function(e) {
        e.stopPropagation();
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });
    // Tab switching logic (robust mapping for all tabs, outside profile click)
    var tabs = document.querySelectorAll('.tab');
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            tabs.forEach(function(t) {
                t.classList.remove('active');
                t.style.borderBottom = '';
            });
            tab.classList.add('active');
            tab.style.borderBottom = '3px solid #7c83e7';
            tab.style.paddingBottom = '2px';
            var status = tab.id.replace('tab-','');
            // Normalize status mapping for all tabs
            if (status === 'inprogress' || status === 'in_progress') status = 'in_progress';
            if (status === 'completed') status = 'completed';
            if (status === 'todo') status = 'todo';
            if (status === 'due') status = 'due';
            var cards = document.querySelectorAll('.task-card');
            cards.forEach(function(card) {
                card.style.display = card.getAttribute('data-status') === status ? '' : 'none';
            });
        });
    });
    document.addEventListener('click', function() {
    if (menu.style.display === 'block') menu.style.display = 'none';
    });
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
                    // Update button
                    var btn = card.querySelector('.task-action');
                    if (btn) {
                        if (newStatus === 'in_progress') {
                            btn.textContent = 'Complete';
                            btn.setAttribute('data-status', 'completed');
                            btn.style.background = '#22c55e';
                        } else if (newStatus === 'completed') {
                            btn.remove();
                        }
                    }
                    // Instantly show/hide card based on active tab
                    var activeTab = document.querySelector('.tab.active').id.replace('tab-','');
                    if (activeTab === newStatus) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                    // Update tab counts
                    var todoTab = document.getElementById('tab-todo');
                    var inProgressTab = document.getElementById('tab-in_progress');
                    var completedTab = document.getElementById('tab-completed');
                    var todoCount = document.querySelectorAll('.task-card[data-status="todo"]').length;
                    var inProgressCount = document.querySelectorAll('.task-card[data-status="in_progress"]').length;
                    var completedCount = document.querySelectorAll('.task-card[data-status="completed"]').length;
                    todoTab.innerHTML = todoTab.innerHTML.replace(/\(\d+\)/, '(' + todoCount + ')');
                    inProgressTab.innerHTML = inProgressTab.innerHTML.replace(/\(\d+\)/, '(' + inProgressCount + ')');
                    completedTab.innerHTML = completedTab.innerHTML.replace(/\(\d+\)/, '(' + completedCount + ')');
                } else {
                    alert('Failed to update task status.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
});
</script>
@endsection

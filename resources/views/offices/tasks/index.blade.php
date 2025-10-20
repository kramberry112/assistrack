@extends('layouts.app')

@section('page-title')
    TASKS REQUEST
@endsection

@section('page-icon')
    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2">
        <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"/>
        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
        <path d="M9 14l2 2 4-4"/>
    </svg>
@endsection

@section('content')
<style>
    
     /* Tasks Request Styles */
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
    .btn-create-task {
        padding: 10px 20px;
        background: #6366f1;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
        white-space: nowrap;
    }
    .btn-create-task:hover {
        background: #4f46e5;
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



        <div class="tasks-controls">
            <div class="search-box">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <input type="text" placeholder="Search Student" id="searchInput">
            </div>
            <select class="filter-dropdown" id="filterDropdown">
                <option value="">Filter by Status</option>
                <option value="pending">Pending</option>
                <option value="verified">Verified</option>
                <option value="rejected">Rejected</option>
            </select>
            <button id="openCreateTaskModal" class="btn-create-task" style="margin-left:16px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Create Task
            </button>

            <!-- Modal for Create Task -->
            <div id="createTaskModal" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.18);z-index:9999;align-items:center;justify-content:center;">
                <div style="background:#fff;border-radius:24px;max-width:420px;width:100%;margin:auto;padding:32px 32px 24px 32px;box-shadow:0 8px 32px rgba(0,0,0,0.12);position:relative;">
                    <h2 style="text-align:center;font-size:1.6rem;font-weight:700;color:#3730a3;margin-bottom:24px;">Create New Task</h2>
                    @if(session('success'))
                        <div id="modalSuccessMsg" style="background:#d1fae5;color:#065f46;padding:12px 20px;border-radius:8px;margin-bottom:16px;text-align:center;font-weight:600;">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('tasks.store') }}" id="createTaskForm">
                        @csrf
                        <div style="margin-bottom:16px;">
                            <label for="modal_title" style="font-weight:600;">Title</label>
                            <textarea name="title" id="modal_title" required style="width:100%;padding:8px 12px;border-radius:8px;border:1px solid #d1d5db;margin-top:4px;"></textarea>
                        </div>
                        <div style="margin-bottom:16px;">
                            <label for="modal_description" style="font-weight:600;">Description</label>
                            <textarea name="description" id="modal_description" required style="width:100%;padding:8px 12px;border-radius:8px;border:1px solid #d1d5db;margin-top:4px;"></textarea>
                        </div>
                        <div style="margin-bottom:16px;">
                            <label for="modal_student_id" style="font-weight:600;">Student</label>
                            <select name="student_id" id="modal_student_id" required style="width:100%;padding:8px 12px;border-radius:8px;border:1px solid #d1d5db;margin-top:4px;">
                                <option value="">Select student</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->username }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="margin-bottom:16px;">
                            <label for="modal_priority" style="font-weight:600;">Level of Priority</label>
                            <select name="priority" id="modal_priority" required style="width:100%;padding:8px 12px;border-radius:8px;border:1px solid #d1d5db;margin-top:4px;">
                                <option value="">Select priority</option>
                                <option value="low" style="color:#f87171;">Critical</option>
                                <option value="medium" style="color:#fbbf24;">Medium</option>
                                <option value="high" style="color:#34d399;">Not Urgent</option>
                            </select>
                        </div>
                        <div style="margin-bottom:24px;">
                            <label for="modal_due_date" style="font-weight:600;">Due Date</label>
                            <input type="date" name="due_date" id="modal_due_date" required style="width:100%;padding:8px 12px;border-radius:8px;border:1px solid #d1d5db;margin-top:4px;">
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:12px;">
                            <button type="button" id="cancelCreateTask" style="background:#e5e7eb;color:#374151;padding:8px 24px;border:none;border-radius:8px;font-weight:500;">Cancel</button>
                            <button type="submit" id="submitCreateTask" style="background:#3730a3;color:#fff;padding:8px 24px;border:none;border-radius:8px;font-weight:600;">Create</button>
                        </div>
                    </form>
                </div>
            </div>
<script>
    // Modal open/close logic
    const openModalBtn = document.getElementById('openCreateTaskModal');
    const modal = document.getElementById('createTaskModal');
    const cancelBtn = document.getElementById('cancelCreateTask');
    const createTaskForm = document.getElementById('createTaskForm');
    openModalBtn.addEventListener('click', function() {
        modal.style.display = 'flex';
    });
    cancelBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    // Close modal when clicking outside the modal content
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // AJAX form submission for Create Task
    createTaskForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(createTaskForm);
        fetch(createTaskForm.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': formData.get('_token'),
            },
            body: formData
        })
        .then(response => {
            if (response.ok) {
                showModalSuccessMsg('Task created successfully!');
                setTimeout(() => {
                    modal.style.display = 'none';
                    location.reload();
                }, 1200);
            } else {
                response.text().then(text => alert('Error: ' + text));
            }
        })
        .catch(error => {
            alert('Error: ' + error);
        });
    });

    // Show success message inside modal, styled like student dashboard
    function showModalSuccessMsg(message) {
        let msg = document.getElementById('modalSuccessMsg');
        if (!msg) {
            msg = document.createElement('div');
            msg.id = 'modalSuccessMsg';
            msg.style.background = '#d1fae5';
            msg.style.color = '#065f46';
            msg.style.padding = '12px 20px';
            msg.style.borderRadius = '8px';
            msg.style.marginBottom = '16px';
            msg.style.textAlign = 'center';
            msg.style.fontWeight = '600';
            msg.style.fontSize = '1rem';
            const modalContent = modal.querySelector('div');
            modalContent.insertBefore(msg, modalContent.firstChild.nextSibling);
        }
        msg.textContent = message;
        msg.style.display = 'block';
    }

    // Toast message function
    function showSuccessToast(message) {
        let toast = document.createElement('div');
        toast.textContent = message;
        toast.style.position = 'absolute';
        toast.style.left = '50%';
        toast.style.bottom = '24px';
        toast.style.transform = 'translateX(-50%)';
        toast.style.background = '#10b981';
        toast.style.color = '#fff';
        toast.style.padding = '14px 32px';
        toast.style.borderRadius = '12px';
        toast.style.fontWeight = '600';
        toast.style.fontSize = '1rem';
        toast.style.zIndex = '10001';
        toast.style.boxShadow = '0 4px 16px rgba(16,185,129,0.15)';
        // Append to modal content
        const modalContent = modal.querySelector('div');
        modalContent.appendChild(toast);
        setTimeout(() => {
            toast.remove();
        }, 1100);
    }
</script>
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
                const status = row.cells[5].textContent.toLowerCase(); // Status column is index 5
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
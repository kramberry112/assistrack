@extends('layouts.app')

@section('page-title')
    TASKS OVERVIEW
@endsection

@section('page-icon')
    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2d2e83" stroke-width="2">
        <rect x="3" y="3" width="18" height="18" rx="2"/>
        <line x1="9" y1="9" x2="15" y2="9"/>
        <line x1="9" y1="15" x2="15" y2="15"/>
    </svg>
@endsection

@section('content')
<script>
window.currentUserId = {{ auth()->id() }};
</script>
<style>
    .highlight {
        background: #fff59d;
        color: #d97706;
        padding: 0 2px;
        border-radius: 4px;
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

    /* Filter Dropdown Styles */
    .filter-dropdown {
        position: relative;
        display: inline-block;
    }

    .filter-options {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        z-index: 100;
        min-width: 160px;
        margin-top: 4px;
    }

    .filter-options.show {
        display: block;
    }

    .filter-option {
        padding: 12px 16px;
        cursor: pointer;
        font-size: 0.95rem;
        font-weight: 500;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
        transition: background-color 0.2s;
    }

    .filter-option:last-child {
        border-bottom: none;
    }

    .filter-option:hover {
        background: #f9fafb;
    }

    .filter-option.active {
        background: #eff6ff;
        color: #2563eb;
        font-weight: 600;
    }

    .filter-btn.active {
        background: #2563eb;
        color: white;
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

    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        body {
            overflow-x: hidden !important;
        }

        .main-content {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100vw !important;
        }

        .page-header {
            margin: 0 !important;
            padding: 16px !important;
        }

        .content-area {
            margin: 0 !important;
            padding: 16px !important;
            width: 100% !important;
            max-width: 100vw !important;
            box-sizing: border-box !important;
        }

        .controls-section {
            flex-direction: column !important;
            gap: 12px !important;
            padding: 0 !important;
            margin: 0 0 16px 0 !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }

        .controls-right {
            flex-direction: column !important;
            gap: 12px !important;
            width: 100% !important;
        }

        .search-input {
            width: 100% !important;
            max-width: 100% !important;
            font-size: 16px !important; /* Prevents iOS zoom */
            box-sizing: border-box !important;
            margin: 0 !important;
        }

        .filter-btn, .create-btn {
            width: 100% !important;
            max-width: 100% !important;
            justify-content: center !important;
            padding: 12px !important;
            font-size: 0.9rem !important;
            box-sizing: border-box !important;
            margin: 0 !important;
        }

        .tabs-section {
            overflow-x: auto !important;
            scrollbar-width: none !important;
            -ms-overflow-style: none !important;
            padding: 0 !important;
            margin: 0 0 16px 0 !important;
            width: 100% !important;
            max-width: 100vw !important;
            box-sizing: border-box !important;
        }

        .tabs-section::-webkit-scrollbar {
            display: none !important;
        }

        .tab {
            white-space: nowrap !important;
            min-width: fit-content !important;
            font-size: 0.9rem !important;
            padding: 8px 16px !important;
        }

        .tasks-grid {
            grid-template-columns: 1fr !important;
            gap: 16px !important;
            padding: 0 !important;
            width: 100% !important;
            max-width: 100vw !important;
            box-sizing: border-box !important;
            margin: 0 !important;
        }

        .task-card {
            padding: 16px !important;
        }

        .task-header {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 8px !important;
        }

        .task-title {
            font-size: 1rem !important;
            line-height: 1.4 !important;
        }

        .task-priority {
            align-self: flex-end !important;
        }

        .task-meta {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 8px !important;
        }

        .task-actions {
            flex-direction: column !important;
            gap: 8px !important;
            margin-top: 16px !important;
        }

        .task-action {
            width: 100% !important;
            justify-content: center !important;
            padding: 12px !important;
            font-size: 0.9rem !important;
        }

        /* Modal Mobile Styles */
        .modal-content {
            width: 95% !important;
            max-width: none !important;
            margin: 10px !important;
            max-height: 90vh !important;
            overflow-y: auto !important;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            font-size: 16px !important; /* Prevents iOS zoom */
            padding: 12px !important;
        }

        .form-actions {
            flex-direction: column !important;
            gap: 12px !important;
        }

        .btn {
            width: 100% !important;
            padding: 12px !important;
            font-size: 0.9rem !important;
        }
    }

    @media (max-width: 480px) {
        .content-area {
            padding: 12px !important;
        }

        .task-card {
            padding: 12px !important;
        }

        .task-title {
            font-size: 0.9rem !important;
        }

        .task-description {
            font-size: 0.85rem !important;
        }

        .task-action {
            padding: 10px !important;
            font-size: 0.85rem !important;
        }
    }
</style>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Controls -->
            <div class="controls-section">
                <input type="text" placeholder="Search" class="search-input">
                <div class="controls-right">
                    <div class="filter-dropdown">
                        <button id="filterBtn" class="filter-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                            </svg>
                            <span id="filterText">All Tasks</span>
                        </button>
                        <div id="filterOptions" class="filter-options">
                            <div class="filter-option active" data-filter="all">All Tasks</div>
                            <div class="filter-option" data-filter="todo">To-Do</div>
                            <div class="filter-option" data-filter="in_progress">In Progress</div>
                            <div class="filter-option" data-filter="completed">Completed</div>
                            <div class="filter-option" data-filter="due">Due</div>
                        </div>
                    </div>
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
                                    <span class="status-badge" style="background:#fee2e2;color:#b91c1c;margin-left:10px;padding:4px 12px;border-radius:12px;font-size:0.8rem;font-weight:600;">Rejected ❌</span>
                                @elseif(isset($task->verified) && $task->verified)
                                    <span class="status-badge status-completed" style="background:#d1fae5;color:#065f46;margin-left:10px;padding:4px 12px;border-radius:12px;font-size:0.8rem;font-weight:600;">Verified ✅</span>
                                @else
                                    <span class="status-badge status-pending" style="background:#fef3c7;color:#92400e;margin-left:10px;padding:4px 12px;border-radius:12px;font-size:0.8rem;font-weight:600;">Pending ⏳</span>
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
                                        <button class="task-action start" data-id="{{ $task->id }}" data-status="in_progress" disabled style="background:#fee2e2;color:#b91c1c;cursor:not-allowed;" title="This task was rejected">❌ Rejected</button>
                                    @elseif(isset($task->verified) && $task->verified)
                                        <button class="task-action start" data-id="{{ $task->id }}" data-status="in_progress" style="background:#7c83e7;color:#fff;" title="Task is verified, you can start">▶️ Start</button>
                                    @else
                                        <button class="task-action start" data-id="{{ $task->id }}" data-status="in_progress" disabled style="background:#e5e7eb;color:#888;cursor:not-allowed;" title="Waiting for verification">⏳ Pending</button>
                                    @endif
                                @elseif($task->status == 'in_progress')
                                    <button class="task-action complete" data-id="{{ $task->id }}" data-status="completed" style="background:#22c55e;color:#fff;" title="Complete this task">✅ Complete</button>
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
                        <input id="taskTitle" name="title" type="text" required class="form-input" style="min-height:40px;" />
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
                            <span class="status-badge status-pending" style="background:#fef3c7;color:#92400e;margin-left:10px;padding:4px 12px;border-radius:12px;font-size:0.8rem;font-weight:600;">Pending ⏳</span>
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
                            <button class="task-action start" data-id="${data.task.id}" data-status="in_progress" disabled style="background:#e5e7eb;color:#888;cursor:not-allowed;" title="Waiting for verification">⏳ Pending</button>
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
                            // Check if current filter allows this card
                            if (currentFilter === 'all' || card.getAttribute('data-status') === currentFilter) {
                                card.style.display = '';
                                var regex = new RegExp('('+keyword.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')+')', 'gi');
                                titleSpan.innerHTML = originalTitle.replace(regex, '<span class="highlight">$1</span>');
                                if (!firstMatch) firstMatch = card;
                            } else {
                                card.style.display = 'none';
                            }
                        } else {
                            card.style.display = 'none';
                            titleSpan.innerHTML = originalTitle;
                        }
                    });
                    if (firstMatch) {
                        firstMatch.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                } else {
                    // Restore previous state based on current filter
                    cards.forEach(function(card) {
                        var titleSpan = card.querySelector('.task-title');
                        if (!titleSpan) return;
                        var originalTitle = titleSpan.getAttribute('data-original') || titleSpan.textContent;
                        titleSpan.innerHTML = originalTitle;
                    });
                    
                    // Apply current filter
                    if (currentFilter === 'all') {
                        if (lastActiveTab) {
                            lastActiveTab.classList.add('active');
                        }
                        var activeTab = document.querySelector('.tab.active');
                        var status = activeTab ? activeTab.id.replace('tab-','') : 'todo';
                        if (status === 'inprogress' || status === 'in_progress') status = 'in_progress';
                        cards.forEach(function(card) {
                            if (card.getAttribute('data-status') === status) {
                                card.style.display = '';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    } else {
                        applyFilter(currentFilter);
                    }
                    lastActiveTab = null;
                }
            });
        }
    // Listen for office verification event to update dashboard instantly
    window.addEventListener('task-verified', function(e) {
        // Find the task card and update its verified status
        var taskId = e.detail.taskId;
        var card = document.querySelector('.task-card[data-task-id="' + taskId + '"]');
        if (card) {
            // Mark as verified visually
            var statusBadge = card.querySelector('.status-badge');
            if (statusBadge) {
                statusBadge.textContent = 'Verified';
                statusBadge.className = 'status-badge status-completed';
                statusBadge.style.background = '#d1fae5';
                statusBadge.style.color = '#065f46';
            }
            // Enable Start button
            var startBtn = card.querySelector('.task-action.start');
            if (startBtn) {
                startBtn.disabled = false;
                startBtn.style.background = '#7c83e7';
                startBtn.style.color = '#fff';
                startBtn.style.cursor = 'pointer';
            }
        }
        updateTabCounts();
        
        // Update notifications in layout header
        if (window.updateNotificationCount) {
            window.updateNotificationCount();
        }
    });

    // Listen for office rejection event to update dashboard instantly
    window.addEventListener('task-rejected', function(e) {
        var taskId = e.detail.taskId;
        var card = document.querySelector('.task-card[data-task-id="' + taskId + '"]');
        if (card) {
            // Mark as rejected visually
            var statusBadge = card.querySelector('.status-badge');
            if (statusBadge) {
                statusBadge.textContent = 'Rejected';
                statusBadge.className = 'status-badge';
                statusBadge.style.background = '#fee2e2';
                statusBadge.style.color = '#b91c1c';
            }
            // Disable Start button
            var startBtn = card.querySelector('.task-action.start');
            if (startBtn) {
                startBtn.disabled = true;
                startBtn.style.background = '#e5e7eb';
                startBtn.style.color = '#888';
                startBtn.style.cursor = 'not-allowed';
                startBtn.textContent = 'Start (Rejected)';
            }
        }
        updateTabCounts();
        
        // Update notifications in layout header
        if (window.updateNotificationCount) {
            window.updateNotificationCount();
        }
    });

    // Filter functionality
    var filterBtn = document.getElementById('filterBtn');
    var filterOptions = document.getElementById('filterOptions');
    var filterText = document.getElementById('filterText');
    var currentFilter = 'all';
    
    if (filterBtn && filterOptions && filterText) {
        // Toggle filter dropdown
        filterBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            filterOptions.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!filterBtn.contains(e.target) && !filterOptions.contains(e.target)) {
                filterOptions.classList.remove('show');
            }
        });
        
        // Handle filter option selection
        filterOptions.addEventListener('click', function(e) {
            if (e.target.classList.contains('filter-option')) {
                var selectedFilter = e.target.getAttribute('data-filter');
                var selectedText = e.target.textContent;
                
                // Update UI
                document.querySelectorAll('.filter-option').forEach(function(option) {
                    option.classList.remove('active');
                });
                e.target.classList.add('active');
                
                filterText.textContent = selectedText;
                currentFilter = selectedFilter;
                
                // Update filter button appearance
                if (selectedFilter === 'all') {
                    filterBtn.classList.remove('active');
                } else {
                    filterBtn.classList.add('active');
                }
                
                // Apply filter
                applyFilter(selectedFilter);
                
                // Close dropdown
                filterOptions.classList.remove('show');
            }
        });
        
        // Filter function
        function applyFilter(filter) {
            var cards = document.querySelectorAll('.task-card');
            var tabs = document.querySelectorAll('.tab');
            
            if (filter === 'all') {
                // Show all cards based on active tab
                var activeTab = document.querySelector('.tab.active');
                if (activeTab) {
                    var tabStatus = activeTab.id.replace('tab-', '');
                    cards.forEach(function(card) {
                        card.style.display = card.getAttribute('data-status') === tabStatus ? '' : 'none';
                    });
                }
                // Enable tabs
                tabs.forEach(function(tab) {
                    tab.style.pointerEvents = 'auto';
                    tab.style.opacity = '1';
                });
            } else {
                // Show only cards matching the filter
                cards.forEach(function(card) {
                    card.style.display = card.getAttribute('data-status') === filter ? '' : 'none';
                });
                
                // Disable tabs and activate the corresponding one
                tabs.forEach(function(tab) {
                    tab.classList.remove('active');
                    if (tab.id === 'tab-' + filter) {
                        tab.classList.add('active');
                    }
                    tab.style.pointerEvents = 'none';
                    tab.style.opacity = '0.6';
                });
            }
        }
        
        // Override tab click when filter is active
        document.querySelectorAll('.tab').forEach(function(tab) {
            tab.addEventListener('click', function(e) {
                if (currentFilter !== 'all') {
                    e.preventDefault();
                    return false;
                }
            });
        });
    }
});
</script>
@vite(['resources/js/app.js'])

@endsection
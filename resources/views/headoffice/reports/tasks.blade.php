@extends('layouts.app')

@section('page-title')
    <i class="bi bi-list-ul" style="margin-right: 8px;"></i>
    Tasks Report
@endsection

@section('content')
<style>
    .content-wrapper {
        background: #fff !important;
    }
    .admin-content-wrapper {
        background: #fff !important;
    }
</style>
<div style="padding: 24px; background: #fff; min-height: calc(100vh - 76px);">
    
    <!-- Filter Button -->
    <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
        <button onclick="toggleFilters()" class="filter-btn" style="display: flex; align-items: center; gap: 6px; background: #6366f1; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 500;">
            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            Filters
        </button>
    </div>
    
    <!-- Filter Panel -->
    <div id="filterPanel" style="display: none; background: #f8f9fa; border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
            <div>
                <label style="display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px;">Office</label>
                <select id="officeFilter" onchange="applyFilters()" style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
                    <option value="">All Offices</option>
                    <option value="ACADS">ACADS</option>
                    <option value="ALUMNI OFFICE">ALUMNI OFFICE</option>
                    <option value="ARCHIVING">ARCHIVING</option>
                    <option value="ARZATECH">ARZATECH</option>
                    <option value="CANTEEN">CANTEEN</option>
                    <option value="CLINIC">CLINIC</option>
                    <option value="FINANCE">FINANCE</option>
                    <option value="GUIDANCE">GUIDANCE</option>
                    <option value="HRD">HRD</option>
                    <option value="KUWAGO">KUWAGO</option>
                    <option value="LCR">LCR</option>
                    <option value="LIBRARY">LIBRARY</option>
                    <option value="LINKAGES">LINKAGES</option>
                    <option value="MARKETING">MARKETING</option>
                    <option value="OPEN LAB">OPEN LAB</option>
                    <option value="PRESIDENT'S OFFICE">PRESIDENT'S OFFICE</option>
                    <option value="QUEUING">QUEUING</option>
                    <option value="QUALITY ASSURANCE">QUALITY ASSURANCE</option>
                    <option value="REGISTRAR">REGISTRAR</option>
                    <option value="SAO">SAO</option>
                    <option value="SBA FACULTY">SBA FACULTY</option>
                    <option value="SIHM FACULTY">SIHM FACULTY</option>
                    <option value="SITE FACULTY">SITE FACULTY</option>
                    <option value="SOE FACULTY">SOE FACULTY</option>
                    <option value="SOH FACULTY">SOH FACULTY</option>
                    <option value="SOHS FACULTY">SOHS FACULTY</option>
                    <option value="SOC FACULTY">SOC FACULTY</option>
                    <option value="SPORTS AND CULTURE">SPORTS AND CULTURE</option>
                    <option value="STE DEAN'S OFFICE">STE DEAN'S OFFICE</option>
                    <option value="STE FACULTY">STE FACULTY</option>
                    <option value="STEEDS">STEEDS</option>
                    <option value="XACTO">XACTO</option>
                </select>
            </div>
            <div>
                <label style="display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px;">Task Count</label>
                <select id="taskFilter" onchange="applyFilters()" style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
                    <option value="">All</option>
                    <option value="0">0 tasks</option>
                    <option value="1-5">1-5 tasks</option>
                    <option value="6-10">6-10 tasks</option>
                    <option value="10+">10+ tasks</option>
                </select>
            </div>
            <div>
                <label style="display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px;">Search</label>
                <input type="text" id="searchFilter" oninput="applyFilters()" placeholder="Search by name or ID..." style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
            </div>
            <div style="display: flex; align-items: flex-end;">
                <button onclick="clearFilters()" style="background: #6b7280; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 14px; width: 100%;">
                    Clear Filters
                </button>
            </div>
        </div>
    </div>

<style>
    .page-header {
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 600;
        color: #7c3aed;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .main-content-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .reports-table {
        width: 100%;
        border-collapse: collapse;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    
    .reports-table thead tr {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .reports-table th {
        padding: 18px 16px;
        text-align: left;
        font-weight: 600;
        color: #ffffff;
        font-size: 14px;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .reports-table th:first-child {
        border-top-left-radius: 8px;
    }

    .reports-table th:last-child {
        border-top-right-radius: 8px;
    }
    
    .reports-table tbody tr {
        border-bottom: 1px solid #e9ecef;
        transition: background-color 0.2s ease;
    }

    .reports-table tbody tr:last-child {
        border-bottom: none;
    }
    
    .reports-table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .reports-table td {
        padding: 18px 16px;
        color: #495057;
        font-size: 14px;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .empty-state-text {
        font-size: 16px;
        font-weight: 500;
    }

    .task-count-badge {
        display: inline-block;
        background-color: #e7f3ff;
        color: #0066cc;
        padding: 4px 12px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 13px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    
    .btn-primary {
        background: #6366f1;
        color: #ffffff;
    }
    
    .btn-primary:hover {
        background: #4f46e5;
    }
    
    .btn-sm {
        padding: 4px 8px;
        font-size: 11px;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        /* Container adjustments */
        div[style*="padding: 24px"] {
            padding: 16px !important;
        }
        
        .main-content-card {
            padding: 20px !important;
            margin: 0 !important;
        }
        
        /* Hide table on mobile */
        .reports-table {
            display: none;
        }
        
        /* Show mobile cards instead */
        .mobile-report-cards {
            display: block !important;
        }
        
        .report-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        
        .report-card-header {
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .report-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 8px 0;
        }
        
        .report-card-subtitle {
            font-size: 0.9rem;
            color: #6b7280;
            margin: 0;
        }
        
        .report-card-details {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .report-detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .report-detail-label {
            font-size: 0.9rem;
            color: #6b7280;
            font-weight: 500;
        }
        
        .report-detail-value {
            font-size: 0.9rem;
            color: #111827;
            font-weight: 600;
        }
        
        /* Office filter notice */
        div[style*="background: #e0f2fe"] {
            padding: 12px 16px !important;
            margin-bottom: 16px !important;
            border-radius: 8px !important;
        }
        
        /* Empty state adjustments */
        .empty-state {
            padding: 30px 20px !important;
        }
        
        .empty-state-icon {
            font-size: 36px !important;
        }
        
        .empty-state-text {
            font-size: 14px !important;
        }
    }
    
    @media (max-width: 480px) {
        div[style*="padding: 24px"] {
            padding: 12px !important;
        }
        
        .report-card {
            padding: 16px !important;
        }
        
        .report-card-title {
            font-size: 1rem !important;
        }
    }
    
    /* Desktop - hide mobile cards */
    .mobile-report-cards {
        display: none;
    }
</style>

    @if(isset($currentUser) && $currentUser->role === 'offices')
        <div style="background: #e0f2fe; border-left: 4px solid #0277bd; padding: 12px 16px; margin-bottom: 20px; border-radius: 4px;">
            <p style="margin: 0; color: #01579b; font-weight: 600;">
                📍 Showing tasks for: {{ $currentUser->office_name ?? 'Your Office' }}
            </p>
        </div>
    @endif

    <!-- Desktop Table View -->
    <table class="reports-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Designated Office</th>
                <th>Tasks Completed</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr id="noResults" style="display: none;">
                <td colspan="5" style="text-align: center; padding: 40px; background: #f9fafb;">
                    <svg style="width: 48px; height: 48px; margin: 0 auto 16px; color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p style="color: #6b7280; font-size: 14px; margin: 0;">No matching records found</p>
                </td>
            </tr>
            @forelse($students as $user)
                <tr>
                    <td>{{ $user->student->id_number ?? 'N/A' }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->student->designated_office ?? 'Not Assigned' }}</td>
                    <td>
                        <span class="task-count-badge">{{ $user->student_tasks_count }}</span>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="viewUserTasks({{ $user->id }}, '{{ addslashes($user->name) }}')">
                            <svg style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Tasks
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <div class="empty-state-icon">📋</div>
                            <div class="empty-state-text">
                                @if(isset($currentUser) && $currentUser->role === 'offices')
                                    No completed tasks found for {{ $currentUser->office_name ?? 'your office' }}
                                @else
                                    No completed tasks found
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- Mobile Card View -->
    <div class="mobile-report-cards">
        @forelse($students as $user)
            <div class="report-card">
                <div class="report-card-header">
                    <h3 class="report-card-title">{{ $user->name }}</h3>
                    <p class="report-card-subtitle">{{ $user->student->id_number ?? 'N/A' }}</p>
                </div>
                <div class="report-card-details">
                    <div class="report-detail-item">
                        <span class="report-detail-label">Designated Office</span>
                        <span class="report-detail-value">{{ $user->student->designated_office ?? 'Not Assigned' }}</span>
                    </div>
                    <div class="report-detail-item">
                        <span class="report-detail-label">Tasks Completed</span>
                        <span class="task-count-badge">{{ $user->student_tasks_count }}</span>
                    </div>
                    <button class="btn btn-primary" onclick="viewUserTasks({{ $user->id }}, '{{ addslashes($user->name) }}')" 
                            style="width: 100%; margin-top: 12px; padding: 8px 16px;">
                        <svg style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View Tasks
                    </button>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-state-icon">📋</div>
                <div class="empty-state-text">
                    @if(isset($currentUser) && $currentUser->role === 'offices')
                        No completed tasks found for {{ $currentUser->office_name ?? 'your office' }}
                    @else
                        No completed tasks found
                    @endif
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Task Modal -->
<div id="taskModal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
    <div id="modalContainer" style="background-color: #fff; margin: 5% auto; padding: 0; border-radius: 12px; width: 90%; max-width: 800px; max-height: 80vh; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
        <div id="modalHeader" style="padding: 20px 24px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; background: #f8fafc;">
            <h3 id="modalTitle" style="margin: 0; font-size: 1.2rem; font-weight: 600; color: #111827; flex: 1; padding-right: 16px; word-wrap: break-word;">Tasks for Student</h3>
            <button onclick="closeTaskModal()" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #6b7280; padding: 0; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px; flex-shrink: 0;">
                &times;
            </button>
        </div>
        <div id="modalContent" style="padding: 24px; max-height: 60vh; overflow-y: auto;">
            <div style="text-align: center; padding: 40px; color: #6b7280;">
                <div style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;">⏳</div>
                <div>Loading tasks...</div>
            </div>
        </div>
    </div>
</div>

<style>
/* Modal responsive styles */
@media (max-width: 768px) {
    #modalContainer {
        margin: 2% auto !important;
        width: 95% !important;
        max-height: 90vh !important;
        border-radius: 8px !important;
    }
    
    #modalHeader {
        padding: 16px 20px !important;
    }
    
    #modalTitle {
        font-size: 1rem !important;
        line-height: 1.3 !important;
    }
    
    #modalContent {
        padding: 16px !important;
        max-height: 70vh !important;
    }
    
    #modalContent > div > div {
        padding: 12px !important;
        margin-bottom: 8px !important;
    }
    
    #modalContent h4 {
        font-size: 0.95rem !important;
    }
    
    #modalContent p {
        font-size: 0.85rem !important;
    }
}

@media (max-width: 480px) {
    #modalContainer {
        margin: 1% auto !important;
        width: 98% !important;
        max-height: 95vh !important;
    }
    
    #modalHeader {
        padding: 12px 16px !important;
    }
    
    #modalContent {
        padding: 12px !important;
        max-height: 75vh !important;
    }
}
</style>

<script>
function viewUserTasks(userId, userName) {
    document.getElementById('modalTitle').textContent = 'Tasks for ' + userName;
    document.getElementById('taskModal').style.display = 'block';
    
    // Reset content
    document.getElementById('modalContent').innerHTML = `
        <div style="text-align: center; padding: 40px; color: #6b7280;">
            <div style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;">⏳</div>
            <div>Loading tasks...</div>
        </div>
    `;
    
    // Fetch tasks
    fetch('/head/tasks/user/' + userId)
        .then(response => response.json())
        .then(data => {
            displayTasks(data.tasks);
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('modalContent').innerHTML = `
                <div style="text-align: center; padding: 40px; color: #ef4444;">
                    <div style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;">❌</div>
                    <div>Error loading tasks</div>
                </div>
            `;
        });
}

function displayTasks(tasks) {
    if (tasks.length === 0) {
        document.getElementById('modalContent').innerHTML = `
            <div style="text-align: center; padding: 40px; color: #6b7280;">
                <div style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;">📋</div>
                <div>No completed tasks found</div>
            </div>
        `;
        return;
    }
    
    let html = '<div style="space-y: 16px;">';
    tasks.forEach((task, index) => {
        const completedDate = new Date(task.updated_at);
        const formattedDate = completedDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        const formattedTime = completedDate.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit'
        });
        
        html += `
            <div style="padding: 16px; border: 1px solid #e5e7eb; border-radius: 8px; background: #fff; margin-bottom: 12px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                    <h4 style="margin: 0; font-size: 1rem; font-weight: 600; color: #111827;">${task.title}</h4>
                    <span style="background: #d1fae5; color: #065f46; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 500;">Completed</span>
                </div>
                <p style="margin: 8px 0; color: #6b7280; font-size: 0.9rem; line-height: 1.4;">${task.description}</p>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px; padding-top: 8px; border-top: 1px solid #f3f4f6;">
                    <span style="font-size: 0.8rem; color: #6b7280;">Completed on:</span>
                    <span style="font-size: 0.85rem; font-weight: 500; color: #111827;">${formattedDate} at ${formattedTime}</span>
                </div>
            </div>
        `;
    });
    html += '</div>';
    
    document.getElementById('modalContent').innerHTML = html;
}

function closeTaskModal() {
    document.getElementById('taskModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('taskModal');
    if (event.target === modal) {
        closeTaskModal();
    }
}

function toggleFilters() {
    const panel = document.getElementById('filterPanel');
    panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
}

function applyFilters() {
    const officeFilter = document.getElementById('officeFilter').value.toLowerCase();
    const taskFilter = document.getElementById('taskFilter').value;
    const searchFilter = document.getElementById('searchFilter').value.toLowerCase();
    
    const table = document.querySelector('.reports-table tbody');
    const rows = table.querySelectorAll('tr');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length <= 1) return; // Skip empty row
        
        const idNumber = cells[0]?.textContent.trim().toLowerCase() || '';
        const name = cells[1]?.textContent.trim().toLowerCase() || '';
        const office = cells[2]?.textContent.trim().toLowerCase() || '';
        const taskCountText = cells[3]?.textContent.trim() || '0';
        const taskCount = parseInt(taskCountText) || 0;
        
        const officeMatch = !officeFilter || office.includes(officeFilter);
        const searchMatch = !searchFilter || name.includes(searchFilter) || idNumber.includes(searchFilter);
        
        let taskMatch = true;
        if (taskFilter) {
            if (taskFilter === '0') {
                taskMatch = taskCount === 0;
            } else if (taskFilter === '1-5') {
                taskMatch = taskCount >= 1 && taskCount <= 5;
            } else if (taskFilter === '6-10') {
                taskMatch = taskCount >= 6 && taskCount <= 10;
            } else if (taskFilter === '10+') {
                taskMatch = taskCount > 10;
            }
        }
        
        if (officeMatch && taskMatch && searchMatch) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Show/hide no results message
    const noResults = document.getElementById('noResults');
    if (visibleCount === 0) {
        noResults.style.display = 'table-row';
    } else {
        noResults.style.display = 'none';
    }
}

function clearFilters() {
    document.getElementById('officeFilter').value = '';
    document.getElementById('taskFilter').value = '';
    document.getElementById('searchFilter').value = '';
    applyFilters();
}
</script>

@endsection
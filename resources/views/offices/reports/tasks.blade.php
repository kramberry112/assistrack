@extends('layouts.app')

@section('page-title')
    <i class="bi bi-list-ul" style="margin-right: 8px;"></i>
    Tasks Report
@endsection

@section('content')
<style>
    .content-wrapper { background: #fff !important; }
    .admin-content-wrapper { background: #fff !important; }
    .reports-table { width: 100%; border-collapse: collapse; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
    .reports-table thead tr { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .reports-table th { padding: 18px 16px; text-align: left; font-weight: 600; color: #ffffff; font-size: 14px; border: none; text-transform: uppercase; letter-spacing: 0.5px; }
    .reports-table th:first-child { border-top-left-radius: 8px; }
    .reports-table th:last-child { border-top-right-radius: 8px; }
    .reports-table tbody tr { border-bottom: 1px solid #e9ecef; transition: background-color 0.2s ease; }
    .reports-table tbody tr:last-child { border-bottom: none; }
    .reports-table tbody tr:hover { background-color: #f8f9fa; }
    .reports-table td { padding: 18px 16px; color: #495057; font-size: 14px; }
    .empty-state { text-align: center; padding: 40px 20px; color: #6c757d; }
    .empty-state-icon { font-size: 48px; margin-bottom: 16px; opacity: 0.5; }
    .empty-state-text { font-size: 16px; font-weight: 500; }
    .task-count-badge { display: inline-block; background-color: #e7f3ff; color: #0066cc; padding: 4px 12px; border-radius: 12px; font-weight: 600; font-size: 13px; }
</style>
<div style="padding: 24px; background: #fff; min-height: calc(100vh - 76px);">
<style>
    /* ...existing styles for table, cards, badges, etc... */
</style>
    
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
    
    <table class="reports-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Designated Office</th>
                <th>Tasks Completed</th>
            </tr>
        </thead>
        <tbody>
            @forelse($studentsWithTasks as $user)
                <tr>
                    <td>{{ $user->student->id_number ?? 'N/A' }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->student->designated_office ?? 'Not Assigned' }}</td>
                    <td>
                        <span class="task-count-badge">{{ $user->student_tasks_count }}</span>
                        <button class="view-tasks-btn" onclick="showTasksModal({{ $user->id }}, '{{ $user->name }}')"
                                style="margin-left: 10px; background: #3b82f6; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                            <i class="bi bi-eye"></i> View
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
        </tbody>
    </table>
</div>

<!-- Tasks Modal -->
<div id="tasksModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; border-radius: 8px; padding: 24px; max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #e9ecef; padding-bottom: 12px;">
            <h3 id="modalTitle" style="margin: 0; color: #333; font-size: 18px;">Completed Tasks</h3>
            <button onclick="closeTasksModal()" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
        </div>
        <div id="modalContent" style="min-height: 100px;">
            <div style="text-align: center; padding: 20px; color: #666;">Loading...</div>
        </div>
    </div>
</div>

<script>
function showTasksModal(userId, userName) {
    document.getElementById('modalTitle').textContent = `Completed Tasks - ${userName}`;
    document.getElementById('tasksModal').style.display = 'block';
    
    // Fetch tasks via AJAX
    fetch(`/offices/reports/tasks/user/${userId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            let content = '';
            if (data.tasks && data.tasks.length > 0) {
                content = '<div style="space-y: 12px;">';
                data.tasks.forEach(task => {
                    const completedDate = new Date(task.updated_at).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    content += `
                        <div style="border: 1px solid #e9ecef; border-radius: 6px; padding: 16px; margin-bottom: 12px; background: #f8f9fa;">
                            <h4 style="margin: 0 0 8px 0; color: #333; font-size: 16px; font-weight: 600;">${task.title}</h4>
                            <p style="margin: 0 0 8px 0; color: #666; font-size: 14px;">${task.description || 'No description provided'}</p>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 12px; color: #28a745; font-weight: 500; background: #d4edda; padding: 4px 8px; border-radius: 12px;">✓ Completed</span>
                                <span style="font-size: 12px; color: #666;">Finished on: ${completedDate}</span>
                            </div>
                        </div>
                    `;
                });
                content += '</div>';
            } else {
                content = '<div style="text-align: center; padding: 20px; color: #666;">No completed tasks found</div>';
            }
            document.getElementById('modalContent').innerHTML = content;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('modalContent').innerHTML = '<div style="text-align: center; padding: 20px; color: #dc3545;">Error loading tasks</div>';
        });
}

function closeTasksModal() {
    document.getElementById('tasksModal').style.display = 'none';
}

// Close modal when clicking outside
document.getElementById('tasksModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeTasksModal();
    }
});

// Filter functions
function toggleFilters() {
    const panel = document.getElementById('filterPanel');
    panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
}

function applyFilters() {
    const searchValue = document.getElementById('searchFilter').value.toLowerCase();
    const table = document.querySelector('.reports-table tbody');
    const rows = table.getElementsByTagName('tr');
    
    let visibleCount = 0;
    for (let row of rows) {
        if (row.querySelector('.empty-state')) continue;
        
        const cells = row.getElementsByTagName('td');
        const studentId = cells[0]?.textContent.toLowerCase() || '';
        const name = cells[1]?.textContent.toLowerCase() || '';
        
        const matchesSearch = !searchValue || studentId.includes(searchValue) || name.includes(searchValue);
        
        if (matchesSearch) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    }
    
    // Show/hide no results message
    updateNoResultsMessage(table, visibleCount);
}

function clearFilters() {
    document.getElementById('searchFilter').value = '';
    applyFilters();
}

function updateNoResultsMessage(table, visibleCount) {
    let noResultsRow = table.querySelector('.no-results-row');
    
    if (visibleCount === 0) {
        if (!noResultsRow) {
            noResultsRow = document.createElement('tr');
            noResultsRow.className = 'no-results-row';
            noResultsRow.innerHTML = `
                <td colspan="4" style="text-align: center; padding: 40px; color: #6b7280;">
                    <svg style="width: 48px; height: 48px; margin: 0 auto 12px; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <div style="font-size: 16px; font-weight: 500;">No matching records found</div>
                    <div style="font-size: 14px; margin-top: 4px;">Try adjusting your filters</div>
                </td>
            `;
            table.appendChild(noResultsRow);
        }
        noResultsRow.style.display = '';
    } else if (noResultsRow) {
        noResultsRow.style.display = 'none';
    }
}
</script>

@endsection
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
    @if(isset($currentUser) && $currentUser->role === 'offices')
        <div style="background: #e0f2fe; border-left: 4px solid #0277bd; padding: 12px 16px; margin-bottom: 20px; border-radius: 4px;">
            <p style="margin: 0; color: #01579b; font-weight: 600;">
                📍 Showing tasks for: {{ $currentUser->office_name ?? 'Your Office' }}
            </p>
        </div>
    @endif
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
</script>

@endsection
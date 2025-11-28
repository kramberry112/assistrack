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
            </tr>
        </thead>
        <tbody>
            @forelse($students as $user)
                <tr>
                    <td>{{ $user->student->id_number ?? 'N/A' }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->student->designated_office ?? 'Not Assigned' }}</td>
                    <td>
                        <span class="task-count-badge">{{ $user->student_tasks_count }}</span>
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
@endsection
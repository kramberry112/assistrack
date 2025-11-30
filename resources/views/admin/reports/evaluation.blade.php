@extends('layouts.app')

@section('page-title')
    <i class="bi bi-graph-up-arrow" style="margin-right: 8px;"></i>
    Evaluation Report
@endsection

@section('content')
<style>
    .content-wrapper {
        background: #fff !important;
    }
    .admin-content-wrapper {
        background: #fff !important;
    }
    
    /* Hide mobile cards by default */
    .mobile-evaluation-cards {
        display: none;
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
        .mobile-evaluation-cards {
            display: block !important;
        }
        
        .evaluation-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        
        .evaluation-card-header {
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .evaluation-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 4px 0;
        }
        
        .evaluation-card-subtitle {
            font-size: 0.85rem;
            color: #6b7280;
            margin: 0;
        }
        
        .evaluation-card-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .evaluation-detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .evaluation-detail-label {
            font-size: 0.85rem;
            color: #6b7280;
            font-weight: 500;
        }
        
        .evaluation-detail-value {
            font-size: 0.9rem;
            color: #111827;
            font-weight: 600;
        }
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

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        margin-right: 4px;
    }

    .btn-primary {
        background: #6366f1;
        color: #ffffff;
    }

    .btn-primary:hover {
        background: #4f46e5;
    }

    .btn-warning {
        background: #f59e0b;
        color: #ffffff;
    }

    .btn-warning:hover {
        background: #d97706;
    }

    .btn-danger {
        background: #ef4444;
        color: #ffffff;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .btn-sm {
        padding: 4px 8px;
        font-size: 11px;
    }
</style>

    <table class="reports-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Office</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($evaluations as $evaluation)
                <tr>
                    <td>
                        <div class="text-sm font-medium text-gray-900">
                            {{ $evaluation->student->student_name ?? 'N/A' }}
                        </div>
                        <div class="text-xs text-gray-500">
                            Student ID: {{ $evaluation->student->id_number ?? 'N/A' }}
                        </div>
                    </td>
                    <td>
                        <span class="text-sm text-gray-700">{{ $evaluation->department }}</span>
                        <div class="text-xs text-gray-500">
                            Evaluated by: {{ $evaluation->evaluator->name ?? 'Unknown' }}
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.evaluations.view', $evaluation->id) }}" class="btn btn-primary btn-sm">
                            <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View
                        </a>
                        <div class="text-xs text-gray-500 mt-1">
                            Avg: {{ $evaluation->average_rating }}/5
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="empty-state">
                            <div class="empty-state-icon">📊</div>
                            <div class="empty-state-text">No evaluation records found</div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- Mobile Cards View -->
    <div class="mobile-evaluation-cards">
        @forelse($evaluations as $evaluation)
            <div class="evaluation-card">
                <div class="evaluation-card-header">
                    <h3 class="evaluation-card-title">{{ $evaluation->student->student_name ?? 'N/A' }}</h3>
                    <p class="evaluation-card-subtitle">Student ID: {{ $evaluation->student->id_number ?? 'N/A' }}</p>
                </div>
                
                <div class="evaluation-card-details">
                    <div class="evaluation-detail-item">
                        <span class="evaluation-detail-label">Department</span>
                        <span class="evaluation-detail-value">{{ $evaluation->department }}</span>
                    </div>
                    
                    <div class="evaluation-detail-item">
                        <span class="evaluation-detail-label">Evaluated by</span>
                        <span class="evaluation-detail-value">{{ $evaluation->evaluator->name ?? 'Unknown' }}</span>
                    </div>
                    
                    <div class="evaluation-detail-item">
                        <span class="evaluation-detail-label">Average Rating</span>
                        <span class="evaluation-detail-value">
                            <span style="display: inline-block; padding: 4px 12px; background: #d1fae5; color: #065f46; border-radius: 12px; font-size: 0.8rem; font-weight: 600;">
                                Avg: {{ $evaluation->average_rating }}/5
                            </span>
                        </span>
                    </div>
                    
                    <a href="{{ route('admin.evaluations.view', $evaluation->id) }}" 
                       style="display: inline-flex; align-items: center; justify-content: center; gap: 6px; padding: 12px 20px; background: #6366f1; color: white; border-radius: 8px; text-decoration: none; font-size: 0.9rem; font-weight: 500; width: 100%; margin-top: 12px;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View
                    </a>
                </div>
            </div>
        @empty
            <div class="evaluation-card">
                <div class="empty-state">
                    <div class="empty-state-icon">📊</div>
                    <div class="empty-state-text">No evaluation records found</div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
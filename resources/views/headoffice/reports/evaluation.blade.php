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
                        <a href="{{ route('head.evaluations.view', $evaluation->id) }}" class="btn btn-primary btn-sm">
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
</div>
@endsection
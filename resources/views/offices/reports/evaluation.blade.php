@extends('layouts.app')

@section('page-title')
    <i class="bi bi-graph-up-arrow" style="margin-right: 8px;"></i>
    Evaluation Report
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
    .mobile-evaluation-cards { display: none; }
</style>
<div style="padding: 24px; background: #fff; min-height: calc(100vh - 76px);">
<style>
    /* ...existing styles for table, cards, badges, etc... */
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
                @foreach($evaluations as $evaluation)
                <tr style="border-bottom:1px solid #f3f4f6;">
                    <td style="padding:14px 8px;vertical-align:top;">
                        <strong>{{ $evaluation->student->student_name }}</strong><br>
                        <span style="font-size:0.95em;color:#555;">Student ID: {{ $evaluation->student->id_number }}</span><br>
                        <span style="font-size:0.95em;color:#888;">Evaluated by: {{ $evaluation->evaluator->name ?? 'Unknown' }}</span>
                    </td>
                    <td style="padding:14px 8px;vertical-align:top;">{{ $evaluation->department }}</td>
                    <td style="padding:14px 8px;vertical-align:top;">
                        <a href="{{ route('offices.evaluations.view', $evaluation->id) }}" 
                           style="display: inline-block; background: #3b82f6; color: white; border: none; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: 500;">
                            <i class="bi bi-eye"></i> View
                        </a>
                        <div style="font-size: 11px; color: #666; margin-top: 4px;">
                            Avg: {{ $evaluation->average_rating }}/5
                        </div>
                    </td>
                </tr>
                @endforeach
                @if($evaluations->isEmpty())
                    <tr>
                        <td colspan="3">
                            <div class="empty-state">
                                <div class="empty-state-icon">📊</div>
                                <div class="empty-state-text">No evaluation records found</div>
                            </div>
                        </td>
                    </tr>
                @endif
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
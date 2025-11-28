@extends('layouts.app')

@section('page-title')
    <i class="bi bi-grid-3x3-gap" style="margin-right: 8px;"></i>
    Dashboard Overview
@endsection

@section('page-icon')
    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2">
        <rect x="3" y="3" width="7" height="7" rx="1"/>
        <rect x="14" y="3" width="7" height="7" rx="1"/>
        <rect x="14" y="14" width="7" height="7" rx="1"/>
        <rect x="3" y="14" width="7" height="7" rx="1"/>
    </svg>
@endsection

@section('content')
<style>
    body, .content-wrapper, .admin-content-wrapper {
        background: #fff !important;
        min-height: 100vh;
    }
    .welcome-section {
        padding: 36px 24px 24px 24px;
        background: #fff;
        box-shadow: 0 8px 32px rgba(80,80,180,0.10);
        max-width: 1100px;
        margin: 32px auto 0 auto;
        border-radius: 12px;
    }
    .welcome-message {
        font-size: 2rem;
        font-weight: 800;
        color: #000000 !important;
        margin: 0 0 4px 0;
        letter-spacing: 0.01em;
    }
    .welcome-subtitle {
        font-size: 1.1rem;
        color: #374151;
        margin-top: 4px;
        font-weight: 500;
    }
    .dashboard-stats {
        display: flex;
        flex-direction: row;
        gap: 20px;
        margin-top: 36px;
        justify-content: flex-start;
        flex-wrap: wrap;
        align-items: stretch;
    }
    .stat-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 32px 24px 28px 24px;
        text-align: left;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 18px;
        box-shadow: 0 4px 24px rgba(45,46,131,0.08);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        min-width: 220px;
        flex: 1 1 calc(20% - 16px);
        max-width: 280px;
        min-height: 120px;
        -webkit-tap-highlight-color: transparent;
    }
    .stat-card:hover {
        background: #f8fafc;
        box-shadow: 0 8px 32px rgba(45,46,131,0.13);
        transform: translateY(-2px);
        text-decoration: none;
        color: inherit;
    }
    
    .stat-card:active {
        transform: translateY(0px) scale(0.98);
        box-shadow: 0 2px 12px rgba(45,46,131,0.15);
    }
    .stat-icon {
        font-size: 2.2rem;
        color: #2d2e83;
        background: #f1f5f9;
        border-radius: 50%;
        padding: 14px;
        box-shadow: 0 2px 8px rgba(45,46,131,0.08);
        margin-bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .stat-number {
        font-size: 2.3rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.2rem;
    }
    .stat-label {
        font-size: 1.05rem;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        font-weight: 600;
        margin-top: 0.1rem;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        body {
            -webkit-text-size-adjust: 100%;
        }
        body {
            -webkit-text-size-adjust: 100%;
        }
        
        .welcome-section {
            padding: 20px 16px !important;
            margin: 12px !important;
            max-width: calc(100% - 24px) !important;
            border-radius: 16px !important;
        }

        .welcome-message {
            font-size: 1.6rem !important;
            line-height: 1.3 !important;
        }

        .welcome-subtitle {
            font-size: 1rem !important;
            line-height: 1.4 !important;
        }

        .dashboard-stats {
            flex-direction: column !important;
            gap: 12px !important;
            margin-top: 20px !important;
        }

        .stat-card {
            min-width: unset !important;
            max-width: unset !important;
            padding: 24px 20px !important;
            min-height: 100px !important;
            border-radius: 14px !important;
            flex-direction: row !important;
        }
        
        .stat-card:hover {
            transform: none !important;
        }
        
        .stat-card:active {
            transform: scale(0.98) !important;
        }

        .stat-icon {
            font-size: 2rem !important;
            padding: 14px !important;
            min-width: 56px !important;
            min-height: 56px !important;
        }

        .stat-number {
            font-size: 1.9rem !important;
            line-height: 1.2 !important;
        }

        .stat-label {
            font-size: 0.95rem !important;
            line-height: 1.3 !important;
        }
    }

    @media (max-width: 480px) {
        .welcome-section {
            padding: 16px 12px !important;
            margin: 8px !important;
            max-width: calc(100% - 16px) !important;
            border-radius: 12px !important;
        }

        .welcome-message {
            font-size: 1.4rem !important;
            line-height: 1.2 !important;
        }
        
        .welcome-subtitle {
            font-size: 0.9rem !important;
        }
        
        .dashboard-stats {
            gap: 10px !important;
            margin-top: 16px !important;
        }

        .stat-card {
            padding: 20px 16px !important;
            min-height: 90px !important;
            border-radius: 12px !important;
        }
        
        .stat-icon {
            font-size: 1.7rem !important;
            padding: 12px !important;
            min-width: 48px !important;
            min-height: 48px !important;
        }

        .stat-number {
            font-size: 1.7rem !important;
        }
        
        .stat-label {
            font-size: 0.85rem !important;
        }
    }
    
    /* Ultra small screens */
    @media (max-width: 360px) {
        .welcome-section {
            padding: 14px 10px !important;
            margin: 6px !important;
        }
        
        .welcome-message {
            font-size: 1.25rem !important;
        }
        
        .stat-card {
            padding: 18px 14px !important;
            gap: 12px !important;
        }
        
        .stat-icon {
            font-size: 1.5rem !important;
            padding: 10px !important;
            min-width: 44px !important;
            min-height: 44px !important;
        }
        
        .stat-number {
            font-size: 1.5rem !important;
        }
        
        .stat-label {
            font-size: 0.8rem !important;
        }
    }
</style>

<div class="welcome-section">
    <h1 class="welcome-message">Welcome back, {{ auth()->user()->name }}!</h1>
    <p class="welcome-subtitle">Here's what's happening with your system today.</p>
    <div class="dashboard-stats">
        <a href="{{ route('head.student.list') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-people"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Student::count() }}</div>
                <div class="stat-label">Total Students</div>
            </div>
        </a>
        <a href="{{ route('head.reports.tasks') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-list-ul"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\StudentTask::where('status', '!=', 'completed')->count() }}</div>
                <div class="stat-label">Total Tasks</div>
            </div>
        </a>
        <a href="{{ route('head.reports.attendance') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-calendar-check"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Attendance::whereDate('created_at', today())->count() }}</div>
                <div class="stat-label">Today's Attendance</div>
            </div>
        </a>
        <a href="{{ route('head.reports.grades') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-award"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Grade::count() }}</div>
                <div class="stat-label">Total Grades</div>
            </div>
        </a>
        <a href="{{ route('head.reports.evaluation') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-graph-up-arrow"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Evaluation::count() }}</div>
                <div class="stat-label">Total Evaluations</div>
            </div>
        </a>
    </div>
</div>
@endsection

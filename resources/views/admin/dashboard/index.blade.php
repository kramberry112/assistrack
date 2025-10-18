@extends('layouts.app')

@section('page-title')
    <i class="bi bi-grid-3x3-gap" style="margin-right: 8px;"></i>
    Dashboard Overview
@endsection

@section('content')
<style>
    .content-wrapper {
        background: #fff !important;
    }
    .admin-content-wrapper {
        background: #fff !important;
    }
    
    .welcome-section {
        padding: 24px;
        background: #fff;
    }

    .welcome-message {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    .welcome-subtitle {
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 4px;
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-top: 24px;
    }

    .stat-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 16px;
        text-align: center;
        text-decoration: none;
        color: inherit;
        display: block;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .stat-card:hover {
        background: #f1f5f9;
        border-color: #3b82f6;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        text-decoration: none;
        color: inherit;
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
    }

    .stat-label {
        font-size: 0.75rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 4px;
    }
</style>

<div class="welcome-section">
    <h1 class="welcome-message">Welcome back, {{ auth()->user()->name }}!</h1>
    <p class="welcome-subtitle">Here's what's happening with your system today.</p>
    
    <div class="dashboard-stats">
        <a href="{{ route('student.list') }}" class="stat-card">
            <div class="stat-number">{{ \App\Models\Student::count() }}</div>
            <div class="stat-label">Total Students</div>
        </a>
        <a href="{{ route('applicants.list') }}" class="stat-card">
            <div class="stat-number">{{ \App\Models\Application::count() }}</div>
            <div class="stat-label">Total Applications</div>
        </a>
        <a href="{{ route('admin.usermanagement') }}" class="stat-card">
            <div class="stat-number">{{ \App\Models\User::count() }}</div>
            <div class="stat-label">Total Users</div>
        </a>
        <a href="{{ route('student.list') }}" class="stat-card">
            <div class="stat-number">{{ \App\Models\StudentTask::where('status', 'completed')->count() }}</div>
            <div class="stat-label">Completed Tasks</div>
        </a>
    </div>
</div>
@endsection

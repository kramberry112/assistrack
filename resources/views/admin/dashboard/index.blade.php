@extends('layouts.app')

@section('page-title')
    <i class="bi bi-grid-3x3-gap" style="margin-right: 8px;"></i>
    Dashboard Overview
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
    body, .admin-content-wrapper {
        box-shadow: 0 8px 32px rgba(80,80,180,0.10);
        max-width: 1100px;
        margin: 32px auto 0 auto;
    /* .content-wrapper removed */
        font-weight: 800;
        color: #2d2e83;
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
        gap: 32px;
        margin-top: 36px;
        justify-content: space-between;
        flex-wrap: wrap;
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
        transition: box-shadow 0.2s, transform 0.2s, background 0.2s;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        min-width: 240px;
        flex: 1 1 0;
        max-width: 320px;
    }
    .stat-card:hover {
        background: #f8fafc;
        box-shadow: 0 8px 32px rgba(45,46,131,0.13);
        transform: translateY(-4px) scale(1.025);
        text-decoration: none;
        color: inherit;
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
</style>

<div class="welcome-section">
    <h1 class="welcome-message">Welcome back, {{ auth()->user()->name }}!</h1>
    <p class="welcome-subtitle">Here's what's happening with your system today.</p>
    <div class="dashboard-stats">
        <a href="{{ route('student.list') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-people"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Student::count() }}</div>
                <div class="stat-label">Total Students</div>
            </div>
        </a>
        <a href="{{ route('applicants.list') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-person-lines-fill"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Application::count() }}</div>
                <div class="stat-label">Total Applications</div>
            </div>
        </a>
        <a href="{{ route('admin.usermanagement') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-person-badge"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\User::count() }}</div>
                <div class="stat-label">Total Users</div>
            </div>
        </a>
        <a href="{{ route('student.list') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-check2-circle"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\StudentTask::where('status', 'completed')->count() }}</div>
                <div class="stat-label">Completed Tasks</div>
            </div>
        </a>
    </div>
</div>
@endsection

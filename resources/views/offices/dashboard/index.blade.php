@extends('layouts.app')

@section('content')
<style>
    .content-card {
        flex: 1;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    .content-header {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 16px 20px;
        border-bottom: 1px solid #e5e7eb;
        background: #fff;
        font-size: 0.95rem;
        color: #6b7280;
    }

    .welcome-section {
        flex: 1;
        padding: 24px;
    }

    .welcome-message {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
    }
</style>

<div class="content-card w-full">
    <div id="mainContent" class="w-full">
        <div class="content-header">
            <span class="icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                </svg>
            </span>
            Dashboard
        </div>
        <div class="welcome-section">
            <h1 class="welcome-message">Welcome, Office User!</h1>
        </div>
    </div>
</div>
@endsection

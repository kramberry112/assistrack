@extends('layouts.office-layout')

@section('page-title')
    DASHBOARD
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
        <div style="padding: 0 24px; margin-bottom: 12px;">
            <div style="margin-top: 20px;">
                <h1 class="welcome-message">
                    Welcome, {{ $user->name ?? 'Office User' }}!
                    @if(isset($user) && $user->office_name)
                        <span style="display: block; font-size: 1rem; color: #6b7280; margin-top: 8px;">
                            📍 {{ $user->office_name }} Office
                        </span>
                    @endif
                </h1>
            </div>
        </div>
    </div>
</div>
@endsection

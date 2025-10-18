@extends('layouts.app')

@section('page-title')
    <i class="bi bi-grid-3x3-gap" style="margin-right: 8px;"></i>
    Dashboard Overview
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


        <div class="content-card">
            <div class="welcome-section">
                <h1 class="welcome-message">Welcome, Head!</h1>
            </div>
        </div>
@endsection

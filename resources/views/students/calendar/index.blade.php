@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <aside class="sidebar">
        <!-- ...existing sidebar code... -->
    </aside>
    <section class="main-content">
        <div class="content-card">
            <div class="content-header">
                <span class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <line x1="9" y1="9" x2="15" y2="9"/>
                        <line x1="9" y1="15" x2="15" y2="15"/>
                    </svg>
                </span>
                Calendar
            </div>
            <div class="welcome-section">
                <h1 class="welcome-message">Your Student Calendar</h1>
                <p style="margin-top:12px;color:#374151;font-size:1rem;">View your academic and activity calendar here.</p>
            </div>
        </div>
    </section>
</div>
@endsection

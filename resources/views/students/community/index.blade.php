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
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                        <circle cx="9" cy="10" r="1"/>
                        <circle cx="15" cy="10" r="1"/>
                    </svg>
                </span>
                Community
            </div>
            <div class="welcome-section">
                <h1 class="welcome-message">Welcome to the Student Community!</h1>
                <p style="margin-top:12px;color:#374151;font-size:1rem;">Connect and collaborate with other students here.</p>
            </div>
        </div>
    </section>
</div>
@endsection

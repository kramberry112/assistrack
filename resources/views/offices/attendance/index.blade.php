@extends('layouts.app')

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f3f4f6;
    }

    .dashboard-container {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
        width: 260px;
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .sidebar .logo {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
    }

    .sidebar .logo img {
        width: 36px;
        height: 36px;
    }

    .sidebar .logo span {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
    }

    .sidebar .nav {
        display: flex;
        flex-direction: column;
        margin-top: 8px;
        flex: 1;
    }

    .sidebar .nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        font-size: 0.95rem;
        color: #374151;
        text-decoration: none;
        transition: all 0.2s;
        border-left: 3px solid transparent;
        font-weight: 500;
    }

    .sidebar .nav a:hover {
        background: #f9fafb;
        color: #111827;
    }

    .sidebar .nav a.active {
        background: #f9fafb;
        color: #111827;
        border-left: 3px solid #3b82f6;
    }

    .sidebar .nav a .icon {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Profile */
    .sidebar .profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        border-top: 1px solid #e5e7eb;
        cursor: pointer;
        position: relative;
    }

    .sidebar .profile .avatar {
        width: 36px;
        height: 36px;
        background: #e5e7eb;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #374151;
    }

    .sidebar .profile-details {
        display: flex;
        flex-direction: column;
        font-size: 0.85rem;
    }
    .sidebar .profile-details .name {
        font-weight: 600;
        color: #111827;
        font-size: 0.9rem;
        letter-spacing: 0.05em;
    }
    .sidebar .profile-details .username {
        font-size: 0.75rem;
        color: #6b7280;
        letter-spacing: 0.05em;
    }

    /* Logout dropdown */
    #logoutMenu {
        display: none;
        position: absolute;
        bottom: 60px;
        left: 20px;
        background: #fff;
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        padding: 24px 20px 16px 20px;
        min-width: 220px;
        z-index: 100;
        text-align: center;
    }

    #logoutMenu a,
    #logoutMenu button {
        display: block;
        width: 100%;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 8px;
        padding: 8px 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border: none;
        transition: background 0.2s, box-shadow 0.2s;
        text-align: center;
        cursor: pointer;
    }

    #logoutMenu a {
        background: #4f8ef7;
        color: #fff;
        text-decoration: none;
    }

    #logoutMenu a:hover {
        background: #2563eb;
    }

    #logoutMenu button {
        background: linear-gradient(90deg, #ef4444, #dc2626);
        color: #fff;
    }

    #logoutMenu button:hover {
        background: linear-gradient(90deg, #b91c1c, #dc2626);
        box-shadow: 0 4px 16px rgba(239,68,68,0.15);
    }

    /* Main Content */
    .main-content {
        flex: 1;
        background: #f9fafb;
        display: flex;
        flex-direction: column;
        padding: 20px;
    }

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

    .attendance-section {
        flex: 1;
        padding: 24px;
    }

    .attendance-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 24px;
    }

    /* Enhanced DTR Section Styles */
    .dtr-sections {
        display: flex;
        flex-direction: column;
        gap: 32px;
        max-width: 800px;
    }

    .session-group {
        background: #f9fafb;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #e5e7eb;
    }

    .session-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .session-buttons {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-bottom: 16px;
    }

    .attendance-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        background: #ffffff;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        min-height: 100px;
    }

    .attendance-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Morning Session Colors */
    .morning-session .attendance-btn.morning-in {
        border-color: #10b981;
        color: #10b981;
    }

    .morning-session .attendance-btn.morning-in:hover {
        border-color: #059669;
        background: #f0fdf4;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    }

    .morning-session .attendance-btn.morning-out {
        border-color: #f59e0b;
        color: #f59e0b;
    }

    .morning-session .attendance-btn.morning-out:hover {
        border-color: #d97706;
        background: #fffbeb;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.15);
    }

    /* Afternoon Session Colors */
    .afternoon-session .attendance-btn.afternoon-in {
        border-color: #3b82f6;
        color: #3b82f6;
    }

    .afternoon-session .attendance-btn.afternoon-in:hover {
        border-color: #2563eb;
        background: #eff6ff;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
    }

    .afternoon-session .attendance-btn.afternoon-out {
        border-color: #8b5cf6;
        color: #8b5cf6;
    }

    .afternoon-session .attendance-btn.afternoon-out:hover {
        border-color: #7c3aed;
        background: #faf5ff;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.15);
    }

    /* Overtime Session Colors */
    .overtime-session .attendance-btn.overtime-in {
        border-color: #ef4444;
        color: #ef4444;
    }

    .overtime-session .attendance-btn.overtime-in:hover {
        border-color: #dc2626;
        background: #fef2f2;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
    }

    .overtime-session .attendance-btn.overtime-out {
        border-color: #6b7280;
        color: #6b7280;
    }

    .overtime-session .attendance-btn.overtime-out:hover {
        border-color: #4b5563;
        background: #f9fafb;
        box-shadow: 0 4px 12px rgba(107, 114, 128, 0.15);
    }

    .btn-icon {
        width: 28px;
        height: 28px;
        margin-bottom: 8px;
    }

    .btn-text {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .btn-subtext {
        font-size: 0.8rem;
        opacity: 0.7;
        text-align: center;
    }

    .session-status {
        background: #ffffff;
        border-radius: 6px;
        padding: 10px 12px;
        font-size: 0.85rem;
        color: #6b7280;
        text-align: center;
        border: 1px solid #e5e7eb;
    }

    .status-active {
        background: #f0fdf4;
        color: #059669;
        border-color: #10b981;
    }

    .status-completed {
        background: #eff6ff;
        color: #2563eb;
        border-color: #3b82f6;
    }

    .current-time {
        margin-top: 24px;
        padding: 16px;
        background: #f9fafb;
        border-radius: 8px;
        text-align: center;
        max-width: 300px;
    }

    .time-display {
        font-size: 1.5rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 4px;
    }

    .date-display {
        font-size: 0.875rem;
        color: #6b7280;
    }

    /* DTR History Table */
    .dtr-history {
        margin-top: 32px;
        background: #fff;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .history-header {
        background: #f9fafb;
        padding: 16px 20px;
        border-bottom: 1px solid #e5e7eb;
        font-weight: 600;
        color: #111827;
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
    }

    .history-table th,
    .history-table td {
        padding: 12px 20px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
        font-size: 0.875rem;
    }

    .history-table th {
        background: #f9fafb;
        font-weight: 600;
        color: #374151;
    }

    .history-table td {
        color: #6b7280;
    }

    .session-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: capitalize;
    }

    .badge-morning {
        background: #f0fdf4;
        color: #059669;
    }

    .badge-afternoon {
        background: #eff6ff;
        color: #2563eb;
    }

    .badge-overtime {
        background: #fef2f2;
        color: #dc2626;
    }

    /* QR Modal Styles */
    .qr-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
    }

    .qr-modal-content {
        background-color: #fff;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        position: relative;
    }

    .qr-close {
        position: absolute;
        right: 15px;
        top: 15px;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        color: #999;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s;
    }

    .qr-close:hover {
        color: #333;
        background-color: #f0f0f0;
    }

    .qr-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 20px;
    }

    .qr-code-container {
        display: flex;
        justify-content: center;
        margin: 20px 0;
        padding: 20px;
        background: #f9fafb;
        border-radius: 10px;
    }

    .qr-info {
        font-size: 0.9rem;
        color: #6b7280;
        margin-top: 15px;
        line-height: 1.5;
    }

    .qr-success {
        background: #f0fdf4;
        color: #059669;
        padding: 10px 15px;
        border-radius: 8px;
        margin-top: 15px;
        font-weight: 500;
    }
</style>

<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div>
            <div class="logo">
                <img src="/images/assistracklogo.png" alt="Logo">
                <span>Assistrack Portal</span>
            </div>
            <nav class="nav">
                <a href="{{ route('offices.dashboard') }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="14" width="7" height="7" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" rx="1"/>
                        </svg>
                    </span>
                    Dashboard
                </a>
                <a href="{{ route('attendance.index') }}" class="active">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 11l3 3L22 4"/>
                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                        </svg>
                    </span>
                    Attendance
                </a>
                <a href="{{ route('evaluation.index') }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                    </span>
                    Evaluation
                </a>
                <a href="#">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"/>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                            <path d="M9 14l2 2 4-4"/>
                        </svg>
                    </span>
                    Tasks
                </a>
            </nav>
        </div>

        <!-- Profile -->
        <div class="profile" id="profileDropdown">
            @if(auth()->user()->profile_photo)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="{{ auth()->user()->name }}" class="avatar" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=667eea&color=fff&size=36" alt="{{ auth()->user()->name }}" class="avatar" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
            @endif
            <div class="profile-details">
                <span class="name">{{ auth()->user()->name }}</span>
                <span class="username">{{ auth()->user()->username }}</span>
            </div>
            <div style="margin-left:auto; display:flex; flex-direction:column; gap:2px; align-items:center;">
                <button id="logoutUp" style="background:none;border:none;cursor:pointer;padding:0;" title="Show Logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                </button>
                <button id="logoutDown" style="background:none;border:none;cursor:pointer;padding:0;" title="Hide Logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </div>
        </div>

        <div id="logoutMenu">
            <a href="{{ route('profile.edit') }}">Settings</a>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <section class="main-content">
        <div class="content-card">
            <div class="content-header">
                <span class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 11l3 3L22 4"/>
                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                    </svg>
                </span>
                Daily Time Record (DTR)
            </div>
            <div class="attendance-section">
                <h1 class="attendance-title">Student Assistant Time Tracking</h1>
                
                <div class="dtr-sections">
                    <!-- Morning Session -->
                    <div class="session-group morning-session">
                        <div class="session-title">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="5"/>
                                <line x1="12" y1="1" x2="12" y2="3"/>
                                <line x1="12" y1="21" x2="12" y2="23"/>
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                                <line x1="1" y1="12" x2="3" y2="12"/>
                                <line x1="21" y1="12" x2="23" y2="12"/>
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                            </svg>
                            Morning Session
                        </div>
                        <div class="session-buttons">
                            <button class="attendance-btn morning-in" onclick="handleTimeAction('morning', 'in')">
                                <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                <div class="btn-text">Morning In</div>
                                <div class="btn-subtext">Start morning shift</div>
                            </button>
                            <button class="attendance-btn morning-out" onclick="handleTimeAction('morning', 'out')">
                                <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 8 14"/>
                                </svg>
                                <div class="btn-text">Morning Out</div>
                                <div class="btn-subtext">End morning shift</div>
                            </button>
                        </div>
                        <div class="session-status" id="morningStatus">
                            Ready to start morning session
                        </div>
                    </div>

                    <!-- Afternoon Session -->
                    <div class="session-group afternoon-session">
                        <div class="session-title">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="5"/>
                                <line x1="12" y1="1" x2="12" y2="3"/>
                                <line x1="12" y1="21" x2="12" y2="23"/>
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                                <line x1="1" y1="12" x2="3" y2="12"/>
                                <line x1="21" y1="12" x2="23" y2="12"/>
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                            </svg>
                            Afternoon Session
                        </div>
                        <div class="session-buttons">
                            <button class="attendance-btn afternoon-in" onclick="handleTimeAction('afternoon', 'in')">
                                <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                <div class="btn-text">Afternoon In</div>
                                <div class="btn-subtext">Start afternoon shift</div>
                            </button>
                            <button class="attendance-btn afternoon-out" onclick="handleTimeAction('afternoon', 'out')">
                                <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 8 14"/>
                                </svg>
                                <div class="btn-text">Afternoon Out</div>
                                <div class="btn-subtext">End afternoon shift</div>
                            </button>
                        </div>
                        <div class="session-status" id="afternoonStatus">
                            Ready to start afternoon session
                        </div>
                    </div>

                    <!-- Overtime Session -->
                    <div class="session-group overtime-session">
                        <div class="session-title">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            Overtime Session
                        </div>
                        <div class="session-buttons">
                            <button class="attendance-btn overtime-in" onclick="handleTimeAction('overtime', 'in')">
                                <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                <div class="btn-text">OT In</div>
                                <div class="btn-subtext">Start overtime</div>
                            </button>
                            <button class="attendance-btn overtime-out" onclick="handleTimeAction('overtime', 'out')">
                                <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 8 14"/>
                                </svg>
                                <div class="btn-text">OT Out</div>
                                <div class="btn-subtext">End overtime</div>
                            </button>
                        </div>
                        <div class="session-status" id="overtimeStatus">
                            Overtime session available
                        </div>
                    </div>
                </div>

                <div class="current-time">
                    <div class="time-display" id="currentTime">--:--:--</div>
                    <div class="date-display" id="currentDate">-- --- --</div>
                </div>

                <!-- DTR History -->
                <div class="dtr-history">
                    <div class="history-header">Today's DTR Records</div>
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Session</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Duration</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="dtrHistory">
                            <tr>
                                <td colspan="5" style="text-align: center; color: #9ca3af;">No records for today</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- QR Code Modal -->
<div id="qrModal" class="qr-modal">
    <div class="qr-modal-content">
        <span class="qr-close" onclick="closeQRModal()">&times;</span>
        <h2 id="qrTitle" class="qr-title">Attendance QR Code</h2>
        <div class="qr-code-container">
            <div id="qrcode"></div>
        </div>
        <div class="qr-success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 5px;">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            Attendance recorded successfully!
        </div>
        <div class="qr-info">
            This QR code contains your attendance verification data.<br>
            Present this to your supervisor if needed.
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
// DTR Data Storage
let dtrData = {
    morning: { timeIn: null, timeOut: null, status: 'ready' },
    afternoon: { timeIn: null, timeOut: null, status: 'ready' },
    overtime: { timeIn: null, timeOut: null, status: 'ready' }
};

document.addEventListener('DOMContentLoaded', function() {
    // Profile dropdown functionality
    var profile = document.getElementById('profileDropdown');
    var menu = document.getElementById('logoutMenu');
    profile.addEventListener('click', function(e) {
        e.stopPropagation();
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });
    document.addEventListener('click', function() {
        if (menu.style.display === 'block') menu.style.display = 'none';
    });

    // Update current time
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', { 
            hour12: false, 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit' 
        });
        const dateString = now.toLocaleDateString('en-US', { 
            weekday: 'short', 
            year: 'numeric', 
            month: 'short', 
            day: 'numeric' 
        });
        
        document.getElementById('currentTime').textContent = timeString;
        document.getElementById('currentDate').textContent = dateString;
    }

    // Update time immediately and then every second
    updateTime();
    setInterval(updateTime, 1000);

    // Load existing DTR data
    loadDTRData();
    updateStatusDisplays();
    updateHistoryTable();

    // Check for new day every minute
    setInterval(checkNewDay, 60000);
});

function handleTimeAction(session, action) {
    const now = new Date();
    const timeString = now.toLocaleTimeString('en-US', { 
        hour12: true, 
        hour: '2-digit', 
        minute: '2-digit' 
    });
    
    let message = '';
    let canProceed = true;
    
    if (action === 'in') {
        if (dtrData[session].timeIn) {
            message = `You have already timed in for ${session} session at ${dtrData[session].timeIn}`;
            canProceed = false;
        } else {
            // Check if user needs to time in for previous session first
            if (session === 'afternoon' && dtrData.morning.status !== 'completed') {
                message = 'Please complete your morning session before starting afternoon session';
                canProceed = false;
            } else if (session === 'overtime' && dtrData.afternoon.status !== 'completed') {
                message = 'Please complete your afternoon session before starting overtime';
                canProceed = false;
            } else {
                dtrData[session].timeIn = timeString;
                dtrData[session].status = 'active';
                message = `${session.charAt(0).toUpperCase() + session.slice(1)} Time In recorded at ${timeString}`;
            }
        }
    } else if (action === 'out') {
        if (!dtrData[session].timeIn) {
            message = `You need to time in first for ${session} session`;
            canProceed = false;
        } else if (dtrData[session].timeOut) {
            message = `You have already timed out for ${session} session at ${dtrData[session].timeOut}`;
            canProceed = false;
        } else {
            dtrData[session].timeOut = timeString;
            dtrData[session].status = 'completed';
            message = `${session.charAt(0).toUpperCase() + session.slice(1)} Time Out recorded at ${timeString}`;
        }
    }
    
    if (canProceed) {
        // Save data to local storage
        saveDTRData();
        updateStatusDisplays();
        updateHistoryTable();
        
        // Show QR modal
        showQRModal(session, action, timeString);
        
        // Show success message
        showNotification(message, 'success');
        
        // Send to server (optional - uncomment when backend is ready)
        // sendAttendanceToServer(session, action, timeString);
    } else {
        // Show error message
        showNotification(message, 'error');
    }
}

function updateStatusDisplays() {
    // Update morning status
    const morningStatus = document.getElementById('morningStatus');
    if (dtrData.morning.status === 'ready') {
        morningStatus.textContent = 'Ready to start morning session';
        morningStatus.className = 'session-status';
    } else if (dtrData.morning.status === 'active') {
        morningStatus.textContent = `Started at ${dtrData.morning.timeIn} - Click Morning Out to finish`;
        morningStatus.className = 'session-status status-active';
    } else if (dtrData.morning.status === 'completed') {
        morningStatus.textContent = `Completed: ${dtrData.morning.timeIn} - ${dtrData.morning.timeOut}`;
        morningStatus.className = 'session-status status-completed';
    }
    
    // Update afternoon status
    const afternoonStatus = document.getElementById('afternoonStatus');
    if (dtrData.afternoon.status === 'ready') {
        afternoonStatus.textContent = 'Ready to start afternoon session';
        afternoonStatus.className = 'session-status';
    } else if (dtrData.afternoon.status === 'active') {
        afternoonStatus.textContent = `Started at ${dtrData.afternoon.timeIn} - Click Afternoon Out to finish`;
        afternoonStatus.className = 'session-status status-active';
    } else if (dtrData.afternoon.status === 'completed') {
        afternoonStatus.textContent = `Completed: ${dtrData.afternoon.timeIn} - ${dtrData.afternoon.timeOut}`;
        afternoonStatus.className = 'session-status status-completed';
    }
    
    // Update overtime status
    const overtimeStatus = document.getElementById('overtimeStatus');
    if (dtrData.overtime.status === 'ready') {
        overtimeStatus.textContent = 'Overtime session available';
        overtimeStatus.className = 'session-status';
    } else if (dtrData.overtime.status === 'active') {
        overtimeStatus.textContent = `Started at ${dtrData.overtime.timeIn} - Click OT Out to finish`;
        overtimeStatus.className = 'session-status status-active';
    } else if (dtrData.overtime.status === 'completed') {
        overtimeStatus.textContent = `Completed: ${dtrData.overtime.timeIn} - ${dtrData.overtime.timeOut}`;
        overtimeStatus.className = 'session-status status-completed';
    }
}

function updateHistoryTable() {
    const tbody = document.getElementById('dtrHistory');
    const sessions = ['morning', 'afternoon', 'overtime'];
    let hasRecords = false;
    
    // Clear existing rows
    tbody.innerHTML = '';
    
    sessions.forEach(session => {
        if (dtrData[session].timeIn || dtrData[session].timeOut) {
            hasRecords = true;
            const row = document.createElement('tr');
            
            const duration = calculateDuration(dtrData[session].timeIn, dtrData[session].timeOut);
            const status = dtrData[session].status;
            
            row.innerHTML = `
                <td><span class="session-badge badge-${session}">${session}</span></td>
                <td>${dtrData[session].timeIn || '--:--'}</td>
                <td>${dtrData[session].timeOut || '--:--'}</td>
                <td>${duration}</td>
                <td>${status.charAt(0).toUpperCase() + status.slice(1)}</td>
            `;
            
            tbody.appendChild(row);
        }
    });
    
    if (!hasRecords) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: #9ca3af;">No records for today</td></tr>';
    }
}

function calculateDuration(timeIn, timeOut) {
    if (!timeIn || !timeOut) return '--:--';
    
    try {
        const today = new Date().toDateString();
        const startTime = new Date(`${today} ${timeIn}`);
        const endTime = new Date(`${today} ${timeOut}`);
        
        const diffMs = endTime - startTime;
        if (diffMs < 0) return '--:--'; // Invalid time range
        
        const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
        const diffMinutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));
        
        return `${diffHours}h ${diffMinutes}m`;
    } catch (error) {
        return '--:--';
    }
}

function saveDTRData() {
    const today = new Date().toDateString();
    localStorage.setItem(`dtr_${today}`, JSON.stringify(dtrData));
}

function loadDTRData() {
    const today = new Date().toDateString();
    const savedData = localStorage.getItem(`dtr_${today}`);
    
    if (savedData) {
        try {
            dtrData = JSON.parse(savedData);
        } catch (error) {
            console.error('Error loading DTR data:', error);
        }
    }
}

function showQRModal(session, action, timeString) {
    const modal = document.getElementById('qrModal');
    const title = document.getElementById('qrTitle');
    const qrDiv = document.getElementById('qrcode');
    
    // Clear previous QR code
    qrDiv.innerHTML = '';
    
    // Generate QR data
    const currentDate = new Date().toLocaleDateString();
    const actionText = `${session.charAt(0).toUpperCase() + session.slice(1)} ${action.charAt(0).toUpperCase() + action.slice(1)}`;
    const qrData = JSON.stringify({
        userId: '{{ auth()->user()->id }}',
        userName: '{{ auth()->user()->name }}',
        action: actionText,
        time: timeString,
        date: currentDate,
        timestamp: new Date().toISOString()
    });
    
    // Update modal title
    title.textContent = `${actionText} QR Code`;
    
    // Generate QR code
    try {
        new QRCode(qrDiv, {
            text: qrData,
            width: 200,
            height: 200,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    } catch (error) {
        qrDiv.innerHTML = '<p style="color: #dc2626;">Error generating QR code</p>';
        console.error('QR Code generation error:', error);
    }
    
    // Show modal
    modal.style.display = 'flex';
    
    // Auto-close after 10 seconds
    setTimeout(() => {
        if (modal.style.display === 'flex') {
            closeQRModal();
        }
    }, 10000);
}

function closeQRModal() {
    document.getElementById('qrModal').style.display = 'none';
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 16px 20px;
        border-radius: 8px;
        font-weight: 500;
        z-index: 1000;
        max-width: 400px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        animation: slideIn 0.3s ease-out;
        ${type === 'success' ? 
            'background: #f0fdf4; color: #059669; border: 1px solid #10b981;' : 
            'background: #fef2f2; color: #dc2626; border: 1px solid #ef4444;'
        }
    `;
    
    notification.textContent = message;
    document.body.appendChild(notification);
    
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    `;
    document.head.appendChild(style);
    
    setTimeout(() => {
        notification.style.animation = 'slideIn 0.3s ease-out reverse';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
            if (document.head.contains(style)) {
                document.head.removeChild(style);
            }
        }, 300);
    }, 5000);
}

function checkNewDay() {
    const today = new Date().toDateString();
    const lastDate = localStorage.getItem('last_dtr_date');
    
    if (lastDate && lastDate !== today) {
        dtrData = {
            morning: { timeIn: null, timeOut: null, status: 'ready' },
            afternoon: { timeIn: null, timeOut: null, status: 'ready' },
            overtime: { timeIn: null, timeOut: null, status: 'ready' }
        };
        updateStatusDisplays();
        updateHistoryTable();
    }
    
    localStorage.setItem('last_dtr_date', today);
}

// Optional: Send attendance data to Laravel backend
function sendAttendanceToServer(session, action, timeString) {
    fetch('/api/attendance', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify({
            session: session,
            action: action,
            time: timeString,
            date: new Date().toISOString().split('T')[0]
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Attendance saved to server:', data);
    })
    .catch(error => {
        console.error('Error saving to server:', error);
    });
}

// Close modal when clicking outside
document.getElementById('qrModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeQRModal();
    }
});
</script>

@endsection
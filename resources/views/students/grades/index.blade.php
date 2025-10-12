@extends('layouts.app')

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f3f4f6;
    }
    .highlight {
        background: #fff59d;
        color: #d97706;
        padding: 0 2px;
        border-radius: 4px;
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
    }

    /* Header Section */
    .page-header {
        background: #ffffff;
        border-bottom: 1px solid #e5e7eb;
        padding: 20px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .page-header h1 {
        font-size: 1.875rem;
        font-weight: 700;
        color: #3b82f6;
        margin: 0;
        letter-spacing: 0.05em;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .notification-badge {
        position: relative;
        width: 40px;
        height: 40px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .notification-count {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ef4444;
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
    }

    /* New Styles for Grade Form */
    .instructions-box {
        background: #e0f2fe;
        border: 1px solid #0ea5e9;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 24px;
    }

    .instructions-box h3 {
        margin: 0 0 8px 0;
        color: #0369a1;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .instructions-box p {
        margin: 4px 0;
        color: #0c4a6e;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .form-container {
        background: #ffffff;
        border-radius: 8px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        margin-bottom: 24px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-row.full {
        grid-template-columns: 1fr;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: 600;
        color: #111827;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-family: inherit;
        font-size: 0.95rem;
        transition: border-color 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .subjects-section {
        margin: 20px 0;
    }

    .subjects-section h4 {
        font-weight: 600;
        color: #111827;
        margin-bottom: 12px;
        font-size: 0.95rem;
    }

    .subjects-input-wrapper {
        display: flex;
        gap: 8px;
        margin-bottom: 16px;
    }

    .subjects-input-wrapper button {
        padding: 10px 16px;
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.2s;
        font-size: 0.95rem;
    }

    .subjects-input-wrapper button:hover {
        background: #2563eb;
    }

    /* Subject Table Styles */
    .subjects-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 16px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        overflow: hidden;
    }

    .subjects-table thead {
        background: #f3f4f6;
        border-bottom: 2px solid #e5e7eb;
    }

    .subjects-table th {
        padding: 12px;
        text-align: left;
        font-weight: 600;
        color: #111827;
        font-size: 0.9rem;
    }

    .subjects-table td {
        padding: 12px;
        border-bottom: 1px solid #e5e7eb;
    }

    .subjects-table tbody tr:last-child td {
        border-bottom: none;
    }

    .subjects-table input {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-family: inherit;
        font-size: 0.9rem;
    }

    .subjects-table input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }

    .subjects-table .remove-btn {
        background: #ef4444;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.2s;
        font-size: 0.85rem;
    }

    .subjects-table .remove-btn:hover {
        background: #dc2626;
    }

    #subjects-list {
        display: none;
    }

    #subjects-list.show {
        display: table;
    }

    .file-upload-area {
        background: #f3f4f6;
        border-radius: 24px;
        box-shadow: 0 4px 24px rgba(59,130,246,0.08);
        padding: 0;
        min-height: 320px;
        width: 240px;
        max-width: 240px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        border: none;
        overflow-x: hidden;
    }

    .upload-icon {
        width: 90px;
        height: 90px;
        background: #fff;
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 12px rgba(59,130,246,0.10);
        margin-bottom: 18px;
    }

    .upload-icon svg {
        width: 56px;
        height: 56px;
        color: #222;
    }

    .photo-upload-label {
        font-size: 1.25rem;
        font-weight: 700;
        color: #222;
        letter-spacing: 0.12em;
        margin-top: 18px;
        margin-bottom: 0;
        text-align: center;
    }
    }

    .file-upload-section.active svg {
        color: #3b82f6;
    }

    .file-upload-section p {
        margin: 8px 0;
        color: #6b7280;
        font-size: 0.95rem;
    }

    .file-upload-section.active p {
        color: #1e40af;
    }

    .file-name {
        color: #10b981;
        font-weight: 600;
        margin-top: 8px;
        font-size: 0.9rem;
    }

    #gradeFileInput {
        display: none;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 24px;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.95rem;
    }

    .btn-primary {
        background: #3b82f6;
        color: white;
    }

    .btn-primary:hover {
        background: #2563eb;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    /* Main Form Wrapper */
    .form-wrapper {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 24px;
        align-items: start;
    }

    .form-left {
        flex: 1;
    }

    .form-right {
        display: flex;
        flex-direction: column;
    }

    .file-upload-label {
        font-weight: 600;
        color: #111827;
        margin-bottom: 12px;
        font-size: 0.95rem;
    }

    .file-upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        background: #f9fafb;
        transition: all 0.3s;
        min-height: 420px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .file-upload-area:hover {
        border-color: #3b82f6;
        background: #eff6ff;
    }

    .file-upload-area.active {
        border-color: #3b82f6;
        background: #dbeafe;
    }

    .file-upload-area.has-file {
        padding: 0;
        border: none;
    }

    .upload-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 16px;
    }

    .upload-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.3);
    }

    .upload-icon svg {
        width: 32px;
        height: 32px;
        color: white;
    }

    .upload-text {
        font-weight: 600;
        color: #111827;
        font-size: 1rem;
        margin-bottom: 4px;
    }

    .upload-subtext {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 12px;
    }

    .upload-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .upload-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }

    .upload-btn:active {
        transform: translateY(0);
    }

    .file-preview {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .preview-image-wrapper {
        width: 100%;
        height: 420px;
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        background: #000;
    }

    .preview-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .preview-actions {
        position: absolute;
        top: 12px;
        right: 12px;
        display: flex;
        gap: 8px;
        z-index: 10;
    }

    .preview-btn {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .preview-btn:hover {
        background: white;
        transform: scale(1.05);
    }

    .preview-btn svg {
        width: 18px;
        height: 18px;
    }

    .preview-btn.delete svg {
        color: #ef4444;
    }

    .preview-btn.change svg {
        color: #3b82f6;
    }

    .file-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 16px;
        color: white;
    }

    .file-name-display {
        font-size: 0.875rem;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
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
                <a href="{{ route('student.dashboard') }}">
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
                <a href="{{ route('student.community') }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                            <circle cx="9" cy="10" r="1"/>
                            <circle cx="15" cy="10" r="1"/>
                        </svg>
                    </span>
                    Community
                </a>
                <a href="{{ route('student.calendar') }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <line x1="9" y1="9" x2="15" y2="9"/>
                            <line x1="9" y1="15" x2="15" y2="15"/>
                        </svg>
                    </span>
                    Calendar
                </a>
                <a href="{{ route('student.grades') }}" class="active">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="8" r="6" />
                            <rect x="9" y="14" width="6" height="6" rx="2" />
                            <path d="M12 12v2" />
                        </svg>
                    </span>
                    Grades
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
            <div style="margin-left:auto; display:flex; flex-direction:column; gap:4px; align-items:center; justify-content:center; height:60px;">
                <svg id="logoutUp" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 15 12 9 18 15"></polyline>
                </svg>
                <svg id="logoutDown" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </div>
        </div>

        <!-- Logout Menu -->
        <div id="logoutMenu">
            <a href="#">Settings</a>
            <button onclick="logout()">Logout</button>
        </div>
    </aside>

    <!-- Main Content -->
    <section class="main-content">
        <div class="page-header">
            <h1 class="text-lg font-semibold mb-2">GRADES</h1>
            <div class="header-right">
                <div class="notification-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    <span class="notification-count">0</span>
                </div>
            </div>
        </div>

        <div class="container mx-auto py-8" style="max-width: 1200px;">

            <!-- Instructions Box -->
            <div class="instructions-box">
                <h3>📝 Instructions</h3>
                <p>• Please fill in your grade information accurately</p>
                <p>• Input your grades info and upload your grade slip as proof</p>
                <p>• Input all subjects and grades to the table below</p>
                <p>• For remarks, type "Passed" or "Failed"</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Grade Input Form -->
            <div class="form-container">
                <form id="gradeForm" method="POST" action="{{ route('student.grades.submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-wrapper">
                        <!-- Left Side -->
                        <div class="form-left">
                            <!-- Student Name -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="student_name">Student Name</label>
                                <input type="text" name="student_name" id="student_name" value="{{ auth()->user()->name }}" required readonly>
                            </div>
                            <!-- Year Level -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="year_level">Year Level</label>
                                <select name="year_level" id="year_level" required>
                                    <option value="">Select Year Level</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                </select>
                            </div>
                            <!-- Semester -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="semester">Semester</label>
                                <select name="semester" id="semester" required>
                                    <option value="">Select Semester</option>
                                    <option value="1st Semester">1st Semester</option>
                                    <option value="2nd Semester">2nd Semester</option>
                                </select>
                            </div>
                            <!-- Dynamic Subject Input -->
                            <div class="subjects-section">
                                <h4>Subjects</h4>
                                <div class="subjects-input-wrapper">
                                    <button type="button" id="add-subject" class="btn btn-primary">+ Add Subject</button>
                                </div>
                                <!-- Subjects Table -->
                                <table class="subjects-table" id="subjects-list">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Final Grade</th>
                                            <th>Remarks</th>
                                            <th style="width: 80px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="subjects-tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Right Side - File Upload -->
                        <div class="form-right">
                            <div id="fileUploadArea" class="file-upload-area">
                                <div class="upload-icon">
                                    <!-- Camera icon with upload arrow -->
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <rect x="8" y="16" width="48" height="32" rx="10" fill="#222"/>
                                        <circle cx="32" cy="32" r="10" fill="#fff"/>
                                        <circle cx="32" cy="32" r="6" fill="#222"/>
                                        <circle cx="48" cy="48" r="8" fill="#222"/>
                                        <path d="M48 52v-4m0 0l-2 2m2-2l2 2" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <input type="file" name="proof" id="gradeFileInput" accept="image/*,.pdf" required style="display:none;">
                                <div id="filePreview" class="file-preview"></div>
                                <div class="photo-upload-label">Photo Upload</div>
                            </div>
                        </div>
                    </div>
                    <!-- Hidden subjects input -->
                    <input type="hidden" name="subjects" id="subjectsJson">
                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">Clear</button>
                        <button type="button" class="btn btn-primary" id="submitConfirmBtn">Submit Grade</button>
                    </div>
                </form>
            </div>

            <!-- Modal -->
            <div id="submitModal" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.3);z-index:9999;align-items:center;justify-content:center;">
                <div style="background:#fff;padding:32px 24px;border-radius:12px;box-shadow:0 4px 24px rgba(0,0,0,0.15);max-width:350px;margin:auto;text-align:center;">
                    <h2 style="font-size:1.2rem;font-weight:700;margin-bottom:18px;">Are you sure you want to Submit?</h2>
                    <div style="display:flex;gap:16px;justify-content:center;">
                        <button id="modalCancel" style="padding:10px 24px;border-radius:6px;background:#e5e7eb;color:#222;font-weight:600;border:none;">Cancel</button>
                        <button id="modalConfirm" style="padding:10px 24px;border-radius:6px;background:#3b82f6;color:#fff;font-weight:600;border:none;">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Notification dropdown logic for grades page
    document.addEventListener('DOMContentLoaded', function() {
        const notificationBadge = document.querySelector('.notification-badge');
        if (!notificationBadge) return;
        // Add dropdown if not present
        let notificationDropdown = document.getElementById('notificationDropdown');
        let notificationContent;
        if (!notificationDropdown) {
            notificationDropdown = document.createElement('div');
            notificationDropdown.id = 'notificationDropdown';
            notificationDropdown.style.display = 'none';
            notificationDropdown.style.position = 'absolute';
            notificationDropdown.style.top = '48px';
            notificationDropdown.style.right = '0';
            notificationDropdown.style.background = '#fff';
            notificationDropdown.style.borderRadius = '10px';
            notificationDropdown.style.boxShadow = '0 2px 8px rgba(0,0,0,0.08)';
            notificationDropdown.style.minWidth = '220px';
            notificationDropdown.style.maxWidth = '350px';
            notificationDropdown.style.zIndex = '100';
            notificationDropdown.style.padding = '16px';
            notificationContent = document.createElement('div');
            notificationContent.id = 'notificationContent';
            notificationDropdown.appendChild(notificationContent);
            notificationBadge.parentNode.appendChild(notificationDropdown);
        } else {
            notificationContent = document.getElementById('notificationContent');
        }

        notificationBadge.addEventListener('click', function(event) {
            event.stopPropagation();
            if (notificationDropdown.style.display === 'block') {
                notificationDropdown.style.display = 'none';
            } else {
                notificationDropdown.style.display = 'block';
                notificationContent.textContent = 'Loading...';
                fetch('/community/join-requests')
                    .then(response => response.json())
                    .then(data => {
                        if (data.length === 0) {
                            notificationContent.innerHTML = '<div style="color:#374151;font-weight:500;">No notifications.</div>';
                        } else {
                            notificationContent.innerHTML = data.map(req => `
                                <div style="background:#fff;border-radius:10px;padding:14px 18px;box-shadow:0 2px 8px rgba(0,0,0,0.08);margin-bottom:12px;min-width:220px;max-width:350px;display:flex;flex-direction:column;align-items:center;">
                                    <div style="font-size:1rem;color:#2563eb;font-weight:600;margin-bottom:4px;text-align:center;">
                                        ${req.user.name} (@${req.user.username})
                                    </div>
                                    <div style="font-size:0.95rem;color:#374151;margin-bottom:10px;text-align:center;">wants to join your group.</div>
                                    <div style="display:flex;gap:10px;justify-content:center;">
                                        <button class="accept-btn" data-request-id="${req.id}" data-user-id="${req.user.id}" style="background:#22c55e;color:#fff;border:none;border-radius:6px;padding:6px 18px;font-size:1rem;font-weight:500;">Accept</button>
                                        <button class="reject-btn" data-request-id="${req.id}" style="background:#ef4444;color:#fff;border:none;border-radius:6px;padding:6px 18px;font-size:1rem;font-weight:500;">Reject</button>
                                    </div>
                                </div>
                            `).join('');
                            // Attach Accept/Reject handlers
                            setTimeout(() => {
                                document.querySelectorAll('.accept-btn').forEach(function(btn) {
                                    btn.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        var reqId = btn.getAttribute('data-request-id');
                                        var userId = btn.getAttribute('data-user-id');
                                        fetch(`/community/join-request/${reqId}/action`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                'X-Requested-With': 'XMLHttpRequest'
                                            },
                                            body: JSON.stringify({ action: 'accept' })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                btn.closest('div').innerHTML = '<span style="color:#22c55e;font-weight:600;font-size:1.1rem;">Accepted</span>';
                                                notificationDropdown.style.display = 'none';
                                            }
                                        });
                                    });
                                });
                                document.querySelectorAll('.reject-btn').forEach(function(btn) {
                                    btn.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        var reqId = btn.getAttribute('data-request-id');
                                        fetch(`/community/join-request/${reqId}/action`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                'X-Requested-With': 'XMLHttpRequest'
                                            },
                                            body: JSON.stringify({ action: 'reject' })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                btn.closest('div').innerHTML = '<span style="color:#ef4444;font-weight:600;font-size:1.1rem;">Rejected</span>';
                                                notificationDropdown.style.display = 'none';
                                            }
                                        });
                                    });
                                });
                            }, 100);
                        }
                    })
                    .catch(() => {
                        notificationContent.textContent = 'Failed to load notifications.';
                    });
            }
        });
        document.addEventListener('click', function(event) {
            if (!notificationBadge.contains(event.target) && !notificationDropdown.contains(event.target)) {
                notificationDropdown.style.display = 'none';
            }
        });
    });
    // Logout Script
    const profileDropdown = document.getElementById('profileDropdown');
    const logoutMenu = document.getElementById('logoutMenu');
    const logoutUp = document.getElementById('logoutUp');
    const logoutDown = document.getElementById('logoutDown');

    profileDropdown.addEventListener('click', function() {
        logoutMenu.style.display = logoutMenu.style.display === 'none' ? 'block' : 'none';
        logoutUp.style.display = logoutMenu.style.display === 'none' ? 'block' : 'none';
        logoutDown.style.display = logoutMenu.style.display === 'none' ? 'none' : 'block';
    });

    document.addEventListener('click', function(event) {
        if (!profileDropdown.contains(event.target) && !logoutMenu.contains(event.target)) {
            logoutMenu.style.display = 'none';
            logoutUp.style.display = 'block';
            logoutDown.style.display = 'none';
        }
    });

    function logout() {
        alert('Logout clicked');
    }

    // Grade Form Scripts
    const subjectsList = document.getElementById('subjects-list');
    const subjectsTbody = document.getElementById('subjects-tbody');
    const addSubjectBtn = document.getElementById('add-subject');
    const gradeForm = document.getElementById('gradeForm');
    const subjectsJson = document.getElementById('subjectsJson');

    addSubjectBtn.addEventListener('click', function(e) {
        e.preventDefault();
        // Create table row
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" placeholder="Subject name" class="subject-input" required></td>
            <td><input type="text" placeholder="Grade" class="grade-input" required></td>
            <td><input type="text" placeholder="Passed/Failed" class="remarks-input" required></td>
            <td><button type="button" class="remove-btn" onclick="removeSubjectRow(this)">Remove</button></td>
        `;
        subjectsTbody.appendChild(row);
        subjectsList.classList.add('show');
        row.querySelector('.subject-input').focus();
    });

    function removeSubjectRow(btn) {
        btn.closest('tr').remove();
        if (subjectsTbody.children.length === 0) {
            subjectsList.classList.remove('show');
        }
    }

    // Modal confirmation logic
    const submitConfirmBtn = document.getElementById('submitConfirmBtn');
    const submitModal = document.getElementById('submitModal');
    const modalCancel = document.getElementById('modalCancel');
    const modalConfirm = document.getElementById('modalConfirm');

    submitConfirmBtn.addEventListener('click', function(e) {
        // Validate required fields
        const yearLevel = document.getElementById('year_level').value;
        const semester = document.getElementById('semester').value;
        const fileInput = document.getElementById('gradeFileInput');
        const rows = subjectsTbody.querySelectorAll('tr');
        let valid = true;
        let errorMsg = '';
        if (!yearLevel) {
            valid = false;
            errorMsg = 'Year Level is required.';
        } else if (!semester) {
            valid = false;
            errorMsg = 'Semester is required.';
        } else if (rows.length === 0) {
            valid = false;
            errorMsg = 'At least one subject is required.';
        } else {
            rows.forEach(row => {
                if (!row.querySelector('.subject-input').value || !row.querySelector('.grade-input').value || !row.querySelector('.remarks-input').value) {
                    valid = false;
                    errorMsg = 'All subject fields are required.';
                }
            });
        }
        if (!fileInput.files.length) {
            valid = false;
            errorMsg = 'Proof file is required.';
        }
        if (!valid) {
            alert(errorMsg);
            return;
        }
        submitModal.style.display = 'flex';
    });
    modalCancel.addEventListener('click', function(e) {
        submitModal.style.display = 'none';
    });
    modalConfirm.addEventListener('click', function(e) {
        submitModal.style.display = 'none';
        // Serialize subjects to JSON before submit
        const rows = subjectsTbody.querySelectorAll('tr');
        const subjectsArr = [];
        rows.forEach(row => {
            const subject = row.querySelector('.subject-input').value;
            const grade = row.querySelector('.grade-input').value;
            const remarks = row.querySelector('.remarks-input').value;
            subjectsArr.push({ subject, grade, remarks });
        });
        subjectsJson.value = JSON.stringify(subjectsArr);
        gradeForm.submit();
    });

    // File Upload Handling
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileInput = document.getElementById('gradeFileInput');
    const filePreview = document.getElementById('filePreview');
    const uploadIcon = fileUploadArea.querySelector('.upload-icon');

    // Only clicking the upload icon or Change button triggers file input
    uploadIcon.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.click();
    });

    // Remove any click event from fileUploadArea itself
    fileUploadArea.onclick = null;

    // Drag & drop support
    fileUploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileUploadArea.classList.add('active');
    });
    fileUploadArea.addEventListener('dragleave', () => {
        fileUploadArea.classList.remove('active');
    });
    fileUploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        fileUploadArea.classList.remove('active');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            updateFileName(files[0].name);
            showImagePreview(files[0]);
        }
    });

    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            updateFileName(file.name);
            showImagePreview(file);
        }
    });

    function updateFileName(name) {
        filePreview.innerHTML = `<div class="file-name">✓ ${name}</div>`;
    }

    function showImagePreview(file) {
        // Only show preview for images
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                filePreview.innerHTML += `
                    <div style="width:100%;height:320px;display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;">
                        <img src="${e.target.result}" alt="Preview" style="width:100%;height:100%;object-fit:cover;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);max-width:100%;">
                        <button type="button" class="preview-btn change" style="position:absolute;top:12px;right:12px;z-index:2;" title="Change photo">
                            <svg viewBox="0 0 20 20" fill="none" width="20" height="20"><path d="M4 4h3l2-2h2l2 2h3v2H4V4zm0 4v8a2 2 0 002 2h8a2 2 0 002-2V8H4zm8 4a2 2 0 11-4 0 2 2 0 014 0z" fill="#3b82f6"/></svg>
                        </button>
                    </div>
                `;
                // Add event listener to change button
                setTimeout(() => {
                    const changeBtn = filePreview.querySelector('.preview-btn.change');
                    if (changeBtn) {
                        changeBtn.addEventListener('click', function(ev) {
                            ev.stopPropagation();
                            fileInput.click();
                        });
                    }
                }, 10);
            };
            reader.readAsDataURL(file);
        }
    }

    // Prevent clicking preview image from triggering file input
    filePreview.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    function resetForm() {
        document.getElementById('gradeForm').reset();
        subjectsTbody.innerHTML = '';
        subjectsList.classList.remove('show');
        filePreview.innerHTML = '';
    }
</script>
@endsection
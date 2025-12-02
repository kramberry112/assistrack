@extends('layouts.app')

@section('page-title')
    <i class="bi bi-people-fill" style="margin-right: 8px;"></i>
    User Management
@endsection





@section('content')
<style>
    .content-wrapper {
        background: #fff !important;
    }
    .admin-content-wrapper {
        background: #fff !important;
    }
</style>
<style>
    * {
        box-sizing: border-box;
    }

    .content-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        margin: 0;
    }

    .content-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 24px;
        border-bottom: 1px solid #e5e7eb;
        background: #fff;
        font-size: 1rem;
        color: #374151;
        font-weight: 600;
    }

    .content-header .icon {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .header-actions {
        margin-left: auto;
    }

    .search-filter-section {
        padding: 20px 24px;
        border-bottom: 1px solid #e5e7eb;
        background: #f9fafb;
    }

    .search-filter-row {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-input-wrapper {
        flex: 1;
        min-width: 300px;
    }

    .filter-select-wrapper {
        min-width: 180px;
    }

    /* Form controls */
    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.875rem;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .content-body {
        padding: 0;
        overflow-x: auto;
    }

    .table-container {
        width: 100%;
        overflow-x: auto;
        padding: 0 24px 24px 24px;
        max-width: 100%;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 100%;
        table-layout: auto;
    }

    thead tr {
        background: #f9fafb;
    }

    th {
        padding: 12px 16px;
        text-align: left;
        font-weight: 600;
        color: #374151;
        font-size: 0.875rem;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    td {
        padding: 12px 16px;
        text-align: left;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        height: 50px; /* Fixed row height */
    }

    tbody tr:hover {
        background: #f9fafb;
    }

    /* Column widths - Responsive percentages */
    th:nth-child(1), td:nth-child(1) { width: 14%; }
    th:nth-child(2), td:nth-child(2) { width: 11%; }
    th:nth-child(3), td:nth-child(3) { width: 20%; }
    th:nth-child(4), td:nth-child(4) { width: 8%; text-align: center; }
    th:nth-child(5), td:nth-child(5) { width: 11%; }
    th:nth-child(6), td:nth-child(6) { width: 11%; }
    th:nth-child(7), td:nth-child(7) { width: 9%; }
    th:nth-child(8), td:nth-child(8) { width: 16%; }

    /* Email column wrapping */
    td:nth-child(3) {
        word-break: break-word;
        overflow-wrap: break-word;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 0; /* Forces ellipsis to work */
    }

    /* Badge styles */
    .role-badge, .office-badge, .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
        white-space: nowrap;
    }

    .office-badge {
        background: #f3f4f6;
        color: #374151;
        border-radius: 6px;
    }

    .status-active {
        background: #d1fae5;
        color: #065f46;
    }

    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    /* Button styles */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.813rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn i {
        font-size: 0.875rem;
    }

    .btn-primary {
        background: #3b82f6;
        color: white;
    }

    .btn-primary:hover {
        background: #2563eb;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .btn-gray {
        background: #6b7280;
        color: white;
    }

    .btn-gray:hover {
        background: #4b5563;
    }

    .btn-success {
        background: #10b981;
        color: white;
    }

    .btn-success:hover {
        background: #059669;
    }

    /* Actions column */
    .actions {
        display: flex;
        gap: 4px;
        align-items: center;
        flex-wrap: nowrap;
        justify-content: flex-start;
        width: 100%;
    }

    .actions form {
        display: inline-block;
        margin: 0;
        flex: 1;
    }

    .actions .btn {
        width: 100%;
        min-width: 0;
        padding: 6px 8px;
        font-size: 0.7rem;
        justify-content: center;
    }

    .actions .btn i {
        font-size: 0.75rem;
        margin-right: 3px;
    }

    /* Ensure action buttons don't get squeezed */
    td:nth-child(8) {
        white-space: nowrap;
        overflow: hidden;
        padding: 8px 12px;
    }

    /* Form styles */
    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.875rem;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background: white;
        padding: 24px;
        border-radius: 12px;
        width: 90%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
        color: #9ca3af;
        padding: 0;
        line-height: 1;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-close:hover {
        color: #374151;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #374151;
        font-size: 0.875rem;
    }

    .form-help {
        color: #6b7280;
        font-size: 0.75rem;
        margin-top: 4px;
        display: block;
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 24px;
    }

    /* Alert styles */
    .alert {
        padding: 12px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: opacity 0.5s ease-out;
    }

    .alert-success {
        background: #10b981;
        color: #fff;
    }

    .alert-error {
        background: #ef4444;
        color: #fff;
    }

    /* Password field styling */
    .password-field-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 6px;
    }

    .password-field-group label {
        margin: 0;
    }

    .btn-reset {
        background: #f59e0b;
        color: white;
        padding: 5px 12px;
        font-size: 0.75rem;
    }

    .btn-reset:hover {
        background: #d97706;
    }

    /* Responsive adjustments - No horizontal scroll */
    @media (max-width: 1400px) {
        .table-container {
            padding: 0 16px 16px 16px;
        }
        
        .actions .btn {
            padding: 5px 6px;
            font-size: 0.65rem;
        }
        
        .actions .btn i {
            font-size: 0.7rem;
        }
    }

    @media (max-width: 1200px) {
        .table-container {
            padding: 0 12px 12px 12px;
        }
        
        /* Adjust column widths for smaller screens */
        th:nth-child(1), td:nth-child(1) { width: 12%; }
        th:nth-child(2), td:nth-child(2) { width: 10%; }
        th:nth-child(3), td:nth-child(3) { width: 18%; }
        th:nth-child(4), td:nth-child(4) { width: 7%; }
        th:nth-child(5), td:nth-child(5) { width: 10%; }
        th:nth-child(6), td:nth-child(6) { width: 10%; }
        th:nth-child(7), td:nth-child(7) { width: 8%; }
        th:nth-child(8), td:nth-child(8) { width: 25%; }
        
        .actions {
            gap: 3px;
        }
        
        .actions .btn {
            padding: 4px 6px;
            font-size: 0.6rem;
        }
        
        .actions .btn i {
            font-size: 0.65rem;
            margin-right: 2px;
        }
    }

    @media (max-width: 1024px) {
        .table-container {
            padding: 0 8px 8px 8px;
        }
        
        /* Stack buttons vertically on very small screens */
        .actions {
            flex-direction: column;
            gap: 2px;
        }
        
        .actions .btn {
            width: 100%;
            padding: 3px 4px;
            font-size: 0.55rem;
        }
        
        /* Hide icons on very small screens to save space */
        .actions .btn i {
            display: none;
        }
        
        /* Adjust column widths for mobile */
        th:nth-child(1), td:nth-child(1) { width: 15%; }
        th:nth-child(2), td:nth-child(2) { width: 12%; }
        th:nth-child(3), td:nth-child(3) { width: 20%; }
        th:nth-child(4), td:nth-child(4) { width: 8%; }
        th:nth-child(5), td:nth-child(5) { width: 12%; }
        th:nth-child(6), td:nth-child(6) { width: 8%; }
        th:nth-child(7), td:nth-child(7) { width: 8%; }
        th:nth-child(8), td:nth-child(8) { width: 17%; }
        
        /* Maintain consistent row height and text handling */
        th, td {
            padding: 8px 6px;
            font-size: 0.75rem;
            height: 45px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        /* Keep email column consistent - no wrapping */
        td:nth-child(3) {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }

    @media (max-width: 768px) {
        /* Mobile tablet */
        .search-filter-section {
            padding: 16px;
        }
        
        .search-filter-row {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }
        
        .search-input-wrapper {
            min-width: auto;
        }
        
        .filter-select-wrapper {
            min-width: auto;
        }
        
        /* Ultra compact for phones */
        th:nth-child(1), td:nth-child(1) { width: 16%; }
        th:nth-child(2), td:nth-child(2) { width: 14%; }
        th:nth-child(3), td:nth-child(3) { width: 22%; }
        th:nth-child(4), td:nth-child(4) { width: 8%; }
        th:nth-child(5), td:nth-child(5) { width: 14%; }
        th:nth-child(6), td:nth-child(6) { width: 8%; }
        th:nth-child(7), td:nth-child(7) { width: 8%; }
        th:nth-child(8), td:nth-child(8) { width: 10%; }
        
        .actions .btn {
            padding: 2px 3px;
            font-size: 0.5rem;
        }
        
        th, td {
            padding: 6px 4px;
            font-size: 0.7rem;
            height: 40px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }
    
    @media (max-width: 480px) {
        /* Mobile phone optimizations */
        .search-filter-section {
            padding: 12px;
        }
        
        .content-body {
            padding: 0;
        }
        
        .table-container {
            padding: 0 8px 8px 8px;
            margin: 0;
        }
        
        /* Hide less important columns on mobile */
        th:nth-child(4), td:nth-child(4),  /* Password column */
        th:nth-child(6), td:nth-child(6) { /* Office column */
            display: none;
        }
        
        /* Adjust remaining column widths */
        th:nth-child(1), td:nth-child(1) { width: 20%; }
        th:nth-child(2), td:nth-child(2) { width: 18%; }
        th:nth-child(3), td:nth-child(3) { width: 25%; }
        th:nth-child(5), td:nth-child(5) { width: 20%; }
        th:nth-child(7), td:nth-child(7) { width: 12%; }
        th:nth-child(8), td:nth-child(8) { width: 15%; }
        
        /* Improve mobile button styling */
        .actions {
            flex-direction: column;
            gap: 2px;
        }
        
        .actions .btn {
            width: 100%;
            padding: 4px 6px;
            font-size: 0.6rem;
            min-height: 28px;
        }
        
        .actions .btn i {
            display: none;
        }
        
        /* Mobile form styling */
        .form-control {
            font-size: 16px; /* Prevents zoom on iOS */
            min-height: 44px; /* Touch target size */
        }
        
        /* Mobile header actions */
        .header-actions .btn {
            padding: 12px 16px;
            font-size: 0.875rem;
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Alerts -->
@if(session('success'))
    <div id="successMessage" class="alert alert-success">
        <i class="bi bi-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div id="errorMessage" class="alert alert-error">
        <i class="bi bi-exclamation-circle"></i>
        {{ session('error') }}
    </div>
@endif

<div style="background: #fff; min-height: calc(100vh - 76px); padding: 0;">
    <!-- Search and Filter Section -->
    <div class="search-filter-section">
        <div class="search-filter-row">
            <div class="search-input-wrapper">
                <input type="text" 
                       id="searchInput" 
                       class="form-control"
                       placeholder="Search by name, username, or email..." 
                       onkeyup="filterUsers()">
            </div>
            
            <div class="filter-select-wrapper">
                <select id="roleFilter" 
                        class="form-control"
                        onchange="filterUsers()">
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="head">Head Office</option>
                    <option value="offices">Offices</option>
                    <option value="student">Student</option>
                </select>
            </div>
            
            <button onclick="clearFilters()" class="btn btn-gray">
                <i class="bi bi-x-circle"></i> Clear
            </button>
            
            <button class="btn btn-primary" onclick="openCreateUserModal()" style="padding: 8px 16px; background: #3b82f6; color: white; border: none; border-radius: 6px; font-size: 14px; cursor: pointer; display: flex; align-items: center; gap: 6px; font-weight: 500;">
                <i class="bi bi-person-plus"></i>
                Create New User
            </button>
        </div>
    </div>
    
    <div class="content-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Office</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    @forelse($users as $user)
                    <tr class="user-row" 
                        data-name="{{ strtolower($user->name) }}" 
                        data-username="{{ strtolower($user->username) }}" 
                        data-email="{{ strtolower($user->email) }}" 
                        data-role="{{ $user->role }}">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td style="text-align: center;">
                            <span style="color:#9ca3af;font-family:monospace;letter-spacing:2px;">••••••••</span>
                        </td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="role-badge" style="background:#3b82f6;color:#fff;">Administrator</span>
                            @elseif($user->role === 'head')
                                <span class="role-badge" style="background:#8b5cf6;color:#fff;">Head Office</span>
                            @elseif($user->role === 'offices')
                                <span class="role-badge" style="background:#f59e0b;color:#fff;">Offices</span>
                            @elseif($user->role === 'student')
                                <span class="role-badge" style="background:#10b981;color:#fff;">Student</span>
                            @else
                                <span class="role-badge" style="background:#6b7280;color:#fff;">{{ ucfirst($user->role) }}</span>
                            @endif
                        </td>
                        <td>
                            @if($user->office_name)
                                <span class="office-badge">{{ $user->office_name }}</span>
                            @else
                                <span style="color:#9ca3af;">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge status-active">Active</span>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="btn btn-primary" onclick='confirmEditUser({{ $user->id }}, "{{ addslashes($user->name) }}", "{{ $user->username }}", "{{ $user->email }}", "", "{{ $user->role }}", "{{ $user->office_name ?? "" }}")'>
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </button>
                                @if($user->role !== 'admin')
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick='return confirm("Are you sure you want to delete this user account for {{ addslashes($user->name) }}?")'>
                                        <i class="bi bi-trash"></i>
                                        Delete
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 48px; color: #9ca3af;">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 8px;"></i>
                            No users found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create User Modal -->
<div id="createUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Create New User Account</h3>
            <button type="button" class="modal-close" onclick="closeCreateUserModal()">&times;</button>
        </div>
        
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Role</label>
                <select name="role" id="userRole" class="form-control" required onchange="toggleOfficeField()">
                    <option value="">Select Role</option>
                    <option value="admin">Administrator</option>
                    <option value="head">Head Office</option>
                    <option value="offices">Offices</option>
                </select>
            </div>
            
            <div id="officeField" class="form-group" style="display: none;">
                <label>Assigned Office</label>
                <select name="office_name" class="form-control">
                    <option value="">Select Office</option>
                    <option value="LIBRARY">LIBRARY</option>
                    <option value="ACADS">ACADS</option>
                    <option value="REGISTRAR">REGISTRAR</option>
                    <option value="CANTEEN">CANTEEN</option>
                    <option value="KUWAGO">KUWAGO</option>
                    <option value="QUEUING">QUEUING</option>
                    <option value="HRD">HRD</option>
                    <option value="SAO">SAO</option>
                    <option value="GUIDANCE">GUIDANCE</option>
                    <option value="CLINIC">CLINIC</option>
                    <option value="OPEN LAB">OPEN LAB</option>
                    <option value="LINKAGES">LINKAGES</option>
                    <option value="XACTO">XACTO</option>
                    <option value="SITE FACULTY">SITE FACULTY</option>
                    <option value="SOHS FACULTY">SOHS FACULTY</option>
                    <option value="SOH FACULTY">SOH FACULTY</option>
                    <option value="STE FACULTY">STE FACULTY</option>
                    <option value="SOC FACULTY">SOC FACULTY</option>
                    <option value="SBA FACULTY">SBA FACULTY</option>
                    <option value="SOE FACULTY">SOE FACULTY</option>
                    <option value="SIHM FACULTY">SIHM FACULTY</option>
                    <option value="STE DEAN'S OFFICE">STE DEAN'S OFFICE</option>
                    <option value="FINANCE">FINANCE</option>
                    <option value="LCR">LCR</option>
                    <option value="STEEDS">STEEDS</option>
                    <option value="SPORTS AND CULTURE">SPORTS AND CULTURE</option>
                    <option value="QUALITY ASSURANCE">QUALITY ASSURANCE</option>
                    <option value="ARCHIVING">ARCHIVING</option>
                    <option value="PRESIDENT'S OFFICE">PRESIDENT'S OFFICE</option>
                    <option value="MARKETING">MARKETING</option>
                    <option value="ALUMNI OFFICE">ALUMNI OFFICE</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                <small class="form-help">Minimum 8 characters</small>
            </div>
            
            <div class="modal-actions">
                <button type="button" class="btn btn-gray" onclick="closeCreateUserModal()">Cancel</button>
                <button type="submit" class="btn btn-success">Create Account</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit User Account</h3>
            <button type="button" class="modal-close" onclick="closeEditUserModal()">&times;</button>
        </div>
        
        <form method="POST" action="" id="editUserForm" onsubmit="return confirmSaveEdit()">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" id="editName" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" id="editUsername" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="editEmail" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Role</label>
                <select name="role" id="editRole" class="form-control" required onchange="toggleEditOfficeField()">
                    <option value="admin">Administrator</option>
                    <option value="head">Head Office</option>
                    <option value="offices">Offices</option>
                    <option value="student">Student</option>
                </select>
            </div>
            
            <div id="editOfficeField" class="form-group" style="display: none;">
                <label>Assigned Office</label>
                <select name="office_name" id="editOfficeName" class="form-control">
                    <option value="">Select Office</option>
                    <option value="LIBRARY">LIBRARY</option>
                    <option value="ACADS">ACADS</option>
                    <option value="REGISTRAR">REGISTRAR</option>
                    <option value="CANTEEN">CANTEEN</option>
                    <option value="KUWAGO">KUWAGO</option>
                    <option value="QUEUING">QUEUING</option>
                    <option value="HRD">HRD</option>
                    <option value="SAO">SAO</option>
                    <option value="GUIDANCE">GUIDANCE</option>
                    <option value="CLINIC">CLINIC</option>
                    <option value="OPEN LAB">OPEN LAB</option>
                    <option value="LINKAGES">LINKAGES</option>
                    <option value="XACTO">XACTO</option>
                    <option value="SITE FACULTY">SITE FACULTY</option>
                    <option value="SOHS FACULTY">SOHS FACULTY</option>
                    <option value="SOH FACULTY">SOH FACULTY</option>
                    <option value="STE FACULTY">STE FACULTY</option>
                    <option value="SOC FACULTY">SOC FACULTY</option>
                    <option value="SBA FACULTY">SBA FACULTY</option>
                    <option value="SOE FACULTY">SOE FACULTY</option>
                    <option value="SIHM FACULTY">SIHM FACULTY</option>
                    <option value="STE DEAN'S OFFICE">STE DEAN'S OFFICE</option>
                    <option value="FINANCE">FINANCE</option>
                    <option value="LCR">LCR</option>
                    <option value="STEEDS">STEEDS</option>
                    <option value="SPORTS AND CULTURE">SPORTS AND CULTURE</option>
                    <option value="QUALITY ASSURANCE">QUALITY ASSURANCE</option>
                    <option value="ARCHIVING">ARCHIVING</option>
                    <option value="PRESIDENT'S OFFICE">PRESIDENT'S OFFICE</option>
                    <option value="MARKETING">MARKETING</option>
                    <option value="ALUMNI OFFICE">ALUMNI OFFICE</option>
                </select>
            </div>
            
            <div class="form-group">
                <div class="password-field-group">
                    <label>Password</label>
                    <button type="button" onclick="resetPassword()" class="btn btn-reset">
                        Reset Password
                    </button>
                </div>
                <input type="password" name="password" id="editPassword" class="form-control">
                <small class="form-help">Leave blank to keep current password</small>
            </div>
            
            <div class="modal-actions">
                <button type="button" class="btn btn-gray" onclick="closeEditUserModal()">Cancel</button>
                <button type="submit" class="btn btn-success">Update Account</button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateUserModal() {
    document.getElementById('createUserModal').classList.add('active');
}

function closeCreateUserModal() {
    document.getElementById('createUserModal').classList.remove('active');
    document.querySelector('#createUserModal form').reset();
    document.getElementById('officeField').style.display = 'none';
}

function openEditUserModal(userId, name, username, email, password, role, officeName) {
    document.getElementById('editUserModal').classList.add('active');
    document.getElementById('editUserForm').action = `/users/${userId}`;
    document.getElementById('editName').value = name;
    document.getElementById('editUsername').value = username;
    document.getElementById('editEmail').value = email;
    document.getElementById('editPassword').value = '';
    document.getElementById('editRole').value = role;
    document.getElementById('editOfficeName').value = officeName || '';
    
    toggleEditOfficeField();
}

function closeEditUserModal() {
    document.getElementById('editUserModal').classList.remove('active');
}

function toggleEditOfficeField() {
    const roleSelect = document.getElementById('editRole');
    const officeField = document.getElementById('editOfficeField');
    const officeSelect = document.getElementById('editOfficeName');
    
    if (roleSelect.value === 'offices') {
        officeField.style.display = 'block';
        officeSelect.setAttribute('required', 'required');
    } else {
        officeField.style.display = 'none';
        officeSelect.removeAttribute('required');
        officeSelect.value = '';
    }
}

function resetPassword() {
    const currentRole = document.getElementById('editRole').value;
    let defaultPassword = '';
    
    if (currentRole === 'student') {
        defaultPassword = 'assistrack2025';
    } else if (currentRole === 'offices') {
        const officeName = document.getElementById('editOfficeName').value;
        defaultPassword = officeName ? officeName.toLowerCase() + '2025' : 'office2025';
    } else {
        defaultPassword = 'admin2025';
    }
    
    document.getElementById('editPassword').value = defaultPassword;
}

function toggleOfficeField() {
    const roleSelect = document.getElementById('userRole');
    const officeField = document.getElementById('officeField');
    const officeSelect = officeField.querySelector('select[name="office_name"]');
    
    if (roleSelect.value === 'offices') {
        officeField.style.display = 'block';
        officeSelect.setAttribute('required', 'required');
    } else {
        officeField.style.display = 'none';
        officeSelect.removeAttribute('required');
        officeSelect.value = '';
    }
}

// Close modals when clicking outside
document.getElementById('createUserModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCreateUserModal();
    }
});

document.getElementById('editUserModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditUserModal();
    }
});

// Auto-hide messages
document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    
    if (successMessage) {
        setTimeout(function() {
            successMessage.style.opacity = '0';
            setTimeout(function() {
                successMessage.remove();
            }, 500);
        }, 3000);
    }
    
    if (errorMessage) {
        setTimeout(function() {
            errorMessage.style.opacity = '0';
            setTimeout(function() {
                errorMessage.remove();
            }, 500);
        }, 3000);
    }
});

// Search and Filter Functions
function filterUsers() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const roleFilter = document.getElementById('roleFilter').value;
    const rows = document.querySelectorAll('.user-row');
    
    let visibleCount = 0;
    
    rows.forEach(function(row) {
        const name = row.dataset.name;
        const username = row.dataset.username;
        const email = row.dataset.email;
        const role = row.dataset.role;
        
        const matchesSearch = !searchInput || 
            name.includes(searchInput) || 
            username.includes(searchInput) || 
            email.includes(searchInput);
        
        const matchesRole = !roleFilter || role === roleFilter;
        
        if (matchesSearch && matchesRole) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    updateNoResultsMessage(visibleCount);
}

function clearFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('roleFilter').value = '';
    filterUsers();
}

function updateNoResultsMessage(visibleCount) {
    const tbody = document.getElementById('userTableBody');
    let noResultsRow = document.getElementById('noResultsRow');
    
    if (visibleCount === 0) {
        if (!noResultsRow) {
            noResultsRow = document.createElement('tr');
            noResultsRow.id = 'noResultsRow';
            noResultsRow.innerHTML = '<td colspan="8" style="text-align: center; padding: 48px; color: #9ca3af;"><i class="bi bi-search" style="font-size: 2rem; display: block; margin-bottom: 8px;"></i>No users match your search criteria</td>';
            tbody.appendChild(noResultsRow);
        }
        noResultsRow.style.display = '';
    } else {
        if (noResultsRow) {
            noResultsRow.style.display = 'none';
        }
    }
}

// Security confirmation functions
function confirmEditUser(userId, name, username, email, password, role, officeName) {
    if (role === 'admin' || role === 'head') {
        const isConfirmed = confirm(
            '⚠️ SECURITY NOTICE: You are about to edit a ' + (role === 'admin' ? 'Administrator' : 'Head Office') + ' account for "' + name + '".\n\n' +
            'This is a privileged account with elevated permissions. Please ensure you have authorization to make changes.\n\n' +
            'Do you want to continue?'
        );
        
        if (!isConfirmed) {
            return false;
        }
    }
    
    openEditUserModal(userId, name, username, email, password, role, officeName);
}

function confirmSaveEdit() {
    const currentRole = document.getElementById('editRole').value;
    const userName = document.getElementById('editName').value;
    
    if (currentRole === 'admin' || currentRole === 'head') {
        return confirm(
            '🔒 Final Confirmation Required\n\n' +
            'You are saving changes to ' + (currentRole === 'admin' ? 'Administrator' : 'Head Office') + ' account: "' + userName + '"\n\n' +
            'This action will update critical system access credentials. Please confirm this is intentional.\n\n' +
            'Save changes to this privileged account?'
        );
    }
    
    return confirm('Save changes to "' + userName + '"?');
}
</script>
</div>
@endsection
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

    .content-body {
        flex: 1;
        padding: 24px;
    }

    .table-container {
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    th {
        background: #f9fafb;
        font-weight: 600;
        font-size: 0.875rem;
        color: #374151;
    }

    td {
        font-size: 0.875rem;
        color: #6b7280;
    }

    tr:hover td {
        background: #f9fafb;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
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

    .status-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-active {
        background: #d1fae5;
        color: #065f46;
    }

    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    .actions {
        display: flex;
        gap: 8px;
    }
</style>

<!-- Main Content -->
@if(session('success'))
    <div id="successMessage" style="background:#10b981;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:16px;transition:opacity 0.5s ease-out;">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div id="errorMessage" style="background:#ef4444;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:16px;transition:opacity 0.5s ease-out;">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
    </div>
@endif

<div class="content-card">
    <div class="content-header">
        <span class="icon">
            <i class="bi bi-people-fill"></i>
        </span>
        User Management
        <div style="margin-left: auto;">
            <button class="btn btn-primary" onclick="openCreateUserModal()" style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; background: #3b82f6; color: white; border: none; border-radius: 6px; cursor: pointer;">
                <i class="bi bi-person-plus"></i>
                Create New User
            </button>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div style="padding: 20px; border-bottom: 1px solid #e5e7eb; background: #f9fafb;">
        <div style="display: flex; gap: 16px; flex-wrap: wrap; align-items: center;">
            <!-- Search Input -->
            <div style="flex: 1; min-width: 250px;">
                <input type="text" 
                       id="searchInput" 
                       placeholder="Search by name, username, or email..." 
                       style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem;"
                       onkeyup="filterUsers()">
            </div>
            
            <!-- Role Filter -->
            <div style="min-width: 150px;">
                <select id="roleFilter" 
                        onchange="filterUsers()" 
                        style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; background: white;">
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="head">Head Office</option>
                    <option value="offices">Offices</option>
                    <option value="student">Student</option>
                </select>
            </div>
            
            <!-- Clear Filters -->
            <button onclick="clearFilters()" 
                    style="padding: 8px 16px; background: #6b7280; color: white; border: none; border-radius: 6px; font-size: 0.875rem; cursor: pointer;">
                <i class="bi bi-x-circle"></i> Clear
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
                        data-role="{{ $user->role }}" 
                        data-office="{{ $user->office_name ?? '' }}">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span style="color:#6b7280;font-family:monospace;font-size:0.875rem;">••••••••</span>
                        </td>
                        <td>
                            @if($user->role === 'admin')
                                <span style="background:#3b82f6;color:#fff;padding:2px 8px;border-radius:12px;font-size:0.75rem;font-weight:500;">Administrator</span>
                            @elseif($user->role === 'head')
                                <span style="background:#8b5cf6;color:#fff;padding:2px 8px;border-radius:12px;font-size:0.75rem;font-weight:500;">Head Office</span>
                            @elseif($user->role === 'offices')
                                <span style="background:#f59e0b;color:#fff;padding:2px 8px;border-radius:12px;font-size:0.75rem;font-weight:500;">Offices</span>
                            @elseif($user->role === 'student')
                                <span style="background:#10b981;color:#fff;padding:2px 8px;border-radius:12px;font-size:0.75rem;font-weight:500;">Student</span>
                            @else
                                <span style="background:#6b7280;color:#fff;padding:2px 8px;border-radius:12px;font-size:0.75rem;font-weight:500;">{{ ucfirst($user->role) }}</span>
                            @endif
                        </td>
                        <td>
                            @if($user->office_name)
                                <span style="background:#f3f4f6;color:#374151;padding:2px 8px;border-radius:6px;font-size:0.75rem;font-weight:500;">{{ $user->office_name }}</span>
                            @else
                                <span style="color:#6b7280;">-</span>
                            @endif
                        </td>
                        <td><span class="status-badge status-active">Active</span></td>
                        <td class="actions">
                            <button class="btn btn-primary" onclick="confirmEditUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->username }}', '{{ $user->email }}', '', '{{ $user->role }}', '{{ $user->office_name }}')">
                                <i class="bi bi-pencil-square"></i>
                                Edit
                            </button>
                            @if($user->role !== 'admin')
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user account for {{ $user->name }}?')">
                                    <i class="bi bi-trash"></i>
                                    Delete
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 24px; color: #6b7280;">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create User Modal -->
<div id="createUserModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 24px; border-radius: 12px; width: 90%; max-width: 500px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #111827;">Create New User Account</h3>
            <button onclick="closeCreateUserModal()" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #6b7280;">&times;</button>
        </div>
        
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #374151;">Full Name</label>
                <input type="text" name="name" required style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
            </div>
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #374151;">Username</label>
                <input type="text" name="username" required style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
            </div>
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #374151;">Email</label>
                <input type="email" name="email" required style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
            </div>
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #374151;">Role</label>
                <select name="role" id="userRole" required style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;" onchange="toggleOfficeField()">
                    <option value="">Select Role</option>
                    <option value="admin">Administrator</option>
                    <option value="head">Head Office</option>
                    <option value="offices">Offices</option>
                </select>
            </div>
            
            <div id="officeField" style="margin-bottom: 16px; display: none;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #374151;">Assigned Office</label>
                <select name="office_name" style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
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
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #374151;">Password</label>
                <input type="password" name="password" required style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
                <small style="color: #6b7280; font-size: 12px;">Minimum 8 characters</small>
            </div>
            
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="closeCreateUserModal()" style="padding: 8px 16px; background: #6b7280; color: white; border: none; border-radius: 6px; cursor: pointer;">Cancel</button>
                <button type="submit" style="padding: 8px 16px; background: #10b981; color: white; border: none; border-radius: 6px; cursor: pointer;">Create Account</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 24px; border-radius: 12px; width: 90%; max-width: 500px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #111827;">Edit User Account</h3>
            <button onclick="closeEditUserModal()" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #6b7280;">&times;</button>
        </div>
        
        <form method="POST" action="" id="editUserForm" onsubmit="return confirmSaveEdit()">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #374151;">Full Name</label>
                <input type="text" name="name" id="editName" required style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
            </div>
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #374151;">Username</label>
                <input type="text" name="username" id="editUsername" required style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
            </div>
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #374151;">Email</label>
                <input type="email" name="email" id="editEmail" required style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
            </div>
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #374151;">Role</label>
                <select name="role" id="editRole" required style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;" onchange="toggleEditOfficeField()">
                    <option value="admin">Administrator</option>
                    <option value="head">Head Office</option>
                    <option value="offices">Offices</option>
                    <option value="student">Student</option>
                </select>
            </div>
            
            <div id="editOfficeField" style="margin-bottom: 16px; display: none;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #374151;">Assigned Office</label>
                <select name="office_name" id="editOfficeName" style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
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
            
            <div style="margin-bottom: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                    <label style="font-weight: 600; color: #374151;">Password</label>
                    <button type="button" onclick="resetPassword()" style="background: #f59e0b; color: white; border: none; padding: 4px 8px; border-radius: 4px; font-size: 12px; cursor: pointer;">Reset Password</button>
                </div>
                <input type="password" name="password" id="editPassword" style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
                <small style="color: #6b7280; font-size: 12px;">Leave blank to keep current password</small>
            </div>
            
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="closeEditUserModal()" style="padding: 8px 16px; background: #6b7280; color: white; border: none; border-radius: 6px; cursor: pointer;">Cancel</button>
                <button type="submit" style="padding: 8px 16px; background: #10b981; color: white; border: none; border-radius: 6px; cursor: pointer;">Update Account</button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateUserModal() {
    document.getElementById('createUserModal').style.display = 'block';
}

function closeCreateUserModal() {
    document.getElementById('createUserModal').style.display = 'none';
    // Reset form
    document.querySelector('#createUserModal form').reset();
    document.getElementById('officeField').style.display = 'none';
}

function openEditUserModal(userId, name, username, email, password, role, officeName) {
    document.getElementById('editUserModal').style.display = 'block';
    document.getElementById('editUserForm').action = `/users/${userId}`;
    document.getElementById('editName').value = name;
    document.getElementById('editUsername').value = username;
    document.getElementById('editEmail').value = email;
    document.getElementById('editPassword').value = ''; // Always start with empty password
    document.getElementById('editRole').value = role;
    document.getElementById('editOfficeName').value = officeName || '';
    
    // Show/hide office field based on role
    toggleEditOfficeField();
}

function closeEditUserModal() {
    document.getElementById('editUserModal').style.display = 'none';
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

// Auto-hide success and error messages
document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    
    if (successMessage) {
        setTimeout(function() {
            successMessage.style.opacity = '0';
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 500);
        }, 3000); // Hide after 3 seconds
    }
    
    if (errorMessage) {
        setTimeout(function() {
            errorMessage.style.opacity = '0';
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 500);
        }, 3000); // Hide after 3 seconds
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
        
        // Check search criteria
        const matchesSearch = !searchInput || 
            name.includes(searchInput) || 
            username.includes(searchInput) || 
            email.includes(searchInput);
        
        // Check role filter
        const matchesRole = !roleFilter || role === roleFilter;
        
        // Show/hide row based on criteria
        if (matchesSearch && matchesRole) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Show "no results" message if needed
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
            noResultsRow.innerHTML = '<td colspan="8" style="text-align: center; padding: 24px; color: #6b7280;">No users match your search criteria.</td>';
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
    // Check if editing admin or head office account
    if (role === 'admin' || role === 'head') {
        const isConfirmed = confirm(
            `⚠️ SECURITY NOTICE: You are about to edit a ${role === 'admin' ? 'Administrator' : 'Head Office'} account for "${name}".\n\n` +
            `This is a privileged account with elevated permissions. Please ensure you have authorization to make changes.\n\n` +
            `Do you want to continue?`
        );
        
        if (!isConfirmed) {
            return false;
        }
    }
    
    // Open the edit modal
    openEditUserModal(userId, name, username, email, password, role, officeName);
}

function confirmSaveEdit() {
    const currentRole = document.getElementById('editRole').value;
    const userName = document.getElementById('editName').value;
    
    // Extra confirmation for admin/head office edits
    if (currentRole === 'admin' || currentRole === 'head') {
        return confirm(
            `🔒 Final Confirmation Required\n\n` +
            `You are saving changes to ${currentRole === 'admin' ? 'Administrator' : 'Head Office'} account: "${userName}"\n\n` +
            `This action will update critical system access credentials. Please confirm this is intentional.\n\n` +
            `Save changes to this privileged account?`
        );
    }
    
    // Standard confirmation for other accounts
    return confirm(`Save changes to "${userName}"?`);
}
</script>
@endsection
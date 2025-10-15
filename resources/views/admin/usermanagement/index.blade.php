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
    <div style="background:#10b981;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:16px;">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background:#ef4444;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:16px;">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
    </div>
@endif

<div class="content-card">
    <div class="content-header">
        <span class="icon">
            <i class="bi bi-people-fill"></i>
        </span>
        User Management
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
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role === 'student')
                                <span style="color:#6b7280;font-family:monospace;">assistrack2025</span>
                            @else
                                <span style="color:#6b7280;">••••••••</span>
                            @endif
                        </td>
                        <td>
                            @if($user->role === 'admin')
                                <span style="background:#3b82f6;color:#fff;padding:2px 8px;border-radius:12px;font-size:0.75rem;font-weight:500;">Administrator</span>
                            @elseif($user->role === 'head_office')
                                <span style="background:#8b5cf6;color:#fff;padding:2px 8px;border-radius:12px;font-size:0.75rem;font-weight:500;">Head Office</span>
                            @elseif($user->role === 'student')
                                <span style="background:#10b981;color:#fff;padding:2px 8px;border-radius:12px;font-size:0.75rem;font-weight:500;">Student</span>
                            @else
                                <span style="background:#6b7280;color:#fff;padding:2px 8px;border-radius:12px;font-size:0.75rem;font-weight:500;">{{ ucfirst($user->role) }}</span>
                            @endif
                        </td>
                        <td><span class="status-badge status-active">Active</span></td>
                        <td class="actions">
                            <button class="btn btn-primary">
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
                        <td colspan="7" style="text-align: center; padding: 24px; color: #6b7280;">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
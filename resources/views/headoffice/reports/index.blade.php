@extends('layouts.app')

@section('content')
<style>

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
        border-radius: 10px;
        padding: 0;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .content-header {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 16px 20px;
        border-bottom: 1px solid #e5e7eb;
        background: #f9fafb;
        font-size: 0.95rem;
        color: #374151;
        font-weight: 600;
    }
    .reports-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #111827;
        margin: 16px 24px 4px 24px;
    }
    .reports-desc {
        font-size: 0.95rem;
        color: #6b7280;
        margin-bottom: 12px;
        padding: 0 24px;
    }
    .table-container {
        width: 100%;
        padding: 0 24px 24px 24px;
        overflow-x: auto;
    }
    .reports-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
    }
    .reports-table thead th {
        background: #f3f4f6;
        color: #111827;
        font-size: 0.9rem;
        font-weight: 600;
        padding: 12px 16px;
        text-align: left;
    }
    .reports-table tbody td {
        font-size: 0.9rem;
        color: #374151;
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
    }
    .reports-table tbody tr:hover td {
        background: #f9fafb;
    }
    .reports-table tbody tr:last-child td {
        border-bottom: none;
    }
</style>


<!-- Main Content -->
<div class="content-card">
            <div class="content-header">
                <span class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <line x1="9" y1="9" x2="15" y2="9"/>
                        <line x1="9" y1="15" x2="15" y2="15"/>
                    </svg>
                </span>
                Reports
            </div>
            <div class="reports-title">Reports</div>
            <div class="reports-desc">This list contains of the students and their reports</div>
            <div class="table-container">
                <table class="reports-table">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Designated Office</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Reports rows go here -->
                    </tbody>
                </table>
            </div>
        </div>
@endsection

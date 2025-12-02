@extends('layouts.app')

@section('page-title')
    <i class="bi bi-person-check-fill" style="margin-right: 8px;"></i>
    SA REQUESTS
@endsection

@section('content')
<style>
    /* Mobile optimization */
    * {
        -webkit-tap-highlight-color: transparent;
        box-sizing: border-box;
    }

    .content-card {
        flex: 1;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        overflow: hidden;
        margin: 0;
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

    .header-wrapper {
        padding: 20px 24px 0;
    }

    .sa-requests-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 4px;
    }

    .sa-requests-desc {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 16px;
    }

    /* Mobile responsive styles */
    @media (max-width: 768px) {
        .content-header {
            padding: 12px 16px;
            font-size: 0.85rem;
            flex-wrap: wrap;
        }

        .content-header svg {
            width: 18px;
            height: 18px;
        }

        .header-wrapper {
            padding: 16px 16px 0;
        }

        .sa-requests-desc {
            font-size: 0.8rem;
            margin-bottom: 12px;
        }
    }

    .requests-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }

    .requests-table th {
        background: #f9fafb;
        padding: 12px 16px;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
    }

    .requests-table td {
        padding: 12px 16px;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }

    .requests-table tbody tr:hover {
        background: #f9fafb;
    }

    /* Mobile table styles */
    @media (max-width: 768px) {
        .requests-table {
            font-size: 0.8rem;
        }

        .requests-table th,
        .requests-table td {
            padding: 8px 12px;
        }

        /* Hide less important columns on mobile */
        .requests-table th:nth-child(5),
        .requests-table td:nth-child(5),
        .requests-table th:nth-child(6),
        .requests-table td:nth-child(6) {
            display: none;
        }
    }

    @media (max-width: 480px) {
        /* Stack table content vertically on very small screens */
        .requests-table {
            font-size: 0.75rem;
        }

        .requests-table th,
        .requests-table td {
            padding: 6px 8px;
        }

        /* Hide more columns on very small screens */
        .requests-table th:nth-child(3),
        .requests-table td:nth-child(3) {
            display: none;
        }
    }

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        text-transform: capitalize;
    }

    .status-pending {
        background: #fef3c7;
        color: #d97706;
    }

    .status-approved {
        background: #d1fae5;
        color: #059669;
    }

    .status-rejected {
        background: #fecaca;
        color: #dc2626;
    }

    .action-btn {
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        margin: 0 2px;
        transition: all 0.2s;
        min-width: 44px; /* Minimum touch target size */
        min-height: 32px;
    }

    .btn-approve {
        background: #10b981;
        color: white;
    }

    .btn-approve:hover {
        background: #059669;
    }

    .btn-reject {
        background: #ef4444;
        color: white;
    }

    .btn-reject:hover {
        background: #dc2626;
    }

    .btn-disabled {
        background: #9ca3af;
        color: #6b7280;
        cursor: not-allowed;
    }

    .pagination-controls {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 16px;
        padding: 20px;
    }

    .pagination-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #fff;
        color: #374151;
        transition: all 0.2s;
        text-decoration: none;
    }

    .pagination-btn:hover:not([disabled]) {
        background: #f3f4f6;
    }

    .pagination-btn[disabled] {
        color: #9ca3af;
        cursor: not-allowed;
    }

    .pagination-text {
        color: #6b7280;
        font-size: 0.9rem;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
    }

    .modal-content {
        background: white;
        margin: 10% auto;
        padding: 20px;
        border-radius: 10px;
        width: 90%;
        max-width: 500px;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .modal-title {
        font-size: 1.2rem;
        font-weight: 600;
    }

    .close {
        font-size: 24px;
        cursor: pointer;
        color: #6b7280;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-label {
        display: block;
        margin-bottom: 4px;
        font-weight: 500;
        color: #374151;
    }

    .form-input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .form-textarea {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.9rem;
        min-height: 80px;
        resize: vertical;
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn-modal {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-primary {
        background: #3b82f6;
        color: white;
    }

    .btn-secondary {
        background: #6b7280;
        color: white;
    }

    /* Mobile responsive button styles */
    @media (max-width: 768px) {
        .action-btn {
            padding: 4px 8px;
            font-size: 0.75rem;
            margin: 0 1px;
            min-width: 40px;
            min-height: 28px;
        }

        /* Stack buttons vertically if needed */
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
    }

    /* Mobile container and padding adjustments */
    @media (max-width: 768px) {
        .content-card {
            margin: 0 -8px;
            border-radius: 8px;
        }

        div[style*="padding: 0 24px 24px"] {
            padding: 0 16px 16px !important;
        }
    }

    @media (max-width: 480px) {
        .content-card {
            margin: 0 -4px;
            border-radius: 6px;
        }

        div[style*="padding: 0 24px 24px"],
        div[style*="padding: 0 16px 16px"] {
            padding: 0 12px 12px !important;
        }
    }

    /* Mobile pagination styles */
    @media (max-width: 768px) {
        .pagination-container {
            padding: 12px 16px;
        }

        .pagination-btn {
            padding: 6px 12px;
            font-size: 0.8rem;
        }

        .pagination-text {
            font-size: 0.8rem;
        }
    }

    /* Mobile modal styles */
    @media (max-width: 768px) {
        .modal {
            padding: 20px 16px;
        }

        .modal-content {
            width: 95%;
            max-width: none;
            margin: 0;
        }

        .modal-title {
            font-size: 1.1rem;
        }

        .modal input,
        .modal textarea,
        .modal select {
            font-size: 16px; /* Prevents zoom on iOS */
        }
    }

    /* Responsive table scroll for very small screens */
    @media (max-width: 480px) {
        .table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .requests-table {
            min-width: 320px;
        }
    }
</style>

<div class="content-card">
    <div class="content-header">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2">
            <path d="M16 21v-2a4 4 0 0 0-4 4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="8.5" cy="7" r="4"/>
            <polyline points="17,11 19,13 23,9"/>
        </svg>
        Student Assistant Requests Management
    </div>
    
    <div class="header-wrapper">
        <p class="sa-requests-desc">Review and manage Student Assistant requests from offices</p>
    </div>

    <div style="flex: 1; padding: 0 24px 24px;">
        @if($saRequests->count() > 0)
            <div class="table-container">
                <table class="requests-table">
                <thead>
                    <tr>
                        <th>Office</th>
                        <th>SAs Needed</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Assigned Student</th>
                        <th>Requested Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saRequests as $request)
                    <tr>
                        <td>{{ $request->office }}</td>
                        <td>{{ $request->requested_count }}</td>
                        <td style="max-width: 200px; word-wrap: break-word;">{{ Str::limit($request->description, 60) }}</td>
                        <td>
                            <span class="status-badge status-{{ $request->status }}">
                                {{ $request->status }}
                            </span>
                        </td>
                        <td>
                            @if($request->assignedStudent)
                                <div>
                                    <strong>{{ $request->assignedStudent->student_name }}</strong><br>
                                    <small>{{ $request->assignedStudent->id_number }}</small>
                                </div>
                            @else
                                <span style="color: #6b7280; font-style: italic;">Not assigned</span>
                            @endif
                        </td>
                        <td>{{ $request->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                @if($request->status === 'pending')
                                    <button class="action-btn btn-approve" 
                                            onclick="showAssignmentModal({{ $request->id }}, '{{ $request->office }}', {{ $request->requested_count }}, '{{ addslashes($request->description) }}')">
                                        Assign SA
                                    </button>
                                    <button class="action-btn btn-reject" 
                                            onclick="showRejectionModal({{ $request->id }}, '{{ $request->office }}', '{{ addslashes($request->description) }}')">
                                        Reject
                                    </button>
                                @else
                                    <button class="action-btn btn-disabled" disabled>
                                        {{ ucfirst($request->status) }}
                                    </button>
                                    @if($request->reason)
                                        <small style="display: block; color: #6b7280; margin-top: 4px;">
                                            Reason: {{ $request->reason }}
                                        </small>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            <div class="pagination-controls pagination-container">
                @if ($saRequests->onFirstPage())
                    <button class="pagination-btn" disabled>
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                @else
                    <a href="{{ $saRequests->previousPageUrl() }}" class="pagination-btn">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                @endif
                <span class="pagination-text">Page {{ $saRequests->currentPage() }} of {{ $saRequests->lastPage() }}</span>
                @if ($saRequests->hasMorePages())
                    <a href="{{ $saRequests->nextPageUrl() }}" class="pagination-btn">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @else
                    <button class="pagination-btn" disabled>
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                @endif
            </div>
        @else
            <div style="text-align: center; padding: 60px 20px; color: #6b7280;">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin: 0 auto 16px; opacity: 0.5;">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="8.5" cy="7" r="4"/>
                    <polyline points="17,11 19,13 23,9"/>
                </svg>
                <h3 style="margin-bottom: 8px; font-size: 1.1rem;">No SA Requests Found</h3>
                <p style="margin: 0; font-size: 0.9rem;">There are currently no Student Assistant requests to review.</p>
            </div>
        @endif
    </div>
</div>

<!-- Assignment Modal -->
<div id="assignmentModal" class="modal">
    <div class="modal-content" style="max-width: 600px;">
        <div class="modal-header">
            <h2 class="modal-title">Assign Student Assistant</h2>
            <span class="close" onclick="closeModal('assignmentModal')">&times;</span>
        </div>
        <form id="assignmentForm">
            <div class="form-group">
                <label class="form-label">Office:</label>
                <input type="text" id="assignOffice" class="form-input" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">SAs Needed:</label>
                <input type="text" id="assignRequestedCount" class="form-input" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Description:</label>
                <textarea id="assignDescription" class="form-textarea" readonly rows="3"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Select Student to Assign:</label>
                <select id="assignStudentId" class="form-input" required>
                    <option value="">Loading students...</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Assignment Notes (Optional):</label>
                <textarea id="assignReason" class="form-textarea" placeholder="Add any notes about this assignment..."></textarea>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-secondary" onclick="closeModal('assignmentModal')">Cancel</button>
                <button type="submit" class="btn-modal btn-primary">Assign Student</button>
            </div>
        </form>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejectionModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Reject SA Request</h2>
            <span class="close" onclick="closeModal('rejectionModal')">&times;</span>
        </div>
        <form id="rejectionForm">
            <div class="form-group">
                <label class="form-label">Office:</label>
                <input type="text" id="rejectOffice" class="form-input" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Request Description:</label>
                <textarea id="rejectDescription" class="form-textarea" readonly rows="3"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Rejection Reason:</label>
                <textarea id="rejectReason" class="form-textarea" placeholder="Please provide a reason for rejection..." required></textarea>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-secondary" onclick="closeModal('rejectionModal')">Cancel</button>
                <button type="submit" class="btn-modal btn-primary">Reject Request</button>
            </div>
        </form>
    </div>
</div>

<script>
let currentRequestId = null;

function showAssignmentModal(requestId, office, requestedCount, description) {
    currentRequestId = requestId;
    document.getElementById('assignOffice').value = office;
    document.getElementById('assignRequestedCount').value = requestedCount;
    document.getElementById('assignDescription').value = description;
    document.getElementById('assignReason').value = '';
    
    // Load available students
    loadAvailableStudents();
    
    document.getElementById('assignmentModal').style.display = 'block';
}

function showRejectionModal(requestId, office, description) {
    currentRequestId = requestId;
    document.getElementById('rejectOffice').value = office;
    document.getElementById('rejectDescription').value = description;
    document.getElementById('rejectReason').value = '';
    document.getElementById('rejectionModal').style.display = 'block';
}

function loadAvailableStudents() {
    const select = document.getElementById('assignStudentId');
    select.innerHTML = '<option value="">Loading students...</option>';
    
    // Fetch available students (those not currently assigned as SA)
    fetch('/admin/available-students', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        select.innerHTML = '<option value="">Select a student...</option>';
        data.students.forEach(student => {
            const option = document.createElement('option');
            option.value = student.id;
            option.textContent = `${student.student_name} (${student.id_number}) - ${student.course} Year ${student.year_level}`;
            select.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error loading students:', error);
        select.innerHTML = '<option value="">Error loading students</option>';
    });
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
    currentRequestId = null;
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    const assignmentModal = document.getElementById('assignmentModal');
    const rejectionModal = document.getElementById('rejectionModal');
    if (event.target === assignmentModal) {
        closeModal('assignmentModal');
    }
    if (event.target === rejectionModal) {
        closeModal('rejectionModal');
    }
}

// Handle assignment form submission
document.getElementById('assignmentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const studentId = document.getElementById('assignStudentId').value;
    const reason = document.getElementById('assignReason').value;
    
    if (!studentId) {
        alert('Please select a student to assign');
        return;
    }
    
    fetch(`/admin/sa-requests/${currentRequestId}/assign`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ 
            student_id: studentId,
            reason: reason 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert(data.message || 'Error assigning SA');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error assigning SA');
    });
});

// Handle rejection form submission
document.getElementById('rejectionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const reason = document.getElementById('rejectReason').value;
    
    if (!reason.trim()) {
        alert('Please provide a reason for rejection');
        return;
    }
    
    fetch(`/admin/sa-requests/${currentRequestId}/reject`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ reason: reason })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert(data.message || 'Error rejecting SA request');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error rejecting SA request');
    });
});
</script>

@endsection
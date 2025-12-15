@extends('layouts.app')

@section('page-title')
    <i class="bi bi-person-check-fill" style="margin-right: 8px;"></i>
    SA REQUESTS
@endsection

@section('content')
@php
    // Auto-detect current school year and semester
    $currentMonth = (int) date('n'); // 1-12
    $currentYear = (int) date('Y');
    
    // Determine semester and school year based on month
    if ($currentMonth >= 8 && $currentMonth <= 12) {
        // August to December = 1st Semester
        $currentSemester = '1st Semester';
        $currentSchoolYear = $currentYear . '-' . ($currentYear + 1);
    } elseif ($currentMonth >= 1 && $currentMonth <= 5) {
        // January to May = 2nd Semester
        $currentSemester = '2nd Semester';
        $currentSchoolYear = ($currentYear - 1) . '-' . $currentYear;
    } else {
        // June to July = Summer
        $currentSemester = 'Summer';
        $currentSchoolYear = ($currentYear - 1) . '-' . $currentYear;
    }
@endphp
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
        display: none !important;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
        padding: 20px;
        box-sizing: border-box;
    }

    .modal.show {
        display: flex !important;
    }

    .modal-content {
        background: white;
        padding: 24px;
        border-radius: 10px;
        width: 100%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        animation: modalSlideIn 0.3s ease-out;
        margin: 0;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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

    /* Styles for multiple student selection */
    #multipleStudentSelection {
        margin-top: 4px;
    }

    #studentCheckboxList {
        background: #f9fafb;
    }

    #studentCheckboxList > div {
        padding: 8px 12px;
        border-bottom: 1px solid #e5e7eb;
        transition: background-color 0.2s;
    }

    #studentCheckboxList > div:hover {
        background: #f3f4f6;
    }

    #studentCheckboxList > div:last-child {
        border-bottom: none;
    }

    #studentCheckboxList input[type="checkbox"] {
        accent-color: #2563eb;
    }

    #studentCheckboxList label {
        user-select: none;
        flex: 1;
    }

    .partial-assignment-info {
        background: #fef3c7;
        border: 1px solid #f59e0b;
        border-radius: 6px;
        padding: 8px 12px;
        margin: 8px 0;
        font-size: 0.85rem;
        color: #92400e;
    }

    /* Modal button styles */
    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px solid #e5e7eb;
    }

    .btn-modal {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        min-width: 100px;
    }

    .btn-primary {
        background: #2563eb;
        color: white;
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }

    .btn-secondary:hover {
        background: #e5e7eb;
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
                            @php
                                $assignedStudents = $request->getAllAssignedStudents();
                                $assignedCount = $assignedStudents->count();
                            @endphp
                            
                            @if($assignedCount > 0)
                                @if($assignedCount == 1)
                                    <div>
                                        <strong>{{ $assignedStudents->first()->student_name }}</strong><br>
                                        <small>{{ $assignedStudents->first()->id_number }}</small>
                                    </div>
                                @else
                                    <div>
                                        <strong>{{ $assignedCount }} students assigned:</strong><br>
                                        @foreach($assignedStudents->take(2) as $student)
                                            <small>• {{ $student->student_name }} ({{ $student->id_number }})</small><br>
                                        @endforeach
                                        @if($assignedCount > 2)
                                            <small style="color: #6b7280;">... and {{ $assignedCount - 2 }} more</small>
                                        @endif
                                    </div>
                                @endif
                            @else
                                <span style="color: #6b7280; font-style: italic;">
                                    Not assigned 
                                    @if($request->requested_count > 1)
                                        ({{ $request->requested_count }} needed)
                                    @endif
                                </span>
                            @endif
                        </td>
                        <td>{{ $request->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                @php
                                    $assignedCount = $request->getAllAssignedStudents()->count();
                                    $isFullyAssigned = $assignedCount >= $request->requested_count;
                                @endphp
                                
                                @if($request->status === 'pending')
                                    <button class="action-btn btn-approve" 
                                            onclick="showAssignmentModal({{ $request->id }}, '{{ $request->office }}', {{ $request->requested_count }}, '{{ addslashes($request->description) }}')">
                                        Assign SA{{ $request->requested_count > 1 ? 's' : '' }}
                                    </button>
                                    <button class="action-btn btn-reject" 
                                            onclick="showRejectionModal({{ $request->id }}, '{{ $request->office }}', '{{ addslashes($request->description) }}')">
                                        Reject
                                    </button>
                                @elseif($request->status === 'approved' && !$isFullyAssigned)
                                    @php
                                        $remaining = $request->requested_count - $assignedCount;
                                    @endphp
                                    <button class="action-btn btn-approve" 
                                            onclick="showAssignmentModal({{ $request->id }}, '{{ $request->office }}', {{ $remaining }}, '{{ addslashes($request->description) }} - Additional Assignment')">
                                        Assign {{ $remaining }} More
                                    </button>
                                    <small style="display: block; color: #059669; margin-top: 4px;">
                                        {{ $assignedCount }}/{{ $request->requested_count }} assigned
                                    </small>
                                @else
                                    <button class="action-btn btn-disabled" disabled>
                                        @if($isFullyAssigned)
                                            Fully Assigned
                                        @else
                                            {{ ucfirst($request->status) }}
                                        @endif
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
            <div id="partialAssignmentInfo" class="partial-assignment-info" style="display: none;">
                <!-- This will be populated with current assignment status for partial assignments -->
            </div>
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
                <label class="form-label" id="studentSelectLabel">Select Student to Assign:</label>
                <select id="assignStudentId" class="form-input" style="display: none;">
                    <option value="">Loading students...</option>
                </select>
                <!-- Multiple student selection for requests with count > 1 -->
                <div id="multipleStudentSelection" style="display: none;">
                    <!-- Filter and Search Controls -->
                    <div style="display: flex; gap: 8px; margin-bottom: 12px;">
                        <div style="flex: 1;">
                            <input type="text" id="studentSearchBar" placeholder="Search by student name..." style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;">
                        </div>
                        <div style="min-width: 160px;">
                            <input type="text" list="officeList" id="officeFilterDropdown" placeholder="All Offices" style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; background: white;">
                            <datalist id="officeList">
                                <option value="">All Offices</option>
                            </datalist>
                        </div>
                    </div>
                    <div style="max-height: 250px; overflow-y: auto; border: 1px solid #d1d5db; border-radius: 6px; padding: 8px;">
                        <div id="studentCheckboxList">
                            <!-- Student checkboxes will be populated here -->
                        </div>
                    </div>
                    <small style="color: #6b7280; margin-top: 4px; display: block;" id="selectionHelper">
                        Select up to <span id="maxSelectionCount">1</span> students for this assignment.
                    </small>
                </div>
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
    
    // Configure UI based on requested count
    const singleSelect = document.getElementById('assignStudentId');
    const multipleSelect = document.getElementById('multipleStudentSelection');
    const label = document.getElementById('studentSelectLabel');
    const maxCount = document.getElementById('maxSelectionCount');
    const partialInfo = document.getElementById('partialAssignmentInfo');
    
    // Check if this is a partial assignment (description contains "Additional Assignment")
    const isPartialAssignment = description.includes('Additional Assignment');
    
    if (isPartialAssignment) {
        partialInfo.style.display = 'block';
        partialInfo.innerHTML = '<strong>Partial Assignment:</strong> This request already has some students assigned. You are assigning the remaining positions.';
    } else {
        partialInfo.style.display = 'none';
    }
    
    if (requestedCount > 1) {
        // Show multiple selection for requests > 1
        singleSelect.style.display = 'none';
        multipleSelect.style.display = 'block';
        label.textContent = `Select ${requestedCount} Student${requestedCount > 1 ? 's' : ''} to Assign:`;
        maxCount.textContent = requestedCount;
        loadAvailableStudentsMultiple(requestedCount, office);
    } else {
        // Show single selection for requests = 1
        singleSelect.style.display = 'block';
        multipleSelect.style.display = 'none';
        label.textContent = 'Select Student to Assign:';
        loadAvailableStudents(office);
    }
    
    document.getElementById('assignmentModal').classList.add('show');
}

function showRejectionModal(requestId, office, description) {
    currentRequestId = requestId;
    document.getElementById('rejectOffice').value = office;
    document.getElementById('rejectDescription').value = description;
    document.getElementById('rejectReason').value = '';
    document.getElementById('rejectionModal').classList.add('show');
}

function loadAvailableStudents(office) {
    const select = document.getElementById('assignStudentId');
    select.innerHTML = '<option value="">Loading students...</option>';
    
    // Fetch available students for current school year and semester (excluding those from the requesting office)
    const url = `/admin/available-students?exclude_office=${encodeURIComponent(office)}&school_year={{ $currentSchoolYear }}&semester={{ urlencode($currentSemester) }}`;
    fetch(url, {
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
            const officeText = student.designated_office ? ` - ${student.designated_office}` : '';
            option.textContent = `${student.student_name} (${student.id_number}) - ${student.course} Year ${student.year_level}${officeText}`;
            select.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error loading students:', error);
        select.innerHTML = '<option value="">Error loading students</option>';
    });
}

function loadAvailableStudentsMultiple(maxCount, office) {
    const container = document.getElementById('studentCheckboxList');
    container.innerHTML = '<div style="text-align: center; padding: 10px;">Loading students...</div>';
    
    // Fetch available students for current school year and semester (excluding those from the requesting office)
    const url = `/admin/available-students?exclude_office=${encodeURIComponent(office)}&school_year={{ $currentSchoolYear }}&semester={{ urlencode($currentSemester) }}`;
    fetch(url, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        container.innerHTML = '';
        if (data.students.length === 0) {
            container.innerHTML = '<div style="text-align: center; padding: 10px; color: #6b7280;">No available students found</div>';
            return;
        }
        
        // Store students data globally for filtering
        window.allStudents = data.students;
        
        // Populate office filter datalist with all offices in the system
        const officeList = document.getElementById('officeList');
        const allOffices = [
            'ACADS', 'ALUMNI OFFICE', 'ARCHIVING', 'ARZATECH', 'CANTEEN', 'CLINIC',
            'FINANCE', 'GUIDANCE', 'HRD', 'KUWAGO', 'LCR', 'LIBRARY', 'LINKAGES',
            'MARKETING', 'OPEN LAB', 'PRESIDENT\'S OFFICE', 'QUEUING', 'QUALITY ASSURANCE',
            'REGISTRAR', 'SAO', 'SBA FACULTY', 'SIHM FACULTY', 'SITE FACULTY',
            'SOE FACULTY', 'SOH FACULTY', 'SOHS FACULTY', 'SOC FACULTY',
            'SPORTS AND CULTURE', 'STE DEAN\'S OFFICE', 'STE FACULTY', 'STEEDS', 'XACTO'
        ];
        officeList.innerHTML = '<option value="">All Offices</option>';
        allOffices.forEach(office => {
            const option = document.createElement('option');
            option.value = office;
            officeList.appendChild(option);
        });
        
        // Render all students initially
        renderStudentList(data.students, maxCount);
        
        // Setup filter and search event listeners
        setupFiltersAndSearch(maxCount);
    })
    .catch(error => {
        console.error('Error loading students:', error);
        container.innerHTML = '<div style="text-align: center; padding: 10px; color: #dc2626;">Error loading students</div>';
    });
}

function renderStudentList(students, maxCount) {
    const container = document.getElementById('studentCheckboxList');
    container.innerHTML = '';
    
    if (students.length === 0) {
        container.innerHTML = '<div style="text-align: center; padding: 10px; color: #6b7280;">No students match your filters</div>';
        return;
    }
    
    students.forEach(student => {
        const checkboxWrapper = document.createElement('div');
        checkboxWrapper.style.cssText = 'margin-bottom: 8px; display: flex; align-items: center; padding: 4px;';
        checkboxWrapper.className = 'student-item';
        
        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.value = student.id;
        checkbox.name = 'selected_students';
        checkbox.id = `student_${student.id}`;
        checkbox.style.cssText = 'margin-right: 8px; min-width: 16px; min-height: 16px;';
        
        const label = document.createElement('label');
        label.setAttribute('for', `student_${student.id}`);
        label.style.cssText = 'cursor: pointer; font-size: 0.9rem; line-height: 1.4; flex: 1;';
        
        const officeBadge = student.designated_office 
            ? `<span style="background: #e0e7ff; color: #4338ca; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem; margin-left: 8px; display: inline-block;">${student.designated_office}</span>`
            : '';
        
        label.innerHTML = `${student.student_name} (${student.id_number}) - ${student.course} Year ${student.year_level}${officeBadge}`;
        
        // Add click handler to limit selection
        checkbox.addEventListener('change', function() {
            const checkedBoxes = container.querySelectorAll('input[type="checkbox"]:checked');
            if (checkedBoxes.length > maxCount) {
                this.checked = false;
                alert(`You can only select up to ${maxCount} students for this request.`);
            }
        });
        
        checkboxWrapper.appendChild(checkbox);
        checkboxWrapper.appendChild(label);
        container.appendChild(checkboxWrapper);
    });
}

function setupFiltersAndSearch(maxCount) {
    const searchBar = document.getElementById('studentSearchBar');
    const officeFilter = document.getElementById('officeFilterDropdown');
    
    function applyFilters() {
        const searchTerm = searchBar.value.toLowerCase().trim();
        const selectedOffice = officeFilter.value.trim();
        
        let filteredStudents = window.allStudents;
        
        // Apply office filter (allow partial matches for typed input)
        if (selectedOffice && selectedOffice !== 'All Offices') {
            filteredStudents = filteredStudents.filter(s => 
                s.designated_office && s.designated_office.toLowerCase().includes(selectedOffice.toLowerCase())
            );
        }
        
        // Apply search filter
        if (searchTerm) {
            filteredStudents = filteredStudents.filter(s => 
                s.student_name.toLowerCase().includes(searchTerm) ||
                s.id_number.toLowerCase().includes(searchTerm)
            );
        }
        
        renderStudentList(filteredStudents, maxCount);
    }
    
    // Add event listeners
    searchBar.addEventListener('input', applyFilters);
    officeFilter.addEventListener('input', applyFilters); // Changed from 'change' to 'input' for real-time typing
    officeFilter.addEventListener('change', applyFilters);
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('show');
    currentRequestId = null;
    
    // Reset filters when closing assignment modal
    if (modalId === 'assignmentModal') {
        const searchBar = document.getElementById('studentSearchBar');
        const officeFilter = document.getElementById('officeFilterDropdown');
        if (searchBar) searchBar.value = '';
        if (officeFilter) officeFilter.value = '';
    }
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
    
    const requestedCount = parseInt(document.getElementById('assignRequestedCount').value);
    const reason = document.getElementById('assignReason').value;
    let selectedStudents = [];
    
    if (requestedCount > 1) {
        // Handle multiple selection
        const checkboxes = document.querySelectorAll('input[name="selected_students"]:checked');
        selectedStudents = Array.from(checkboxes).map(cb => cb.value);
        
        if (selectedStudents.length === 0) {
            alert('Please select at least one student to assign');
            return;
        }
        
        if (selectedStudents.length !== requestedCount) {
            alert(`Please select exactly ${requestedCount} students for this request`);
            return;
        }
    } else {
        // Handle single selection
        const studentId = document.getElementById('assignStudentId').value;
        if (!studentId) {
            alert('Please select a student to assign');
            return;
        }
        selectedStudents = [studentId];
    }
    
    fetch(`/admin/sa-requests/${currentRequestId}/assign`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ 
            student_ids: selectedStudents,
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
    
    // Show confirmation dialog
    if (!confirm('Are you sure you want to reject this SA request? This action cannot be undone.')) {
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
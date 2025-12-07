@extends('layouts.app')

@section('page-title')
    <i class="bi bi-people" style="margin-right: 8px;"></i>
    New Applicants
@endsection

@section('content')
<style>
    .content-wrapper {
        background: #fff !important;
    }
    .admin-content-wrapper {
        background: #fff !important;
    }
    .main-content {
        background: #fff !important;
    }
    body {
        background: #fff !important;
    }
    
    /* Action cell layout: View left, Add to Student List right */
    .applicants-table td.action-cell {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-right: 16px;
    }
    .applicants-table td.action-cell a {
        background: #f3f4f6;
        color: #2563eb;
        border: none;
        padding: 4px 10px;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        font-weight: 500;
    }
    .applicants-table td.action-cell form button {
        background: #2563eb;
        color: #fff;
        border: none;
        padding: 4px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
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
    .applicants-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
        line-height: 1.4;
    }
    .applicants-desc {
        font-size: 0.95rem;
        color: #6b7280;
        margin: 4px 0 0 0;
        line-height: 1.3;
    }
    .table-container {
        width: 100%;
        padding: 0 24px 24px 24px;
        overflow-x: auto;
    }
    .applicants-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
    }
    .applicants-table thead th {
        background: #f3f4f6;
        color: #111827;
        font-size: 0.9rem;
        font-weight: 600;
        padding: 12px 16px;
        text-align: left;
    }
    .applicants-table tbody td {
        font-size: 0.9rem;
        color: #374151;
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
    }
    .applicants-table tbody tr:hover td {
        background: #f9fafb;
    }
    .applicants-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Filter Button and Dropdown Styles */
    .filter-container {
        position: relative;
        display: inline-block;
    }
    
    .filter-button {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 16px;
        background: #3b82f6;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        touch-action: manipulation;
        min-height: 48px;
        width: 100%;
        max-width: 300px;
    }
    
    .filter-button:hover {
        background: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    .filter-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        min-width: 250px;
        max-width: 300px;
        z-index: 9999;
        padding: 8px 0;
        max-height: 400px;
        overflow-y: auto;
    }
    
    .filter-dropdown.show {
        display: block;
    }
    
    .filter-section {
        padding: 8px 16px;
    }
    
    .filter-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 16px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #374151;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .filter-label:hover {
        background: #f9fafb;
    }
    
    .filter-options {
        display: none;
        background: #f9fafb;
        border-top: 1px solid #e5e7eb;
        padding: 8px 0;
    }
    
    .filter-options.show {
        display: block;
    }
    
    .filter-option {
        padding: 8px 32px;
        font-size: 0.85rem;
        color: #374151;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .filter-option:hover {
        background: #f3f4f6;
    }
    
    .filter-option.selected {
        background: #dbeafe;
        color: #2563eb;
        font-weight: 600;
    }
    
    .filter-clear {
        padding: 8px 16px;
        margin: 8px 16px 4px 16px;
        background: #ef4444;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
        width: calc(100% - 32px);
    }
    
    .filter-clear:hover {
        background: #dc2626;
    }

    /* Filter cascade styles */
    .filter-cascade {
        display: none;
        background: #ffffff;
        border-top: 1px solid #e5e7eb;
        max-height: 200px;
        overflow-y: auto;
        position: relative;
        z-index: 1;
    }

    .filter-cascade .filter-option {
        padding: 8px 24px;
        font-size: 0.85rem;
        border-bottom: 1px solid #f3f4f6;
    }

    .filter-cascade .filter-option:last-child {
        border-bottom: none;
    }

    /* Mobile Cards */
    .mobile-applicant-cards {
        display: none;
        padding: 16px;
        gap: 16px;
        flex-direction: column;
    }

    .applicant-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        width: 100%;
        max-width: 100%;
        overflow: hidden;
    }

    .applicant-card-header {
        font-size: 1.1rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid #f3f4f6;
    }

    .applicant-card-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 16px;
    }

    .applicant-card-info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .applicant-card-label {
        font-weight: 500;
        color: #6b7280;
        font-size: 0.9rem;
    }

    .applicant-card-value {
        color: #111827;
        font-size: 0.9rem;
        text-align: right;
    }

    .applicant-card-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: flex-start;
    }

    .applicant-card-actions button,
    .applicant-card-actions a {
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.85rem;
        text-decoration: none;
        text-align: center;
        min-width: 80px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .btn-view {
        background: #f3f4f6;
        color: #2563eb;
        border: 1px solid #e5e7eb;
    }

    .btn-view:hover {
        background: #e5e7eb;
    }

    .btn-add {
        background: #2563eb;
        color: #fff;
        border: none;
    }

    .btn-add:hover {
        background: #1d4ed8;
    }

    .btn-delete {
        background: #ef4444;
        color: #fff;
        border: none;
    }

    .btn-delete:hover {
        background: #dc2626;
    }

    /* Prevent horizontal scroll on all devices */
    * {
        box-sizing: border-box;
    }
    
    html, body {
        overflow-x: hidden;
        max-width: 100vw;
    }
    
    .content-card {
        max-width: 100%;
        overflow: hidden;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        /* Hide desktop table */
        .table-container {
            display: none !important;
        }

        /* Show mobile cards */
        .mobile-applicant-cards {
            display: flex !important;
            padding: 8px !important;
        }

        /* Container adjustments */
        div[style*="background: #fff"] {
            padding: 0 !important;
        }
        
        /* Header adjustments */
        .applicants-title {
            font-size: 1.1rem !important;
            margin: 0 !important;
        }

        .applicants-desc {
            font-size: 0.9rem !important;
            margin: 4px 0 0 0 !important;
        }

        /* Header layout adjustments */
        .header-container {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 16px !important;
            padding: 16px 8px !important;
            margin-bottom: 0 !important;
        }

        .header-text {
            width: 100% !important;
        }

        .page-header-controls {
            width: 100% !important;
            justify-content: flex-start !important;
            margin-top: 0 !important;
            flex: none !important;
        }

        /* Filter container positioning for mobile */
        .filter-container {
            position: relative !important;
        }

        /* Filter dropdown mobile */
        .filter-dropdown {
            position: absolute !important;
            left: 0 !important;
            right: 0 !important;
            top: calc(100% + 8px) !important;
            width: auto !important;
            min-width: 200px !important;
            max-width: calc(100vw - 16px) !important;
            max-height: 60vh !important;
            overflow-y: auto !important;
            z-index: 99999 !important;
        }

        .filter-button {
            width: 100% !important;
            max-width: none !important;
            padding: 14px 16px !important;
            font-size: 1rem !important;
            min-height: 52px !important;
            border-radius: 12px !important;
            touch-action: manipulation !important;
        }
        
        .filter-container {
            width: 100% !important;
        }
        
        .page-header-controls {
            width: 100% !important;
            justify-content: stretch !important;
        }

        /* Pagination mobile */
        .pagination-container,
        div[style*="justify-content: center"] {
            font-size: 0.85rem !important;
            padding: 6px 8px !important;
            flex-wrap: wrap !important;
            justify-content: center !important;
            margin: 16px 8px !important;
        }
        
        /* Ensure pagination doesn't overflow */
        span[style*="font-size:1rem"] {
            font-size: 0.9rem !important;
            padding: 6px 12px !important;
        }

        /* Remove modal overlay - use normal dropdown behavior */
    }

    /* Ultra mobile (small phones) */
    @media (max-width: 480px) {
        .header-container {
            padding: 12px 4px !important;
        }
        
        .mobile-applicant-cards {
            padding: 4px !important;
        }
        
        .applicant-card {
            padding: 12px !important;
            margin-bottom: 8px;
        }
        
        .applicant-card-actions {
            flex-direction: column !important;
            gap: 6px !important;
        }

        .applicant-card-actions button,
        .applicant-card-actions a {
            width: 100% !important;
            padding: 10px 16px !important;
        }
        
        .filter-button {
            padding: 12px 14px !important;
            font-size: 0.9rem !important;
        }
    }

    /* Desktop: hide mobile cards */
    @media (min-width: 769px) {
        .mobile-applicant-cards {
            display: none !important;
        }
    }
</style>

<div style="background: #fff; min-height: calc(100vh - 76px); padding: 0;">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div id="successMessage" style="position: fixed; top: 80px; right: 20px; z-index: 1000; padding: 12px 16px; background: #d1fae5; border: 1px solid #10b981; border-radius: 8px; color: #065f46; font-size: 0.95rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); max-width: 300px; animation: slideOut 0.3s ease-in-out 3s forwards;">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(() => {
                        const msg = document.getElementById('successMessage');
                        if (msg) {
                            msg.style.opacity = '0';
                            msg.style.transform = 'translateX(400px)';
                            msg.style.transition = 'all 0.3s ease-in-out';
                            setTimeout(() => msg.remove(), 300);
                        }
                    }, 3000);
                </script>
            @endif
            
            @if(session('error'))
                <div id="errorMessage" style="position: fixed; top: 80px; right: 20px; z-index: 1000; padding: 12px 16px; background: #fee2e2; border: 1px solid #ef4444; border-radius: 8px; color: #991b1b; font-size: 0.95rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); max-width: 300px;">
                    {{ session('error') }}
                </div>
                <script>
                    setTimeout(() => {
                        const msg = document.getElementById('errorMessage');
                        if (msg) {
                            msg.style.opacity = '0';
                            msg.style.transform = 'translateX(400px)';
                            msg.style.transition = 'all 0.3s ease-in-out';
                            setTimeout(() => msg.remove(), 300);
                        }
                    }, 5000);
                </script>
            @endif

            <div class="header-container" style="display: flex; flex-direction: row; align-items: flex-start; padding: 20px 24px 0 24px; margin-bottom: 16px;">
                <div class="header-text" style="flex: 1 1 auto;">
                    <div class="applicants-title">New Applicants</div>
                    <div class="applicants-desc">This page contains new applicants for student assistantship.</div>
                </div>
                <div class="page-header-controls" style="flex: 0 0 auto; display: flex; align-items: center; gap: 8px; justify-content: flex-end; margin-top: 4px;">
                    <!-- Filter Button -->
                    <div class="filter-container">
                        <button class="filter-button" id="filterButton">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg><span>Filter</span>
                        </button>
                        
                        <div class="filter-dropdown" id="filterDropdown">
                            <div class="filter-label cascading-label" data-cascade="course">
                                <span>Course</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                            <div class="filter-cascade filter-cascade-course">
                                <div class="filter-option" data-filter="course" data-value="">All Courses</div>
                                <div class="filter-option" data-filter="course" data-value="SOH">SOH</div>
                                <div class="filter-option" data-filter="course" data-value="STE">STE</div>
                                <div class="filter-option" data-filter="course" data-value="SBA">SBA</div>
                                <div class="filter-option" data-filter="course" data-value="SOHS">SOHS</div>
                                <div class="filter-option" data-filter="course" data-value="SOE">SOE</div>
                                <div class="filter-option" data-filter="course" data-value="SITE">SITE</div>
                                <div class="filter-option" data-filter="course" data-value="SIHM">SIHM</div>
                                <div class="filter-option" data-filter="course" data-value="SOC">SOC</div>
                            </div>
                            <div class="filter-label cascading-label" data-cascade="year">
                                <span>Year Level</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                            <div class="filter-cascade filter-cascade-year">
                                <div class="filter-option" data-filter="year" data-value="">All Years</div>
                                <div class="filter-option" data-filter="year" data-value="First Year">First Year</div>
                                <div class="filter-option" data-filter="year" data-value="Second Year">Second Year</div>
                                <div class="filter-option" data-filter="year" data-value="Third Year">Third Year</div>
                                <div class="filter-option" data-filter="year" data-value="Fourth Year">Fourth Year</div>
                                <div class="filter-option" data-filter="year" data-value="Fifth Year">Fifth Year</div>
                            </div>
                            <button class="filter-clear" onclick="clearFilters()">Clear Filters</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="table-container">
                <table class="applicants-table">
                    <thead>
                        <tr>
                            <th>Applicant Name</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Student ID</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $applicant)
                            <tr>
                                <td>{{ $applicant->student_name }}</td>
                                <td>{{ $applicant->course }}</td>
                                <td>{{ $applicant->year_level }}</td>
                                <td>{{ $applicant->id_number }}</td>
                                <td>Pending</td>
                                <td class="action-cell">
                                    <span style="display:flex;gap:10px;align-items:center;">
                                        <a href="{{ route('applications.show', $applicant->id) }}">View</a>
                                        <form method="POST" action="{{ route('applications.destroy', $applicant->id) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this applicant?')" style="background:#ef4444;color:#fff;">Delete</button>
                                        </form>
                                    </span>
                                    <form method="POST" action="{{ route('studentlist.add', $applicant->id) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to add this applicant to the student list?')">
                                        @csrf
                                        <button type="submit">Add to Student List</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Mobile Cards -->
            <div class="mobile-applicant-cards">
                @foreach($applications as $applicant)
                <div class="applicant-card">
                    <div class="applicant-card-header">
                        {{ $applicant->student_name }}
                    </div>
                    
                    <div class="applicant-card-info">
                        <div class="applicant-card-info-row">
                            <span class="applicant-card-label">Course:</span>
                            <span class="applicant-card-value">{{ $applicant->course }}</span>
                        </div>
                        <div class="applicant-card-info-row">
                            <span class="applicant-card-label">Year Level:</span>
                            <span class="applicant-card-value">{{ $applicant->year_level }}</span>
                        </div>
                        <div class="applicant-card-info-row">
                            <span class="applicant-card-label">Student ID:</span>
                            <span class="applicant-card-value">{{ $applicant->id_number }}</span>
                        </div>
                        <div class="applicant-card-info-row">
                            <span class="applicant-card-label">Status:</span>
                            <span class="applicant-card-value" style="color: #f59e0b; font-weight: 500;">Pending</span>
                        </div>
                    </div>
                    
                    <div class="applicant-card-actions">
                        <a href="{{ route('applications.show', $applicant->id) }}" class="btn-view">View</a>
                        
                        <form method="POST" action="{{ route('studentlist.add', $applicant->id) }}" style="flex: 1;" onsubmit="return confirm('Are you sure you want to add this applicant to the student list?')">
                            @csrf
                            <button type="submit" class="btn-add" style="width: 100%;">Add to Student List</button>
                        </form>
                        
                        <form method="POST" action="{{ route('applications.destroy', $applicant->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this applicant?')" class="btn-delete">Delete</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination at bottom -->
            <div style="display: flex; justify-content: center; margin-top: 20px; margin-bottom: 20px;">
                <span style="font-size:1rem;color:#374151;padding:6px 18px;border-radius:18px;background:#f3f4f6;display:inline-flex;align-items:center;gap:12px;">
                    @if ($applications->onFirstPage())
                    <span style="color:#d1d5db;cursor:not-allowed;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </span>
                    @else
                    <a href="{{ $applications->previousPageUrl() }}" style="color:#2563eb;text-decoration:none;display:inline-flex;align-items:center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </a>
                    @endif
                    <span style="font-size:1rem;color:#374151;">Page {{ $applications->currentPage() }} of {{ $applications->lastPage() }}</span>
                    @if ($applications->hasMorePages())
                    <a href="{{ $applications->nextPageUrl() }}" style="color:#2563eb;text-decoration:none;display:inline-flex;align-items:center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </a>
                    @else
                    <span style="color:#d1d5db;cursor:not-allowed;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </span>
                    @endif
                </span>
            </div>
            
            <!-- Filter overlay for mobile -->
            <div class="filter-overlay" id="filterOverlay"></div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Cascading submenu logic for filter
    const filterButton = document.getElementById('filterButton');
    const filterDropdown = document.getElementById('filterDropdown');
    const cascadeLabels = document.querySelectorAll('.cascading-label');
    const cascades = {
        course: document.querySelector('.filter-cascade-course'),
        year: document.querySelector('.filter-cascade-year')
    };
    Object.values(cascades).forEach(c => c.style.display = 'none');

    // Show dropdown when filter button is clicked
    filterButton.addEventListener('click', function(e) {
        e.stopPropagation();
        const isShowing = filterDropdown.classList.contains('show');
        
        filterDropdown.classList.toggle('show');
        
        // Normal dropdown behavior for all screen sizes
        
        // Hide all submenus when opening dropdown
        Object.values(cascades).forEach(c => c.style.display = 'none');
    });

    cascadeLabels.forEach(label => {
        label.addEventListener('click', function(e) {
            e.stopPropagation();
            const type = label.getAttribute('data-cascade');
            // Toggle submenu: close if open, open if closed
            const isOpen = cascades[type].style.display === 'block';
            Object.values(cascades).forEach(c => c.style.display = 'none');
            if (!isOpen) {
                cascades[type].style.display = 'block';
            }
        });
    });

    // Hide dropdown and submenus when clicking outside
    function closeFilterDropdown() {
        filterDropdown.classList.remove('show');
        Object.values(cascades).forEach(c => c.style.display = 'none');
        
        // Normal close behavior
    }
    
    document.addEventListener('click', function(e) {
        if (!filterDropdown.contains(e.target) && e.target !== filterButton) {
            closeFilterDropdown();
        }
    });
    
    // Close filter when overlay is clicked on mobile
    document.getElementById('filterOverlay').addEventListener('click', function() {
        closeFilterDropdown();
    });

    // Filter option selection
    document.querySelectorAll('.filter-option').forEach(option => {
        option.addEventListener('click', function(e) {
            e.stopPropagation();
            const filterType = this.getAttribute('data-filter');
            const filterValue = this.getAttribute('data-value');
            // Remove selected class from siblings
            this.parentElement.querySelectorAll('.filter-option').forEach(sib => sib.classList.remove('selected'));
            this.classList.add('selected');
            applyFilter(filterType, filterValue);
        });
    });
});

function toggleFilterSection(sectionId) {
    const section = document.getElementById(sectionId);
    section.classList.toggle('show');
}

function applyFilter(filterType, filterValue) {
    // Get current URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    
    // Update or remove filter parameter
    if (filterValue === '') {
        urlParams.delete(filterType);
    } else {
        urlParams.set(filterType, filterValue);
    }
    
    // Reload page with new filters
    window.location.search = urlParams.toString();
}

function clearFilters() {
    // Remove all filter parameters from URL
    window.location.href = window.location.pathname;
}

// Close filter when overlay is clicked on mobile
document.getElementById('filterOverlay').addEventListener('click', function() {
    closeFilterDropdown();
});
</script>
</div>
@endsection
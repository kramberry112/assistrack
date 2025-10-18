@extends('layouts.app')

@section('page-title')
    <div style="display: flex; align-items: center; gap: 8px;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="m22 21-3-3 3-3"/>
        </svg>
        <span>New Applicants</span>
    </div>
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
        gap: 0;
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
        margin: 16px 24px 4px 24px;
    }
    .applicants-desc {
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
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 18px;
        background: #3b82f6;
        color: #fff;
        border: none;
        border-radius: 18px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .filter-button:hover {
        background: #2563eb;
    }
    
    .filter-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        min-width: 200px;
        z-index: 50;
        padding: 8px 0;
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
</style>

<div style="background: #fff; min-height: calc(100vh - 76px); padding: 0;">
            <div style="display: flex; flex-direction: row; align-items: center; padding: 16px 16px 0 16px; margin-bottom: 8px;">
                <div style="flex: 1 1 auto;">
                    <div class="applicants-title" style="margin-bottom:0;">New Applicants</div>
                    <div class="applicants-desc" style="margin-bottom:0;">This page contains new applicants for student assistantship.</div>
                </div>
                <div style="flex: 0 0 auto; display: flex; align-items: center; gap: 8px; justify-content: flex-end;">
                    <!-- Filter Button -->
                    <div class="filter-container">
                        <button class="filter-button" id="filterButton">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                            </svg>
                            Filter
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
                    
                    <!-- Pagination -->
                    <span style="font-size:1rem;color:#374151;padding:6px 18px;border-radius:18px;background:#f3f4f6;display:inline-flex;align-items:center;gap:12px;">
                        @if ($applications->onFirstPage())
                            <span style="color:#d1d5db;cursor:not-allowed;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>
                            </span>
                        @else
                            <a href="{{ $applications->previousPageUrl() }}" style="color:#2563eb;text-decoration:none;display:inline-flex;align-items:center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>
                            </a>
                        @endif
                        <span style="font-size:1rem;color:#374151;">Page {{ $applications->currentPage() }} of {{ $applications->lastPage() }}</span>
                        @if ($applications->hasMorePages())
                            <a href="{{ $applications->nextPageUrl() }}" style="color:#2563eb;text-decoration:none;display:inline-flex;align-items:center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
                            </a>
                        @else
                            <span style="color:#d1d5db;cursor:not-allowed;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
                            </span>
                        @endif
                    </span>
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
                                    <a href="{{ route('applications.show', $applicant->id) }}">View</a>
                                    <form method="POST" action="{{ route('studentlist.add', $applicant->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit">Add to Student List</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
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
        filterDropdown.classList.toggle('show');
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
    document.addEventListener('click', function(e) {
        if (!filterDropdown.contains(e.target) && e.target !== filterButton) {
            filterDropdown.classList.remove('show');
            Object.values(cascades).forEach(c => c.style.display = 'none');
        }
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
</script>
</div>
@endsection
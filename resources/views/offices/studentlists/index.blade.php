@extends('layouts.app')

@section('page-title')
    STUDENT LIST
@endsection

@section('page-icon')
    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2">
        <circle cx="12" cy="7" r="4"/>
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
    </svg>
@endsection

@section('content')
<style>
    .content-card {
        flex: 1;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        overflow: hidden;
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

    .studentlist-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 4px;
    }

    .studentlist-desc {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 16px;
    }

    .toolbar {
        display: flex;
        align-items: center;
        gap: 16px;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    /* Filter Dropdown */
    .filter-container {
        position: relative;
    }

    .filter-button {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.9rem;
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
        top: 100%;
        left: 0;
        margin-top: 8px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        min-width: 220px;
        z-index: 50;
        padding: 8px 0;
    }

    .filter-dropdown.show {
        display: block;
    }

    .filter-label {
        padding: 10px 16px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #374151;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: background 0.2s;
    }

    .filter-label:hover {
        background: #f9fafb;
    }

    .filter-cascade {
        display: none;
    }

    .filter-cascade.show {
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

    .filter-option.active {
        background: #eff6ff;
        color: #3b82f6;
        font-weight: 500;
    }

    .filter-clear {
        margin: 8px 12px;
        padding: 8px 12px;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 0.85rem;
        cursor: pointer;
        width: calc(100% - 24px);
        font-weight: 500;
    }

    .filter-clear:hover {
        background: #dc2626;
    }

    .search-container {
        display: flex;
        gap: 8px;
    }

    .search-input {
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.9rem;
        width: 220px;
        outline: none;
    }

    .search-input:focus {
        border-color: #3b82f6;
    }

    .search-btn {
        padding: 8px 20px;
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
    }

    .search-btn:hover {
        background: #2563eb;
    }

    .pagination-controls {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pagination-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #f3f4f6;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #2563eb;
    }

    .pagination-btn:disabled {
        color: #d1d5db;
        cursor: not-allowed;
    }

    .pagination-text {
        background: #f3f4f6;
        color: #374151;
        border-radius: 50px;
        padding: 8px 18px;
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* Table */
    .table-container {
        flex: 1;
        overflow: auto;
        padding: 24px;
    }

    .student-table {
        width: 100%;
        border-collapse: collapse;
    }

    .student-table thead {
        background: #f9fafb;
    }

    .student-table thead th {
        padding: 12px 16px;
        text-align: left;
        font-size: 0.85rem;
        font-weight: 600;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
    }

    .student-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.2s;
    }

    .student-table tbody tr:hover {
        background: #f9fafb;
    }

    .student-table tbody td {
        padding: 14px 16px;
        font-size: 0.9rem;
        color: #374151;
    }

    .action-cell {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .action-cell a,
    .action-cell button {
        padding: 6px 14px;
        background: #f3f4f6;
        color: #374151;
        border: none;
        border-radius: 4px;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }

    .action-cell a:hover {
        background: #e5e7eb;
    }

    .action-cell .delete-btn {
        background: #ef4444;
        color: white;
    }

    .action-cell .delete-btn:hover {
        background: #dc2626;
    }

    /* Button Success Style */
    .btn-success {
        background: #22c55e;
        color: white;
        border: 1px solid #22c55e;
    }

    .btn.disabled {
        opacity: 0.7;
        cursor: not-allowed;
        pointer-events: none;
    }
</style>


<div class="content-card">
            <div style="display: flex; flex-direction: row; align-items: center; padding: 0 24px; margin-bottom: 12px;">
                <div style="flex: 1 1 auto;">
                    <div class="studentlist-title" style="margin-bottom:0;">{{ $officeName ?? 'Office' }} Student Assistants</div>
                    <div class="studentlist-desc" style="margin-bottom:0;">
                        @if(isset($studentType) && $studentType === 'borrowed')
                            Students borrowed from other departments
                        @else
                            Students assigned to {{ $officeName ?? 'this office' }}
                        @endif
                    </div>
                </div>
                <div style="flex: 0 0 auto; display: flex; align-items: center; gap: 8px; margin-top: 8px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div class="filter-container">
                            <form id="filterForm" method="GET" action="{{ route('offices.studentlists.index') }}">
                                <button type="button" class="filter-button" id="filterDropdownBtn">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                                    </svg>
                                    Filter
                                </button>
                                <div class="filter-dropdown" id="filterDropdownMenu">
                                    <div class="filter-label cascading-label" data-cascade="schoolyear">
                                        <span>School Year</span>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </div>
                                    <div class="filter-cascade filter-cascade-schoolyear">
                                        <div class="filter-option" data-filter="school_year" data-value="">All School Years</div>
                                        @foreach($availableSchoolYears as $year)
                                            <div class="filter-option {{ $selectedSchoolYear == $year ? 'active' : '' }}" data-filter="school_year" data-value="{{ $year }}">{{ $year }}</div>
                                        @endforeach
                                    </div>
                                    <div class="filter-label cascading-label" data-cascade="semester">
                                        <span>Semester</span>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </div>
                                    <div class="filter-cascade filter-cascade-semester">
                                        <div class="filter-option" data-filter="semester" data-value="">All Semesters</div>
                                        @foreach($availableSemesters as $semester)
                                            <div class="filter-option {{ $selectedSemester == $semester ? 'active' : '' }}" data-filter="semester" data-value="{{ $semester }}">{{ $semester }}</div>
                                        @endforeach
                                    </div>
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
                                        <div class="filter-option active" data-filter="year_level" data-value="">All Years</div>
                                        <div class="filter-option" data-filter="year_level" data-value="First Year">First Year</div>
                                        <div class="filter-option" data-filter="year_level" data-value="Second Year">Second Year</div>
                                        <div class="filter-option" data-filter="year_level" data-value="Third Year">Third Year</div>
                                        <div class="filter-option" data-filter="year_level" data-value="Fourth Year">Fourth Year</div>
                                        <div class="filter-option" data-filter="year_level" data-value="Fifth Year">Fifth Year</div>
                                    </div>
                                    <button type="button" class="filter-clear" onclick="clearFilters()">Clear Filters</button>
                                </div>
                                <input type="hidden" name="course" id="filterCourse" value="{{ request('course') }}">
                                <input type="hidden" name="year_level" id="filterYear" value="{{ request('year_level') }}">
                                <input type="hidden" name="office" id="filterOffice" value="{{ request('office') }}">
                                <input type="hidden" name="student_type" value="{{ $studentType ?? 'assigned' }}">
                            </form>
                        </div>
                        <form method="GET" action="{{ route('offices.studentlists.index') }}" style="display: flex; align-items: center; gap: 8px;">
                            <input type="text" name="search" id="officeStudentSearchBar" value="{{ request('search') }}" placeholder="Search students..." style="padding: 7px 12px; border-radius: 6px; border: 1px solid #bbb; font-size: 15px;">
                            <input type="hidden" name="student_type" value="{{ $studentType ?? 'assigned' }}">
                            <button type="submit" style="padding: 7px 18px; border-radius: 6px; background: #2563eb; color: #fff; border: none; font-size: 15px; cursor: pointer;">Search</button>
                        </form>
                        @if(!isset($studentType) || $studentType === 'assigned')
                            <button id="requestSaHelpBtn" style="padding: 7px 18px; border-radius: 6px; background: #059669; color: #fff; border: none; font-size: 15px; font-weight: 500; cursor: pointer;">Request SA</button>
                        @endif
                    </div>
                    <!-- ...existing code... -->

                </div>
            </div>

            <div class="table-container">
                <table class="student-table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Student ID</th>
                            <th>Designated Office</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr>
                            <td>{{ $student->student_name }}</td>
                            <td>{{ $student->course }}</td>
                            <td>{{ $student->year_level }}</td>
                            <td>{{ $student->id_number }}</td>
                            <td>{{ $student->designated_office }}</td>
                            <td class="action-cell" style="text-align: center; vertical-align: middle;">
                                @if(isset($studentType) && $studentType === 'borrowed')
                                    <form method="POST" action="{{ route('offices.studentlists.markAsDone', $student->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success" onclick="return confirm('Mark this SA as done? The student will return to their designated office.')">Mark as Done</button>
                                    </form>
                                @else
                                    @if($student->isEvaluated())
                                        <button class="btn btn-success disabled">Evaluated</button>
                                    @else
                                        <a href="{{ route('evaluation.show', $student->id) }}" class="btn btn-primary">Evaluation</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #6b7280;">
                                No students found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination-controls" style="margin-top: 24px; justify-content: center;">
                    @if ($students->onFirstPage())
                        <button class="pagination-btn" disabled>
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                        </button>
                    @else
                        <a href="{{ $students->previousPageUrl() }}" class="pagination-btn" style="text-decoration: none;">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                        </a>
                    @endif
                    <span class="pagination-text">Page {{ $students->currentPage() }} of {{ $students->lastPage() }}</span>
                    @if ($students->hasMorePages())
                        <a href="{{ $students->nextPageUrl() }}" class="pagination-btn" style="text-decoration: none;">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @else
                        <button class="pagination-btn" disabled>
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </button>
                    @endif
                </div>
            </div>
        </div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('officeStudentSearchBar');
    var searchForm = searchInput ? searchInput.form : null;
    if (searchInput && searchForm) {
        searchInput.addEventListener('input', function() {
            if (searchInput.value === '') {
                searchForm.submit();
            }
        });
    }
});
     // Filter dropdown functionality
    const filterBtn = document.getElementById('filterDropdownBtn');
    const filterMenu = document.getElementById('filterDropdownMenu');
    
    filterBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        filterMenu.classList.toggle('show');
    });
    
    // Close filter dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!filterMenu.contains(e.target) && e.target !== filterBtn) {
            filterMenu.classList.remove('show');
        }
    });
    
    // Cascading submenu logic for filter
    const cascadeLabels = document.querySelectorAll('.cascading-label');
    const cascades = {
        schoolyear: document.querySelector('.filter-cascade-schoolyear'),
        semester: document.querySelector('.filter-cascade-semester'),
        course: document.querySelector('.filter-cascade-course'),
        year: document.querySelector('.filter-cascade-year')
    };
    Object.values(cascades).forEach(c => c.style.display = 'none');

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

    // Hide submenu when clicking outside filter dropdown
    document.addEventListener('click', function(e) {
        if (!filterMenu.contains(e.target) && e.target !== filterBtn) {
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
    
    // Apply filter function
    window.applyFilter = function(filterType, filterValue) {
        const url = new URL(window.location.href);
        if (filterValue === '') {
            url.searchParams.delete(filterType);
        } else {
            url.searchParams.set(filterType, filterValue);
        }
        window.location.href = url.toString();
    };
    
    // Clear filters function
    window.clearFilters = function() {
        window.location.href = window.location.pathname;
    };

    // Search bar functionality
    const searchBar = document.getElementById('officeStudentSearchBar');
    const originalUrl = "{{ route('offices.studentlists.index') }}";
    if (searchBar) {
        searchBar.addEventListener('input', function() {
            if (searchBar.value.trim() === '') {
                window.location.href = originalUrl;
            }
        });
    }

    // SA Help Request functionality
    let currentModal = null;
    
    const requestSaHelpBtn = document.getElementById('requestSaHelpBtn');
    if (requestSaHelpBtn) {
        requestSaHelpBtn.addEventListener('click', function() {
            // Show modal for SA help request
            showSaHelpRequestModal();
        });
    }

    window.closeSaHelpModal = function() {
        if (currentModal) {
            currentModal.remove();
            currentModal = null;
        }
    };

    function showSaHelpRequestModal() {
        // Close existing modal if any
        if (currentModal) {
            currentModal.remove();
        }
        
        currentModal = document.createElement('div');
        currentModal.style.cssText = `
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); z-index: 1000; display: flex;
            align-items: center; justify-content: center;
        `;
        
        currentModal.innerHTML = `
            <div style="background: white; padding: 24px; border-radius: 10px; width: 90%; max-width: 500px;">
                <h2 style="margin: 0 0 16px 0; color: #111827; font-size: 1.3rem;">Request Student Assistant Help</h2>
                <form id="saHelpRequestForm">
                    <div style="margin-bottom: 16px;">
                        <label style="display: block; margin-bottom: 4px; font-weight: 500; color: #374151;">
                            Number of SAs needed:
                        </label>
                        <input type="number" id="requestedCount" min="1" max="5" value="1" 
                               style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px;">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 4px; font-weight: 500; color: #374151;">
                            Description of help needed:
                        </label>
                        <textarea id="helpDescription" required rows="4" placeholder="Describe what kind of assistance you need..."
                                  style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; resize: vertical;"></textarea>
                    </div>
                    <div style="display: flex; gap: 10px; justify-content: flex-end;">
                        <button type="button" onclick="closeSaHelpModal()" 
                                style="padding: 8px 16px; border: 1px solid #d1d5db; background: #f9fafb; border-radius: 6px; cursor: pointer;">
                            Cancel
                        </button>
                        <button type="submit" 
                                style="padding: 8px 16px; background: #059669; color: white; border: none; border-radius: 6px; cursor: pointer;">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        `;
        
        document.body.appendChild(currentModal);
        
        // Handle form submission
        document.getElementById('saHelpRequestForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const requestedCount = document.getElementById('requestedCount').value;
            const description = document.getElementById('helpDescription').value.trim();
            
            if (!description) {
                alert('Please provide a description of help needed');
                return;
            }
            
            // Disable submit button
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';
            
            fetch("{{ route('offices.studentlists.request_sa') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    requested_count: parseInt(requestedCount),
                    description: description
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    closeSaHelpModal();
                    // Optionally refresh to show updated status
                    // window.location.reload();
                } else {
                    alert(data.message || 'Error submitting SA request');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Submit Request';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error submitting SA request');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit Request';
            });
        });
        
        // Close modal when clicking outside
        currentModal.addEventListener('click', function(e) {
            if (e.target === currentModal) {
                closeSaHelpModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && currentModal) {
                closeSaHelpModal();
            }
        });
    }
</script>

@endsection
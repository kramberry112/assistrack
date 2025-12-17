@extends('layouts.app')

@section('page-title')
    <i class="bi bi-grid-3x3-gap" style="margin-right: 8px;"></i>
    Dashboard Overview
@endsection

@section('content')
@php
    // Auto-detect current school year and semester
    $currentMonth = (int) date('n'); // 1-12
    $currentYear = (int) date('Y');
    
    // Determine semester and school year based on month
    if ($currentMonth >= 8 && $currentMonth <= 12) {
        // August to December = 1st Semester
        $defaultSemester = '1st Semester';
        $defaultSchoolYear = $currentYear . '-' . ($currentYear + 1);
    } elseif ($currentMonth >= 1 && $currentMonth <= 5) {
        // January to May = 2nd Semester
        $defaultSemester = '2nd Semester';
        $defaultSchoolYear = ($currentYear - 1) . '-' . $currentYear;
    } else {
        // June to July = Summer
        $defaultSemester = 'Summer';
        $defaultSchoolYear = ($currentYear - 1) . '-' . $currentYear;
    }
    
    // Get filter values from request or use defaults
    $selectedSchoolYear = request('school_year', $defaultSchoolYear);
    $selectedSemester = request('semester', $defaultSemester);
    
    // Get distinct school years from students table
    $availableSchoolYears = \App\Models\Student::distinct()
        ->whereNotNull('school_year')
        ->pluck('school_year')
        ->sort()
        ->values();
    
    // Available semesters
    $availableSemesters = ['1st Semester', '2nd Semester', 'Summer'];
@endphp
<style>
    body, .content-wrapper, .admin-content-wrapper {
        background: #fff !important;
        min-height: 100vh;
    }
    .welcome-section {
        padding: 36px 24px 24px 24px;
        background: #fff;
        box-shadow: 0 8px 32px rgba(80,80,180,0.10);
        max-width: 1100px;
        margin: 32px auto 0 auto;
        border-radius: 12px;
    }
    .welcome-message {
        font-size: 2rem;
        font-weight: 800;
        color: #000000;
        margin: 0 0 4px 0;
        letter-spacing: 0.01em;
    }
    .welcome-subtitle {
        font-size: 1.1rem;
        color: #374151;
        margin-top: 4px;
        font-weight: 500;
    }
    .dashboard-stats {
        display: flex;
        flex-direction: row;
        gap: 32px;
        margin-top: 36px;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .stat-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px 18px;
        text-align: left;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 14px;
        box-shadow: 0 2px 12px rgba(45,46,131,0.06);
        transition: box-shadow 0.2s, transform 0.2s, background 0.2s;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        min-width: 200px;
        flex: 1 1 0;
        max-width: 280px;
    }
    .stat-card:hover {
        background: #f8fafc;
        box-shadow: 0 4px 16px rgba(45,46,131,0.1);
        transform: translateY(-2px);
        text-decoration: none;
        color: inherit;
    }
    .stat-icon {
        font-size: 1.8rem;
        color: #2d2e83;
        background: #f1f5f9;
        border-radius: 50%;
        padding: 12px;
        box-shadow: 0 2px 6px rgba(45,46,131,0.06);
        margin-bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 50px;
        min-height: 50px;
    }
    .stat-number {
        font-size: 1.8rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.2rem;
    }
    .stat-label {
        font-size: 0.85rem;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        font-weight: 600;
        margin-top: 0.1rem;
        line-height: 1.3;
    }

    /* Filter Buttons */
    .filter-section {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .year-filter-group {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .year-filter-container {
        position: relative;
        display: inline-block;
    }

    .year-dropdown-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: #4b5563;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        min-height: 44px;
        white-space: nowrap;
        min-width: 150px;
        justify-content: space-between;
    }

    .year-dropdown-btn:hover {
        background: #374151;
        transform: translateY(-1px);
    }

    .year-dropdown-btn.active {
        background: #3b82f6;
    }

    .year-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        min-width: 150px;
        z-index: 99999;
        padding: 4px 0;
    }

    .year-dropdown.show {
        display: block;
    }

    .year-option {
        padding: 10px 16px;
        font-size: 0.9rem;
        color: #374151;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .year-option:hover {
        background: #f3f4f6;
    }

    .year-option.selected {
        background: #eff6ff;
        color: #3b82f6;
        font-weight: 500;
    }

    .year-btn {
        padding: 8px 20px;
        background: #4b5563;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        min-height: 44px;
    }

    .year-btn:hover {
        background: #374151;
        transform: translateY(-1px);
    }

    .year-btn.active {
        background: #3b82f6;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.4);
    }

    .semester-filter-container {
        position: relative;
        display: inline-block;
    }

    .semester-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: #4b5563;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        min-height: 44px;
        white-space: nowrap;
    }

    .semester-btn:hover {
        background: #374151;
        transform: translateY(-1px);
    }

    .semester-btn.active {
        background: #3b82f6;
    }

    .semester-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        min-width: 180px;
        z-index: 99999;
        padding: 4px 0;
        max-height: 400px;
        overflow-y: auto;
    }

    .semester-dropdown.show {
        display: block;
    }

    .semester-option {
        padding: 10px 16px;
        font-size: 0.9rem;
        color: #374151;
        cursor: pointer;
        transition: background 0.2s;
    }

    .semester-option:hover {
        background: #f3f4f6;
    }

    .semester-option.selected {
        background: #dbeafe;
        color: #2563eb;
        font-weight: 600;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        body {
            -webkit-text-size-adjust: 100%;
        }
        
        .welcome-section {
            padding: 20px 16px !important;
            margin: 12px !important;
            max-width: calc(100% - 24px) !important;
            border-radius: 16px !important;
        }

        .welcome-message {
            font-size: 1.6rem !important;
            line-height: 1.3 !important;
        }

        .welcome-subtitle {
            font-size: 1rem !important;
            line-height: 1.4 !important;
        }

        .dashboard-stats {
            flex-direction: column !important;
            gap: 12px !important;
            margin-top: 20px !important;
        }

        .stat-card {
            min-width: unset !important;
            max-width: unset !important;
            padding: 24px 20px !important;
            min-height: 100px !important;
            border-radius: 14px !important;
            flex-direction: row !important;
        }
        
        .stat-card:hover {
            transform: none !important;
        }
        
        .stat-card:active {
            transform: scale(0.98) !important;
        }

        .stat-icon {
            font-size: 2rem !important;
            padding: 14px !important;
            min-width: 56px !important;
            min-height: 56px !important;
        }

        .stat-number {
            font-size: 1.9rem !important;
            line-height: 1.2 !important;
        }

        .stat-label {
            font-size: 0.95rem !important;
            line-height: 1.3 !important;
        }
    }

    @media (max-width: 480px) {
        .welcome-section {
            padding: 16px 12px !important;
            margin: 8px !important;
            max-width: calc(100% - 16px) !important;
            border-radius: 12px !important;
        }

        .welcome-message {
            font-size: 1.4rem !important;
            line-height: 1.2 !important;
        }
        
        .welcome-subtitle {
            font-size: 0.9rem !important;
        }
        
        .dashboard-stats {
            gap: 10px !important;
            margin-top: 16px !important;
        }

        .stat-card {
            padding: 20px 16px !important;
            min-height: 90px !important;
            border-radius: 12px !important;
        }
        
        .stat-icon {
            font-size: 1.7rem !important;
            padding: 12px !important;
            min-width: 48px !important;
            min-height: 48px !important;
        }

        .stat-number {
            font-size: 1.7rem !important;
        }
        
        .stat-label {
            font-size: 0.85rem !important;
        }
    }
    
    /* Ultra small screens */
    @media (max-width: 360px) {
        .welcome-section {
            padding: 14px 10px !important;
            margin: 6px !important;
        }
        
        .welcome-message {
            font-size: 1.25rem !important;
        }
        
        .stat-card {
            padding: 18px 14px !important;
            gap: 12px !important;
        }
        
        .stat-icon {
            font-size: 1.5rem !important;
            padding: 10px !important;
            min-width: 44px !important;
            min-height: 44px !important;
        }
        
        .stat-number {
            font-size: 1.5rem !important;
        }
        
        .stat-label {
            font-size: 0.8rem !important;
        }
    }

    /* Large tablets */
    @media (min-width: 769px) and (max-width: 1024px) {
        .dashboard-stats {
            gap: 20px !important;
        }

        .stat-card {
            min-width: 280px !important;
            max-width: 300px !important;
        }
    }
</style>

<div class="welcome-section">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap;">
        <div>
            <h1 class="welcome-message">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="welcome-subtitle">Here's what's happening with your system today.</p>
        </div>
        
        <!-- Filter Section -->
        <div style="display: flex; align-items: center; gap: 12px; margin-top: 8px;">
            <span style="font-size: 0.9rem; font-weight: 600; color: #374151;">School Year:</span>
            <div class="year-filter-container">
                <button class="year-dropdown-btn active" id="yearDropdownBtn">
                    <span id="yearLabel">{{ $selectedSchoolYear }}</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="year-dropdown" id="yearDropdownMenu">
                    @forelse($availableSchoolYears as $schoolYear)
                        <div class="year-option {{ $selectedSchoolYear == $schoolYear ? 'selected' : '' }}" data-value="{{ $schoolYear }}">{{ $schoolYear }}</div>
                    @empty
                        <div class="year-option" style="color: #9ca3af; cursor: default;">No school years found</div>
                    @endforelse
                </div>
            </div>
            
            <span style="font-size: 0.9rem; font-weight: 600; color: #374151;">Semester:</span>
            <div class="semester-filter-container">
                <button class="semester-btn active" id="semesterDropdownBtn">
                    <span id="semesterLabel">{{ $selectedSemester }}</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="semester-dropdown" id="semesterDropdownMenu">
                    @foreach($availableSemesters as $semester)
                        <div class="semester-option {{ $selectedSemester == $semester ? 'selected' : '' }}" data-value="{{ $semester }}">{{ $semester }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <h2 style="font-size: 1.5rem; font-weight: 700; color: #111827; margin: 32px 0 20px 0; padding-left: 24px;">Students:</h2>
    
    <div class="dashboard-stats">
        <a href="{{ route('student.list') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-people"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Student::where('school_year', $selectedSchoolYear)->where('semester', $selectedSemester)->count() }}</div>
                <div class="stat-label">Total SAs</div>
            </div>
        </a>
        <a href="{{ route('admin.attendance.report') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-calendar-check"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Attendance::whereHas('student', function($q) use ($selectedSchoolYear, $selectedSemester) { $q->where('school_year', $selectedSchoolYear)->where('semester', $selectedSemester); })->count() }}</div>
                <div class="stat-label">Total Attendance</div>
            </div>
        </a>
        <a href="{{ url('/admin/reports/tasks') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-check2-circle"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\StudentTask::where('status', 'completed')->whereHas('user.student', function($q) use ($selectedSchoolYear, $selectedSemester) { $q->where('school_year', $selectedSchoolYear)->where('semester', $selectedSemester); })->count() }}</div>
                <div class="stat-label">Completed Tasks</div>
            </div>
        </a>
        <a href="{{ url('/admin/reports/grades') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-award"></i></span>
            <div>
                <div class="stat-number">
                    {{ \App\Models\Grade::whereHas('student', function($q) use ($selectedSchoolYear, $selectedSemester) {
                            $q->where('school_year', $selectedSchoolYear)
                              ->where('semester', $selectedSemester);
                        })
                        ->count() 
                    }}
                </div>
                <div class="stat-label">Grades Submitted</div>
            </div>
        </a>
    </div>
    
    <div class="dashboard-stats" style="margin-top: 24px;">
        <a href="{{ route('applicants.list') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-person-lines-fill"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Application::count() }}</div>
                <div class="stat-label">Total Applications</div>
            </div>
        </a>
        <a href="{{ route('admin.usermanagement') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-person-badge"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\User::where(function($q) use ($selectedSchoolYear, $selectedSemester) { $q->where('role', '!=', 'student')->orWhereHas('student', function($sq) use ($selectedSchoolYear, $selectedSemester) { $sq->where('school_year', $selectedSchoolYear)->where('semester', $selectedSemester); }); })->count() }}</div>
                <div class="stat-label">Users</div>
            </div>
        </a>
        <a href="{{ route('admin.evaluations.index') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-clipboard-data"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Evaluation::whereHas('student', function($q) use ($selectedSchoolYear, $selectedSemester) { $q->where('school_year', $selectedSchoolYear)->where('semester', $selectedSemester); })->count() }}</div>
                <div class="stat-label">Evaluated Student Assistants</div>
            </div>
        </a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize global filters in sessionStorage with current values
    const currentSchoolYear = '{{ $selectedSchoolYear }}';
    const currentSemester = '{{ $selectedSemester }}';
    
    // Check if there are existing values in sessionStorage
    const savedSchoolYear = sessionStorage.getItem('globalSchoolYear');
    const savedSemester = sessionStorage.getItem('globalSemester');
    
    // If no saved values exist, save current ones
    if (!savedSchoolYear) {
        sessionStorage.setItem('globalSchoolYear', currentSchoolYear);
    }
    if (!savedSemester) {
        sessionStorage.setItem('globalSemester', currentSemester);
    }
    
    // If saved values differ from current URL params, reload with saved values
    if ((savedSchoolYear && savedSchoolYear !== currentSchoolYear) || 
        (savedSemester && savedSemester !== currentSemester)) {
        const url = new URL(window.location.href);
        if (savedSchoolYear) url.searchParams.set('school_year', savedSchoolYear);
        if (savedSemester) url.searchParams.set('semester', savedSemester);
        window.location.href = url.toString();
        return;
    }
    
    // Otherwise, update sessionStorage with current values
    sessionStorage.setItem('globalSchoolYear', currentSchoolYear);
    sessionStorage.setItem('globalSemester', currentSemester);
    
    // Year dropdown functionality
    const yearBtn = document.getElementById('yearDropdownBtn');
    const yearMenu = document.getElementById('yearDropdownMenu');
    const yearLabel = document.getElementById('yearLabel');
    
    if (yearBtn && yearMenu) {
        yearBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            yearMenu.classList.toggle('show');
            // Close semester dropdown if open
            if (semesterMenu) semesterMenu.classList.remove('show');
        });
        
        document.addEventListener('click', function(e) {
            if (!yearBtn.contains(e.target) && !yearMenu.contains(e.target)) {
                yearMenu.classList.remove('show');
            }
        });
        
        document.querySelectorAll('.year-option').forEach(option => {
            option.addEventListener('click', function() {
                const year = this.getAttribute('data-value');
                
                if (!year) return; // Skip if no value
                
                // Remove selected class from all options
                document.querySelectorAll('.year-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                
                // Apply filter while preserving semester
                const url = new URL(window.location.href);
                const currentSemester = url.searchParams.get('semester') || '{{ $defaultSemester }}';
                
                url.searchParams.set('school_year', year);
                url.searchParams.set('semester', currentSemester);
                
                // Save to sessionStorage for global filtering
                sessionStorage.setItem('globalSchoolYear', year);
                
                yearLabel.textContent = year;
                window.location.href = url.toString();
            });
        });
    }
    
    // Semester dropdown functionality
    const semesterBtn = document.getElementById('semesterDropdownBtn');
    const semesterMenu = document.getElementById('semesterDropdownMenu');
    const semesterLabel = document.getElementById('semesterLabel');
    
    if (semesterBtn && semesterMenu) {
        semesterBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            semesterMenu.classList.toggle('show');
            // Close year dropdown if open
            if (yearMenu) yearMenu.classList.remove('show');
        });
        
        document.addEventListener('click', function(e) {
            if (!semesterBtn.contains(e.target) && !semesterMenu.contains(e.target)) {
                semesterMenu.classList.remove('show');
            }
        });
        
        document.querySelectorAll('.semester-option').forEach(option => {
            option.addEventListener('click', function() {
                const semester = this.getAttribute('data-value');
                
                if (!semester) return; // Skip if no value
                
                // Remove selected class from all options
                document.querySelectorAll('.semester-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                
                // Apply filter while preserving year
                const url = new URL(window.location.href);
                const currentYear = url.searchParams.get('school_year') || '{{ $defaultSchoolYear }}';
                
                url.searchParams.set('semester', semester);
                url.searchParams.set('school_year', currentYear);
                
                // Save to sessionStorage for global filtering
                sessionStorage.setItem('globalSemester', semester);
                
                semesterLabel.textContent = semester;
                window.location.href = url.toString();
            });
        });
    }
});

// Filter dashboard function
function filterDashboard(filterType, value) {
    const url = new URL(window.location.href);
    const currentValue = url.searchParams.get(filterType);
    
    if (currentValue === value) {
        // If clicking the same filter, remove it
        url.searchParams.delete(filterType);
    } else {
        url.searchParams.set(filterType, value);
    }
    window.location.href = url.toString();
}
</script>
@endsection

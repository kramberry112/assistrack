@extends('layouts.app')

@section('page-title')
    <i class="bi bi-grid-3x3-gap" style="margin-right: 8px;"></i>
    Dashboard Overview
@endsection

@section('page-icon')
    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2">
        <rect x="3" y="3" width="7" height="7" rx="1"/>
        <rect x="14" y="3" width="7" height="7" rx="1"/>
        <rect x="14" y="14" width="7" height="7" rx="1"/>
        <rect x="3" y="14" width="7" height="7" rx="1"/>
    </svg>
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
    
    // Get filter values from request, session, or use defaults
    $selectedSchoolYear = request('school_year', session('head_school_year', $defaultSchoolYear));
    $selectedSemester = request('semester', session('head_semester', $defaultSemester));
    
    // Always store current selected filters in session for other pages to use
    session(['head_school_year' => $selectedSchoolYear]);
    session(['head_semester' => $selectedSemester]);
    
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
        overflow-x: hidden;
        max-width: 100vw;
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
        color: #000000 !important;
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
        gap: 20px;
        margin-top: 36px;
        justify-content: flex-start;
        flex-wrap: wrap;
        align-items: stretch;
    }
    .stat-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 32px 24px 28px 24px;
        text-align: left;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 18px;
        box-shadow: 0 4px 24px rgba(45,46,131,0.08);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        min-width: 220px;
        flex: 1 1 calc(20% - 16px);
        max-width: 280px;
        min-height: 120px;
        -webkit-tap-highlight-color: transparent;
    }
    .stat-card:hover {
        background: #f8fafc;
        box-shadow: 0 8px 32px rgba(45,46,131,0.13);
        transform: translateY(-2px);
        text-decoration: none;
        color: inherit;
    }
    
    .stat-card:active {
        transform: translateY(0px) scale(0.98);
        box-shadow: 0 2px 12px rgba(45,46,131,0.15);
    }
    .stat-icon {
        font-size: 2.2rem;
        color: #2d2e83;
        background: #f1f5f9;
        border-radius: 50%;
        padding: 14px;
        box-shadow: 0 2px 8px rgba(45,46,131,0.08);
        margin-bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .stat-number {
        font-size: 2.3rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.2rem;
    }
    .stat-label {
        font-size: 1.05rem;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        font-weight: 600;
        margin-top: 0.1rem;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        body {
            -webkit-text-size-adjust: 100%;
            overflow-x: hidden;
        }
        
        .welcome-section {
            padding: 20px 16px !important;
            margin: 12px !important;
            max-width: calc(100% - 24px) !important;
            border-radius: 16px !important;
            overflow-x: hidden;
            word-wrap: break-word;
        }
        
        /* Header flex to stack on mobile */
        .welcome-section > div:first-child {
            flex-direction: column !important;
            align-items: flex-start !important;
        }

        .welcome-message {
            font-size: 1.6rem !important;
            line-height: 1.3 !important;
        }

        .welcome-subtitle {
            font-size: 1rem !important;
            line-height: 1.4 !important;
        }
        
        /* Filter section mobile styles */
        #filterForm {
            width: 100% !important;
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 10px !important;
            margin-top: 16px !important;
        }
        
        #filterForm > div {
            width: 100% !important;
        }
        
        #filterForm select,
        #filterForm a {
            width: 100% !important;
            font-size: 14px !important;
        }

        .dashboard-stats {
            flex-direction: column !important;
            gap: 12px !important;
            margin-top: 20px !important;
        }

        .stat-card {
            min-width: unset !important;
            max-width: unset !important;
            width: 100% !important;
            padding: 24px 20px !important;
            min-height: 100px !important;
            border-radius: 14px !important;
            flex-direction: row !important;
            box-sizing: border-box !important;
            overflow: hidden !important;
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
</style>

<div class="welcome-section">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; margin-bottom: 16px;">
        <div>
            <h1 class="welcome-message">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="welcome-subtitle">Here's what's happening with your system today.</p>
        </div>
        
        <!-- Filters Section - Upper Right -->
        <form method="GET" action="{{ route('Head') }}" id="filterForm" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap; justify-content: flex-end;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <label style="font-size: 14px; font-weight: 600; color: #374151; white-space: nowrap;">School Year:</label>
                <select name="school_year" id="schoolYearFilter" onchange="document.getElementById('filterForm').submit()" style="padding: 10px 16px; border: none; border-radius: 8px; font-size: 14px; background: #4f76f6; color: white; font-weight: 600; min-width: 150px; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27white%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;">
                    @forelse($availableSchoolYears as $year)
                        <option value="{{ $year }}" {{ $selectedSchoolYear == $year ? 'selected' : '' }} style="background: white; color: black;">{{ $year }}</option>
                    @empty
                        <option value="" style="background: white; color: black;">No school years found</option>
                    @endforelse
                </select>
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <label style="font-size: 14px; font-weight: 600; color: #374151; white-space: nowrap;">Semester:</label>
                <select name="semester" id="semesterFilter" onchange="document.getElementById('filterForm').submit()" style="padding: 10px 16px; border: none; border-radius: 8px; font-size: 14px; background: #4f76f6; color: white; font-weight: 600; min-width: 160px; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27white%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;">
                    @foreach($availableSemesters as $semester)
                        <option value="{{ $semester }}" {{ $selectedSemester == $semester ? 'selected' : '' }} style="background: white; color: black;">{{ $semester }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    
    <div class="dashboard-stats">
        <a href="{{ route('head.student.list') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-people"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Student::where('school_year', $selectedSchoolYear)->where('semester', $selectedSemester)->count() }}</div>
                <div class="stat-label">Total Students</div>
            </div>
        </a>
        <a href="{{ route('head.reports.tasks') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-list-ul"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\StudentTask::where('status', '!=', 'completed')->whereHas('user.student', function($q) use ($selectedSchoolYear, $selectedSemester) { $q->where('school_year', $selectedSchoolYear)->where('semester', $selectedSemester); })->count() }}</div>
                <div class="stat-label">Active Tasks</div>
            </div>
        </a>
        <a href="{{ route('head.reports.attendance') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-calendar-check"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Attendance::whereDate('created_at', today())->whereHas('student', function($q) use ($selectedSchoolYear, $selectedSemester) { $q->where('school_year', $selectedSchoolYear)->where('semester', $selectedSemester); })->count() }}</div>
                <div class="stat-label">Today's Attendance</div>
            </div>
        </a>
        <a href="{{ route('head.reports.grades') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-award"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Grade::whereHas('student', function($q) use ($selectedSchoolYear, $selectedSemester) { $q->where('school_year', $selectedSchoolYear)->where('semester', $selectedSemester); })->count() }}</div>
                <div class="stat-label">Total Grades</div>
            </div>
        </a>
        <a href="{{ route('head.reports.evaluation') }}" class="stat-card">
            <span class="stat-icon"><i class="bi bi-graph-up-arrow"></i></span>
            <div>
                <div class="stat-number">{{ \App\Models\Evaluation::whereHas('student', function($q) use ($selectedSchoolYear, $selectedSemester) { $q->where('school_year', $selectedSchoolYear)->where('semester', $selectedSemester); })->count() }}</div>
                <div class="stat-label">Total Evaluations</div>
            </div>
        </a>
    </div>
</div>

<script>
    // Persist filters across navigation
    document.addEventListener('DOMContentLoaded', function() {
        const schoolYear = '{{ $selectedSchoolYear }}';
        const semester = '{{ $selectedSemester }}';
        
        // Store current filters in localStorage for persistence
        if (schoolYear) {
            localStorage.setItem('head_school_year', schoolYear);
        }
        if (semester) {
            localStorage.setItem('head_semester', semester);
        }
    });
</script>
@endsection

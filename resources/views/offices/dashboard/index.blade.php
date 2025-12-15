@extends('layouts.app')

@section('page-title')
    DASHBOARD
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
<div class="page-content">
<style>
    body {
        background: #f8fafc;
    }
    .welcome-section {
        background: #fff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .dashboard-stats {
        display: flex;
        flex-direction: row;
        gap: 20px;
        margin-top: 36px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .stat-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 28px 20px 24px 20px;
        text-align: left;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 18px;
        box-shadow: 0 4px 24px rgba(45,46,131,0.08);
        transition: box-shadow 0.2s, transform 0.2s, background 0.2s;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        min-width: 200px;
        flex: 1 1 0;
        max-width: 320px;
    }
    .stat-card:hover {
        background: #f3f4f6;
        box-shadow: 0 8px 32px rgba(45,46,131,0.13);
        transform: translateY(-4px) scale(1.025);
        text-decoration: none;
        color: inherit;
    }
    .stat-icon {
        font-size: 2rem;
        color: #2563eb;
        background: #f1f5f9;
        border-radius: 50%;
        padding: 12px;
        box-shadow: 0 2px 8px rgba(45,46,131,0.08);
        margin-bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.2rem;
    }
    .stat-label {
        font-size: 1rem;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        font-weight: 600;
        margin-top: 0.1rem;
    }
</style>

<div class="welcome-section">
    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1.5rem;">
        <div>
            <h1 style="font-size:2rem;font-weight:800;margin-bottom:0.5rem;letter-spacing:0.01em;">Welcome, {{ $user->name ?? 'Office User' }}!</h1>
            @if(isset($user) && $user->office_name)
                <span style="font-size:1.1rem;color:#6b7280;margin-top:8px;font-weight:500;display:block;">📍 {{ $user->office_name }} Office</span>
            @endif
        </div>
        
        <!-- School Year and Semester Filters -->
        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap; justify-content: flex-end;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <label style="font-size: 14px; font-weight: 600; color: #374151; white-space: nowrap;">School Year:</label>
                <select id="schoolYearFilter" style="padding: 10px 16px; border: none; border-radius: 8px; font-size: 14px; background: #4f76f6; color: white; font-weight: 600; min-width: 150px; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27white%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;">
                    @foreach($availableSchoolYears as $year)
                        <option value="{{ $year }}" {{ $selectedSchoolYear == $year ? 'selected' : '' }} style="background: white; color: black;">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <label style="font-size: 14px; font-weight: 600; color: #374151; white-space: nowrap;">Semester:</label>
                <select id="semesterFilter" style="padding: 10px 16px; border: none; border-radius: 8px; font-size: 14px; background: #4f76f6; color: white; font-weight: 600; min-width: 160px; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27white%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;">
                    @foreach($availableSemesters as $semester)
                        <option value="{{ $semester }}" {{ $selectedSemester == $semester ? 'selected' : '' }} style="background: white; color: black;">{{ $semester }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    
    <div class="dashboard-stats">
            <a href="{{ route('tasks.index') }}" class="stat-card">
                <span class="stat-icon"><i class="bi bi-person-check"></i></span>
                <div>
                    <div class="stat-number">{{ $totalTasks }}</div>
                    <div class="stat-label">Tasks</div>
                </div>
            </a>
            <a href="{{ route('offices.studentlists.index') }}" class="stat-card">
                <span class="stat-icon"><i class="bi bi-people"></i></span>
                <div>
                    <div class="stat-number">{{ $totalStudents }}</div>
                    <div class="stat-label">Students</div>
                </div>
            </a>
            <a href="{{ route('attendance.index') }}" class="stat-card">
                <span class="stat-icon"><i class="bi bi-calendar2-check"></i></span>
                <div>
                    <div class="stat-number">{{ $attendanceCount ?? 0 }}</div>
                    <div class="stat-label">Attendance</div>
                </div>
            </a>
            <a href="{{ route('offices.reports.grades') }}" class="stat-card">
                <span class="stat-icon"><i class="bi bi-award"></i></span>
                <div>
                    <div class="stat-number">{{ $totalGrades ?? 0 }}</div>
                    <div class="stat-label">Grades</div>
                </div>
            </a>
        </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const schoolYearFilter = document.getElementById('schoolYearFilter');
    const semesterFilter = document.getElementById('semesterFilter');
    
    if (schoolYearFilter) {
        schoolYearFilter.addEventListener('change', function() {
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('school_year', this.value);
            if (semesterFilter) {
                currentUrl.searchParams.set('semester', semesterFilter.value);
            }
            window.location.href = currentUrl.toString();
        });
    }
    
    if (semesterFilter) {
        semesterFilter.addEventListener('change', function() {
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('semester', this.value);
            if (schoolYearFilter) {
                currentUrl.searchParams.set('school_year', schoolYearFilter.value);
            }
            window.location.href = currentUrl.toString();
        });
    }
});
</script>
</div>
@endsection

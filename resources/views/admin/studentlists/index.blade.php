@extends('layouts.app')

@section('page-title')
    <i class="bi bi-person-lines-fill" style="margin-right: 8px;"></i>
    Student List
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
    /* Mobile optimization */
    * {
        -webkit-tap-highlight-color: transparent;
        box-sizing: border-box;
    }
    
    html, body {
        overflow-x: hidden !important;
        width: 100% !important;
        max-width: 100vw !important;
    }
    
    .content-wrapper {
        background: #fff !important;
        padding: 0 !important;
        margin: 0 !important;
        max-width: 100vw !important;
        overflow-x: hidden !important;
    }
    .admin-content-wrapper {
        background: #fff !important;
        max-width: 100vw !important;
        overflow-x: hidden !important;
    }
    .main-content {
        background: #fff !important;
        max-width: 100vw !important;
        overflow-x: hidden !important;
    }
    body {
        background: #fff !important;
        overflow-x: hidden !important;
        max-width: 100vw !important;
    }
    
    .content-card {
        flex: 1;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 0;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
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

    /* Student List */
    .studentlist-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #111827;
        margin: 16px 24px 4px 24px;
    }

    .studentlist-desc {
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

    .student-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
    }

    .student-table thead th {
        background: #f3f4f6;
        color: #111827;
        font-size: 0.9rem;
        font-weight: 600;
        padding: 12px 16px;
        text-align: left;
    }

    .student-table tbody td {
        font-size: 0.9rem;
        color: #374151;
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
    }

    .student-table tbody tr:hover td {
        background: #f9fafb;
    }

    .student-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Filter Dropdown Styles */
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
    
    .action-cell {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        gap: 8px;
        align-items: center;
        justify-content: flex-start;
        white-space: nowrap !important;
    }

        .action-cell form,
        .action-cell a {
            display: inline-block;
            margin: 0 !important;
        }

        .action-cell button,
        .action-cell a,
        .action-cell span {
            font-size: 11px !important;
            padding: 4px 12px !important;
            margin: 0 !important;
            min-width: 100px;
            text-align: center;
            box-sizing: border-box;
        }

        @media (max-width: 600px) {
            .action-cell {
                gap: 4px;
            }
            .action-cell button,
            .action-cell a,
            .action-cell span {
                font-size: 10px !important;
                padding: 3px 8px !important;
                min-width: 70px;
            }
        }
            display: inline-block;
            margin: 0 !important;
        }

        .action-cell button,
        .action-cell a,
        .action-cell span {
            font-size: 11px !important;
            padding: 4px 8px !important;
            margin: 0 !important;
            min-width: 90px;
            text-align: center;
        }

        @media (max-width: 600px) {
            .action-cell {
                gap: 4px;
            }
            .action-cell button,
            .action-cell a,
            .action-cell span {
                font-size: 10px !important;
                padding: 3px 5px !important;
                min-width: 70px;
            }
        }
        transition: background 0.2s;
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
        left: 0;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        min-width: 200px;
        z-index: 99999;
        padding: 8px 0;
    }

    .filter-dropdown.show {
        display: block;
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
        white-space: nowrap;
        overflow: hidden;
        gap: 8px;
        min-height: 40px;
        box-sizing: border-box;
    }
    
    .filter-label span {
        flex: 1;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
    
    .filter-label svg {
        flex-shrink: 0;
        margin-left: auto;
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
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        min-height: 32px;
        box-sizing: border-box;
        display: flex;
        align-items: center;
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

    /* Action Button Styles */
    .btn-view {
        transition: background 0.2s ease;
    }

    .btn-view:hover {
        background: #2563eb !important;
    }

    .btn-create-account {
        transition: background 0.2s ease;
    }

    .btn-create-account:hover {
        background: #059669 !important;
    }

    .btn-account-created {
        opacity: 0.8;
    }

    .btn-delete {
        transition: background 0.2s ease;
    }

    .btn-delete:hover {
        background: #dc2626 !important;
    }

    .desktop-actions {
        align-items: center;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        /* Content adjustments */
        .content-card {
            border-radius: 8px !important;
            margin: 8px !important;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05) !important;
        }

        .content-header {
            padding: 12px 16px !important;
            font-size: 0.9rem !important;
        }

        /* Header section mobile responsive */
        .header-container {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 12px !important;
            padding: 0 16px !important;
        }
        
        .header-text {
            width: 100% !important;
        }
        
        .page-header-controls {
            width: 100% !important;
            flex-direction: column !important;
            gap: 12px !important;
            margin-top: 0 !important;
        }

        /* Header section */
        .studentlist-title {
            font-size: 1.1rem !important;
            margin: 12px 0 4px 0 !important;
        }

        .studentlist-desc {
            font-size: 0.9rem !important;
            padding: 0 !important;
            margin-bottom: 16px !important;
        }

        /* Filter and search controls */
        .filter-container {
            width: 100% !important;
            order: 1 !important;
        }

        .filter-button {
            width: 100% !important;
            justify-content: center !important;
            padding: 12px 16px !important;
            font-size: 0.95rem !important;
            min-height: 48px !important;
            border-radius: 8px !important;
            touch-action: manipulation !important;
        }

        /* Search form mobile responsive */
        form[style*="display: flex"] {
            flex-direction: row !important;
            gap: 8px !important;
            width: 100% !important;
            align-items: stretch !important;
            order: 2 !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: visible !important;
        }

        form input[type="text"] {
            flex: 1 !important;
            padding: 12px 16px !important;
            font-size: 0.95rem !important;
            border-radius: 8px !important;
            min-height: 48px !important;
            border: 1px solid #d1d5db !important;
            box-sizing: border-box !important;
        }

        form button {
            padding: 12px 20px !important;
            font-size: 0.95rem !important;
            border-radius: 8px !important;
            white-space: nowrap !important;
            min-height: 48px !important;
            min-width: 80px !important;
        }

        /* Table container */
        .table-container {
            padding: 0 16px 16px 16px !important;
            overflow-x: auto !important;
        }

        /* Hide table on mobile and show cards instead */
        .student-table {
            display: none !important;
        }

        /* Mobile card layout */
        .mobile-student-cards {
            display: block !important;
            gap: 12px !important;
        }

        .student-card {
            background: #fff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 8px !important;
            padding: 16px !important;
            margin-bottom: 12px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
        }

        .student-card-header {
            display: flex !important;
            justify-content: space-between !important;
            align-items: flex-start !important;
            margin-bottom: 12px !important;
        }

        .student-card-name {
            font-size: 1rem !important;
            font-weight: 600 !important;
            color: #111827 !important;
            margin-bottom: 4px !important;
        }

        .student-card-details {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 8px !important;
            margin-bottom: 12px !important;
        }

        .student-card-item {
            font-size: 0.85rem !important;
            color: #374151 !important;
        }

        .student-card-item strong {
            display: block !important;
            font-size: 0.8rem !important;
            color: #6b7280 !important;
            font-weight: 500 !important;
            margin-bottom: 2px !important;
        }

        .student-card-actions {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 6px !important;
            justify-content: flex-start !important;
        }

        .student-card-actions button,
        .student-card-actions a,
        .student-card-actions span {
            font-size: 0.8rem !important;
            padding: 6px 12px !important;
            border-radius: 4px !important;
            flex: 1 1 auto !important;
            text-align: center !important;
            min-width: 80px !important;
        }

        /* Filter dropdown mobile - responsive positioning */
        .filter-dropdown {
            position: absolute !important;
            left: 0 !important;
            right: 16px !important;
            top: calc(100% + 8px) !important;
            bottom: auto !important;
            width: auto !important;
            min-width: 250px !important;
            max-width: calc(100vw - 32px) !important;
            max-height: 60vh !important;
            overflow-y: auto !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
            z-index: 99999 !important;
        }
        
        .filter-dropdown .filter-cascade {
            max-height: 180px !important;
        }
        
        /* Filter button mobile improvements */
        .filter-button {
            width: 100% !important;
            max-width: none !important;
            padding: 14px 16px !important;
            font-size: 1rem !important;
            min-height: 52px !important;
            border-radius: 12px !important;
            position: relative !important;
        }
        
        .filter-container {
            width: 100% !important;
        }
        
        .page-header-controls {
            width: 100% !important;
            justify-content: stretch !important;
        }
        
        /* Improve filter options for touch */
        .filter-option {
            padding: 12px 16px !important;
            font-size: 0.9rem !important;
            border-bottom: 1px solid #f3f4f6 !important;
        }
        
        .filter-option:last-child {
            border-bottom: none !important;
        }
        
        .cascading-label {
            padding: 12px 16px !important;
            font-size: 0.95rem !important;
            background: #f9fafb !important;
            border-bottom: 1px solid #e5e7eb !important;
        }
        
        .filter-clear {
            margin: 12px 16px 8px 16px !important;
            padding: 10px 16px !important;
            font-size: 0.9rem !important;
            border-radius: 8px !important;
        }
    }

    /* Ultra mobile (small phones) */
    @media (max-width: 480px) {
        .content-card {
            margin: 4px !important;
            border-radius: 6px !important;
        }
        
        .header-container {
            padding: 0 8px !important;
        }
        
        .table-container {
            padding: 0 8px 8px 8px !important;
        }
        
        .studentlist-title {
            font-size: 1rem !important;
        }
        
        .filter-button {
            font-size: 0.9rem !important;
            padding: 10px 12px !important;
            min-height: 44px !important;
        }
        
        form input[type="text"] {
            font-size: 0.9rem !important;
            padding: 10px 12px !important;
            min-height: 44px !important;
        }
        
        form button {
            font-size: 0.9rem !important;
            padding: 10px 16px !important;
            min-height: 44px !important;
            min-width: 70px !important;
        }
        .content-card {
            margin: 4px !important;
            border-radius: 6px !important;
        }

        .studentlist-title {
            font-size: 1rem !important;
            margin: 8px 12px 4px 12px !important;
        }

        .studentlist-desc {
            font-size: 0.85rem !important;
            padding: 0 12px !important;
        }

        .table-container {
            padding: 0 12px 12px 12px !important;
        }

        .student-card {
            padding: 12px !important;
            margin-bottom: 8px !important;
        }

        .student-card-details {
            grid-template-columns: 1fr !important;
            gap: 6px !important;
        }

        .student-card-actions button,
        .student-card-actions a,
        .student-card-actions span {
            font-size: 0.75rem !important;
            padding: 5px 8px !important;
            min-width: 70px !important;
        }
    }

    /* Tablet responsive (medium screens) */
    @media (max-width: 1024px) and (min-width: 769px) {
        .header-container {
            padding: 0 20px !important;
        }
        
        .studentlist-title {
            font-size: 1.15rem !important;
        }
        
        .table-container {
            padding: 0 20px 20px 20px !important;
            overflow-x: auto !important;
        }
        
        .student-table {
            font-size: 0.85rem !important;
        }
        
        .student-table th,
        .student-table td {
            padding: 10px 12px !important;
        }
    }

    /* Desktop: hide mobile cards */
    @media (min-width: 769px) {
        .mobile-student-cards {
            display: none !important;
        }
    }
    
    /* Ensure proper mobile container width */
    @media (max-width: 768px) {
        .content-wrapper,
        .admin-content-wrapper,
        .main-content {
            width: 100% !important;
            max-width: 100% !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        
        /* Prevent horizontal scroll issues */
        .content-card,
        .header-container,
        .table-container {
            max-width: 100% !important;
            box-sizing: border-box !important;
        }
        
        /* Fix any potential text overflow */
        .student-card-name,
        .studentlist-title {
            word-wrap: break-word !important;
            overflow-wrap: break-word !important;
        }
    }

    /* Print Styles */
    @media print {
        body * {
            visibility: hidden;
        }
        
        #printArea {
            display: block !important;
            visibility: visible;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 10mm 15mm;
        }
        
        #printArea * {
            visibility: visible;
        }
        
        @page {
            size: A4 portrait;
            margin: 10mm;
        }
        
        .filter-dropdown,
        .filter-section,
        .content-card,
        nav,
        .footer,
        button,
        .action-buttons {
            display: none !important;
            visibility: hidden !important;
        }
        
        .print-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 8px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        
        .print-logo {
            width: 75px;
            height: 75px;
        }
        
        .print-title-section {
            flex: 1;
            text-align: center;
        }
        
        .print-university {
            font-size: 22px;
            font-weight: bold;
            color: #1e40af;
            margin: 0;
        }
        
        .print-office {
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            margin: 2px 0;
        }
        
        .print-date {
            text-align: right;
            font-size: 13px;
            margin: 10px 0;
        }
        
        .print-doc-title {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            margin: 10px 0 3px 0;
        }
        
        .print-doc-subtitle {
            text-align: center;
            font-size: 13px;
            margin-bottom: 15px;
        }
        
        .print-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            margin-bottom: 20px;
        }
        
        .print-table th {
            background: #f3f4f6;
            border: 1px solid #000;
            padding: 6px 5px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
        }
        
        .print-table td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 14px;
        }
        
        .print-footer {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }
        
        .print-signature-section {
            text-align: center;
        }
        
        .print-signature-line {
            margin-top: 30px;
            border-top: 1px solid #000;
            padding-top: 5px;
            font-weight: bold;
            font-size: 14px;
        }
        
        .print-signature-title {
            font-size: 14px;
            margin-top: 2px;
        }
        
        @page {
            size: A4;
            margin: 15mm;
        }
    }
</style>


        @if(session('success'))
            <div id="successMessage" style="background:#10b981;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:16px;transition:opacity 0.5s ease-out;">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div id="errorMessage" style="background:#ef4444;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:16px;transition:opacity 0.5s ease-out;">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

<div style="background: #fff; min-height: calc(100vh - 76px); padding: 0;">
            <div class="header-container" style="display: flex; flex-direction: row; align-items: flex-start; padding: 0 24px 0 24px; margin-bottom: 16px;">
                <div class="header-text" style="flex: 1 1 auto;">
                    <div class="studentlist-title" style="margin-bottom:0;">Student Official List</div>
                    <div class="studentlist-desc" style="margin-bottom:0;">This list contains Official Student Assistants of Universidad de Dagupan</div>
                </div>
                
                <div class="page-header-controls" style="flex: 0 0 auto; display: flex; align-items: center; gap: 8px; margin-top: 4px;">
                    <!-- Filter Button -->
                    <div class="filter-container">
                        <button class="filter-button" id="filterDropdownBtn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg><span>Filter</span>
                        </button>
                        
                        <div class="filter-dropdown" id="filterDropdownMenu">
                            <div class="filter-label cascading-label" data-cascade="schoolyear">
                                <span>School Year</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                            <div class="filter-cascade filter-cascade-schoolyear">
                                <div class="filter-option {{ !request('school_year') ? 'selected' : '' }}" data-filter="school_year" data-value="">All School Years</div>
                                @foreach($availableSchoolYears as $schoolYear)
                                    <div class="filter-option {{ request('school_year') == $schoolYear ? 'selected' : '' }}" data-filter="school_year" data-value="{{ $schoolYear }}">{{ $schoolYear }}</div>
                                @endforeach
                            </div>
                            
                            <div class="filter-label cascading-label" data-cascade="semester">
                                <span>Semester</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                            <div class="filter-cascade filter-cascade-semester">
                                <div class="filter-option {{ !request('semester') ? 'selected' : '' }}" data-filter="semester" data-value="">All Semesters</div>
                                @foreach($availableSemesters as $semester)
                                    <div class="filter-option {{ request('semester') == $semester ? 'selected' : '' }}" data-filter="semester" data-value="{{ $semester }}">{{ $semester }}</div>
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
                                <div class="filter-option" data-filter="year_level" data-value="">All Years</div>
                                <div class="filter-option" data-filter="year_level" data-value="First Year">First Year</div>
                                <div class="filter-option" data-filter="year_level" data-value="Second Year">Second Year</div>
                                <div class="filter-option" data-filter="year_level" data-value="Third Year">Third Year</div>
                                <div class="filter-option" data-filter="year_level" data-value="Fourth Year">Fourth Year</div>
                                <div class="filter-option" data-filter="year_level" data-value="Fifth Year">Fifth Year</div>
                            </div>
                            <div class="filter-label cascading-label" data-cascade="office">
                                <span>Office</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                            <div class="filter-cascade filter-cascade-office" style="max-height: 250px; overflow-y: auto;">
                                <div class="filter-option" data-filter="office" data-value="">All Offices</div>
                                <div class="filter-option" data-filter="office" data-value="ACADS">ACADS</div>
                                <div class="filter-option" data-filter="office" data-value="ALUMNI OFFICE">ALUMNI OFFICE</div>
                                <div class="filter-option" data-filter="office" data-value="ARCHIVING">ARCHIVING</div>
                                <div class="filter-option" data-filter="office" data-value="ARZATECH">ARZATECH</div>
                                <div class="filter-option" data-filter="office" data-value="CANTEEN">CANTEEN</div>
                                <div class="filter-option" data-filter="office" data-value="CLINIC">CLINIC</div>
                                <div class="filter-option" data-filter="office" data-value="FINANCE">FINANCE</div>
                                <div class="filter-option" data-filter="office" data-value="GUIDANCE">GUIDANCE</div>
                                <div class="filter-option" data-filter="office" data-value="HRD">HRD</div>
                                <div class="filter-option" data-filter="office" data-value="KUWAGO">KUWAGO</div>
                                <div class="filter-option" data-filter="office" data-value="LCR">LCR</div>
                                <div class="filter-option" data-filter="office" data-value="LIBRARY">LIBRARY</div>
                                <div class="filter-option" data-filter="office" data-value="LINKAGES">LINKAGES</div>
                                <div class="filter-option" data-filter="office" data-value="MARKETING">MARKETING</div>
                                <div class="filter-option" data-filter="office" data-value="OPEN LAB">OPEN LAB</div>
                                <div class="filter-option" data-filter="office" data-value="PRESIDENT'S OFFICE">PRESIDENT'S OFFICE</div>
                                <div class="filter-option" data-filter="office" data-value="QUEUING">QUEUING</div>
                                <div class="filter-option" data-filter="office" data-value="QUALITY ASSURANCE">QUALITY ASSURANCE</div>
                                <div class="filter-option" data-filter="office" data-value="REGISTRAR">REGISTRAR</div>
                                <div class="filter-option" data-filter="office" data-value="SAO">SAO</div>
                                <div class="filter-option" data-filter="office" data-value="SBA FACULTY">SBA FACULTY</div>
                                <div class="filter-option" data-filter="office" data-value="SIHM FACULTY">SIHM FACULTY</div>
                                <div class="filter-option" data-filter="office" data-value="SITE FACULTY">SITE FACULTY</div>
                                <div class="filter-option" data-filter="office" data-value="SOE FACULTY">SOE FACULTY</div>
                                <div class="filter-option" data-filter="office" data-value="SOH FACULTY">SOH FACULTY</div>
                                <div class="filter-option" data-filter="office" data-value="SOHS FACULTY">SOHS FACULTY</div>
                                <div class="filter-option" data-filter="office" data-value="SOC FACULTY">SOC FACULTY</div>
                                <div class="filter-option" data-filter="office" data-value="SPORTS AND CULTURE">SPORTS AND CULTURE</div>
                                <div class="filter-option" data-filter="office" data-value="STE DEAN'S OFFICE">STE DEAN'S OFFICE</div>
                                <div class="filter-option" data-filter="office" data-value="STE FACULTY">STE FACULTY</div>
                                <div class="filter-option" data-filter="office" data-value="STEEDS">STEEDS</div>
                                <div class="filter-option" data-filter="office" data-value="XACTO">XACTO</div>
                            </div>
                            <button class="filter-clear" onclick="clearFilters()">Clear Filters</button>
                        </div>
                    </div>
                    
                    <!-- Filter overlay for mobile -->
                    <div class="filter-overlay" id="filterOverlay"></div>
                    
                    <!-- Search Bar -->
                    <form method="GET" action="" style="display: flex; align-items: center; gap: 8px;">
                        <input type="text" name="keyword" id="studentSearchBar" value="{{ request('keyword') }}" placeholder="Search students..." style="padding: 7px 12px; border-radius: 6px; border: 1px solid #bbb; font-size: 15px;">
                        <button type="submit" style="padding: 7px 18px; border-radius: 6px; background: #2563eb; color: #fff; border: none; font-size: 15px; cursor: pointer;">Search</button>
                        <button type="button" onclick="printStudentList()" style="padding: 7px 18px; border-radius: 6px; background: #059669; color: #fff; border: none; font-size: 15px; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Print
                        </button>
                    </form>
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
                            <th>Full Matriculation</th>
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
                            <td style="overflow: visible; position: relative;">
                                <div class="matriculation-dropdown" style="position:relative; width:100px; overflow: visible;">
                                    <div style="position:relative;">
                                        <input type="text" class="matriculation-combo-input" value="{{ $student->matriculation ?? '' }}" placeholder="Select or search..." style="width:100%;padding:6px 32px 6px 10px;border-radius:5px;border:1px solid #bbb;font-size:14px;" autocomplete="off" readonly data-student-id="{{ $student->id }}">
                                        <span class="matriculation-combo-arrow" style="position:absolute;top:8px;right:10px;width:18px;height:18px;pointer-events:auto;cursor:pointer;display:flex;align-items:center;justify-content:center;z-index:100;background:#fff;">
                                            <svg width="18" height="18" viewBox="0 0 24 24">
                                                <path d="M7 10l5 5 5-5" stroke="#555" stroke-width="2" fill="none" />
                                            </svg>
                                        </span>
                                        <div class="matriculation-combo-list" style="display:none;position:absolute;top:40px;left:0;width:100%;background:#fff;border:1px solid #bbb;border-radius:5px;box-shadow:0 8px 32px rgba(0,0,0,0.18);z-index:9999;max-height:120px;overflow-y:auto;">
                                            <div class="matriculation-combo-item" style="padding:8px 12px;cursor:pointer;">50%</div>
                                            <div class="matriculation-combo-item" style="padding:8px 12px;cursor:pointer;">75%</div>
                                            <div class="matriculation-combo-item" style="padding:8px 12px;cursor:pointer;">Full</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="overflow: visible; position: relative;">
                                <div class="office-dropdown" style="position:relative; width:180px; overflow: visible;">
                                    <div style="position:relative;">
                                        <input type="text" class="office-combo-input" value="{{ $student->designated_office }}" placeholder="Select or search office..." style="width:100%;padding:6px 32px 6px 10px;border-radius:5px;border:1px solid #bbb;font-size:14px;" autocomplete="off" readonly data-student-id="{{ $student->id }}">
                                        <span class="office-combo-arrow" style="position:absolute;top:8px;right:10px;width:18px;height:18px;pointer-events:auto;cursor:pointer;display:flex;align-items:center;justify-content:center;z-index:100;background:#fff;">
                                            <svg width="18" height="18" viewBox="0 0 24 24">
                                                <path d="M7 10l5 5 5-5" stroke="#555" stroke-width="2" fill="none" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="office-combo-list" style="display:none;position:absolute;top:40px;left:0;width:100%;background:#fff;border:1px solid #bbb;border-radius:5px;box-shadow:0 8px 32px rgba(0,0,0,0.18);z-index:9999;max-height:220px;overflow-y:auto;">
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">ACADS</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">ALUMNI OFFICE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">ARCHIVING</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">ARZATECH</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">CANTEEN</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">CLINIC</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">FINANCE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">GUIDANCE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">HRD</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">KUWAGO</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">LCR</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">LIBRARY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">LINKAGES</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">MARKETING</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">OPEN LAB</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">PRESIDENT'S OFFICE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">QUEUING</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">QUALITY ASSURANCE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">REGISTRAR</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SAO</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SBA FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SIHM FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SITE FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SOE FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SOH FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SOHS FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SOC FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SPORTS AND CULTURE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">STE DEAN'S OFFICE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">STE FACULTY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">STEEDS</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">XACTO</div>
                                    </div>
                                </div>
                            </td>
                            <td class="action-cell">
                                <div class="desktop-actions" style="display: flex; gap: 4px; flex-wrap: wrap;">
                                    <a href="{{ route('students.show', $student->id) }}" class="btn-view" style="background:#3b82f6;color:#fff;padding:6px 12px;border-radius:4px;text-decoration:none;font-size:12px;display:inline-flex;align-items:center;justify-content:center;min-width:60px;">View</a>
                                    
                                    @if($student->user_id)
                                        <span class="btn-account-created" style="background:#10b981;color:#fff;padding:6px 12px;border-radius:4px;font-size:12px;display:inline-flex;align-items:center;justify-content:center;min-width:80px;">Account Created</span>
                                    @else
                                        <form method="POST" action="{{ route('students.createAccount', $student->id) }}" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Create account for {{ $student->student_name }}?')" class="btn-create-account" style="background:#10b981;color:#fff;border:none;padding:6px 12px;border-radius:4px;cursor:pointer;font-size:12px;display:inline-flex;align-items:center;justify-content:center;min-width:80px;">Create Account</button>
                                        </form>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('students.delete', $student->id) }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this student?')" class="btn-delete" style="background:#ef4444;color:#fff;border:none;padding:6px 12px;border-radius:4px;cursor:pointer;font-size:12px;display:inline-flex;align-items:center;justify-content:center;min-width:60px;">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 40px 20px; color: #6b7280;">
                                <p style="font-size: 0.95rem; margin: 0;">No records found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Mobile Card Layout (shown only on mobile) -->
                <div class="mobile-student-cards" style="display: none;">
                    @foreach($students as $student)
                    <div class="student-card">
                        <div class="student-card-header">
                            <div class="student-card-name">{{ $student->student_name }}</div>
                        </div>
                        
                        <div class="student-card-details">
                            <div class="student-card-item">
                                <strong>Course:</strong>
                                {{ $student->course }}
                            </div>
                            <div class="student-card-item">
                                <strong>Year Level:</strong>
                                {{ $student->year_level }}
                            </div>
                            <div class="student-card-item">
                                <strong>Student ID:</strong>
                                {{ $student->id_number }}
                            </div>
                            <div class="student-card-item">
                                <strong>Matriculation:</strong>
                                <div class="matriculation-dropdown" style="position:relative; width:100%; overflow: visible; margin-top: 4px;">
                                    <div style="position:relative;">
                                        <input type="text" class="matriculation-combo-input" value="{{ $student->matriculation ?? '' }}" placeholder="Select or search..." style="width:100%;padding:8px 32px 8px 10px;border-radius:5px;border:1px solid #bbb;font-size:14px;" autocomplete="off" readonly data-student-id="{{ $student->id }}">
                                        <span class="matriculation-combo-arrow" style="position:absolute;top:8px;right:10px;width:18px;height:18px;pointer-events:auto;cursor:pointer;display:flex;align-items:center;justify-content:center;z-index:100;background:#fff;">
                                            <svg width="18" height="18" viewBox="0 0 24 24">
                                                <path d="M7 10l5 5 5-5" stroke="#555" stroke-width="2" fill="none" />
                                            </svg>
                                        </span>
                                        <div class="matriculation-combo-list" style="display:none;position:absolute;top:40px;left:0;width:100%;background:#fff;border:1px solid #bbb;border-radius:5px;box-shadow:0 8px 32px rgba(0,0,0,0.18);z-index:9999;max-height:120px;overflow-y:auto;">
                                            <div class="matriculation-combo-item" style="padding:8px 12px;cursor:pointer;">50%</div>
                                            <div class="matriculation-combo-item" style="padding:8px 12px;cursor:pointer;">75%</div>
                                            <div class="matriculation-combo-item" style="padding:8px 12px;cursor:pointer;">Full</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="student-card-item" style="grid-column: 1 / -1;">
                                <strong>Designated Office:</strong>
                                <div class="office-dropdown" style="position:relative; width:100%; overflow: visible; margin-top: 4px;">
                                    <div style="position:relative;">
                                        <input type="text" class="office-combo-input" value="{{ $student->designated_office }}" placeholder="Select or search office..." style="width:100%;padding:8px 32px 8px 10px;border-radius:5px;border:1px solid #bbb;font-size:14px;" autocomplete="off" readonly data-student-id="{{ $student->id }}">
                                        <span class="office-combo-arrow" style="position:absolute;top:8px;right:10px;width:18px;height:18px;pointer-events:auto;cursor:pointer;display:flex;align-items:center;justify-content:center;z-index:100;background:#fff;">
                                            <svg width="18" height="18" viewBox="0 0 24 24">
                                                <path d="M7 10l5 5 5-5" stroke="#555" stroke-width="2" fill="none" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="office-combo-list" style="display:none;position:absolute;top:40px;left:0;width:100%;background:#fff;border:1px solid #bbb;border-radius:5px;box-shadow:0 8px 32px rgba(0,0,0,0.18);z-index:9999;max-height:220px;overflow-y:auto;">
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">ACADS</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">ALUMNI OFFICE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">ARCHIVING</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">ARZATECH</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">CANTEEN</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">CLINIC</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">FINANCE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">GUIDANCE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">HRD</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">KUWAGO</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">LCR</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">LIBRARY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">LINKAGES</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">MARKETING</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">OPEN LAB</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">PRESIDENTS OFFICE</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">REGISTRAR</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">RESEARCH</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SAS</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SECURITY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">SUPPLY</div>
                                        <div class="office-combo-item" style="padding:8px 12px;cursor:pointer;">VPAA</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="student-card-actions">
                            <a href="{{ route('students.show', $student->id) }}" class="btn-view" style="background:#3b82f6;color:#fff;text-decoration:none;padding:8px 12px;border-radius:4px;font-size:0.85rem;display:flex;align-items:center;justify-content:center;flex:1;">View</a>
                            
                            @if($student->user_id)
                                <span class="btn-account-created" style="background:#10b981;color:#fff;padding:8px 12px;border-radius:4px;font-size:0.85rem;display:flex;align-items:center;justify-content:center;flex:1;">Account Created</span>
                            @else
                                <form method="POST" action="{{ route('students.createAccount', $student->id) }}" style="flex:1;">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Create account for {{ $student->student_name }}?')" class="btn-create-account" style="background:#10b981;color:#fff;border:none;cursor:pointer;padding:8px 12px;border-radius:4px;font-size:0.85rem;width:100%;display:flex;align-items:center;justify-content:center;">Create Account</button>
                                </form>
                            @endif
                            
                            <form method="POST" action="{{ route('students.delete', $student->id) }}" style="flex:1;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this student?')" class="btn-delete" style="background:#ef4444;color:#fff;border:none;cursor:pointer;padding:8px 12px;border-radius:4px;font-size:0.85rem;width:100%;display:flex;align-items:center;justify-content:center;">Delete</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Pagination at bottom -->
            <div style="display: flex; justify-content: center; margin-top: 20px; margin-bottom: 20px;">
                <span style="font-size:1rem;color:#374151;padding:6px 18px;border-radius:18px;background:#f3f4f6;display:inline-flex;align-items:center;gap:12px;">
                    @if ($students->onFirstPage())
                    <span style="color:#d1d5db;cursor:not-allowed;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </span>
                    @else
                    <a href="{{ $students->previousPageUrl() }}" style="color:#2563eb;text-decoration:none;display:inline-flex;align-items:center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </a>
                    @endif
                    <span style="font-size:1rem;color:#374151;">Page {{ $students->currentPage() }} of {{ $students->lastPage() }}</span>
                    @if ($students->hasMorePages())
                    <a href="{{ $students->nextPageUrl() }}" style="color:#2563eb;text-decoration:none;display:inline-flex;align-items:center;">
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

<script>
document.addEventListener('DOMContentLoaded', function() {

    // Apply global filters from dashboard if available
    const globalSchoolYear = sessionStorage.getItem('globalSchoolYear');
    const globalSemester = sessionStorage.getItem('globalSemester');
    
    if (globalSchoolYear || globalSemester) {
        const url = new URL(window.location.href);
        let needsReload = false;
        
        if (globalSchoolYear && url.searchParams.get('school_year') !== globalSchoolYear) {
            url.searchParams.set('school_year', globalSchoolYear);
            needsReload = true;
        }
        
        if (globalSemester && url.searchParams.get('semester') !== globalSemester) {
            url.searchParams.set('semester', globalSemester);
            needsReload = true;
        }
        
        if (needsReload) {
            window.location.href = url.toString();
            return;
        }
    }

    // Filter dropdown functionality
    const filterBtn = document.getElementById('filterDropdownBtn');
    const filterMenu = document.getElementById('filterDropdownMenu');
    
    // Cascading submenu logic for filter
    const cascadeLabels = document.querySelectorAll('.cascading-label');
    const cascades = {
        schoolyear: document.querySelector('.filter-cascade-schoolyear'),
        semester: document.querySelector('.filter-cascade-semester'),
        course: document.querySelector('.filter-cascade-course'),
        year: document.querySelector('.filter-cascade-year'),
        office: document.querySelector('.filter-cascade-office')
    };
    
    filterBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        filterMenu.classList.toggle('show');
    });
    
    // Close filter dropdown when clicking outside
    function closeFilterDropdown() {
        filterMenu.classList.remove('show');
        // Also close any open cascades
        Object.values(cascades).forEach(c => c.style.display = 'none');
    }
    
    document.addEventListener('click', function(e) {
        if (!filterMenu.contains(e.target) && e.target !== filterBtn) {
            closeFilterDropdown();
        }
    });
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

    // Prevent body scroll when filter is open on mobile
    function toggleBodyScroll(disable) {
        if (window.innerWidth <= 768) {
            document.body.style.overflow = disable ? 'hidden' : '';
        }
    }
    
    // Update the filter button click handler to manage body scroll
    const originalFilterBtnHandler = filterBtn.onclick;
    filterBtn.addEventListener('click', function(e) {
        const willShow = !filterMenu.classList.contains('show');
        toggleBodyScroll(willShow);
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
    const searchBar = document.getElementById('studentSearchBar');
    const originalUrl = "{{ route('student.list') }}";
    searchBar.addEventListener('input', function() {
        if (searchBar.value.trim() === '') {
            window.location.href = originalUrl;
        }
    });

    // Custom searchable dropdown for Designated Office
    document.querySelectorAll('.office-dropdown').forEach(function(dropdownDiv) {
        const input = dropdownDiv.querySelector('.office-combo-input');
        const list = dropdownDiv.querySelector('.office-combo-list');
        const arrow = dropdownDiv.querySelector('.office-combo-arrow');
        let portalList = null;
        
        function showList() {
            if (!portalList) {
                portalList = list.cloneNode(true);
                portalList.classList.add('office-combo-list-portal');
                document.body.appendChild(portalList);
                portalList.style.position = 'fixed';
                portalList.style.zIndex = '99999';
                portalList.style.background = '#fff';
                portalList.style.border = '1px solid #bbb';
                portalList.style.borderRadius = '5px';
                portalList.style.boxShadow = '0 8px 32px rgba(0,0,0,0.18)';
                portalList.style.maxHeight = '224px';
                portalList.style.overflowY = 'auto';
                portalList.style.width = dropdownDiv.offsetWidth + 'px';
                
                const rect = input.getBoundingClientRect();
                portalList.style.left = rect.left + 'px';
                portalList.style.top = (rect.bottom + 2) + 'px';
                
                // Mobile adjustments for office dropdown
                if (window.innerWidth <= 768) {
                    portalList.style.width = Math.min(dropdownDiv.offsetWidth, window.innerWidth - 20) + 'px';
                    if (rect.left + dropdownDiv.offsetWidth > window.innerWidth) {
                        portalList.style.left = (window.innerWidth - dropdownDiv.offsetWidth - 10) + 'px';
                    }
                }
                
                input.addEventListener('input', function() {
                    Array.from(portalList.children).forEach(function(item) {
                        item.style.display = item.textContent.toLowerCase().includes(input.value.toLowerCase()) ? '' : 'none';
                    });
                });
                
                Array.from(portalList.children).forEach(function(item) {
                    item.addEventListener('mousedown', function(e) {
                        e.preventDefault();
                        input.value = item.textContent;
                        hideList();
                        input.setAttribute('readonly', true);
                        
                        // AJAX PATCH request to save office
                        const studentId = input.getAttribute('data-student-id');
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        fetch(`/students/${studentId}/office`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({ designated_office: item.textContent })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                input.value = data.office;
                            }
                        });
                    });
                });
            }
            portalList.style.display = 'block';
            input.removeAttribute('readonly');
            input.focus();
        }
        
        function hideList() {
            if (portalList) portalList.style.display = 'none';
            input.setAttribute('readonly', true);
        }
        
        input.addEventListener('focus', showList);
        input.addEventListener('blur', function() { setTimeout(hideList, 150); });
        arrow.addEventListener('mousedown', function(e) {
            e.preventDefault();
            if (portalList && portalList.style.display === 'block') {
                hideList();
            } else {
                showList();
            }
        });
    });

    // Custom searchable dropdown for Full Matriculation
    document.querySelectorAll('.matriculation-combo-input').forEach(function(input) {
    const dropdownDiv = input.closest('.matriculation-dropdown');
        const list = dropdownDiv.querySelector('.matriculation-combo-list');
        const arrow = dropdownDiv.querySelector('.matriculation-combo-arrow');
        let portalList = null;

        function showList() {
            if (!portalList) {
                portalList = list.cloneNode(true);
                portalList.classList.add('matriculation-combo-list-portal');
                document.body.appendChild(portalList);
                portalList.style.position = 'fixed';
                portalList.style.zIndex = '99999';
                portalList.style.background = '#fff';
                portalList.style.border = '1px solid #bbb';
                portalList.style.borderRadius = '5px';
                portalList.style.boxShadow = '0 8px 32px rgba(0,0,0,0.18)';
                portalList.style.maxHeight = '120px';
                portalList.style.overflowY = 'auto';
                portalList.style.width = dropdownDiv.offsetWidth + 'px';

                const rect = input.getBoundingClientRect();
                portalList.style.left = rect.left + 'px';
                portalList.style.top = (rect.bottom + 2) + 'px';
                
                // Mobile adjustments for matriculation dropdown
                if (window.innerWidth <= 768) {
                    portalList.style.width = Math.min(dropdownDiv.offsetWidth, window.innerWidth - 20) + 'px';
                    if (rect.left + dropdownDiv.offsetWidth > window.innerWidth) {
                        portalList.style.left = (window.innerWidth - dropdownDiv.offsetWidth - 10) + 'px';
                    }
                }

                input.addEventListener('input', function() {
                    Array.from(portalList.children).forEach(function(item) {
                        item.style.display = item.textContent.toLowerCase().includes(input.value.toLowerCase()) ? '' : 'none';
                    });
                });

                Array.from(portalList.children).forEach(function(item) {
                    item.addEventListener('mousedown', function(e) {
                        e.preventDefault();
                        input.value = item.textContent;
                        hideList();
                        input.setAttribute('readonly', true);

                        // AJAX PATCH request to save matriculation
                        const studentId = input.getAttribute('data-student-id');
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        fetch(`/students/${studentId}/matriculation`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({ matriculation: item.textContent })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                input.value = data.matriculation;
                            }
                        });
                    });
                });
            }
            portalList.style.display = 'block';
            input.removeAttribute('readonly');
            input.focus();
        }

        function hideList() {
            if (portalList) portalList.style.display = 'none';
            input.setAttribute('readonly', true);
        }

        input.addEventListener('focus', showList);
        input.addEventListener('blur', function() { setTimeout(hideList, 150); });
        arrow.addEventListener('mousedown', function(e) {
            e.preventDefault();
            if (portalList && portalList.style.display === 'block') {
                hideList();
            } else {
                showList();
            }
        });
    });
    // Auto-hide success and error messages
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    
    if (successMessage) {
        setTimeout(function() {
            successMessage.style.opacity = '0';
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 500);
        }, 3000); // Hide after 3 seconds
    }
    
    if (errorMessage) {
        setTimeout(function() {
            errorMessage.style.opacity = '0';
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 500);
        }, 5000); // Hide after 5 seconds (longer for errors)
    }
});

// Print Function
function printStudentList() {
    const today = new Date();
    const formattedDate = today.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
    
    // Get current filter values
    const semesterFilter = Array.from(document.querySelectorAll('.filter-option[data-filter="semester"].selected')).map(el => el.dataset.value);
    const schoolYearFilter = Array.from(document.querySelectorAll('.filter-option[data-filter="school_year"].selected')).map(el => el.dataset.value);
    const courseFilter = Array.from(document.querySelectorAll('.filter-option[data-filter="course"].selected')).map(el => el.dataset.value);
    const yearFilter = Array.from(document.querySelectorAll('.filter-option[data-filter="year_level"].selected')).map(el => el.dataset.value);
    const officeFilter = Array.from(document.querySelectorAll('.filter-option[data-filter="office"].selected')).map(el => el.dataset.value);
    
    // Get visible table rows
    const visibleRows = Array.from(document.querySelectorAll('.student-table tbody tr')).filter(row => {
        return row.style.display !== 'none';
    });
    
    if (visibleRows.length === 0) {
        alert('No students to print. Please adjust your filters.');
        return;
    }
    
    // Build filter description
    let filterDesc = '';
    if (semesterFilter.length > 0 || schoolYearFilter.length > 0 || courseFilter.length > 0 || yearFilter.length > 0 || officeFilter.length > 0) {
        const filters = [];
        if (semesterFilter.length > 0) filters.push(semesterFilter.join(', '));
        if (schoolYearFilter.length > 0) filters.push(schoolYearFilter.join(', '));
        if (courseFilter.length > 0) filters.push(courseFilter.join(', '));
        if (yearFilter.length > 0) filters.push(yearFilter.join(', '));
        if (officeFilter.length > 0) filters.push(officeFilter.join(', '));
        filterDesc = filters.join(' - ');
    } else {
        filterDesc = 'All Students';
    }
    
    // Build table rows
    let tableRows = '';
    visibleRows.forEach((row, index) => {
        const cells = row.querySelectorAll('td');
        tableRows += `
            <tr>
                <td>${cells[1]?.textContent || ''}</td>
                <td>${cells[0]?.textContent || ''}</td>
                <td>${cells[3]?.textContent || ''}</td>
            </tr>
        `;
    });
    
    // Create print content
    const printContent = `
        <div id="printArea">
            <div class="print-header">
                <img src="/images/uddlogo.png" class="print-logo" alt="CDD Logo" onerror="this.style.display='none'">
                <div class="print-title-section">
                    <p class="print-university">UNIVERSIDAD DE DAGUPAN</p>
                    <p style="margin: 0; font-size: 12px;">(Formerly Colegio de Dagupan)</p>
                    <p class="print-office">Student Affairs Office</p>
                </div>
            </div>
            
            <div class="print-date">${formattedDate}</div>
            
            <div class="print-doc-title">University Scholarship</div>
            <div class="print-doc-subtitle">A.Y 2025-2026</div>
            
            <table class="print-table">
                <thead>
                    <tr>
                        <th>Program</th>
                        <th>Name</th>
                        <th>I.D. Number</th>
                    </tr>
                </thead>
                <tbody>
                    ${tableRows}
                </tbody>
            </table>
            
            <div class="print-footer">
                <div class="print-signature-section">
                    <div class="print-signature-line">DARYL SERAPION</div>
                    <div class="print-signature-title">Student Affairs Coordinator and<br>Scholarship Officer</div>
                    <div style="margin-top: 10px; font-size: 10px;">Recommending Approval:</div>
                </div>
                
                <div class="print-signature-section">
                    <div class="print-signature-line">MAY JACKLYN RADOC-SAMSON</div>
                    <div class="print-signature-title">Director, Student Affairs</div>
                    <div style="margin-top: 10px; font-size: 10px;">Noted by:</div>
                </div>
            </div>
            
            <div class="print-footer" style="margin-top: 30px;">
                <div class="print-signature-section">
                    <div class="print-signature-line">DR. JUSTIN Q. CALLESTO</div>
                    <div class="print-signature-title">Vice President For Administration and<br>Finance</div>
                </div>
                
                <div class="print-signature-section">
                    <div class="print-signature-line">MR. JANN ALFRED ARZADON QUINTO</div>
                    <div class="print-signature-title">Chief Operating Officer</div>
                </div>
            </div>
            
            <div style="margin-top: 30px; font-size: 10px; text-align: center;">
                Arellano Street, Dagupan City, Philippines 2400<br>
                (075) 522-2405 | 522-0143<br>
                cdsao@cdd.edu.ph<br>
                www.cdd.edu.ph
            </div>
        </div>
    `;
    
    // Insert print content into page (hidden by default)
    let printDiv = document.getElementById('printArea');
    if (!printDiv) {
        printDiv = document.createElement('div');
        printDiv.id = 'printArea';
        printDiv.style.display = 'none'; // Hide on screen
        document.body.appendChild(printDiv);
    }
    printDiv.innerHTML = printContent;
    
    // Trigger print
    window.print();
    
    // Clean up after print dialog closes
    setTimeout(() => {
        if (printDiv) {
            printDiv.remove();
        }
    }, 1000);
}
</script>
</div>
@endsection
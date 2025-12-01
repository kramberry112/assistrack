@extends('layouts.app')

@section('page-title')
    <i class="bi bi-award-fill" style="margin-right: 8px;"></i>
    Grades Report
@endsection

@section('content')
<style>
    /* Prevent horizontal scroll */
    * {
        box-sizing: border-box;
    }
    
    html, body {
        overflow-x: hidden;
        max-width: 100vw;
    }
    
    .content-wrapper {
        background: #fff !important;
    }
    .admin-content-wrapper {
        background: #fff !important;
    }
    
    /* Ensure containers don't overflow */
    .overflow-x-auto {
        max-width: 100%;
        overflow: auto;
    }
    
    /* Hide mobile cards by default */
    .mobile-grade-cards {
        display: none;
    }
    
    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        /* Container adjustments */
        div[style*="padding: 24px"] {
            padding: 8px !important;
            max-width: 100vw !important;
            overflow: hidden !important;
        }
        
        /* Hide table on mobile */
        .overflow-x-auto {
            display: none !important;
        }
        
        /* Show mobile cards instead */
        .mobile-grade-cards {
            display: block !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        .grade-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 100%;
            overflow: hidden;
        }
        
        .grade-card-header {
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .grade-card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 4px 0;
            word-wrap: break-word;
        }
        
        .grade-card-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .grade-detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px 0;
        }
        
        .grade-detail-label {
            font-size: 0.8rem;
            color: #6b7280;
            font-weight: 500;
            flex-shrink: 0;
        }
        
        .grade-detail-value {
            font-size: 0.85rem;
            color: #111827;
            font-weight: 600;
            text-align: right;
            word-wrap: break-word;
            max-width: 60%;
        }
        
        .mobile-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 16px;
            background: #6366f1;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            width: 100%;
            margin-top: 8px;
        }
        
        .mobile-action-btn:hover {
            background: #4f46e5;
            color: white;
        }
    }
    
    /* Ultra mobile (small phones) */
    @media (max-width: 480px) {
        div[style*="padding: 24px"] {
            padding: 4px !important;
        }
        
        .grade-card {
            padding: 12px !important;
            margin-bottom: 8px !important;
        }
        
        .grade-card-title {
            font-size: 0.9rem !important;
        }
        
        .grade-detail-label,
        .grade-detail-value {
            font-size: 0.75rem !important;
        }
        
        .mobile-action-btn {
            padding: 8px 12px !important;
            font-size: 0.8rem !important;
        }
        
        /* Success message adjustments */
        .bg-green-100 {
            margin: 0 4px 16px 4px !important;
            padding: 12px !important;
            font-size: 0.85rem !important;
        }
    }
</style>
<div style="padding: 24px; background: #fff; min-height: calc(100vh - 76px);">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-6" role="alert">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    @endif
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
                <thead style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <tr>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">
                            Student Name
                        </th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">
                            Year Level
                        </th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">
                            Semester
                        </th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">
                            Subjects
                        </th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 14px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.5px;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($grades as $grade)
                        <tr style="transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='#ffffff'">
                            <td style="padding: 16px 20px; color: #111827; font-weight: 500;">
                                {{ $grade->student_name }}
                            </td>
                            <td style="padding: 16px 20px; color: #6b7280;">
                                {{ $grade->year_level }}
                            </td>
                            <td style="padding: 16px 20px; color: #6b7280;">
                                {{ $grade->semester }}
                            </td>
                            <td style="padding: 16px 20px;">
                                @php
                                    $subjects = is_array($grade->subjects) ? $grade->subjects : (is_string($grade->subjects) ? json_decode($grade->subjects, true) : []);
                                    $subjectCount = is_array($subjects) ? count($subjects) : 0;
                                @endphp
                                <span style="display: inline-block; padding: 4px 12px; background: #dbeafe; color: #1e40af; border-radius: 20px; font-size: 13px; font-weight: 600;">
                                    {{ $subjectCount }} {{ $subjectCount === 1 ? 'Subject' : 'Subjects' }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px;">
                                <a href="{{ route('admin.grades.show', $grade->id) }}" 
                                       style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #6366f1; color: #ffffff; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; transition: all 0.2s ease;"
                                       onmouseover="this.style.backgroundColor='#4f46e5'"
                                       onmouseout="this.style.backgroundColor='#6366f1'">
                                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 48px 20px; text-align: center; color: #9ca3af;">
                                <svg style="width: 48px; height: 48px; margin: 0 auto 16px; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p style="font-size: 16px; font-weight: 500;">No grades records found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Mobile Cards View -->
        <div class="mobile-grade-cards">
            @forelse($grades as $grade)
                <div class="grade-card">
                    <div class="grade-card-header">
                        <h3 class="grade-card-title">{{ $grade->student_name }}</h3>
                    </div>
                    
                    <div class="grade-card-details">
                        <div class="grade-detail-item">
                            <span class="grade-detail-label">Year Level:</span>
                            <span class="grade-detail-value">{{ $grade->year_level }}</span>
                        </div>
                        
                        <div class="grade-detail-item">
                            <span class="grade-detail-label">Semester:</span>
                            <span class="grade-detail-value">{{ $grade->semester }}</span>
                        </div>
                        
                        <div class="grade-detail-item">
                            <span class="grade-detail-label">Subjects:</span>
                            <span class="grade-detail-value">
                                @php
                                    $subjects = is_array($grade->subjects) ? $grade->subjects : (is_string($grade->subjects) ? json_decode($grade->subjects, true) : []);
                                    $subjectCount = is_array($subjects) ? count($subjects) : 0;
                                @endphp
                                <span style="display: inline-block; padding: 4px 12px; background: #dbeafe; color: #1e40af; border-radius: 20px; font-size: 13px; font-weight: 600;">
                                    {{ $subjectCount }} {{ $subjectCount === 1 ? 'Subject' : 'Subjects' }}
                                </span>
                            </span>
                        </div>
                        
                        <a href="{{ route('admin.grades.show', $grade->id) }}" class="mobile-action-btn">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Details
                        </a>
                    </div>
                </div>
            @empty
                <div class="grade-card">
                    <div style="text-align: center; padding: 24px;">
                        <svg style="width: 48px; height: 48px; margin: 0 auto 16px; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p style="font-size: 16px; font-weight: 500; color: #9ca3af; margin: 0;">No grades records found</p>
                    </div>
                </div>
            @endforelse
        </div>
</div>
@endsection
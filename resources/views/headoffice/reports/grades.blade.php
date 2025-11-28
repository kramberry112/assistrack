@extends('layouts.app')

@section('page-title')
    <i class="bi bi-award-fill" style="margin-right: 8px;"></i>
    Grades Report
@endsection

@section('content')
<style>
    .content-wrapper {
        background: #fff !important;
    }
    
    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        /* Container adjustments */
        div[style*="padding: 24px"] {
            padding: 16px !important;
        }
        
        /* Success alert mobile */
        .bg-green-100 {
            margin-bottom: 16px !important;
            padding: 12px 16px !important;
            border-radius: 8px !important;
        }
        
        /* Hide table on mobile */
        .overflow-x-auto table {
            display: none;
        }
        
        /* Show mobile cards instead */
        .mobile-grades-cards {
            display: block !important;
        }
        
        .grades-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        
        .grades-card-header {
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .grades-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 8px 0;
        }
        
        .grades-card-subtitle {
            font-size: 0.9rem;
            color: #6b7280;
            margin: 0;
        }
        
        .grades-card-details {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .grades-detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .grades-detail-label {
            font-size: 0.9rem;
            color: #6b7280;
            font-weight: 500;
        }
        
        .grades-detail-value {
            font-size: 0.9rem;
            color: #111827;
            font-weight: 600;
        }
        
        .grades-actions {
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid #f3f4f6;
        }
        
        .grades-action-button {
            width: 100% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            padding: 12px 16px !important;
            font-size: 0.9rem !important;
        }
    }
    
    @media (max-width: 480px) {
        div[style*="padding: 24px"] {
            padding: 12px !important;
        }
        
        .grades-card {
            padding: 16px !important;
        }
        
        .grades-card-title {
            font-size: 1rem !important;
        }
    }
    
    /* Desktop - hide mobile cards */
    .mobile-grades-cards {
        display: none;
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
                                <a href="{{ route('head.grades.show', $grade->id) }}" 
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
        
        <!-- Mobile Card View -->
        <div class="mobile-grades-cards">
            @forelse($grades as $grade)
                <div class="grades-card">
                    <div class="grades-card-header">
                        <h3 class="grades-card-title">{{ $grade->student_name }}</h3>
                        <p class="grades-card-subtitle">{{ $grade->year_level }} • {{ $grade->semester }}</p>
                    </div>
                    <div class="grades-card-details">
                        <div class="grades-detail-item">
                            <span class="grades-detail-label">Subjects</span>
                            <span class="grades-detail-value">
                                @php
                                    $subjects = is_array($grade->subjects) ? $grade->subjects : (is_string($grade->subjects) ? json_decode($grade->subjects, true) : []);
                                    $subjectCount = is_array($subjects) ? count($subjects) : 0;
                                @endphp
                                <span style="display: inline-block; padding: 4px 12px; background: #dbeafe; color: #1e40af; border-radius: 20px; font-size: 13px; font-weight: 600;">
                                    {{ $subjectCount }} {{ $subjectCount === 1 ? 'Subject' : 'Subjects' }}
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="grades-actions">
                        <a href="{{ route('head.grades.show', $grade->id) }}" 
                           class="grades-action-button" 
                           style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 8px; padding: 10px 20px; display: inline-flex; align-items: center; gap: 8px; font-weight: 500; transition: all 0.2s ease;">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                            </svg>
                            View Details
                        </a>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 40px 20px; color: #6b7280;">
                    <div style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;">📊</div>
                    <div>No grades found in the system</div>
                </div>
            @endforelse
        </div>
</div>
@endsection
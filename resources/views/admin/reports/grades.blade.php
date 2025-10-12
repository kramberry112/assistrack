@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" style="max-width: 1200px;">
    <h1 class="text-3xl font-bold mb-6" style="color: #111827;">Grades Report</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-6" role="alert">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    @endif
    
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
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
                            Proof
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
                                @if($grade->proof_url)
                                    <a href="{{ asset('storage/' . $grade->proof_url) }}" 
                                       target="_blank" 
                                       style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #10b981; color: #ffffff; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; transition: all 0.2s ease;"
                                       onmouseover="this.style.backgroundColor='#059669'"
                                       onmouseout="this.style.backgroundColor='#10b981'">
                                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </a>
                                @else
                                    <span style="color: #9ca3af; font-size: 14px; font-style: italic;">No file uploaded</span>
                                @endif
                            </td>
                            <td style="padding: 16px 20px;">
                                    <a href="{{ route('admin.grades.show', $grade->id) }}" 
                                   style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #6366f1; color: #ffffff; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; transition: all 0.2s ease;"
                                   onmouseover="this.style.backgroundColor='#4f46e5'"
                                   onmouseout="this.style.backgroundColor='#6366f1'">
                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 48px 20px; text-align: center; color: #9ca3af;">
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
    </div>
</div>
@endsection
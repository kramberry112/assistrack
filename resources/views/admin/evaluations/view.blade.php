@extends('layouts.app')

@section('content')
<style>
    .evaluation-detail-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 24px;
    }
    
    .student-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 24px;
        border-radius: 12px;
        margin-bottom: 24px;
    }
    
    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid #667eea;
    }
    
    .rating-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }
    
    .rating-item {
        background: #f8f9fa;
        padding: 16px;
        border-radius: 8px;
        border-left: 4px solid #667eea;
    }
    
    .rating-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 4px;
    }
    
    .rating-value {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .rating-score {
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 12px;
    }
    
    .score-1 { background: #fee2e2; color: #dc2626; }
    .score-2 { background: #fed7aa; color: #ea580c; }
    .score-3 { background: #fef3c7; color: #d97706; }
    .score-4 { background: #dcfce7; color: #16a34a; }
    .score-5 { background: #dbeafe; color: #2563eb; }
    .score-na { background: #f3f4f6; color: #6b7280; }
    
    .comments-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #667eea;
    }
    
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: #667eea;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
        margin-bottom: 24px;
    }
    
    .back-button:hover {
        background: #5b6ae6;
        color: white;
        text-decoration: none;
    }
</style>

<a href="{{ route('admin.evaluations.index') }}" class="back-button">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
    </svg>
    Back to Evaluations
</a>

<div class="evaluation-detail-card">
    <!-- Student Information -->
    <div class="student-info">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h1 class="text-2xl font-bold mb-2">
                    {{ $evaluation->student->student_name ?? 'N/A' }}
                </h1>
                <p class="text-lg opacity-90">Student ID: {{ $evaluation->student->id_number ?? 'N/A' }}</p>
            </div>
            <div class="text-right">
                <p class="text-lg opacity-90">Department: {{ $evaluation->department }}</p>
                <p class="text-sm opacity-80">Evaluated by: {{ $evaluation->evaluator->name ?? 'Unknown' }}</p>
                <p class="text-sm opacity-80">Submitted: {{ $evaluation->submitted_at->format('M d, Y - h:i A') }}</p>
                <p class="text-lg font-bold mt-2">Average Rating: {{ $evaluation->average_rating }}/5</p>
            </div>
        </div>
    </div>

    <!-- Work Skills Section -->
    <div class="section-title">💼 Work Skills</div>
    <div class="rating-grid">
        <div class="rating-item">
            <div class="rating-name">Problem Solving & Critical Thinking</div>
            <div class="rating-value">
                @if($evaluation->problem_solving)
                    <span class="rating-score score-{{ $evaluation->problem_solving }}">{{ $evaluation->problem_solving }}/5</span>
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
        
        <div class="rating-item">
            <div class="rating-name">Writing Skills</div>
            <div class="rating-value">
                @if($evaluation->writing_skills)
                    <span class="rating-score score-{{ $evaluation->writing_skills }}">{{ $evaluation->writing_skills }}/5</span>
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
        
        <div class="rating-item">
            <div class="rating-name">Oral Communication Skills</div>
            <div class="rating-value">
                @if($evaluation->oral_communication)
                    <span class="rating-score score-{{ $evaluation->oral_communication }}">{{ $evaluation->oral_communication }}/5</span>
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
        
        <div class="rating-item">
            <div class="rating-name">Adaptability</div>
            <div class="rating-value">
                @if($evaluation->adaptability)
                    <span class="rating-score score-{{ $evaluation->adaptability }}">{{ $evaluation->adaptability }}/5</span>
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
        
        <div class="rating-item">
            <div class="rating-name">Service</div>
            <div class="rating-value">
                @if($evaluation->service)
                    <span class="rating-score score-{{ $evaluation->service }}">{{ $evaluation->service }}/5</span>
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
        
        <div class="rating-item">
            <div class="rating-name">Attention to Detail</div>
            <div class="rating-value">
                @if($evaluation->attention_to_detail)
                    <span class="rating-score score-{{ $evaluation->attention_to_detail }}">{{ $evaluation->attention_to_detail }}/5</span>
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
        
        <div class="rating-item">
            <div class="rating-name">Attitude</div>
            <div class="rating-value">
                @if($evaluation->attitude)
                    <span class="rating-score score-{{ $evaluation->attitude }}">{{ $evaluation->attitude }}/5</span>
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Work Attributes Section -->
    <div class="section-title">⭐ Work Attributes</div>
    <div class="rating-grid">
        <div class="rating-item">
            <div class="rating-name">Interpersonal Communication</div>
            <div class="rating-value">
                @if($evaluation->interpersonal_communication)
                    @if($evaluation->interpersonal_communication == 'N/A')
                        <span class="rating-score score-na">N/A</span>
                    @else
                        <span class="rating-score score-{{ $evaluation->interpersonal_communication }}">{{ $evaluation->interpersonal_communication }}/5</span>
                    @endif
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
        
        <div class="rating-item">
            <div class="rating-name">Creativity</div>
            <div class="rating-value">
                @if($evaluation->creativity)
                    @if($evaluation->creativity == 'N/A')
                        <span class="rating-score score-na">N/A</span>
                    @else
                        <span class="rating-score score-{{ $evaluation->creativity }}">{{ $evaluation->creativity }}/5</span>
                    @endif
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
        
        <div class="rating-item">
            <div class="rating-name">Confidentiality</div>
            <div class="rating-value">
                @if($evaluation->confidentiality)
                    @if($evaluation->confidentiality == 'N/A')
                        <span class="rating-score score-na">N/A</span>
                    @else
                        <span class="rating-score score-{{ $evaluation->confidentiality }}">{{ $evaluation->confidentiality }}/5</span>
                    @endif
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
        
        <div class="rating-item">
            <div class="rating-name">Initiative</div>
            <div class="rating-value">
                @if($evaluation->initiative)
                    @if($evaluation->initiative == 'N/A')
                        <span class="rating-score score-na">N/A</span>
                    @else
                        <span class="rating-score score-{{ $evaluation->initiative }}">{{ $evaluation->initiative }}/5</span>
                    @endif
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
        
        <div class="rating-item">
            <div class="rating-name">Teamwork</div>
            <div class="rating-value">
                @if($evaluation->teamwork)
                    @if($evaluation->teamwork == 'N/A')
                        <span class="rating-score score-na">N/A</span>
                    @else
                        <span class="rating-score score-{{ $evaluation->teamwork }}">{{ $evaluation->teamwork }}/5</span>
                    @endif
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
        
        <div class="rating-item">
            <div class="rating-name">Dependability</div>
            <div class="rating-value">
                @if($evaluation->dependability)
                    @if($evaluation->dependability == 'N/A')
                        <span class="rating-score score-na">N/A</span>
                    @else
                        <span class="rating-score score-{{ $evaluation->dependability }}">{{ $evaluation->dependability }}/5</span>
                    @endif
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
        
        <div class="rating-item">
            <div class="rating-name">Punctuality</div>
            <div class="rating-value">
                @if($evaluation->punctuality)
                    @if($evaluation->punctuality == 'N/A')
                        <span class="rating-score score-na">N/A</span>
                    @else
                        <span class="rating-score score-{{ $evaluation->punctuality }}">{{ $evaluation->punctuality }}/5</span>
                    @endif
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
        
        <div class="rating-item">
            <div class="rating-name">Making Use of Time Wisely</div>
            <div class="rating-value">
                @if($evaluation->making_use_of_time_wisely)
                    @if($evaluation->making_use_of_time_wisely == 'N/A')
                        <span class="rating-score score-na">N/A</span>
                    @else
                        <span class="rating-score score-{{ $evaluation->making_use_of_time_wisely }}">{{ $evaluation->making_use_of_time_wisely }}/5</span>
                    @endif
                @else
                    <span class="rating-score score-na">Not Rated</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    @if($evaluation->overall_comments)
        <div class="section-title">💬 Additional Comments</div>
        <div class="comments-section">
            <p style="margin: 0; line-height: 1.6;">{{ $evaluation->overall_comments }}</p>
        </div>
    @endif
</div>
@endsection
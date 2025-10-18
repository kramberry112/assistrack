<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Details - AssisTrack Head Office</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            color: #334155;
            line-height: 1.6;
        }
        
        .header {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .header-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
        }
        
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: #6366f1;
            color: white;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .back-btn:hover {
            background: #4f46e5;
            color: white;
            text-decoration: none;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .evaluation-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .student-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }
        
        .student-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #667eea;
        }
        
        .rating-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .rating-item {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        
        .rating-name {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }
        
        .rating-score {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .score-1 { background: #fee2e2; color: #dc2626; }
        .score-2 { background: #fed7aa; color: #ea580c; }
        .score-3 { background: #fef3c7; color: #d97706; }
        .score-4 { background: #dcfce7; color: #16a34a; }
        .score-5 { background: #dbeafe; color: #2563eb; }
        .score-na { background: #f3f4f6; color: #6b7280; }
        
        .comments-section {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        
        @media (max-width: 768px) {
            .header-content {
                padding: 0 1rem;
                flex-direction: column;
                gap: 1rem;
            }
            
            .container {
                padding: 1rem;
            }
            
            .student-grid {
                grid-template-columns: 1fr;
            }
            
            .rating-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media print {
            .header {
                display: none;
            }
            
            body {
                background: white;
            }
            
            .evaluation-card {
                box-shadow: none;
                border: 1px solid #e2e8f0;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1 class="header-title">
                <i class="bi bi-graph-up-arrow"></i>
                Evaluation Details - Head Office
            </h1>
            <a href="{{ route('head.reports.evaluation') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i>
                Back to Evaluations
            </a>
        </div>
    </header>

    <div class="container">
        <div class="evaluation-card">
            <!-- Student Information -->
            <div class="student-info">
                <div class="student-grid">
                    <div>
                        <h2 style="font-size: 2rem; font-weight: bold; margin-bottom: 0.5rem;">
                            {{ $evaluation->student->student_name ?? 'N/A' }}
                        </h2>
                        <p style="font-size: 1.125rem; opacity: 0.9;">Student ID: {{ $evaluation->student->id_number ?? 'N/A' }}</p>
                    </div>
                    <div style="text-align: right;">
                        <p style="font-size: 1.125rem; opacity: 0.9;">Department: {{ $evaluation->department }}</p>
                        <p style="font-size: 0.875rem; opacity: 0.8;">Evaluated by: {{ $evaluation->evaluator->name ?? 'Unknown' }}</p>
                        <p style="font-size: 0.875rem; opacity: 0.8;">Submitted: {{ $evaluation->submitted_at->format('M d, Y - h:i A') }}</p>
                        <p style="font-size: 1.125rem; font-weight: bold; margin-top: 0.5rem;">Average Rating: {{ $evaluation->average_rating }}/5</p>
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
    </div>
</body>
</html>
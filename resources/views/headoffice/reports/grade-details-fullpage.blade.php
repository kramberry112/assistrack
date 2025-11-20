<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Details - AssisTrack Head Office</title>
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
        
        .grade-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .student-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
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
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .grades-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .grades-table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .grades-table th {
            padding: 1rem 1.25rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.875rem;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .grades-table tbody tr {
            border-bottom: 1px solid #e2e8f0;
            transition: background-color 0.2s ease;
        }
        
        .grades-table tbody tr:hover {
            background-color: #f8fafc;
        }
        
        .grades-table tbody tr:last-child {
            border-bottom: none;
        }
        
        .grades-table td {
            padding: 1rem 1.25rem;
            color: #334155;
        }
        
        .grade-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: #dbeafe;
            color: #1e40af;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .proof-section {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid #667eea;
            margin-bottom: 2rem;
        }
        
        .proof-link {
            color: #6366f1;
            text-decoration: underline;
            font-weight: 500;
        }
        
        .proof-link:hover {
            color: #4f46e5;
        }
        
        .actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background: #6366f1;
            color: white;
        }
        
        .btn-primary:hover {
            background: #4f46e5;
            color: white;
            text-decoration: none;
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
            
            .student-info {
                grid-template-columns: 1fr;
            }
            
            .grades-table {
                font-size: 0.875rem;
            }
            
            .grades-table th,
            .grades-table td {
                padding: 0.75rem 0.5rem;
            }
            
            .actions {
                flex-direction: column;
            }
        }
        
        @media print {
            /* Hide screen-only elements */
            .header {
                display: none !important;
            }
            
            .actions {
                display: none !important;
            }
            
            .proof-section {
                display: none !important;
            }
            
            /* Clean white background for coupon-like appearance */
            body {
                background: white !important;
                color: black !important;
                font-family: 'Times New Roman', serif !important;
                font-size: 12pt !important;
                line-height: 1.4 !important;
                margin: 0 !important;
                padding: 20px !important;
            }
            
            .container {
                max-width: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            
            /* Simple card styling for print */
            .grade-card {
                background: white !important;
                box-shadow: none !important;
                border: 2px solid black !important;
                border-radius: 0 !important;
                padding: 30px !important;
                margin: 0 !important;
                page-break-inside: avoid;
            }
            
            /* Student info section - simple header */
            .student-info {
                background: white !important;
                color: black !important;
                padding: 20px 0 !important;
                border-radius: 0 !important;
                margin-bottom: 30px !important;
                border-bottom: 2px solid black !important;
                display: block !important;
                text-align: center !important;
            }
            
            .student-info h2 {
                font-size: 18pt !important;
                font-weight: bold !important;
                margin-bottom: 10px !important;
                color: black !important;
                text-transform: uppercase !important;
                letter-spacing: 1px !important;
            }
            
            .student-info p {
                font-size: 12pt !important;
                margin: 5px 0 !important;
                color: black !important;
            }
            
            /* Section titles - simple and clean */
            .section-title {
                font-size: 14pt !important;
                font-weight: bold !important;
                color: black !important;
                margin: 20px 0 10px 0 !important;
                padding: 10px 0 5px 0 !important;
                border-bottom: 1px solid black !important;
                text-transform: uppercase !important;
                letter-spacing: 0.5px !important;
            }
            
            .section-title i {
                display: none !important;
            }
            
            /* Table styling - clean and simple */
            .grades-table {
                width: 100% !important;
                border-collapse: collapse !important;
                margin: 20px 0 !important;
                background: white !important;
            }
            
            .grades-table th {
                background: white !important;
                color: black !important;
                border: 2px solid black !important;
                padding: 12px 8px !important;
                text-align: left !important;
                font-weight: bold !important;
                font-size: 11pt !important;
                text-transform: uppercase !important;
            }
            
            .grades-table td {
                border: 1px solid black !important;
                padding: 10px 8px !important;
                color: black !important;
                background: white !important;
                font-size: 11pt !important;
                vertical-align: top !important;
            }
            
            .grades-table tbody tr:hover {
                background: white !important;
            }
            
            /* Grade badges - simple text */
            .grade-badge {
                background: white !important;
                color: black !important;
                border: 1px solid black !important;
                padding: 3px 8px !important;
                border-radius: 0 !important;
                font-weight: bold !important;
                font-size: 11pt !important;
            }
            
            /* Add page header */
            @page {
                margin: 2cm;
                @top-center {
                    content: "GRADE REPORT - ASSISTRACK PORTAL";
                    font-size: 10pt;
                    font-weight: bold;
                }
                @bottom-center {
                    content: "Page " counter(page) " of " counter(pages);
                    font-size: 9pt;
                }
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1 class="header-title">
                <i class="bi bi-award-fill"></i>
                Grade Details - Head Office
            </h1>
            <a href="{{ route('head.reports.grades') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i>
                Back to Grades List
            </a>
        </div>
    </header>

    <div class="container">
        <div class="grade-card">
            <!-- Student Information -->
            <div class="student-info">
                <div>
                    <h2 style="font-size: 2rem; font-weight: bold; margin-bottom: 0.5rem;">
                        {{ $grade->student_name }}
                    </h2>
                    <p style="font-size: 1.125rem; opacity: 0.9;">Year Level: {{ $grade->year_level }}</p>
                </div>
                <div style="text-align: right;">
                    <p style="font-size: 1.125rem; opacity: 0.9;">Semester: {{ $grade->semester }}</p>
                    <p style="font-size: 0.875rem; opacity: 0.8;">Submitted: {{ $grade->created_at->format('M d, Y - h:i A') }}</p>
                </div>
            </div>

            <!-- Subjects & Grades Section -->
            <div class="section-title">
                <i class="bi bi-journal-text"></i>
                Subjects & Grades
            </div>
            
            <div style="overflow-x: auto; margin-bottom: 2rem;">
                <table class="grades-table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grade->subjects as $subject)
                            <tr>
                                <td style="font-weight: 500; color: #1e293b;">{{ $subject['subject'] }}</td>
                                <td>
                                    <span class="grade-badge">{{ $subject['grade'] }}</span>
                                </td>
                                <td style="color: #64748b;">{{ $subject['remarks'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Documents Section -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <!-- Grade Proof Document -->
                <div class="proof-section">
                    <div class="section-title" style="margin-bottom: 0.5rem; border: none; padding: 0;">
                        <i class="bi bi-file-earmark-text"></i>
                        Grade Proof Document
                    </div>
                    @if ($grade->proof_url)
                        <a href="{{ asset('storage/' . $grade->proof_url) }}" target="_blank" class="proof-link">
                            <i class="bi bi-eye"></i>
                            View Proof File
                        </a>
                    @else
                        <p style="color: #64748b; font-style: italic; margin: 0;">No proof document uploaded</p>
                    @endif
                </div>
                
                <!-- Class Schedule -->
                <div class="proof-section">
                    <div class="section-title" style="margin-bottom: 0.5rem; border: none; padding: 0;">
                        <i class="bi bi-calendar-week"></i>
                        Class Schedule
                    </div>
                    @if ($grade->schedule_url)
                        <a href="{{ asset('storage/' . $grade->schedule_url) }}" target="_blank" class="proof-link">
                            <i class="bi bi-eye"></i>
                            View Schedule File
                        </a>
                    @else
                        <p style="color: #64748b; font-style: italic; margin: 0;">No schedule uploaded</p>
                    @endif
                </div>
            </div>
            
            <div class="actions">
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="bi bi-printer"></i>
                    Print Report
                </button>
            </div>
        </div>
    </div>
</body>
</html>
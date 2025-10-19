<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Assistant Account Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 8px 8px;
            border: 1px solid #e9ecef;
        }
        .congratulations {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
        .info-box {
            background-color: white;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 20px;
            margin: 15px 0;
        }
        .info-label {
            font-weight: bold;
            color: #495057;
            margin-bottom: 5px;
        }
        .info-value {
            background-color: #e9ecef;
            padding: 8px 12px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            border-left: 4px solid #007bff;
        }
        .office-info {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .security-note {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">AssisTrack</div>
        <div>Universidad de Dagupan</div>
        <div>Student Assistant Management System</div>
    </div>
    
    <div class="content">
        <div class="congratulations">
            🎉 Congratulations! You are now a Student Assistant! 🎉
        </div>
        
        <p>Dear {{ $student->student_name }},</p>
        
        <p>We are delighted to inform you that your application has been approved, and you have been officially selected as a Student Assistant at Universidad de Dagupan!</p>
        
        @if($student->designated_office)
        <div class="office-info">
            <div class="info-label">🏢 Your Designated Office:</div>
            <div style="font-size: 18px; font-weight: bold; color: #856404; margin-top: 5px;">
                {{ $student->designated_office }}
            </div>
        </div>
        @endif
        
        <p>Your student account has been created with the following credentials:</p>
        
        <div class="info-box">
            <div class="info-label">📧 Email Address:</div>
            <div class="info-value">{{ $studentEmail }}</div>
        </div>
        
        <div class="info-box">
            <div class="info-label">👤 Username:</div>
            <div class="info-value">{{ $username }}</div>
        </div>
        
        <div class="info-box">
            <div class="info-label">🔑 Password:</div>
            <div class="info-value">{{ $password }}</div>
        </div>
        
        <div class="security-note">
            <strong>Security Notice:</strong> For your security, please change your password after your first login. Keep your login credentials confidential and do not share them with anyone.
        </div>
        
        <p>You can now access the AssisTrack system to:</p>
        <ul>
            <li>View and manage your assigned tasks</li>
            <li>Track your attendance</li>
            <li>Submit progress reports</li>
            <li>Communicate with your office supervisors</li>
            <li>Access important announcements and updates</li>
        </ul>
        
        <p>If you have any questions or need assistance getting started, please don't hesitate to contact your designated office or the system administrator.</p>
        
        <p>Welcome to the Student Assistant program! We look forward to working with you.</p>
        
        <p>Best regards,<br>
        <strong>The AssisTrack Team</strong><br>
        Universidad de Dagupan</p>
    </div>
    
    <div class="footer">
        <p>This is an automated message from AssisTrack System.<br>
        Please do not reply to this email.</p>
        <p>© {{ date('Y') }} Universidad de Dagupan. All rights reserved.</p>
    </div>
</body>
</html>
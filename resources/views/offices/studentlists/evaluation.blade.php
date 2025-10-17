@extends('layouts.app')

@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 950px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 48px 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .header p {
            font-size: 1rem;
            opacity: 0.95;
            line-height: 1.6;
        }

        .content {
            padding: 48px 40px;
        }

        .rating-scale {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 24px;
            border-radius: 8px;
            margin-bottom: 40px;
        }

        .rating-scale h3 {
            font-size: 0.95rem;
            color: #333;
            margin-bottom: 16px;
            font-weight: 600;
        }

        .scale-items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 12px;
        }

        .scale-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
            color: #555;
        }

        .scale-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #fff;
            flex-shrink: 0;
        }

        .badge-1 { background: #ef4444; }
        .badge-2 { background: #f97316; }
        .badge-3 { background: #eab308; }
        .badge-4 { background: #22c55e; }
        .badge-5 { background: #06b6d4; }

        .section {
            margin-bottom: 48px;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 2px solid #667eea;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .skill-row {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 16px;
            transition: all 0.3s ease;
        }

        .skill-row:hover {
            border-color: #667eea;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.12);
            transform: translateY(-2px);
        }

        .skill-header {
            margin-bottom: 16px;
        }

        .skill-name {
            font-size: 1.05rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 6px;
        }

        .skill-desc {
            font-size: 0.9rem;
            color: #6b7280;
            line-height: 1.5;
        }

        .rating-options {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .rating-btn {
            flex: 1;
            min-width: 60px;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            background: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
        }

        .rating-btn:hover {
            border-color: #667eea;
            background: #f0f4ff;
        }

        .rating-btn.active {
            background: #667eea;
            color: #fff;
            border-color: #667eea;
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.3);
        }

        .rating-btn.active-1 { background: #ef4444; border-color: #ef4444; color: #fff; }
        .rating-btn.active-2 { background: #f97316; border-color: #f97316; color: #fff; }
        .rating-btn.active-3 { background: #eab308; border-color: #eab308; color: #333; }
        .rating-btn.active-4 { background: #22c55e; border-color: #22c55e; color: #fff; }
        .rating-btn.active-5 { background: #06b6d4; border-color: #06b6d4; color: #fff; }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.2s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: none;
            padding: 16px 48px;
            font-size: 1.05rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(102, 126, 234, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .header {
                padding: 32px 24px;
            }

            .header h1 {
                font-size: 1.8rem;
            }

            .content {
                padding: 32px 24px;
            }

            .rating-options {
                gap: 8px;
            }

            .rating-btn {
                min-width: 50px;
                padding: 10px 8px;
                font-size: 0.85rem;
            }

            .scale-items {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <div class="container">
        <div class="header">
            <h1>Student Assistant Evaluation</h1>
            <p>The intent of this evaluation is to provide students with feedback they can use to further develop and enhance their skills and abilities.
                Your feedback on his/her service delivery will help objectively evaluate his/her over-all performance. Please be fair and objective in rating. Use the rating scale below by checking the box that most objectively represents his/her level of performance:
            </p>
        </div>

        <div class="content">
            <!-- Rating Scale Legend -->
            <div class="rating-scale">
                <h3>📊 Rating Scale</h3>
                <div class="scale-items">
                    <div class="scale-item">
                        <span class="scale-badge badge-1">1</span>
                        <span><strong>Unsatisfactory</strong> — Fails to meet minimal requirements</span>
                    </div>
                    <div class="scale-item">
                        <span class="scale-badge badge-2">2</span>
                        <span><strong>Development Needed</strong> — Meets requirements inconsistently</span>
                    </div>
                    <div class="scale-item">
                        <span class="scale-badge badge-3">3</span>
                        <span><strong>Satisfactory</strong> — Meets general expectations</span>
                    </div>
                    <div class="scale-item">
                        <span class="scale-badge badge-4">4</span>
                        <span><strong>Above Average</strong> — Often exceeds requirements</span>
                    </div>
                    <div class="scale-item">
                        <span class="scale-badge badge-5">5</span>
                        <span><strong>Excellent</strong> — Consistently exceeds requirements</span>
                    </div>
                </div>
            </div>

            <form id="evaluationForm">
                <!-- Work Skills Section -->
                <div class="section">
                    <div class="section-title">
                        <span class="section-icon">💼</span>
                        Work Skills
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Problem Solving & Critical Thinking</div>
                            <div class="skill-desc">Ability to evaluate situations objectively and decide on appropriate solutions</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'problem_solving', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'problem_solving', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'problem_solving', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'problem_solving', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'problem_solving', 5)">5</button>
                        </div>
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Writing Skills</div>
                            <div class="skill-desc">Ability to communicate effectively in writing with proper grammar and structure</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'writing_skills', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'writing_skills', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'writing_skills', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'writing_skills', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'writing_skills', 5)">5</button>
                        </div>
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Oral Communication Skills</div>
                            <div class="skill-desc">Ability to communicate effectively verbally</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'oral_communication', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'oral_communication', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'oral_communication', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'oral_communication', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'oral_communication', 5)">5</button>
                        </div>
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Adaptability</div>
                            <div class="skill-desc">Adjusts to new situations and technologies with flexibility and positive attitude</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'adaptability', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'adaptability', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'adaptability', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'adaptability', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'adaptability', 5)">5</button>
                        </div>
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Service</div>
                            <div class="skill-desc">Assists visitors and students in a friendly and professional manner</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'service', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'service', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'service', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'service', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'service', 5)">5</button>
                        </div>
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Attention to Detail</div>
                            <div class="skill-desc">Completes tasks with few errors while meeting established standards</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'attention_to_detail', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'attention_to_detail', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'attention_to_detail', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'attention_to_detail', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'attention_to_detail', 5)">5</button>
                        </div>
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Attitude</div>
                            <div class="skill-desc">Maintains professional and courteous demeanor</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'attitude', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'attitude', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'attitude', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'attitude', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'attitude', 5)">5</button>
                        </div>
                    </div>
                </div>

                <!-- Work Attributes Section -->
                <div class="section">
                    <div class="section-title">
                        <span class="section-icon">⭐</span>
                        Work Attributes
                    </div>

                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" id="department" name="department" placeholder="Enter department name">
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Interpersonal Communication</div>
                            <div class="skill-desc">Gets along with others, sensitivity to cultural backgrounds, asks for clarification</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'interpersonal_communication', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'interpersonal_communication', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'interpersonal_communication', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'interpersonal_communication', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'interpersonal_communication', 5)">5</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'interpersonal_communication', 'N/A')">N/A</button>
                        </div>
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Creativity</div>
                            <div class="skill-desc">Invents, develops, and implements new ideas with originality</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'creativity', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'creativity', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'creativity', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'creativity', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'creativity', 5)">5</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'creativity', 'N/A')">N/A</button>
                        </div>
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Confidentiality</div>
                            <div class="skill-desc">Respects privacy and follows office confidentiality guidelines</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'confidentiality', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'confidentiality', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'confidentiality', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'confidentiality', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'confidentiality', 5)">5</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'confidentiality', 'N/A')">N/A</button>
                        </div>
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Initiative</div>
                            <div class="skill-desc">Seeks work independently or asks supervisor for new tasks</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'initiative', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'initiative', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'initiative', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'initiative', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'initiative', 5)">5</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'initiative', 'N/A')">N/A</button>
                        </div>
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Teamwork</div>
                            <div class="skill-desc">Cooperates with team members and works toward common goals</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'teamwork', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'teamwork', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'teamwork', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'teamwork', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'teamwork', 5)">5</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'teamwork', 'N/A')">N/A</button>
                        </div>
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Dependability</div>
                            <div class="skill-desc">Attends work on schedule and communicates in advance when unavailable</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'dependability', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'dependability', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'dependability', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'dependability', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'dependability', 5)">5</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'dependability', 'N/A')">N/A</button>
                        </div>
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Punctuality</div>
                            <div class="skill-desc">Arrives on time for work and scheduled commitments</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'punctuality', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'punctuality', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'punctuality', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'punctuality', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'punctuality', 5)">5</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'punctuality', 'N/A')">N/A</button>
                        </div>
                    </div>

                    <div class="skill-row">
                        <div class="skill-header">
                            <div class="skill-name">Making Use of Time Wisely</div>
                            <div class="skill-desc">Uses time productively without personal use of campus facilities</div>
                        </div>
                        <div class="rating-options">
                            <button type="button" class="rating-btn" onclick="setRating(this, 'making_use_of_time_wisely', 1)">1</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'making_use_of_time_wisely', 2)">2</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'making_use_of_time_wisely', 3)">3</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'making_use_of_time_wisely', 4)">4</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'making_use_of_time_wisely', 5)">5</button>
                            <button type="button" class="rating-btn" onclick="setRating(this, 'making_use_of_time_wisely', 'N/A')">N/A</button>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="section">
                    <div class="section-title">
                        <span class="section-icon">💬</span>
                        Additional Comments
                    </div>

                    <div class="form-group">
                        <label for="overall_comments">Overall Rating & General Comments</label>
                        <textarea id="overall_comments" name="overall_comments" placeholder="Provide constructive feedback and observations..."></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">Submit Evaluation</button>
            </form>
        </div>
    </div>

    <script>
        const ratings = {};

        function setRating(button, field, value) {
            // Remove active class from all buttons in this group
            const parent = button.parentElement;
            parent.querySelectorAll('.rating-btn').forEach(btn => {
                btn.classList.remove('active', 'active-1', 'active-2', 'active-3', 'active-4', 'active-5');
            });

            // Add active class to clicked button
            button.classList.add('active');
            if (value !== 'N/A') {
                button.classList.add(`active-${value}`);
            }

            // Store rating
            ratings[field] = value;
        }

        document.getElementById('evaluationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                ...ratings,
                department: document.getElementById('department').value,
                overall_comments: document.getElementById('overall_comments').value,
                _token: '{{ csrf_token() }}'
            };

            fetch('{{ route("evaluation.submit", $student->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Evaluation submitted successfully!');
                    window.location.href = '{{ route("offices.studentlists.index") }}';
                } else {
                    alert('Error submitting evaluation. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error submitting evaluation. Please try again.');
            });
        });
    </script>
@endsection
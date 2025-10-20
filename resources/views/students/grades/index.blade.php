@extends('layouts.app')

@section('page-title')
    GRADES
@endsection

@section('page-icon')
    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2d2e83" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
        <polyline points="14,2 14,8 20,8"/>
        <line x1="16" y1="13" x2="8" y2="13"/>
        <line x1="16" y1="17" x2="8" y2="17"/>
        <polyline points="10,9 9,9 8,9"/>
    </svg>
@endsection

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f3f4f6;
    }
    .highlight {
        background: #fff59d;
        color: #d97706;
        padding: 0 2px;
        border-radius: 4px;
    }


    /* Main Content */
    .main-content {
        flex: 1;
        background: #f9fafb;
        display: flex;
        flex-direction: column;
    }

    


    /* Main Content */
    .main-content {
        flex: 1;
        background: #f9fafb;
        display: flex;
        flex-direction: column;
    }

    /* Header Section */
    .page-header {
        background: #fff;
        border-bottom: 1px solid #e5e7eb;
        padding: 20px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 50;
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .page-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2563eb;
        margin: 0;
        letter-spacing: 0.5px;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }



    /* New Styles for Grade Form */
    .instructions-box {
        background: #e0f2fe;
        border: 1px solid #0ea5e9;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 24px;
    }

    .instructions-box h3 {
        margin: 0 0 8px 0;
        color: #0369a1;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .instructions-box p {
        margin: 4px 0;
        color: #0c4a6e;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .form-container {
        background: #ffffff;
        border-radius: 8px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        margin-bottom: 24px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-row.full {
        grid-template-columns: 1fr;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: 600;
        color: #111827;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-family: inherit;
        font-size: 0.95rem;
        transition: border-color 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .subjects-section {
        margin: 20px 0;
    }

    .subjects-section h4 {
        font-weight: 600;
        color: #111827;
        margin-bottom: 12px;
        font-size: 0.95rem;
    }

    .subjects-input-wrapper {
        display: flex;
        gap: 8px;
        margin-bottom: 16px;
    }

    .subjects-input-wrapper button {
        padding: 10px 16px;
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.2s;
        font-size: 0.95rem;
    }

    .subjects-input-wrapper button:hover {
        background: #2563eb;
    }

    /* Subject Table Styles */
    .subjects-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 16px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        overflow: hidden;
    }

    .subjects-table thead {
        background: #f3f4f6;
        border-bottom: 2px solid #e5e7eb;
    }

    .subjects-table th {
        padding: 12px;
        text-align: left;
        font-weight: 600;
        color: #111827;
        font-size: 0.9rem;
    }

    .subjects-table td {
        padding: 12px;
        border-bottom: 1px solid #e5e7eb;
    }

    .subjects-table tbody tr:last-child td {
        border-bottom: none;
    }

    .subjects-table input {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-family: inherit;
        font-size: 0.9rem;
    }

    .subjects-table input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }

    .subjects-table .remove-btn {
        background: #ef4444;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.2s;
        font-size: 0.85rem;
    }

    .subjects-table .remove-btn:hover {
        background: #dc2626;
    }

    #subjects-list {
        display: none;
    }

    #subjects-list.show {
        display: table;
    }

    .file-upload-area {
        background: #f3f4f6;
        border-radius: 24px;
        box-shadow: 0 4px 24px rgba(59,130,246,0.08);
        padding: 0;
        min-height: 320px;
        width: 240px;
        max-width: 240px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        border: none;
        overflow-x: hidden;
    }

    .upload-icon {
        width: 90px;
        height: 90px;
        background: #fff;
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 12px rgba(59,130,246,0.10);
        margin-bottom: 18px;
    }

    .upload-icon svg {
        width: 56px;
        height: 56px;
        color: #222;
    }

    .photo-upload-label {
        font-size: 1.25rem;
        font-weight: 700;
        color: #222;
        letter-spacing: 0.12em;
        margin-top: 18px;
        margin-bottom: 0;
        text-align: center;
    }
    }

    .file-upload-section.active svg {
        color: #3b82f6;
    }

    .file-upload-section p {
        margin: 8px 0;
        color: #6b7280;
        font-size: 0.95rem;
    }

    .file-upload-section.active p {
        color: #1e40af;
    }

    .file-name {
        color: #10b981;
        font-weight: 600;
        margin-top: 8px;
        font-size: 0.9rem;
    }

    #gradeFileInput {
        display: none;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 24px;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.95rem;
    }

    .btn-primary {
        background: #3b82f6;
        color: white;
    }

    .btn-primary:hover {
        background: #2563eb;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    /* Main Form Wrapper */
    .form-wrapper {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 24px;
        align-items: start;
    }

    .form-left {
        flex: 1;
    }

    .form-right {
        display: flex;
        flex-direction: column;
    }

    .file-upload-label {
        font-weight: 600;
        color: #111827;
        margin-bottom: 12px;
        font-size: 0.95rem;
    }

    .file-upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        background: #f9fafb;
        transition: all 0.3s;
        min-height: 420px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .file-upload-area:hover {
        border-color: #3b82f6;
        background: #eff6ff;
    }

    .file-upload-area.active {
        border-color: #3b82f6;
        background: #dbeafe;
    }

    .file-upload-area.has-file {
        padding: 0;
        border: none;
    }

    .upload-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 16px;
    }

    .upload-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.3);
    }

    .upload-icon svg {
        width: 32px;
        height: 32px;
        color: white;
    }

    .upload-text {
        font-weight: 600;
        color: #111827;
        font-size: 1rem;
        margin-bottom: 4px;
    }

    .upload-subtext {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 12px;
    }

    .upload-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .upload-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }

    .upload-btn:active {
        transform: translateY(0);
    }

    .file-preview {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .preview-image-wrapper {
        width: 100%;
        height: 420px;
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        background: #000;
    }

    .preview-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .preview-actions {
        position: absolute;
        top: 12px;
        right: 12px;
        display: flex;
        gap: 8px;
        z-index: 10;
    }

    .preview-btn {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .preview-btn:hover {
        background: white;
        transform: scale(1.05);
    }

    .preview-btn svg {
        width: 18px;
        height: 18px;
    }

    .preview-btn.delete svg {
        color: #ef4444;
    }

    .preview-btn.change svg {
        color: #3b82f6;
    }

    .file-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 16px;
        color: white;
    }

    .file-name-display {
        font-size: 0.875rem;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

        <div class="container mx-auto py-8" style="max-width: 1200px;">

            <!-- Instructions Box -->
            <div class="instructions-box">
                <h3>📝 Instructions</h3>
                <p>• Please fill in your grade information accurately</p>
                <p>• Input your grades info and upload your grade slip as proof</p>
                <p>• Input all subjects and grades to the table below</p>
                <p>• For remarks, select "Passed" or "Failed" from the dropdown</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Grade Input Form -->
            <div class="form-container">
                <form id="gradeForm" method="POST" action="{{ route('student.grades.submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-wrapper">
                        <!-- Left Side -->
                        <div class="form-left">
                            <!-- Student Name -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="student_name">Student Name</label>
                                <input type="text" name="student_name" id="student_name" value="{{ auth()->user()->name }}" required readonly>
                            </div>
                            <!-- Year Level -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="year_level">Year Level</label>
                                <select name="year_level" id="year_level" required>
                                    <option value="">Select Year Level</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                </select>
                            </div>
                            <!-- Semester -->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="semester">Semester</label>
                                <select name="semester" id="semester" required>
                                    <option value="">Select Semester</option>
                                    <option value="1st Semester">1st Semester</option>
                                    <option value="2nd Semester">2nd Semester</option>
                                </select>
                            </div>
                            <!-- Dynamic Subject Input -->
                            <div class="subjects-section">
                                <h4>Subjects</h4>
                                <div class="subjects-input-wrapper">
                                    <button type="button" id="add-subject" class="btn btn-primary">+ Add Subject</button>
                                </div>
                                <!-- Subjects Table -->
                                <table class="subjects-table" id="subjects-list">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Final Grade</th>
                                            <th>Remarks</th>
                                            <th style="width: 80px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="subjects-tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Right Side - File Upload -->
                        <div class="form-right">
                            <div id="fileUploadArea" class="file-upload-area">
                                <div class="upload-icon">
                                    <!-- Camera icon with upload arrow -->
                                    <svg viewBox="0 0 64 64" fill="none">
                                        <rect x="8" y="16" width="48" height="32" rx="10" fill="#222"/>
                                        <circle cx="32" cy="32" r="10" fill="#fff"/>
                                        <circle cx="32" cy="32" r="6" fill="#222"/>
                                        <circle cx="48" cy="48" r="8" fill="#222"/>
                                        <path d="M48 52v-4m0 0l-2 2m2-2l2 2" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <input type="file" name="proof" id="gradeFileInput" accept="image/*,.pdf" required style="display:none;">
                                <div id="filePreview" class="file-preview"></div>
                                <div class="photo-upload-label">Photo Upload</div>
                            </div>
                        </div>
                    </div>
                    <!-- Hidden subjects input -->
                    <input type="hidden" name="subjects" id="subjectsJson">
                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">Clear</button>
                        <button type="button" class="btn btn-primary" id="submitConfirmBtn">Submit Grade</button>
                    </div>
                </form>
            </div>

            <!-- Modal -->
            <div id="submitModal" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.3);z-index:9999;align-items:center;justify-content:center;">
                <div style="background:#fff;padding:32px 24px;border-radius:12px;box-shadow:0 4px 24px rgba(0,0,0,0.15);max-width:350px;margin:auto;text-align:center;">
                    <h2 style="font-size:1.2rem;font-weight:700;margin-bottom:18px;">Are you sure you want to Submit?</h2>
                    <div style="display:flex;gap:16px;justify-content:center;">
                        <button id="modalCancel" style="padding:10px 24px;border-radius:6px;background:#e5e7eb;color:#222;font-weight:600;border:none;">Cancel</button>
                        <button id="modalConfirm" style="padding:10px 24px;border-radius:6px;background:#3b82f6;color:#fff;font-weight:600;border:none;">Submit</button>
                    </div>
                </div>
<script>
    // Grade Form Scripts
    const subjectsList = document.getElementById('subjects-list');
    const subjectsTbody = document.getElementById('subjects-tbody');
    const addSubjectBtn = document.getElementById('add-subject');
    const gradeForm = document.getElementById('gradeForm');
    const subjectsJson = document.getElementById('subjectsJson');

    addSubjectBtn.addEventListener('click', function(e) {
        e.preventDefault();
        // Create table row
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" placeholder="Subject name" class="subject-input" required></td>
            <td><input type="text" placeholder="Grade" class="grade-input" required></td>
            <td>
                <select class="remarks-input" required>
                    <option value="">Select Remarks</option>
                    <option value="Passed">Passed</option>
                    <option value="Failed">Failed</option>
                </select>
            </td>
            <td><button type="button" class="remove-btn" onclick="removeSubjectRow(this)">Remove</button></td>
        `;
        subjectsTbody.appendChild(row);
        subjectsList.classList.add('show');
        row.querySelector('.subject-input').focus();
    });

    function removeSubjectRow(btn) {
        btn.closest('tr').remove();
        if (subjectsTbody.children.length === 0) {
            subjectsList.classList.remove('show');
        }
    }

    // Modal confirmation logic
    const submitConfirmBtn = document.getElementById('submitConfirmBtn');
    const submitModal = document.getElementById('submitModal');
    const modalCancel = document.getElementById('modalCancel');
    const modalConfirm = document.getElementById('modalConfirm');

    submitConfirmBtn.addEventListener('click', function(e) {
        // Validate required fields
        const yearLevel = document.getElementById('year_level').value;
        const semester = document.getElementById('semester').value;
        const fileInput = document.getElementById('gradeFileInput');
        const rows = subjectsTbody.querySelectorAll('tr');
        let valid = true;
        let errorMsg = '';
        if (!yearLevel) {
            valid = false;
            errorMsg = 'Year Level is required.';
        } else if (!semester) {
            valid = false;
            errorMsg = 'Semester is required.';
        } else if (rows.length === 0) {
            valid = false;
            errorMsg = 'At least one subject is required.';
        } else {
            rows.forEach(row => {
                if (!row.querySelector('.subject-input').value || !row.querySelector('.grade-input').value || !row.querySelector('.remarks-input').value) {
                    valid = false;
                    errorMsg = 'All subject fields are required.';
                }
            });
        }
        if (!fileInput.files.length) {
            valid = false;
            errorMsg = 'Proof file is required.';
        }
        if (!valid) {
            alert(errorMsg);
            return;
        }
        submitModal.style.display = 'flex';
    });
    modalCancel.addEventListener('click', function(e) {
        submitModal.style.display = 'none';
    });
    modalConfirm.addEventListener('click', function(e) {
        submitModal.style.display = 'none';
        // Serialize subjects to JSON before submit
        const rows = subjectsTbody.querySelectorAll('tr');
        const subjectsArr = [];
        rows.forEach(row => {
            const subject = row.querySelector('.subject-input').value;
            const grade = row.querySelector('.grade-input').value;
            const remarks = row.querySelector('.remarks-input').value;
            subjectsArr.push({ subject, grade, remarks });
        });
        subjectsJson.value = JSON.stringify(subjectsArr);
        gradeForm.submit();
    });

    // File Upload Handling
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileInput = document.getElementById('gradeFileInput');
    const filePreview = document.getElementById('filePreview');
    const uploadIcon = fileUploadArea.querySelector('.upload-icon');

    // Only clicking the upload icon or Change button triggers file input
    uploadIcon.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.click();
    });

    // Remove any click event from fileUploadArea itself
    fileUploadArea.onclick = null;

    // Drag & drop support
    fileUploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileUploadArea.classList.add('active');
    });
    fileUploadArea.addEventListener('dragleave', () => {
        fileUploadArea.classList.remove('active');
    });
    fileUploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        fileUploadArea.classList.remove('active');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            updateFileName(files[0].name);
            showImagePreview(files[0]);
        }
    });

    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            updateFileName(file.name);
            showImagePreview(file);
        }
    });

    function updateFileName(name) {
        filePreview.innerHTML = `<div class="file-name">✓ ${name}</div>`;
    }

    function showImagePreview(file) {
        // Only show preview for images
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                filePreview.innerHTML += `
                    <div style="width:100%;height:320px;display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;">
                        <img src="${e.target.result}" alt="Preview" style="width:100%;height:100%;object-fit:cover;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);max-width:100%;">
                        <button type="button" class="preview-btn change" style="position:absolute;top:12px;right:12px;z-index:2;" title="Change photo">
                            <svg viewBox="0 0 20 20" fill="none" width="20" height="20"><path d="M4 4h3l2-2h2l2 2h3v2H4V4zm0 4v8a2 2 0 002 2h8a2 2 0 002-2V8H4zm8 4a2 2 0 11-4 0 2 2 0 014 0z" fill="#3b82f6"/></svg>
                        </button>
                    </div>
                `;
                // Add event listener to change button
                setTimeout(() => {
                    const changeBtn = filePreview.querySelector('.preview-btn.change');
                    if (changeBtn) {
                        changeBtn.addEventListener('click', function(ev) {
                            ev.stopPropagation();
                            fileInput.click();
                        });
                    }
                }, 10);
            };
            reader.readAsDataURL(file);
        }
    }

    // Prevent clicking preview image from triggering file input
    filePreview.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    function resetForm() {
        document.getElementById('gradeForm').reset();
        subjectsTbody.innerHTML = '';
        subjectsList.classList.remove('show');
        filePreview.innerHTML = '';
    }
</script>
@endsection
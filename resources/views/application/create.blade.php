@extends('layouts.guest')

@section('title', 'Student Assistants Society')

@section('content')
<div style="background: #4a6ba3; min-height: 100vh; font-family: 'Segoe UI', Arial, sans-serif; padding: 0;">

    {{-- HEADER --}}
    <div class="header-bar" style="background: #eaeaea; color: #1a237e; display: flex; align-items: center; justify-content: space-between; padding: 0 24px; height: 56px;">
        <div style="display: flex; align-items: center;">
            <img src="/images/uddlogo.png" alt="UDD Logo" style="height: 44px; width: 44px; object-fit: contain; margin-right: 12px;">
            <span class="logo-text" style="font-size: 22px; font-weight: bold; color: #1a237e; letter-spacing: 1px;">UNIVERSIDAD DE DAGUPAN</span>
        </div>
        <nav style="display: flex; gap: 32px;">
            <a href="/index" style="color: #23408e; font-weight: bold; font-size: 18px; text-decoration: none; transition: color 0.2s;">About</a>
            <a href="/welcome" style="color: #23408e; font-weight: bold; font-size: 18px; text-decoration: none; transition: color 0.2s;">Home</a>
            <a href="/contact" style="color: #23408e; font-weight: bold; font-size: 18px; text-decoration: none; transition: color 0.2s;">Contact Us</a>
            <a href="/apply" style="color: #23408e; font-weight: bold; font-size: 18px; text-decoration: none; transition: color 0.2s;">Apply</a>
            <a href="/login" style="color: #23408e; font-weight: bold; font-size: 18px; text-decoration: none; transition: color 0.2s;">Login</a>
        </nav>
    </div>

    {{-- BANNER --}}
    <section style="position: relative; height: 320px; border-bottom: 6px solid #3a5a8c; overflow: hidden; background: #e3eaf7;">
        <img src="/images/application.png" alt="Application Banner" style="width: 100%; height: 100%; object-fit: cover; display: block; filter: blur(4px) brightness(0.85);">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: flex-start; z-index: 2;">
            <div style="background: #fff; padding: 36px 110px; border-radius: 6px; margin-left: 80px; display: flex; align-items: center; justify-content: center; height: 180px; box-shadow: 0 4px 24px rgba(0,0,0,0.10);">
                <span style="font-size: 62px; font-weight: bold; color: #002c77; letter-spacing: 2px; text-align: center; display: block;">Application<br>Form</span>
            </div>
        </div>
    </section>


    {{-- FORM --}}
    <main style="display: flex; justify-content: center; align-items: flex-start; min-height: 100vh; padding: 48px 0;">
        <div style="max-width: 980px; width: 100%; background: #fff; border-radius: 18px; box-shadow: 0 8px 32px rgba(0,0,0,0.18); padding: 38px 38px 24px 38px; margin-top: 32px;">

        {{-- Header with logo --}}
        <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 18px;">
            <div style="display: flex; align-items: center; gap: 18px;">
                <img src="/images/uddlogo.png" alt="UDD Seal" style="width: 80px; height: 80px; object-fit: contain; display: block;">
                <div style="font-size: 19px; font-weight: bold; color: #1a237e; line-height: 1.2;">
                    UNIVERSIDAD DE DAGUPAN<br>
                    <span style="font-size: 14px; font-weight: normal; color: #333;">(formerly Colegio de Dagupan)</span>
                </div>
            </div>
            <div style="text-align: right; font-size: 15px; font-weight: bold; line-height: 1.4; margin-left: auto;">
                Student Assistant Application Form<br>
                UNIVERSIDAD DE DAGUPAN<br>
                Arellano St., Dagupan City,<br>
                Pangasinan
            </div>
        </div>


    <hr style="border: 1px solid #222; margin-bottom: 18px;">
    <form method="POST" action="{{ route('application.store') }}" enctype="multipart/form-data" id="applicationForm">
            @csrf

            {{-- PERSONAL INFORMATION --}}
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 38px; align-items: flex-start; margin-bottom: 0;">
                <div>
                    <h3 style="font-size: 24px; font-family: 'Times New Roman', Times, serif; font-weight: bold; margin-bottom: 8px; margin-top: 18px; text-align: left;">Personal Information</h3>
                       <div style="display: flex; gap: 18px; margin-bottom: 8px;">
                           <div style="flex: 2;">
                               <label style="font-size: 16px; font-weight: bold; text-align: left;">Student’s Name:</label>
                               <input type="text" name="student_name" required style="width: 100%; border: 1.5px solid #888; border-radius: 6px; padding: 7px 12px; font-size: 15px; background: #fff;">
                           </div>
                       </div>
                       <div style="display: flex; gap: 18px; margin-bottom: 8px;">
                           <div style="flex: 1;">
                               <label style="font-size: 16px; font-weight: bold; text-align: left;">Course:</label>
                               <select name="course" required style="width: 100%; border: 1.5px solid #888; border-radius: 6px; font-size: 15px; background: #fff; appearance: auto;">
                                   <option value="">Select</option>
                                   <option value="BSIT">SOH</option>
                                   <option value="BSBA">STE</option>
                                   <option value="BSED">SBA</option>
                                   <option value="BSN">SOHS</option>
                                   <option value="BSN">SOE</option>
                                   <option value="BSN">SITE</option>
                                   <option value="BSN">SIHM</option>
                                   <option value="BSN">SOC</option>
                               </select>
                           </div>
                           <div style="flex: 1;">
                               <label style="font-size: 16px; font-weight: bold; text-align: left;">Year Level:</label>
                               <select name="year_level" required style="width: 100%; border: 1.5px solid #888; border-radius: 6px; font-size: 15px; background: #fff; appearance: auto;">
                                   <option value="">Select</option>
                                   <option>First Year</option>
                                   <option>Second Year</option>
                                   <option>Third Year</option>
                                   <option>Fourth Year</option>
                                   <option>Fifth Year</option>
                               </select>
                           </div>
                           <div style="flex: 1;">
                               <label style="font-size: 16px; font-weight: bold; text-align: left;">Age:</label>
                               <input type="text" name="age" required style="width: 100%; border: 1.5px solid #888; border-radius: 6px; padding: 7px 12px; font-size: 15px; background: #fff;">
                           </div>
                           <div style="flex: 1;">
                               <label style="font-size: 16px; font-weight: bold; text-align: left;">ID Number:</label>
                               <input type="text" name="id_number" required style="width: 100%; border: 1.5px solid #888; border-radius: 6px; padding: 7px 12px; font-size: 15px; background: #fff;">
                           </div>
                       </div>
                       <div style="display: flex; gap: 18px; margin-bottom: 8px;">
                           <div style="flex: 2;">
                               <label style="font-size: 16px; font-weight: bold; text-align: left;">Address:</label>
                               <input type="text" name="address" required style="width: 100%; border: 1.5px solid #888; border-radius: 6px; padding: 7px 12px; font-size: 15px; background: #fff;">
                           </div>
                       </div>
                       <div style="display: flex; gap: 18px; margin-bottom: 8px;">
                           <div style="flex: 1;">
                               <label style="font-size: 16px; font-weight: bold; text-align: left;">Email Address:</label>
                               <input type="email" name="email" required style="width: 100%; border: 1.5px solid #888; border-radius: 6px; padding: 7px 12px; font-size: 15px; background: #fff;">
                           </div>
                           <div style="flex: 1;">
                               <label style="font-size: 16px; font-weight: bold; text-align: left;">Telephone no./ Cp no.</label>
                               <input type="text" name="telephone" required style="width: 100%; border: 1.5px solid #888; border-radius: 6px; padding: 7px 12px; font-size: 15px; background: #fff;">
                           </div>
                       </div>
                </div>
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: flex-start;">
                    <div style="width: 320px; height: 300px; position: relative; margin-bottom: 0; border: 2px solid #222; background: #f6f2f2; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <img id="profile-preview" style="width: 100%; height: 100%; object-fit: cover; border-radius: 0; display: none; position: absolute; top: 0; left: 0;">
                        <span id="picturePreviewLabel" style="font-size: 38px; font-family: 'Segoe UI', Arial, sans-serif; color: #222; letter-spacing: 4px; text-align: center; font-weight: 500; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">Upload<br>Photo</span>
                        <button type="button" id="cameraBtn" style="position: absolute; bottom: 12px; right: 12px; background: #fff; border-radius: 8px; border: 2px solid #23408e; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.10); cursor: pointer;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#23408e" stroke-width="2">
                                <rect x="3" y="7" width="18" height="12" rx="3" fill="#eaeaea" stroke="#23408e"/>
                                <circle cx="12" cy="13" r="4" fill="#fff" stroke="#23408e"/>
                                <rect x="8" y="3" width="8" height="4" rx="2" fill="#eaeaea" stroke="#23408e"/>
                            </svg>
                        </button>
                        <input type="file" name="picture" id="pictureInput" accept="image/*" required style="display:none;">
                        <input type="hidden" name="cropped_picture" id="cropped-picture">
                    </div>
                    <!-- Modal for cropping -->
                    <div id="cropperModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
                        <div style="background:#fff; padding:24px; border-radius:8px; box-shadow:0 2px 16px rgba(0,0,0,0.18); min-width:340px; max-width:95vw; text-align:center; position:relative;">
                            <span style="position:absolute; top:12px; right:18px; font-size:28px; cursor:pointer;" onclick="closeModal()">&times;</span>
                            <h3 style="margin-bottom:12px;">Edit Profile Picture</h3>
                            <img id="modal-image" style="max-width:320px; max-height:320px; display:block; margin:auto;">
                            <div style="margin-top:10px;">
                                <button type="button" onclick="rotateImage(-90)">⟲</button>
                                <button type="button" onclick="rotateImage(90)">⟳</button>
                                <button type="button" onclick="zoomImage(0.1)">＋</button>
                                <button type="button" onclick="zoomImage(-0.1)">－</button>
                            </div>
                            <button type="button" style="margin-top:18px; padding:8px 32px; font-size:18px; background:#23408e; color:#fff; border:none; border-radius:6px; font-weight:bold; cursor:pointer;" onclick="saveCroppedImage()">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <hr style="margin: 16px 0;">

            <!-- Family Background -->
                <hr style="border: 1.5px solid #222; margin: 16px 0;">
                <h3 style="font-size: 24px; font-weight: bold; margin-bottom: 8px; margin-top: 18px; font-family: Times New Roman, Times, serif;">Family Background</h3>
                <hr style="border: 1.5px solid #222; margin-bottom: 18px; margin-top: 0;">
                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 8px;">
                    <div>
                        <label style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Father's Name:</label>
                        <input type="text" name="father_name" required style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                    </div>
                    <div>
                        <label style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Age:</label>
                        <input type="text" name="father_age" required style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                    </div>
                    <div>
                        <label style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Occupation:</label>
                        <input type="text" name="father_occupation" required style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 8px;">
                    <div>
                        <label style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Mother's Name:</label>
                        <input type="text" name="mother_name" required style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                    </div>
                    <div>
                        <label style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Age:</label>
                        <input type="text" name="mother_age" required style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                    </div>
                    <div>
                        <label style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Occupation:</label>
                        <input type="text" name="mother_occupation" required style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                    </div>
                </div>
                <div style="margin-bottom: 8px;">
                    <label style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Monthly Household Income:</label>
                    <input type="text" name="monthly_income" required style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                </div>
                <hr style="border: 1.5px solid #222; margin: 16px 0;">

                <!-- Computer Literacy -->
                <h3 style="font-size: 24px; font-weight: bold; margin-bottom: 8px; margin-top: 18px; font-family: Times New Roman, Times, serif;">Computer Literacy</h3>
                <hr style="border: 1.5px solid #222; margin-bottom: 18px; margin-top: 0;">
                <div style="font-size: 16px; margin-bottom: 10px; font-family: Times New Roman, Times, serif;">
                    <label style="font-weight: bold;">Are you Computer Literate?</label>
                    <input type="radio" name="is_literate" value="1" required> Yes
                    <input type="radio" name="is_literate" value="0" required> No
                </div>
                <div style="font-size: 16px; margin-bottom: 10px; font-family: Times New Roman, Times, serif;">
                    <span id="literacy-label" style="color: #aaa;">If Yes, what tools can you use? (Select all that apply)</span><br>
                    <span id="literacy-checkboxes" style="display: block; color: #aaa;">
                        <input type="checkbox" name="tools[]" value="office" class="literacy-tool" disabled> Can you use Microsoft Office Suite (e.g. Word, Excel, Powerpoint)<br>
                        <input type="checkbox" name="tools[]" value="design" class="literacy-tool" disabled> Can you use Design Software (e.g. Canva, Adobe Photoshop)<br>
                        <input type="checkbox" name="tools[]" value="video_conf" class="literacy-tool" disabled> Can you use email, video conferencing tools and other communication tool (e.g. Gmail, Google Meet, Facebook, Messenger)<br>
                        <input type="checkbox" name="tools[]" value="social" class="literacy-tool" disabled> Can you use social media Platforms (e.g. Facebook, Twitter, Instagram)<br>
                        <input type="checkbox" name="tools[]" value="cloud" class="literacy-tool" disabled> Can you use cloud storage services (e.g. Google Drive) to store and share files<br>
                    </span>
                </div>
                <div style="font-size: 16px; margin-bottom: 10px; font-family: Times New Roman, Times, serif;">
                    <label>ARE YOU ABLE TO COMMIT TO WORKING A MINIMUM NUMBER OF HOURS PER WEEK AS REQUIRED BY THE POSITION?</label><br>
                    <input type="radio" name="can_commit" value="1" required> Yes
                    <input type="radio" name="can_commit" value="0" required> No
                </div>
                <div style="font-size: 16px; margin-bottom: 10px; font-family: Times New Roman, Times, serif;">
                    <label>ARE YOU WILLING TO WORK OVERTIME IF NECESSARY?</label><br>
                    <input type="radio" name="willing_overtime" value="1" required> Yes
                    <input type="radio" name="willing_overtime" value="0" required> No
                </div>
                <div style="font-size: 16px; margin-bottom: 10px; font-family: Times New Roman, Times, serif;">
                    <label>ARE YOU COMFORTABLE WITH PERFORMING CLERICAL TASK SUCH AS FILING, DATA ENTRY, AND PHOTOCOPYING?</label><br>
                    <input type="radio" name="comfortable_clerical" value="1" required> Yes
                    <input type="radio" name="comfortable_clerical" value="0" required> No
                </div>
                <div style="font-size: 16px; margin-bottom: 10px; font-family: Times New Roman, Times, serif;">
                    <label>DO YOU POSSESS STRONG COMMUNICATION SKILLS, BOTH WRITTEN AND VERBAL?</label><br>
                    <input type="radio" name="strong_communication" value="1" required> Yes
                    <input type="radio" name="strong_communication" value="0" required> No
                </div>
                <div style="font-size: 16px; margin-bottom: 10px; font-family: Times New Roman, Times, serif;">
                    <label>ARE YOU WILLING TO UNDERGO TRAINING RELATED TO YOUR DUTIES AS A STUDENT ASSISTANT?</label><br>
                    <input type="radio" name="willing_training" value="1" required> Yes
                    <input type="radio" name="willing_training" value="0" required> No
                </div>
                <div style="font-size: 16px; margin-bottom: 10px; font-family: Times New Roman, Times, serif;">
                    <label>OTHER TALENTS/ SKILLS/ SOFT SKILLS/TECHNICAL SKILLS/HOBBIES, WRITE IT DOWN:</label>
                    <textarea name="other_skills" required style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; height: 60px; background: #f7f7f7;"></textarea>
                </div>
                <div style="text-align: right; margin-top: 18px;">
                    <button type="submit" style="padding: 8px 32px; font-size: 18px; background: #fff; color: #222; border: 2px solid #222; border-radius: 6px; font-weight: bold; cursor: pointer; font-family: Times New Roman, Times, serif; letter-spacing: 2px; transition: background 0.2s;">Submit</button>
                </div>

        <style>
        .modal-confirm-bg {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.18);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-confirm-box {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.18);
            padding: 38px 24px 28px 24px;
            min-width: 340px;
            max-width: 95vw;
            text-align: center;
        }
        .modal-confirm-title {
            font-size: 26px;
            font-family: Arial, sans-serif;
            font-weight: 400;
            margin-bottom: 32px;
            letter-spacing: 1px;
        }
        .modal-confirm-btns {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
        }
        .modal-confirm-btn {
            font-size: 22px;
            letter-spacing: 7px;
            padding: 8px 36px;
            border-radius: 5px;
            border: 1px solid #aaa;
            background: #eee;
            color: #222;
            font-family: Arial, sans-serif;
            cursor: pointer;
            margin: 0 10px;
            transition: background 0.2s;
        }
        .modal-confirm-btn:hover {
            background: #dbeafe;
        }
        </style>
        <style>
        @media print {
            body * {
                visibility: hidden !important;
            }
            /* Show only the form and its header block */
            #applicationForm, #applicationForm * {
                visibility: visible !important;
            }
            #applicationForm {
                position: absolute !important;
                left: 0; top: 0; width: 100vw;
                background: #fff !important;
                box-shadow: none !important;
                z-index: 99999;
            }
            /* Hide navigation bar and banner for print */
            .header-bar, .header-bar *, section, section *, nav, .header-bar nav {
                display: none !important;
                visibility: hidden !important;
            }
            /* Show only the form header block at the top */
            .form-header-block, .form-header-block * {
                display: block !important;
                visibility: visible !important;
            }
            .modal-confirm-bg, .modal-confirm-box, #modalPrint, #modalConfirm, #cropperModal {
                display: none !important;
            }
            button[type="submit"], #cameraBtn {
                display: none !important;
            }
        }
        </style>
        <div id="modalConfirm" style="display:none;" class="modal-confirm-bg">
            <div class="modal-confirm-box">
                <div class="modal-confirm-title">ARE YOU SURE YOU<br>WANT TO SUBMIT?</div>
                <div class="modal-confirm-btns">
                    <button type="button" id="modalYes" class="modal-confirm-btn">YES</button>
                    <button type="button" id="modalNo" class="modal-confirm-btn">NO</button>
                </div>
            </div>
        </div>
        <!-- Print Modal -->
        <div id="modalPrint" style="display:none;" class="modal-confirm-bg">
            <div class="modal-confirm-box">
                <div class="modal-confirm-title">DO YOU WANT TO<br>PRINT THIS FORM?</div>
                <div class="modal-confirm-btns">
                    <button type="button" id="modalPrintYes" class="modal-confirm-btn">PRINT</button>
                    <button type="button" id="modalPrintNo" class="modal-confirm-btn">CANCEL</button>
                </div>
            </div>
        </div>
        <script>
        // Computer Literacy logic: disable checkboxes and gray out text unless 'Yes' is selected
        document.addEventListener('DOMContentLoaded', function() {
            const yesRadio = document.querySelector('input[name="is_literate"][value="1"]');
            const noRadio = document.querySelector('input[name="is_literate"][value="0"]');
            const toolCheckboxes = document.querySelectorAll('.literacy-tool');
            const label = document.getElementById('literacy-label');
            const checkboxesBlock = document.getElementById('literacy-checkboxes');
            function updateToolCheckboxes() {
                if (yesRadio.checked) {
                    toolCheckboxes.forEach(cb => cb.disabled = false);
                    label.style.color = '#222';
                    checkboxesBlock.style.color = '#222';
                } else {
                    toolCheckboxes.forEach(cb => { cb.checked = false; cb.disabled = true; });
                    label.style.color = '#aaa';
                    checkboxesBlock.style.color = '#aaa';
                }
            }
            yesRadio.addEventListener('change', updateToolCheckboxes);
            noRadio.addEventListener('change', updateToolCheckboxes);
            updateToolCheckboxes();
        });
        const form = document.getElementById('applicationForm');
        const modal = document.getElementById('modalConfirm');
        const btnYes = document.getElementById('modalYes');
        const btnNo = document.getElementById('modalNo');
        const modalPrint = document.getElementById('modalPrint');
        const btnPrintYes = document.getElementById('modalPrintYes');
        const btnPrintNo = document.getElementById('modalPrintNo');
        let allowSubmit = false;
        let submitted = false;
        // For photo upload validation
        function isPhotoUploaded() {
            return !!document.getElementById('cropped-picture').value;
        }
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (!form.checkValidity()) {
                alert('Please fill out all required fields before submitting the form.');
                return;
            }
            if (!isPhotoUploaded()) {
                alert('Please upload and crop your photo before submitting the form.');
                return;
            }
            if (!allowSubmit) {
                modal.style.display = 'flex';
            } else {
                allowSubmit = false;
                submitted = true;
                // Submit via AJAX, but do NOT clear/reset the form
                const formData = new FormData(form);
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                }).then(function(response) {
                    if (response.ok) {
                        // Show print modal, keep form data visible
                        modalPrint.style.display = 'flex';
                    } else {
                        alert('Submission failed. Please try again.');
                    }
                }).catch(function() {
                    alert('Submission failed. Please try again.');
                });
            }
        });

        btnYes.addEventListener('click', function() {
            modal.style.display = 'none';
            allowSubmit = true;
            // Trigger submit event again, but now allowSubmit is true so AJAX will run
            form.dispatchEvent(new Event('submit', {cancelable: true, bubbles: true}));
        });
        btnNo.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        // Show print modal after successful submission
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash === '#submitted') {
                setTimeout(function() {
                    modalPrint.style.display = 'flex';
                }, 400);
            }
        });

        // Intercept form submission to add hash and show print modal
        form.addEventListener('submit', function(e) {
            if (allowSubmit && !submitted) {
                e.preventDefault();
                submitted = true;
                // Actually submit the form via AJAX to avoid page reload
                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                }).then(function(response) {
                    if (response.ok) {
                        window.location.hash = '#submitted';
                        modalPrint.style.display = 'flex';
                    } else {
                        alert('Submission failed. Please try again.');
                    }
                }).catch(function() {
                    alert('Submission failed. Please try again.');
                });
            }
        });

        btnPrintYes.addEventListener('click', function() {
            modalPrint.style.display = 'none';
            window.print();
            // After print dialog closes, redirect to show page
            setTimeout(function() {
                window.location.href = '/apply/show';
            }, 500);
        });
        btnPrintNo.addEventListener('click', function() {
            modalPrint.style.display = 'none';
            window.location.href = '/apply/show';
        });

        // Picture preview logic
        // Cropper.js integration
        let cropper;
        const pictureInput = document.getElementById('pictureInput');
        const cameraBtn = document.getElementById('cameraBtn');
        cameraBtn.addEventListener('click', function() {
            pictureInput.click();
        });
        const profilePreview = document.getElementById('profile-preview');
        // Removed label for minimal UI
        const cropperModal = document.getElementById('cropperModal');
        const modalImage = document.getElementById('modal-image');
        pictureInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    // Only open cropper modal, do not show preview yet
                    modalImage.src = ev.target.result;
                    cropperModal.style.display = 'flex';
                    if (cropper) cropper.destroy();
                    cropper = new Cropper(modalImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                    });
                };
                reader.readAsDataURL(file);
            }
        });
        function rotateImage(deg) {
            if (cropper) cropper.rotate(deg);
        }
        function zoomImage(factor) {
            if (cropper) cropper.zoom(factor);
        }
        function saveCroppedImage() {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({ width: 320, height: 300 });
                const dataUrl = canvas.toDataURL('image/png');
                document.getElementById('cropped-picture').value = dataUrl;
                const profilePreview = document.getElementById('profile-preview');
                const picturePreviewLabel = document.getElementById('picturePreviewLabel');
                profilePreview.src = dataUrl;
                profilePreview.style.display = 'block';
                picturePreviewLabel.style.display = 'none';
                cropperModal.style.display = 'none';
                cropper.destroy();
            }
        }
        function closeModal() {
            cropperModal.style.display = 'none';
            // Restore label if no image was saved
            const profilePreview = document.getElementById('profile-preview');
            const picturePreviewLabel = document.getElementById('picturePreviewLabel');
            if (!document.getElementById('cropped-picture').value) {
                profilePreview.style.display = 'none';
                picturePreviewLabel.style.display = 'block';
            }
            if (cropper) cropper.destroy();
        }
        </script>
        <!-- Cropper.js CSS & JS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
        </script>
        <!-- Cropper.js CSS & JS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
        </script>


        </form>
    </div>
</main>

    <!-- Footer -->
    <footer style="background: #1a237e; color: #fff; text-align: center; font-size: 13px; padding: 18px 0; margin-top: 0; letter-spacing: 1px;">
            &copy; 2023 - 2024 by MRCY Inc., a non-profit organization. All rights reserved.
        </footer>
    </div>
@endsection

@extends('layouts.guest')

@section('title', 'Student Assistants Society')

@section('content')
<style>
/* Mobile Menu Styles */
.mobile-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #eaeaea;
    border-top: 1px solid #ccc;
    padding: 12px 0;
    z-index: 1000;
}

.mobile-menu a {
    display: block;
    padding: 8px 24px;
    color: #23408e;
    font-weight: bold;
    font-size: 16px;
    text-decoration: none;
    transition: background-color 0.2s;
}

.mobile-menu a:hover {
    background-color: #ddd;
}

.hamburger {
    display: none;
    flex-direction: column;
    cursor: pointer;
    padding: 4px;
}

.hamburger span {
    width: 25px;
    height: 3px;
    background-color: #23408e;
    margin: 3px 0;
    transition: 0.3s;
}

.header-logo {
    display: flex;
    align-items: center;
}

.header-logo img {
    height: 44px;
    width: 44px;
    object-fit: contain;
    margin-right: 12px;
}

.logo-text {
    font-size: 22px;
    font-weight: bold;
    color: #1a237e;
    letter-spacing: 1px;
}

.desktop-nav {
    display: flex;
    gap: 32px;
}

.desktop-nav a {
    color: #23408e;
    font-weight: bold;
    font-size: 18px;
    text-decoration: none;
    transition: color 0.2s;
}

.desktop-nav a:hover {
    color: #1a237e;
}

/* Mobile Responsive Styles */
@media (max-width: 768px) {
    .header-bar {
        flex-wrap: wrap !important;
        position: relative !important;
        padding: 0 16px !important;
        height: auto !important;
        min-height: 56px !important;
    }
    
    .logo-text {
        font-size: 16px !important;
    }
    
    .desktop-nav {
        display: none !important;
    }
    
    .hamburger {
        display: flex !important;
    }
    
    .mobile-menu.active {
        display: block;
    }
    
    /* Banner adjustments */
    .banner {
        height: 200px !important;
    }
    
    .banner-content {
        margin-left: 20px !important;
        padding: 20px 40px !important;
        font-size: 32px !important;
    }
    
    /* Form adjustments */
    .form-container {
        padding: 24px 20px !important;
        margin: 16px !important;
    }
    
    .form-header {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 16px !important;
    }
    
    .form-header-left {
        align-items: flex-start !important;
    }
    
    .form-header-right {
        text-align: left !important;
        font-size: 13px !important;
        margin-left: 0 !important;
    }
    
    .university-logo {
        width: 60px !important;
        height: 60px !important;
    }
    
    .university-name {
        font-size: 16px !important;
    }
    
    /* Personal info layout */
    .personal-section {
        display: flex !important;
        flex-direction: column !important;
        gap: 24px !important;
    }
    
    .photo-section {
        order: -1 !important;
        width: 100% !important;
        display: flex !important;
        justify-content: center !important;
    }
    
    .photo-container {
        width: 250px !important;
        height: 200px !important;
        margin: 0 auto !important;
    }
    
    /* Form fields */
    .form-row {
        flex-direction: column !important;
        gap: 12px !important;
    }
    
    .form-grid-3 {
        display: flex !important;
        flex-direction: column !important;
        gap: 12px !important;
    }
    
    .form-field {
        flex: 1 !important;
    }
    
    .form-input, .form-select {
        padding: 10px 12px !important;
        font-size: 16px !important;
    }
    
    .form-label {
        font-size: 14px !important;
    }
    
    .section-title {
        font-size: 20px !important;
    }
}

@media (max-width: 480px) {
    .header-bar {
        padding: 0 12px !important;
    }
    
    .logo-text {
        font-size: 14px !important;
    }
    
    .banner {
        height: 150px !important;
    }
    
    .banner-content {
        margin-left: 10px !important;
        padding: 16px 24px !important;
        font-size: 24px !important;
        height: auto !important;
    }
    
    .form-container {
        padding: 16px 12px !important;
        margin: 8px !important;
    }
    
    .photo-container {
        width: 200px !important;
        height: 160px !important;
    }
    
    .form-input, .form-select {
        font-size: 15px !important;
    }
    
    .section-title {
        font-size: 18px !important;
    }
    
    .submit-btn {
        padding: 10px 24px !important;
        font-size: 16px !important;
    }
}
</style>

<div style="background: #4a6ba3; min-height: 100vh; font-family: 'Segoe UI', Arial, sans-serif; padding: 0;">

    {{-- HEADER --}}
    <div class="header-bar" style="background: #eaeaea; color: #1a237e; display: flex; align-items: center; justify-content: space-between; padding: 0 24px; height: 56px; position: relative;">
        <div class="header-logo">
            <img src="{{ asset('images/uddlogo.png') }}" alt="UDD Logo">
            <span class="logo-text">UNIVERSIDAD DE DAGUPAN</span>
        </div>
        
        <!-- Desktop Navigation -->
        <nav class="desktop-nav">
            <a href="/about">About</a>
            <a href="/welcome">Home</a>
            <a href="/contact">Contact Us</a>
            <a href="/apply">Apply</a>
            <a href="/login">Login</a>
        </nav>
        
        <!-- Mobile Menu Button -->
        <div class="hamburger" onclick="toggleMobileMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        
        <!-- Mobile Navigation -->
        <nav class="mobile-menu" id="mobileMenu">
            <a href="/about">About</a>
            <a href="/welcome">Home</a>
            <a href="/contact">Contact Us</a>
            <a href="/apply">Apply</a>
            <a href="/login">Login</a>
        </nav>
    </div>

    {{-- BANNER --}}
    <section class="banner" style="position: relative; height: 320px; border-bottom: 6px solid #3a5a8c; overflow: hidden; background: #e3eaf7;">
        <img src="/images/application.png" alt="Application Banner" style="width: 100%; height: 100%; object-fit: cover; display: block; filter: blur(4px) brightness(0.85);">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: flex-start; z-index: 2;">
            <div class="banner-content" style="background: #fff; padding: 36px 110px; border-radius: 6px; margin-left: 80px; display: flex; align-items: center; justify-content: center; height: 180px; box-shadow: 0 4px 24px rgba(0,0,0,0.10);">
                <span style="font-size: 62px; font-weight: bold; color: #002c77; letter-spacing: 2px; text-align: center; display: block;">Application<br>Form</span>
            </div>
        </div>
    </section>


    {{-- FORM --}}
    <main style="display: flex; justify-content: center; align-items: flex-start; min-height: 100vh; padding: 48px 0;">
        <div class="form-container" style="max-width: 980px; width: 100%; background: #fff; border-radius: 18px; box-shadow: 0 8px 32px rgba(0,0,0,0.18); padding: 38px 38px 24px 38px; margin-top: 32px;">

        {{-- Header with logo --}}
        <div class="form-header" style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 18px;">
            <div class="form-header-left" style="display: flex; align-items: center; gap: 18px;">
                <img src="/images/uddlogo.png" alt="UDD Seal" class="university-logo" style="width: 80px; height: 80px; object-fit: contain; display: block;">
                <div class="university-name" style="font-size: 19px; font-weight: bold; color: #1a237e; line-height: 1.2;">
                    UNIVERSIDAD DE DAGUPAN<br>
                    <span style="font-size: 14px; font-weight: normal; color: #333;">(formerly Colegio de Dagupan)</span>
                </div>
            </div>
            <div class="form-header-right" style="text-align: right; font-size: 15px; font-weight: bold; line-height: 1.4; margin-left: auto;">
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
            <div class="personal-section" style="display: grid; grid-template-columns: 2fr 1fr; gap: 38px; align-items: flex-start; margin-bottom: 0;">
                <div>
                    <h3 class="section-title" style="font-size: 24px; font-family: 'Times New Roman', Times, serif; font-weight: bold; margin-bottom: 8px; margin-top: 18px; text-align: left;">Personal Information</h3>
                       <div style="display: flex; gap: 18px; margin-bottom: 8px;">
                           <div style="flex: 2;">
                               <label style="font-size: 16px; font-weight: bold; text-align: left;">Student’s Name:</label>
                               <input type="text" name="student_name" required style="width: 100%; border: 1.5px solid #888; border-radius: 6px; padding: 7px 12px; font-size: 15px; background: #fff;">
                           </div>
                       </div>
                       <div class="form-grid-3" style="display: flex; gap: 18px; margin-bottom: 8px;">
                           <div class="form-field" style="flex: 1;">
                               <label class="form-label" style="font-size: 16px; font-weight: bold; text-align: left;">Course:</label>
                               <select name="course" required class="form-select" style="width: 100%; border: 1.5px solid #888; border-radius: 6px; font-size: 15px; background: #fff; appearance: auto;">
                                   <option value="">Select</option>
                                   <option value="SOH">SOH</option>
                                   <option value="STE">STE</option>
                                   <option value="SBA">SBA</option>
                                   <option value="SOHS">SOHS</option>
                                   <option value="SOE">SOE</option>
                                   <option value="SITE">SITE</option>
                                   <option value="SIHM">SIHM</option>
                                   <option value="SOC">SOC</option>
                               </select>
                           </div>
                           <div class="form-field" style="flex: 1;">
                               <label class="form-label" style="font-size: 16px; font-weight: bold; text-align: left;">Year Level:</label>
                               <select name="year_level" required class="form-select" style="width: 100%; border: 1.5px solid #888; border-radius: 6px; font-size: 15px; background: #fff; appearance: auto;">
                                   <option value="">Select</option>
                                   <option>First Year</option>
                                   <option>Second Year</option>
                                   <option>Third Year</option>
                                   <option>Fourth Year</option>
                                   <option>Fifth Year</option>
                               </select>
                           </div>
                           <div class="form-field" style="flex: 1;">
                               <label class="form-label" style="font-size: 16px; font-weight: bold; text-align: left;">Age:</label>
                               <input type="text" name="age" required class="form-input" style="width: 100%; border: 1.5px solid #888; border-radius: 6px; padding: 7px 12px; font-size: 15px; background: #fff;">
                           </div>
                           <div class="form-field" style="flex: 1;">
                               <label class="form-label" style="font-size: 16px; font-weight: bold; text-align: left;">ID Number:</label>
                               <input type="text" name="id_number" required pattern="[0-9]{2}-[0-9]{4}-[0-9]{3}" title="Format: 22-0313-407" class="form-input" style="width: 100%; border: 1.5px solid #888; border-radius: 6px; padding: 7px 12px; font-size: 15px; background: #fff;">
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
                <div class="photo-section" style="display: flex; flex-direction: column; align-items: center; justify-content: flex-start;">
                    <div class="photo-container" style="width: 320px; height: 300px; position: relative; margin-bottom: 0; border: 2px solid #222; background: #f6f2f2; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <img id="profile-preview" style="width: 100%; height: 100%; object-fit: cover; border-radius: 0; display: none; position: absolute; top: 0; left: 0;">
                        <span id="picturePreviewLabel" style="font-size: 38px; font-family: 'Segoe UI', Arial, sans-serif; color: #222; letter-spacing: 4px; text-align: center; font-weight: 500; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">Upload<br>Photo</span>
                        <button type="button" id="cameraBtn" style="position: absolute; bottom: 12px; right: 12px; background: #fff; border-radius: 8px; border: 2px solid #23408e; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.10); cursor: pointer;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#23408e" stroke-width="2">
                                <rect x="3" y="7" width="18" height="12" rx="3" fill="#eaeaea" stroke="#23408e"/>
                                <circle cx="12" cy="13" r="4" fill="#fff" stroke="#23408e"/>
                                <rect x="8" y="3" width="8" height="4" rx="2" fill="#eaeaea" stroke="#23408e"/>
                            </svg>
                        </button>
                        <input type="file" name="picture" id="pictureInput" accept="image/*" style="display:none;">
                        <input type="hidden" name="cropped_picture" id="cropped-picture">
                        <div id="photoError" style="display:none; color:#ef4444; font-size:15px; font-weight:bold; position:absolute; bottom:60px; left:0; right:0; text-align:center; background:rgba(255,255,255,0.95); padding:6px 0; border-radius:6px; z-index:10;">Please fill up this field.</div>
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
                <div class="form-grid-3" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 8px;">
                    <div>
                        <label class="form-label" style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Father's Name:</label>
                        <input type="text" name="father_name" required class="form-input" style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                    </div>
                    <div>
                        <label class="form-label" style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Age:</label>
                        <input type="text" name="father_age" required class="form-input" style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                    </div>
                    <div>
                        <label class="form-label" style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Occupation:</label>
                        <input type="text" name="father_occupation" required class="form-input" style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                        <div style="margin-top: 6px;">
                            <input type="checkbox" name="father_deceased" value="1" id="father_deceased" style="margin-right: 8px;">
                            <label for="father_deceased" style="font-size: 14px; font-weight: normal;">Deceased</label>
                        </div>
                    </div>
                </div>
                <div class="form-grid-3" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 8px;">
                    <div>
                        <label class="form-label" style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Mother's Name:</label>
                        <input type="text" name="mother_name" required class="form-input" style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                    </div>
                    <div>
                        <label class="form-label" style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Age:</label>
                        <input type="text" name="mother_age" required class="form-input" style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                    </div>
                    <div>
                        <label class="form-label" style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Occupation:</label>
                        <input type="text" name="mother_occupation" required style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                        <div style="margin-top: 6px;">
                            <input type="checkbox" name="mother_deceased" value="1" id="mother_deceased" style="margin-right: 8px;">
                            <label for="mother_deceased" style="font-size: 14px; font-weight: normal;">Deceased</label>
                        </div>
                    </div>
                </div>
                <div style="margin-bottom: 8px;">
                    <label style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Monthly Household Income:</label>
                    <input type="text" name="monthly_income" required style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                </div>
                <hr style="border: 1.5px solid #222; margin: 16px 0;">

                <!-- Parent Consent -->
                <h3 style="font-size: 24px; font-weight: bold; margin-bottom: 8px; margin-top: 18px; font-family: Times New Roman, Times, serif;">Parent Consent</h3>
                <hr style="border: 1.5px solid #222; margin-bottom: 18px; margin-top: 0;">
                <div style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 6px; padding: 16px; margin-bottom: 16px;">
                    <p style="font-size: 14px; font-family: Times New Roman, Times, serif; margin-bottom: 12px; color: #495057;">
                        <strong>Step 1:</strong> Download the Parent Consent Form below and have your parent/guardian sign it.
                    </p>
                    @if(file_exists(storage_path('app/public/parentconsent/letter.pdf')))
                        <a href="{{ asset('storage/parentconsent/letter.pdf') }}" download style="display: inline-block; background: #007bff; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px; font-size: 14px; margin-bottom: 12px;">
                            📄 Download Parent Consent Form
                        </a>
                    @elseif(file_exists(storage_path('app/public/parentconsent/letter.docx')))
                        <a href="{{ asset('storage/parentconsent/letter.docx') }}" download style="display: inline-block; background: #007bff; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px; font-size: 14px; margin-bottom: 12px;">
                            📄 Download Parent Consent Form
                        </a>
                    @elseif(file_exists(storage_path('app/public/parentconsent/letter')))
                        <a href="{{ asset('storage/parentconsent/letter') }}" download style="display: inline-block; background: #007bff; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px; font-size: 14px; margin-bottom: 12px;">
                            📄 Download Parent Consent Form
                        </a>
                    @else
                        <p style="color: #dc3545; font-size: 14px; padding: 8px 16px; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 4px; margin-bottom: 12px;">
                            Parent consent form is not yet available. Please contact the administrator.
                        </p>
                    @endif
                    <p style="font-size: 14px; font-family: Times New Roman, Times, serif; margin-bottom: 12px; color: #495057;">
                        <strong>Step 2:</strong> Upload the signed consent form here:
                    </p>
                    <div style="margin-bottom: 8px;">
                        <label style="font-size: 16px; font-weight: bold; font-family: Times New Roman, Times, serif;">Upload Signed Consent Form:</label>
                        <input type="file" name="parent_consent" accept=".pdf,.jpg,.jpeg,.png" required style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; background: #f7f7f7;">
                        <small style="font-size: 12px; color: #6c757d; font-family: Times New Roman, Times, serif;">Accepted formats: PDF, JPG, JPEG, PNG (Max size: 5MB)</small>
                    </div>
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
                    <label>OTHER TALENTS/ SKILLS/ SOFT SKILLS/TECHNICAL SKILLS/HOBBIES, WRITE IT DOWN: (Optional)</label>
                    <textarea name="other_skills" style="width: 100%; border: 1px solid #b0b8d1; border-radius: 4px; padding: 6px; font-size: 15px; height: 60px; background: #f7f7f7;"></textarea>
                </div>
                <div style="text-align: right; margin-top: 18px;">
                    <button type="submit" class="submit-btn" style="padding: 8px 32px; font-size: 18px; background: #fff; color: #222; border: 2px solid #222; border-radius: 6px; font-weight: bold; cursor: pointer; font-family: Times New Roman, Times, serif; letter-spacing: 2px; transition: background 0.2s;">Submit</button>
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
            @page {
                size: A4;
                margin: 0.4in;
            }
            
            * {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                box-sizing: border-box !important;
            }
            
            body * {
                visibility: hidden !important;
            }
            
            /* Show only the print data */
            .print-container, .print-container * {
                visibility: visible !important;
            }
            
            .print-container {
                position: absolute !important;
                left: 0 !important;
                top: 0 !important;
                width: 100% !important;
                height: auto !important;
                padding: 12px !important;
                margin: 0 !important;
                background: #fff !important;
                font-family: 'Times New Roman', serif !important;
                font-size: 12px !important;
                color: #000 !important;
            }
            
            /* Hide original form when printing */
            #applicationForm {
                display: none !important;
                visibility: hidden !important;
            }
            
            /* Hide elements not needed for print */
            .header-bar, section, footer, nav,
            button, .modal-confirm-bg, .modal-confirm-box, 
            #modalPrint, #modalConfirm, #cropperModal {
                display: none !important;
                visibility: hidden !important;
            }
            
            /* Print layout styles */
            .print-header {
                display: flex !important;
                align-items: flex-start !important;
                justify-content: space-between !important;
                margin-bottom: 15px !important;
                border-bottom: 2px solid #000 !important;
                padding-bottom: 8px !important;
            }
            
            .print-header-left {
                display: flex !important;
                align-items: center !important;
                gap: 15px !important;
            }
            
            .print-header img {
                width: 60px !important;
                height: 60px !important;
            }
            
            .print-university-info {
                font-size: 14px !important;
                font-weight: bold !important;
                line-height: 1.3 !important;
            }
            
            .print-header-right {
                text-align: right !important;
                font-size: 11px !important;
                font-weight: bold !important;
                line-height: 1.4 !important;
            }
            
            .print-section {
                margin-bottom: 12px !important;
            }
            
            .print-section-title {
                font-size: 13px !important;
                font-weight: bold !important;
                margin-bottom: 8px !important;
                border-bottom: 1px solid #000 !important;
                padding-bottom: 3px !important;
            }
            
            .print-personal-layout {
                display: flex !important;
                gap: 20px !important;
                align-items: flex-start !important;
            }
            
            .print-personal-info {
                flex-grow: 1 !important;
            }
            
            .print-photo {
                width: 100px !important;
                height: 120px !important;
                border: 2px solid #000 !important;
                flex-shrink: 0 !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }
            
            .print-photo img {
                width: 100% !important;
                height: 100% !important;
                object-fit: cover !important;
            }
            
            .print-field {
                display: flex !important;
                margin-bottom: 6px !important;
                align-items: baseline !important;
            }
            
            .print-field-label {
                font-weight: bold !important;
                width: 140px !important;
                flex-shrink: 0 !important;
                font-size: 11px !important;
            }
            
            .print-field-value {
                border-bottom: 1px solid #000 !important;
                flex-grow: 1 !important;
                min-height: 16px !important;
                padding-left: 5px !important;
                font-size: 11px !important;
            }
            
            .print-grid-2 {
                display: grid !important;
                grid-template-columns: 1fr 1fr !important;
                gap: 15px !important;
                margin-bottom: 6px !important;
            }
            
            .print-grid-3 {
                display: grid !important;
                grid-template-columns: 1fr 1fr 1fr !important;
                gap: 12px !important;
                margin-bottom: 6px !important;
            }
            
            .print-checkbox {
                display: inline-block !important;
                width: 12px !important;
                height: 12px !important;
                border: 1px solid #000 !important;
                margin-right: 5px !important;
                position: relative !important;
                top: 2px !important;
            }
            
            .print-checkbox.checked::after {
                content: "✓" !important;
                position: absolute !important;
                top: -2px !important;
                left: 1px !important;
                font-size: 10px !important;
                font-weight: bold !important;
            }
            
            .print-radio {
                display: inline-block !important;
                width: 12px !important;
                height: 12px !important;
                border: 1px solid #000 !important;
                border-radius: 50% !important;
                margin-right: 5px !important;
                position: relative !important;
                top: 2px !important;
            }
            
            .print-radio.checked::after {
                content: "●" !important;
                position: absolute !important;
                top: -1px !important;
                left: 2px !important;
                font-size: 8px !important;
            }
            
            .print-questions {
                font-size: 11px !important;
                margin-top: 8px !important;
                line-height: 1.4 !important;
            }
            
            .print-question {
                margin-bottom: 4px !important;
            }
            
            #picturePreviewLabel {
                display: none !important;
            }
            
            /* Format grid layouts */
            div[style*="display: grid"] {
                display: grid !important;
                gap: 10px !important;
                margin-bottom: 10px !important;
            }
            
            div[style*="grid-template-columns: 2fr 1fr"] {
                grid-template-columns: 2fr 1fr !important;
            }
            
            div[style*="grid-template-columns: 2fr 1fr 1fr"] {
                grid-template-columns: 2fr 1fr 1fr !important;
            }
            
            /* Format horizontal rules */
            hr {
                border: 1px solid #000 !important;
                margin: 15px 0 !important;
                page-break-after: avoid !important;
            }
            
            /* Ensure proper page breaks */
            .page-break {
                page-break-before: always !important;
            }
            
            /* Format text areas */
            textarea {
                min-height: 60px !important;
                resize: none !important;
            }
            
            /* Hide specific elements that shouldn't print */
            span[id*="picturePreviewLabel"],
            button,
            .modal-confirm-bg,
            .modal-confirm-box {
                display: none !important;
                visibility: hidden !important;
            }
            
            /* Ensure proper font sizes */
            body, * {
                font-family: 'Times New Roman', serif !important;
                font-size: 12px !important;
                line-height: 1.4 !important;
            }
            
            h3 {
                font-size: 16px !important;
                font-weight: bold !important;
            }
            
            /* Format the university header */
            div[style*="font-size: 19px; font-weight: bold"] {
                font-size: 14px !important;
            }
            
            div[style*="text-align: right; font-size: 15px"] {
                font-size: 11px !important;
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
                var photoError = document.getElementById('photoError');
                photoError.style.display = 'block';
                setTimeout(function() { photoError.style.display = 'none'; }, 3000);
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
            createPrintLayout();
            setTimeout(function() {
                window.print();
                // After print dialog closes, redirect to show page
                setTimeout(function() {
                    window.location.href = '/apply/show';
                }, 1000);
            }, 100);
        });
        
        function createPrintLayout() {
            const form = document.getElementById('applicationForm');
            const formData = new FormData(form);
            
            // Get photo source
            const photoImg = document.getElementById('profile-preview');
            const photoSrc = photoImg && photoImg.style.display !== 'none' ? photoImg.src : '';
            
            // Check if parent consent file is uploaded
            const parentConsentFile = document.querySelector('input[name="parent_consent"]').files[0];
            const parentConsentStatus = parentConsentFile ? 'Uploaded' : 'Not uploaded';
            
            // Get tools
            const tools = [];
            const toolCheckboxes = document.querySelectorAll('input[name="tools[]"]:checked');
            toolCheckboxes.forEach(cb => {
                const toolNames = {
                    'office': 'Microsoft Office Suite',
                    'design': 'Design Software', 
                    'video_conf': 'Email & Video Conferencing',
                    'social': 'Social Media Platforms',
                    'cloud': 'Cloud Storage Services'
                };
                tools.push(toolNames[cb.value] || cb.value);
            });
            
            const printHTML = `
                <div class="print-container">
                    <div class="print-header">
                        <div class="print-header-left">
                            <img src="/images/uddlogo.png" alt="UDD Logo">
                            <div class="print-university-info">
                                UNIVERSIDAD DE DAGUPAN<br>
                                <span style="font-size: 9px; font-weight: normal;">(formerly Colegio de Dagupan)</span>
                            </div>
                        </div>
                        <div class="print-header-right">
                            Student Assistant Application Form<br>
                            UNIVERSIDAD DE DAGUPAN<br>
                            Arellano St., Dagupan City,<br>
                            Pangasinan
                        </div>
                    </div>
                    
                    <div class="print-section">
                        <div class="print-section-title">Personal Information</div>
                        <div class="print-personal-layout">
                            <div class="print-personal-info">
                                <div class="print-field">
                                    <span class="print-field-label">Student's Name:</span>
                                    <span class="print-field-value">${formData.get('student_name') || ''}</span>
                                </div>
                                <div class="print-grid-3">
                                    <div class="print-field">
                                        <span class="print-field-label">Course:</span>
                                        <span class="print-field-value">${formData.get('course') || ''}</span>
                                    </div>
                                    <div class="print-field">
                                        <span class="print-field-label">Year Level:</span>
                                        <span class="print-field-value">${formData.get('year_level') || ''}</span>
                                    </div>
                                    <div class="print-field">
                                        <span class="print-field-label">Age:</span>
                                        <span class="print-field-value">${formData.get('age') || ''}</span>
                                    </div>
                                </div>
                                <div class="print-field">
                                    <span class="print-field-label">ID Number:</span>
                                    <span class="print-field-value">${formData.get('id_number') || ''}</span>
                                </div>
                                <div class="print-field">
                                    <span class="print-field-label">Address:</span>
                                    <span class="print-field-value">${formData.get('address') || ''}</span>
                                </div>
                                <div class="print-grid-2">
                                    <div class="print-field">
                                        <span class="print-field-label">Email:</span>
                                        <span class="print-field-value">${formData.get('email') || ''}</span>
                                    </div>
                                    <div class="print-field">
                                        <span class="print-field-label">Telephone:</span>
                                        <span class="print-field-value">${formData.get('telephone') || ''}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="print-photo">
                                ${photoSrc ? `<img src="${photoSrc}" alt="Photo">` : '<span style="font-size: 8px; color: #999;">Photo</span>'}
                            </div>
                        </div>
                    </div>
                    
                    <div class="print-section">
                        <div class="print-section-title">Family Background</div>
                        <div class="print-grid-3">
                            <div class="print-field">
                                <span class="print-field-label">Father's Name:</span>
                                <span class="print-field-value">${formData.get('father_name') || ''}</span>
                            </div>
                            <div class="print-field">
                                <span class="print-field-label">Age:</span>
                                <span class="print-field-value">${formData.get('father_age') || ''}</span>
                            </div>
                            <div class="print-field">
                                <span class="print-field-label">Occupation:</span>
                                <span class="print-field-value">${formData.get('father_occupation') || ''} ${formData.get('father_deceased') ? '(Deceased)' : ''}</span>
                            </div>
                        </div>
                        <div class="print-grid-3">
                            <div class="print-field">
                                <span class="print-field-label">Mother's Name:</span>
                                <span class="print-field-value">${formData.get('mother_name') || ''}</span>
                            </div>
                            <div class="print-field">
                                <span class="print-field-label">Age:</span>
                                <span class="print-field-value">${formData.get('mother_age') || ''}</span>
                            </div>
                            <div class="print-field">
                                <span class="print-field-label">Occupation:</span>
                                <span class="print-field-value">${formData.get('mother_occupation') || ''} ${formData.get('mother_deceased') ? '(Deceased)' : ''}</span>
                            </div>
                        </div>
                        <div class="print-field">
                            <span class="print-field-label">Monthly Household Income:</span>
                            <span class="print-field-value">${formData.get('monthly_income') || ''}</span>
                        </div>
                    </div>
                    
                    <div class="print-section">
                        <div class="print-section-title">Parent Consent</div>
                        <div class="print-field">
                            <span class="print-field-label">Parent Consent Form:</span>
                            <span class="print-field-value">${parentConsentStatus}</span>
                        </div>
                    </div>
                    
                    <div class="print-section">
                        <div class="print-section-title">Computer Literacy & Skills Assessment</div>
                        <div class="print-field" style="margin-bottom: 6px;">
                            <span class="print-field-label">Computer Literate:</span>
                            <span class="print-radio ${formData.get('is_literate') === '1' ? 'checked' : ''}"></span> Yes
                            <span class="print-radio ${formData.get('is_literate') === '0' ? 'checked' : ''}"></span> No
                        </div>
                        
                        ${tools.length > 0 ? `
                        <div class="print-field">
                            <span class="print-field-label">Tools & Software:</span>
                            <span class="print-field-value" style="font-size: 9px;">${tools.join(', ')}</span>
                        </div>
                        ` : ''}
                        
                        <div class="print-questions">
                            <div class="print-question">
                                <strong>Can commit to minimum hours weekly:</strong>
                                <span class="print-checkbox ${formData.get('can_commit') === '1' ? 'checked' : ''}"></span> Yes
                                <span class="print-checkbox ${formData.get('can_commit') === '0' ? 'checked' : ''}"></span> No
                            </div>
                            <div class="print-question">
                                <strong>Willing to work overtime:</strong>
                                <span class="print-checkbox ${formData.get('willing_overtime') === '1' ? 'checked' : ''}"></span> Yes
                                <span class="print-checkbox ${formData.get('willing_overtime') === '0' ? 'checked' : ''}"></span> No
                            </div>
                            <div class="print-question">
                                <strong>Comfortable with clerical task:</strong>
                                <span class="print-checkbox ${formData.get('comfortable_clerical') === '1' ? 'checked' : ''}"></span> Yes
                                <span class="print-checkbox ${formData.get('comfortable_clerical') === '0' ? 'checked' : ''}"></span> No
                            </div>
                            <div class="print-question">
                                <strong>Strong communication skills:</strong>
                                <span class="print-checkbox ${formData.get('strong_communication') === '1' ? 'checked' : ''}"></span> Yes
                                <span class="print-checkbox ${formData.get('strong_communication') === '0' ? 'checked' : ''}"></span> No
                            </div>
                            <div class="print-question">
                                <strong>Willing to undergo training:</strong>
                                <span class="print-checkbox ${formData.get('willing_training') === '1' ? 'checked' : ''}"></span> Yes
                                <span class="print-checkbox ${formData.get('willing_training') === '0' ? 'checked' : ''}"></span> No
                            </div>
                        </div>
                        
                        ${formData.get('other_skills') ? `
                        <div class="print-field" style="margin-top: 4px;">
                            <span class="print-field-label">Other Skills:</span>
                            <span class="print-field-value">${formData.get('other_skills')}</span>
                        </div>
                        ` : ''}
                    </div>
                </div>
            `;
            
            // Insert print layout
            const body = document.body;
            const printDiv = document.createElement('div');
            printDiv.innerHTML = printHTML;
            body.appendChild(printDiv);
            
            // Clean up after printing
            window.addEventListener('afterprint', function() {
                if (printDiv.parentNode) {
                    printDiv.parentNode.removeChild(printDiv);
                }
            });
        }
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

<script>
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('active');
}

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const mobileMenu = document.getElementById('mobileMenu');
    const hamburger = document.querySelector('.hamburger');
    
    if (!hamburger.contains(event.target) && !mobileMenu.contains(event.target)) {
        mobileMenu.classList.remove('active');
    }
});

// Close mobile menu when window is resized to desktop
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        document.getElementById('mobileMenu').classList.remove('active');
    }
});
</script>

@endsection

@extends('layouts.app')

@section('content')
    @php
        $role = auth()->user()->role ?? null;
        $dashboardRoute = $role === 'admin' ? route('Admin') : ($role === 'head' ? route('Head') : ($role === 'student' ? route('Student') : '/'));
    @endphp
    <a href="{{ $dashboardRoute }}" class="back-btn">&#8592; Back to Dashboard</a>
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        margin: 0;
        font-family: 'Inter', sans-serif;
    }

    .profile-wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar */
    .profile-sidebar {
        width: 260px;
        background: #fff;
        border-right: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
        padding: 20px;
        position: relative;
    }
    
    .sidebar-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .sidebar-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 12px;
        display: block;
        border: 3px solid #e5e7eb;
    }
    
    .sidebar-name {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 4px;
    }
    
    .sidebar-email {
        font-size: 0.9rem;
        color: #6b7280;
    }
    
    .sidebar-nav {
        flex: 1;
        margin-top: 20px;
    }
    
    .nav-item {
        padding: 12px;
        font-weight: 600;
        color: #374151;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
        margin-bottom: 4px;
    }
    
    .nav-item:hover {
        background: #f3f4f6;
        color: #2563eb;
    }
    
    .nav-item.active {
        background: #e0e7ff;
        color: #4338ca;
    }
    
    .sidebar-footer {
        margin-top: auto;
        padding-top: 20px;
    }
    
    .btn-logout {
        width: 100%;
        background: linear-gradient(90deg, #ef4444, #dc2626);
        color: white;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        text-align: center;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
        display: block;
    }
    
    .btn-logout:hover {
        background: linear-gradient(90deg, #b91c1c, #dc2626);
        color: white;
        text-decoration: none;
    }

    /* Main content */
    .profile-content {
        flex: 1;
        background: #f9fafb;
        padding: 40px;
        overflow-y: auto;
    }
    
    .tab-content {
        display: none;
    }
    
    .tab-content.active {
        display: block;
    }
    
    .tab-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: #1f2937;
    }

    /* Cards */
    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }
    
    .profile-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .profile-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .profile-card h3 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 12px;
        color: #1e3a8a;
    }
    
    .profile-card p {
        margin: 6px 0;
        color: #374151;
        line-height: 1.5;
    }

    /* Forms */
    .form-container {
        background: #fff;
        border-radius: 14px;
        padding: 30px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }
    
    .form-group {
        margin-bottom: 18px;
    }
    
    .form-group label {
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
        color: #374151;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }
    
    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79,70,229,0.2);
        outline: none;
    }

    .btn-primary {
        background: linear-gradient(90deg, #4f46e5, #3b82f6);
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .btn-primary:hover {
        background: linear-gradient(90deg, #4338ca, #2563eb);
    }

    .section-divider {
        border: none;
        height: 1px;
        background: #e5e7eb;
        margin: 30px 0;
    }

    /* Alert styles */
    .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }
    
    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-wrapper {
            flex-direction: column;
        }
        
        .profile-sidebar {
            width: 100%;
            padding: 15px;
        }
        
        .profile-content {
            padding: 20px;
        }
        
        .card-grid {
            grid-template-columns: 1fr;
        }
    }

    .back-btn {
        position: fixed;
        top: 24px;
        right: 32px;
        z-index: 100;
        background: linear-gradient(90deg, #4f46e5, #3b82f6);
        color: white;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: background 0.2s;
        border: none;
        display: inline-block;
    }

    .back-btn:hover {
        background: linear-gradient(90deg, #4338ca, #2563eb);
        color: #fff;
        text-decoration: none;
    }
</style>

<div class="profile-wrapper">
    <!-- Sidebar -->

    <div class="profile-sidebar">
        <div class="sidebar-header">
            <div style="position:relative;">
                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="{{ auth()->user()->name }}" class="sidebar-avatar" style="box-shadow:0 4px 16px rgba(79,70,229,0.12);">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=667eea&color=fff&size=100" alt="{{ auth()->user()->name }}" class="sidebar-avatar" style="box-shadow:0 4px 16px rgba(79,70,229,0.12);">
                @endif
            </div>

            <div class="sidebar-name" style="margin-top:8px;">{{ auth()->user()->name }}</div>
            <div class="sidebar-email">{{ auth()->user()->email }}</div>
        </div>
        <div class="sidebar-nav">
            <div class="nav-item active" data-tab="overview"><svg style="vertical-align:middle;margin-right:8px;" width="18" height="18" fill="none" stroke="#374151" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> Overview</div>
            <div class="nav-item" data-tab="edit"><svg style="vertical-align:middle;margin-right:8px;" width="18" height="18" fill="none" stroke="#374151" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg> Edit Profile</div>
            <div class="nav-item" data-tab="security"><svg style="vertical-align:middle;margin-right:8px;" width="18" height="18" fill="none" stroke="#374151" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg> Security</div>
            <div class="nav-item" data-tab="settings"><svg style="vertical-align:middle;margin-right:8px;" width="18" height="18" fill="none" stroke="#374151" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h.09a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51h.09a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v.09a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg> Settings</div>
        </div>
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout" style="display:flex;align-items:center;justify-content:center;gap:8px;">
                    <svg width="18" height="18" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7"/><rect x="3" y="4" width="8" height="16" rx="2"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="profile-content">
        @if (session('status'))
            <div class="alert alert-success">
                @if(session('status') === 'profile-updated')
                    Profile updated successfully.
                @elseif(session('status') === 'password-updated')
                    Password updated successfully.
                @else
                    {{ session('status') }}
                @endif
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Overview Tab -->
        <div id="overview-tab" class="tab-content active">
            <div class="tab-title" style="display:flex;align-items:center;gap:10px;">
                <svg width="28" height="28" fill="none" stroke="#4f46e5" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                Profile Overview
            </div>
            <div class="card-grid">
                <div class="profile-card" style="transition:box-shadow 0.2s;">
                    <h3 style="display:flex;align-items:center;gap:6px;"><svg width="18" height="18" fill="none" stroke="#1e3a8a" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0 1 13 0"/></svg> Personal Information</h3>
                    <p><strong>Full Name:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Member Since:</strong> {{ auth()->user()->created_at->format('F j, Y') }}</p>
                </div>
                <div class="profile-card" style="transition:box-shadow 0.2s;">
                    <h3 style="display:flex;align-items:center;gap:6px;"><svg width="18" height="18" fill="none" stroke="#1e3a8a" stroke-width="2" viewBox="0 0 24 24"><path d="M3 3v18h18"/><path d="M8 17l4-4-4-4"/></svg> Account Activity</h3>
                    <p><strong>Last Login:</strong> {{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('M j, Y g:i A') : 'N/A' }}</p>
                    <p><strong>Profile Updated:</strong> {{ auth()->user()->updated_at->format('F j, Y') }}</p>
                    <p><strong>Account Status:</strong> <span style="color: #059669; font-weight: 600;">Active</span></p>
                </div>
                <div class="profile-card" style="transition:box-shadow 0.2s;">
                    <h3 style="display:flex;align-items:center;gap:6px;"><svg width="18" height="18" fill="none" stroke="#1e3a8a" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5A6.5 6.5 0 0 1 12 2a6.5 6.5 0 0 1 10 6.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg> Profile Completion</h3>
                    <p><strong>Progress:</strong> {{ auth()->user()->profile_photo ? '100%' : '80%' }}</p>
                    <p><strong>Photo:</strong> {{ auth()->user()->profile_photo ? 'Uploaded' : 'Not uploaded' }}</p>
                    <p><strong>Email Verified:</strong> {{ auth()->user()->email_verified_at ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>

        <!-- Edit Profile Tab -->
        <div id="edit-tab" class="tab-content">
            <div class="tab-title" style="display:flex;align-items:center;gap:10px;">
                <svg width="28" height="28" fill="none" stroke="#4f46e5" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
                Edit Profile
            </div>
            <div class="form-container" style="box-shadow:0 4px 24px rgba(79,70,229,0.08);">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}" required autocomplete="name" style="font-size:1.1rem;">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" required autocomplete="email" style="font-size:1.1rem;">
                    </div>
                    <div class="form-group">
                        <label for="profile_photo">Profile Photo</label>
                        <div style="width: 320px; height: 300px; position: relative; margin-bottom: 0; border: 2px solid #222; background: #f6f2f2; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius:16px; box-shadow:0 2px 12px rgba(0,0,0,0.05);">
                            <img id="profile-preview" src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : '' }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 16px; display: {{ auth()->user()->profile_photo ? 'block' : 'none' }}; position: absolute; top: 0; left: 0;">
                            <span id="picturePreviewLabel" style="font-size: 38px; font-family: 'Segoe UI', Arial, sans-serif; color: #222; letter-spacing: 4px; text-align: center; font-weight: 500; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); {{ auth()->user()->profile_photo ? 'display:none;' : '' }}">Upload<br>Photo</span>
                            <button type="button" id="cameraBtn" style="position: absolute; bottom: 12px; right: 12px; background: #fff; border-radius: 8px; border: 2px solid #23408e; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.10); cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#23408e" stroke-width="2">
                                    <rect x="3" y="7" width="18" height="12" rx="3" fill="#eaeaea" stroke="#23408e"/>
                                    <circle cx="12" cy="13" r="4" fill="#fff" stroke="#23408e"/>
                                    <rect x="8" y="3" width="8" height="4" rx="2" fill="#eaeaea" stroke="#23408e"/>
                                </svg>
                            </button>
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" style="display:none;">
                            <input type="hidden" name="cropped_profile_photo" id="cropped-profile-photo">
                        </div>
                        <!-- Modal for cropping -->
                        <div id="cropperModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
                            <div style="background:#fff; padding:24px; border-radius:8px; box-shadow:0 2px 16px rgba(0,0,0,0.18); min-width:340px; max-width:95vw; text-align:center; position:relative;">
                                <span style="position:absolute; top:12px; right:18px; font-size:28px; cursor:pointer;" onclick="closeModal()">&times;</span>
                                <h3 style="margin-bottom:12px;">Edit Profile Photo</h3>
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
                        <small style="color: #6b7280; margin-top: 4px; display: block;">
                            Supported formats: JPG, PNG, GIF (max 2MB)
                        </small>
<!-- Cropper.js CSS & JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
let cropper;
const profilePhotoInput = document.getElementById('profile_photo');
const cameraBtn = document.getElementById('cameraBtn');
const profilePreview = document.getElementById('profile-preview');
const picturePreviewLabel = document.getElementById('picturePreviewLabel');
const cropperModal = document.getElementById('cropperModal');
const modalImage = document.getElementById('modal-image');
cameraBtn.addEventListener('click', function() {
    profilePhotoInput.click();
});
profilePhotoInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
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
        document.getElementById('cropped-profile-photo').value = dataUrl;
        profilePreview.src = dataUrl;
        profilePreview.style.display = 'block';
        picturePreviewLabel.style.display = 'none';
        cropperModal.style.display = 'none';
        cropper.destroy();
    }
}
function closeModal() {
    cropperModal.style.display = 'none';
    if (!document.getElementById('cropped-profile-photo').value) {
        profilePreview.style.display = 'none';
        picturePreviewLabel.style.display = 'block';
    }
    if (cropper) cropper.destroy();
}
</script>
                    </div>

                    <button type="submit" class="btn-primary">Save Changes</button>
                </form>
            </div>
        </div>

        <!-- Security Tab -->
        <div id="security-tab" class="tab-content">
            <div class="tab-title" style="display:flex;align-items:center;gap:10px;">
                <svg width="28" height="28" fill="none" stroke="#4f46e5" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Security Settings
            </div>
            <div class="form-container" style="box-shadow:0 4px 24px rgba(79,70,229,0.08);">
                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <div style="position:relative;">
                            <input type="password" id="current_password" class="form-control" name="current_password" required style="padding-right:32px;">
                            <span class="toggle-password" data-target="current_password" style="position:absolute; right:8px; top:50%; transform:translateY(-50%); cursor:pointer; font-size:1.2rem;">
                                <svg width="20" height="20" fill="none" stroke="#374151" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <div style="position:relative;">
                            <input type="password" id="password" class="form-control" name="password" required style="padding-right:32px;">
                            <span class="toggle-password" data-target="password" style="position:absolute; right:8px; top:50%; transform:translateY(-50%); cursor:pointer; font-size:1.2rem;">
                                <svg width="20" height="20" fill="none" stroke="#374151" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <div style="position:relative;">
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required style="padding-right:32px;">
                            <span class="toggle-password" data-target="password_confirmation" style="position:absolute; right:8px; top:50%; transform:translateY(-50%); cursor:pointer; font-size:1.2rem;">
                                <svg width="20" height="20" fill="none" stroke="#374151" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary">Update Password</button>
                </form>
            </div>
        </div>

        <!-- Settings Tab -->
        <div id="settings-tab" class="tab-content">
            <div class="tab-title" style="display:flex;align-items:center;gap:10px;">
                <svg width="28" height="28" fill="none" stroke="#4f46e5" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h.09a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51h.09a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v.09a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                Account Settings
            </div>
            <div class="card-grid">
                <div class="profile-card" style="transition:box-shadow 0.2s;">
                    <h3 style="display:flex;align-items:center;gap:6px;"><svg width="18" height="18" fill="none" stroke="#1e3a8a" stroke-width="2" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0 0 18 15V11a6 6 0 1 0-12 0v4c0 .386-.149.735-.405 1.005L4 17h5"/></svg> Notifications</h3>
                    <p>Email notifications: <span style="color:#059669;font-weight:600;">Enabled</span></p>
                    <p>Push notifications: <span style="color:#991b1b;font-weight:600;">Disabled</span></p>
                    <p>Marketing emails: <span style="color:#059669;font-weight:600;">Enabled</span></p>
                </div>
                <div class="profile-card" style="transition:box-shadow 0.2s;">
                    <h3 style="display:flex;align-items:center;gap:6px;"><svg width="18" height="18" fill="none" stroke="#1e3a8a" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg> Privacy</h3>
                    <p>Profile visibility: <span style="color:#2563eb;font-weight:600;">Public</span></p>
                    <p>Activity status: <span style="color:#059669;font-weight:600;">Visible</span></p>
                    <p>Data sharing: <span style="color:#991b1b;font-weight:600;">Limited</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching logic (restored)
    const navItems = document.querySelectorAll('.nav-item');
    const tabContents = document.querySelectorAll('.tab-content');
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            navItems.forEach(nav => nav.classList.remove('active'));
            tabContents.forEach(tab => tab.classList.remove('active'));
            this.classList.add('active');
            document.getElementById(targetTab + '-tab').classList.add('active');
        });
    });

    // Password show/hide toggle
    document.querySelectorAll('.toggle-password').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            var input = document.getElementById(this.getAttribute('data-target'));
            input.type = input.type === 'password' ? 'text' : 'password';
        });
    });
});
</script>
@endsection
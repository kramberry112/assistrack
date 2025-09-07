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
            @if(auth()->user()->profile_photo)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                     alt="{{ auth()->user()->name }}" 
                     class="sidebar-avatar">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=667eea&color=fff&size=100" 
                     alt="{{ auth()->user()->name }}" 
                     class="sidebar-avatar">
            @endif
            <div class="sidebar-name">{{ auth()->user()->name }}</div>
            <div class="sidebar-email">{{ auth()->user()->email }}</div>
        </div>
        
        <div class="sidebar-nav">
            <div class="nav-item active" data-tab="overview">Overview</div>
            <div class="nav-item" data-tab="edit">Edit Profile</div>
            <div class="nav-item" data-tab="security">Security</div>
            <div class="nav-item" data-tab="settings">Settings</div>
        </div>
        
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Sign Out</button>
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
            <div class="tab-title">Profile Overview</div>
            <div class="card-grid">
                <div class="profile-card">
                    <h3>Personal Information</h3>
                    <p><strong>Full Name:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Member Since:</strong> {{ auth()->user()->created_at->format('F j, Y') }}</p>
                </div>
                <div class="profile-card">
                    <h3>Account Activity</h3>
                    <p><strong>Last Login:</strong> {{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('M j, Y g:i A') : 'N/A' }}</p>
                    <p><strong>Profile Updated:</strong> {{ auth()->user()->updated_at->format('F j, Y') }}</p>
                    <p><strong>Account Status:</strong> <span style="color: #059669; font-weight: 600;">Active</span></p>
                </div>
                <div class="profile-card">
                    <h3>Profile Completion</h3>
                    <p><strong>Progress:</strong> {{ auth()->user()->profile_photo ? '100%' : '80%' }}</p>
                    <p><strong>Photo:</strong> {{ auth()->user()->profile_photo ? 'Uploaded' : 'Not uploaded' }}</p>
                    <p><strong>Email Verified:</strong> {{ auth()->user()->email_verified_at ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>

        <!-- Edit Profile Tab -->
        <div id="edit-tab" class="tab-content">
            <div class="tab-title">Edit Profile</div>
            <div class="form-container">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" class="form-control" name="name" 
                               value="{{ old('name', auth()->user()->name) }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" class="form-control" name="email" 
                               value="{{ old('email', auth()->user()->email) }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="profile_photo">Profile Photo</label>
                        <input type="file" id="profile_photo" class="form-control" name="profile_photo" 
                               accept="image/*">
                        <small style="color: #6b7280; margin-top: 4px; display: block;">
                            Supported formats: JPG, PNG, GIF (max 2MB)
                        </small>
                    </div>

                    <button type="submit" class="btn-primary">Save Changes</button>
                </form>
            </div>
        </div>

        <!-- Security Tab -->
        <div id="security-tab" class="tab-content">
            <div class="tab-title">Security Settings</div>
            <div class="form-container">
                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <div style="position:relative;">
                            <input type="password" id="current_password" class="form-control" name="current_password" required style="padding-right:32px;">
                            <span class="toggle-password" data-target="current_password" style="position:absolute; right:8px; top:50%; transform:translateY(-50%); cursor:pointer; font-size:1.2rem;">&#128065;</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <div style="position:relative;">
                            <input type="password" id="password" class="form-control" name="password" required style="padding-right:32px;">
                            <span class="toggle-password" data-target="password" style="position:absolute; right:8px; top:50%; transform:translateY(-50%); cursor:pointer; font-size:1.2rem;">&#128065;</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <div style="position:relative;">
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required style="padding-right:32px;">
                            <span class="toggle-password" data-target="password_confirmation" style="position:absolute; right:8px; top:50%; transform:translateY(-50%); cursor:pointer; font-size:1.2rem;">&#128065;</span>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary">Update Password</button>
                </form>
            </div>
        </div>

        <!-- Settings Tab -->
        <div id="settings-tab" class="tab-content">
            <div class="tab-title">Account Settings</div>
            <div class="card-grid">
                <div class="profile-card">
                    <h3>Notifications</h3>
                    <p>Email notifications: Enabled</p>
                    <p>Push notifications: Disabled</p>
                    <p>Marketing emails: Enabled</p>
                </div>
                <div class="profile-card">
                    <h3>Privacy</h3>
                    <p>Profile visibility: Public</p>
                    <p>Activity status: Visible</p>
                    <p>Data sharing: Limited</p>
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
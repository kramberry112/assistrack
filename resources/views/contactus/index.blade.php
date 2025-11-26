@extends('layouts.app')
@section('title', 'Contact Us')
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
    
    /* Header */
    .header-bar {
        background: #eaeaea;
        color: #1a237e;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 24px;
        height: 56px;
        position: relative;
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

    /* Contact */
    .contact-header {
        background: linear-gradient(90deg, #23408e, #4a6ba3);
        color: #fff;
        font-size: 36px;
        font-weight: 700;
        text-align: center;
        padding: 30px 0;
        margin-bottom: 40px;
        letter-spacing: 1px;
    }
    .contact-section {
        background: #f0f3fa;
        padding: 60px 20px;
        display: flex;
        justify-content: center;
    }
    .contact-wrapper {
        max-width: 1200px;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }
    .contact-container {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 18px;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
        padding: 36px 28px;
        display: flex;
        flex-direction: column;
        gap: 22px;
    }
    .contact-title {
        font-size: 24px;
        font-weight: 700;
        color: #23408e;
        margin-bottom: 6px;
    }
    .contact-details {
        font-size: 16px;
        color: #555;
    }
    .contact-icons {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .contact-icon {
        display: flex;
        gap: 14px;
        font-size: 17px;
        color: #23408e;
    }
    .contact-icon .icon {
        font-size: 22px;
        margin-top: 2px;
    }
    .contact-label {
        font-weight: 600;
        display: block;
        margin-bottom: 2px;
    }
    .contact-link {
        color: #23408e;
        text-decoration: none;
        font-weight: 500;
    }
    .contact-link:hover {
        text-decoration: underline;
    }
    .map-container {
        width: 100%;
        height: 100%;
        min-height: 400px;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
    }

    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        .header-bar {
            flex-wrap: wrap;
            position: relative;
            padding: 0 16px;
            height: auto;
            min-height: 56px;
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
        
        .contact-header {
            font-size: 28px;
            padding: 20px 16px;
        }
        
        .contact-section {
            padding: 40px 16px;
        }
        
        .contact-wrapper {
            grid-template-columns: 1fr;
            gap: 24px;
        }
        
        .contact-container {
            padding: 24px 20px;
        }
        
        .contact-title {
            font-size: 20px;
        }
        
        .map-container {
            min-height: 250px;
        }
    }
    
    @media (max-width: 480px) {
        .header-bar {
            padding: 0 12px;
        }
        
        .logo-text {
            font-size: 14px !important;
        }
        
        .contact-header {
            font-size: 24px;
            padding: 16px 12px;
        }
        
        .contact-section {
            padding: 32px 12px;
        }
        
        .contact-wrapper {
            gap: 20px;
        }
        
        .contact-container {
            padding: 20px 16px;
        }
        
        .contact-title {
            font-size: 18px;
        }
        
        .contact-details {
            font-size: 15px;
        }
        
        .contact-icon {
            font-size: 15px;
        }
        
        .contact-icon .icon {
            font-size: 20px;
        }
        
        .map-container {
            min-height: 200px;
        }
    }
    
    @media (max-width: 992px) {
        .contact-wrapper {
            grid-template-columns: 1fr;
        }
        .map-container {
            min-height: 300px;
        }
    }
</style>

    <!-- Header with Logo and Nav -->
    <div class="header-bar">
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

<div class="contact-header">Contact Us</div>

<div class="contact-section">
    <div class="contact-wrapper">
        <!-- Contact Info -->
        <div class="contact-container">
            <h2 class="contact-title">Contact Information</h2>
            <p class="contact-details">We’d love to hear from you! Reach us through the details below.</p>
            
            <div class="contact-icons">
                <div class="contact-icon">
                    <span class="icon">&#128222;</span>
                    <div>
                        <span class="contact-label">Phone:</span>
                        <span>(075) 522-2405 | 522-0143</span>
                    </div>
                </div>
                <div class="contact-icon">
                    <span class="icon">&#9993;</span>
                    <div>
                        <span class="contact-label">Email:</span>
                        <span>info@cdd.edu.ph</span>
                    </div>
                </div>
                <div class="contact-icon">
                    <span class="icon">&#127760;</span>
                    <div>
                        <span class="contact-label">Website:</span>
                        <a href="https://udd.edu.ph/" class="contact-link" target="_blank" rel="noopener">www.udd.edu.ph</a>
                    </div>
                </div>
                <div class="contact-icon">
                    <span class="icon">&#128205;</span>
                    <div>
                        <span class="contact-label">Address:</span>
                        <span>Arellano Street, Dagupan City, Philippines 2400</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Map -->
        <div class="map-container" style="border-radius:18px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,0.10); min-height:350px;">
            <iframe 
                src="https://www.google.com/maps?q=Universidad+de+Dagupan,+Arellano+Street,+Dagupan+City,+Philippines+2400&output=embed"
                width="100%" height="100%" style="border:0; width:100%; height:100%; display:block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
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



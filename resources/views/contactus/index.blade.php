@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')

    <!-- Header with Logo and Nav -->
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
                        <a href="mailto:info@cdd.edu.ph" class="contact-link">info@cdd.edu.ph</a>
                    </div>
                </div>
                <div class="contact-icon">
                    <span class="icon">&#127760;</span>
                    <div>
                        <span class="contact-label">Website:</span>
                        <a href="https://www.cdd.edu.ph" class="contact-link" target="_blank">www.cdd.edu.ph</a>
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

@endsection

<style>
/* Header */
.header-bar {
    background: #f5f6fa;
    color: #1a237e;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 24px;
    height: 70px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    position: sticky;
    top: 0;
    z-index: 1000;
}
.logo {
    display: flex;
    align-items: center;
}
.logo img {
    height: 48px;
    width: 48px;
    margin-right: 12px;
}
.logo-text {
    font-size: 20px;
    font-weight: 700;
    color: #1a237e;
    letter-spacing: 1px;
}
nav {
    display: flex;
    gap: 24px;
}
nav a {
    color: #23408e;
    font-weight: 600;
    font-size: 16px;
    text-decoration: none;
    padding-bottom: 3px;
    transition: 0.2s;
}
nav a:hover,
nav a.active {
    color: #0d1b4c;
    border-bottom: none;
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

/* Responsive */
@media (max-width: 992px) {
    .contact-wrapper {
        grid-template-columns: 1fr;
    }
    .map-container {
        min-height: 300px;
    }
}
</style>

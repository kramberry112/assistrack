<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad de Dagupan </title>
    <style>
@keyframes swipeLeft {
    from {
        opacity: 0;
        transform: translateX(80px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

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



        .header-bar {
            background: #eaeaea;
            color: #1a237e;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            height: 56px;
            position: relative;
            width: 100%;
            max-width: 100vw;
            box-sizing: border-box;
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
        .banner {
            position: relative;
            height: 420px;
            background: url('{{ asset('images/background.png') }}') no-repeat center center;
            background-size: cover;
            overflow: hidden;
            border-bottom: 6px solid #3a5a8c;
            width: 100%;
            max-width: 100vw;
            margin: 0;
            box-sizing: border-box;
        }
        .banner-bg {
            display: none;
        }
        .main-content {
            background: #fff;
            padding: 0;
            width: 100%;
            max-width: 100vw;
            margin: 0;
            overflow-x: hidden;
            box-sizing: border-box;
        }
        
        /* Mobile main content adjustments */
        @media (max-width: 768px) {
            .main-content {
                padding: 16px 0 !important;
            }
        }
        
        @media (max-width: 480px) {
            .main-content {
                padding: 12px 0 !important;
            }
        }
        * {
            box-sizing: border-box;
        }
        
        html, body { 
            background: #fff; 
            margin: 0; 
            padding: 0;
            width: 100%;
            overflow-x: hidden;
            font-family: 'Segoe UI', Arial, sans-serif; 
        }
        
        .container {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 0 32px;
            box-sizing: border-box;
        }
        
        .white-box {
            background: none;
            border-radius: 0;
            margin: 0 auto;
            max-width: 1200px;
            width: 100%;
            padding: 0 32px;
            box-shadow: none;
            box-sizing: border-box;
        }
        
        .divider {
            width: 100%;
            height: 1px;
            background: #eaeaea;
            margin: 32px 0;
            border: none;
        }
        .section-header {
            background: #23408e;
            color: #fff;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            padding: 12px 0;
            border-radius: 8px;
            margin-bottom: 24px;
            letter-spacing: 1px;
        }
        .about-row {
            display: flex;
            gap: 32px;
            align-items: flex-start;
            margin-bottom: 32px;
        }
        .about-left {
            flex: 1;
        }
        .about-left .about-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .about-left .about-desc {
            font-size: 15px;
            color: #222;
            line-height: 1.5;
        }
        .about-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .about-right img {
            width: 320px;
            height: 180px;
            max-width: 100%;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #dbeafe;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            box-sizing: border-box;
        }
        .grid-row {
            display: flex;
            gap: 24px;
            margin-bottom: 32px;
        }
        .grid-item {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            border: 1px solid #dbeafe;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 12px;
        }
        .grid-item img {
            width: 220px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 8px;
        }
        .grid-item .caption {
            font-size: 15px;
            color: #222;
            text-align: center;
        }
        .more-btn {
            background: #23408e;
            color: #fff;
            font-weight: bold;
            border-radius: 6px;
            padding: 8px 24px;
            font-size: 15px;
            border: none;
            text-decoration: none;
            display: inline-block;
            margin: 0 auto;
            margin-bottom: 12px;
        }
        .footer {
            background: #23408e;
            color: #fff;
            text-align: center;
            font-size: 13px;
            padding: 18px 0;
            margin-top: 0;
            letter-spacing: 1px;
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
                line-height: 1.2 !important;
            }
            
            .desktop-nav {
                display: none !important;
            }
            
            .hamburger {
                display: flex !important;
            }
            
            .mobile-menu.active {
                display: block !important;
            }
            
            .banner {
                height: 200px !important;
            }
            
            .container {
                padding: 0 16px !important;
            }
            
            .white-box {
                padding: 0 16px !important;
            }
            
            .section-header {
                font-size: 18px !important;
                margin-left: -16px !important;
                margin-right: -16px !important;
                border-radius: 0 !important;
                padding: 12px 16px !important;
                box-sizing: border-box !important;
                overflow: hidden !important;
            }
            
            .about-row {
                flex-direction: column !important;
                gap: 20px !important;
                margin-bottom: 24px !important;
            }
            
            .about-left {
                text-align: center !important;
            }
            
            .about-left .about-title {
                font-size: 17px !important;
                margin-bottom: 8px !important;
            }
            
            .about-left .about-desc {
                font-size: 15px !important;
                line-height: 1.5 !important;
            }
            
            .about-right {
                justify-content: center !important;
            }
            
            .about-right img {
                width: 100% !important;
                max-width: 320px !important;
                height: auto !important;
                min-height: 160px !important;
            }
            
            .grid-row {
                flex-direction: column !important;
                gap: 16px !important;
            }
            
            .grid-item {
                min-width: auto !important;
                max-width: none !important;
                flex: none !important;
                width: 100% !important;
                padding: 16px !important;
            }
            
            .grid-item img {
                width: 100% !important;
                max-width: 300px !important;
                height: 160px !important;
                object-fit: cover !important;
                box-sizing: border-box !important;
            }
            
            .grid-item .caption {
                font-size: 14px !important;
                line-height: 1.4 !important;
            }
            
            .more-btn {
                padding: 10px 20px !important;
                font-size: 14px !important;
            }
        }

        @media (max-width: 480px) {
            .header-bar {
                padding: 0 12px !important;
                min-height: 52px !important;
            }
            
            .logo-text {
                font-size: 14px !important;
                line-height: 1.2 !important;
            }
            
            .banner {
                height: 150px !important;
            }
            
            .container {
                padding: 0 12px !important;
            }
            
            .white-box {
                padding: 0 12px !important;
            }
            
            .section-header {
                font-size: 16px !important;
                margin-left: -12px !important;
                margin-right: -12px !important;
                padding: 10px 12px !important;
                border-radius: 0 !important;
            }
            
            .about-row {
                gap: 16px !important;
                margin-bottom: 20px !important;
            }
            
            .about-left .about-title {
                font-size: 16px !important;
                margin-bottom: 6px !important;
            }
            
            .about-left .about-desc {
                font-size: 14px !important;
                line-height: 1.4 !important;
            }
            
            .about-right img {
                max-width: 280px !important;
                min-height: 140px !important;
            }
            
            .grid-row {
                gap: 12px !important;
            }
            
            .grid-item {
                padding: 12px !important;
            }
            
            .grid-item img {
                height: 140px !important;
                max-width: 260px !important;
            }
            
            .grid-item .caption {
                font-size: 13px !important;
                line-height: 1.3 !important;
            }
            
            .more-btn {
                font-size: 13px !important;
                padding: 8px 16px !important;
            }
            
            .divider {
                margin: 20px 0 !important;
            }
        }
        
        /* Additional mobile enhancements */
        @media (max-width: 320px) {
            .header-bar {
                padding: 0 8px !important;
                min-height: 48px !important;
            }
            
            .logo-text {
                font-size: 12px !important;
            }
            
            .container {
                padding: 0 8px !important;
            }
            
            .white-box {
                padding: 0 8px !important;
            }
            
            .section-header {
                font-size: 14px !important;
                margin-left: -8px !important;
                margin-right: -8px !important;
                padding: 8px !important;
            }
            
            .about-left .about-title {
                font-size: 15px !important;
            }
            
            .about-left .about-desc {
                font-size: 13px !important;
            }
            
            .grid-item {
                padding: 10px !important;
            }
            
            .grid-item img {
                height: 120px !important;
                max-width: 100% !important;
            }
            
            /* Prevent any horizontal overflow */
            .container, .white-box {
                overflow-x: hidden !important;
            }
            
            .header-bar {
                overflow-x: hidden !important;
            }
            
            .grid-item .caption {
                font-size: 12px !important;
            }
        }
    </style>
</head>
<body>
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
    <div class="banner"></div>
    <main class="main-content">
        <div class="white-box">
            <div style="height: 32px;"></div>
            <div class="section-header">About Universidad de Dagupan</div>
            <div class="about-row">
                <div class="about-left">
                    <div class="about-title"><input type="radio" checked style="margin-right:8px;">Leadership and Vision</div>
                    <div class="about-desc">The university was founded by Dr. Voltaire P. Arzadon, who served as its president for 39 years.<br>In 2022, Dr. Feliza Valorie C. Arzadon-Sua succeeded him as the university's second president. UdD is committed to discovering and developing God-given gifts to help achieve personal fulfilment and community uplift, maintaining innovation efforts to create solutions and be an invaluable national treasure.</div>
                </div>
                <div class="about-right">
                    <img src="{{ asset('images/aboutudd.png') }}" alt="About Building">
                </div>
            </div>
            <hr class="divider">
            <div class="section-header">News</div>
            <div class="grid-row">
                <div class="grid-item">
                    <img src="{{ asset('images/news1.png') }}" alt="Escalator">
                        <div class="caption" style="font-weight:bold;">Infrastructure development -<br>new escalator in UdD</div>
                        <div style="font-size:15px; color:#888; text-align:center; margin-top:4px;">June 3, 2024</div>
                </div>
                <div class="grid-item">
                    <img src="{{ asset('images/news2.png') }}" alt="Capilano">
                        <div class="caption" style="font-weight:bold;">Capilano University honored<br>Universidad de Dagupan as its Most Outstanding Global Partner.</div>
                        <div style="font-size:15px; color:#888; text-align:center; margin-top:4px;">February 25, 2025</div>
                </div>
                <div class="grid-item">
                    <img src="{{ asset('images/news3.png') }}" alt="ISO Certificate">
                        <div class="caption" style="font-weight:bold;">UdD achieves ISO 21001:2018 Certification, a First in Region 1</div>
                        <div style="font-size:15px; color:#888; text-align:center; margin-top:4px;">January 17, 2025</div>
                </div>
            </div>
                <div style="display: flex; justify-content: flex-end;">
                    <a href="/news" class="more-btn">More News</a>
                </div>
            <hr class="divider">
            <div class="section-header">Events</div>
            <div class="grid-row">
                <div class="grid-item">
                    <img src="{{ asset('images/event1.png') }}" alt="GMA Event">
                    <div class="caption"><span style="font-weight:700;">UdD hosts first Luzon leg of GMA Masterclass Series</span></div>
                    <div style="font-size:15px; color:#888; text-align:center; margin-top:4px;">March 7, 2025</div>
                </div>
                <div class="grid-item">
                    <img src="{{ asset('images/event2.png') }}" alt="Robotics">
                    <div class="caption"><span style="font-weight:700;">SHS - Robotics Competition in Universidad</span></div>
                    <div style="font-size:15px; color:#888; text-align:center; margin-top:4px;">March 27, 2025</div>
                </div>
                <div class="grid-item">
                    <img src="{{ asset('images/event3.png') }}" alt="Intramurals">
                    <div class="caption"><span style="font-weight:700;">Intramural 2025</span></div>
                    <div style="font-size:15px; color:#888; text-align:center; margin-top:4px;">March 31, 2025</div>
                </div>
            </div>
                <div style="display: flex; justify-content: flex-end;">
                    <a href="/events" class="more-btn">More Events</a>
                </div>
        </div>
    </main>
    <footer class="footer">
        &copy; 2023 - 2025 Universidad de Dagupan. All rights reserved.
    </footer>
    
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
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Events - Universidad de Dagupan</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f7fb;
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
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 24px;
        }
        
        .page-header {
            background: #1a237e;
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            text-align: left;
            padding: 10px 18px;
            border-radius: 8px;
            margin-bottom: 18px;
        }
        
        .event-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.09);
            border: 1px solid #dbeafe;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }
        
        .event-card img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        
        .event-content {
            padding: 24px 18px 48px 18px;
            font-size: 20px;
            line-height: 1.5;
            color: #222;
        }
        
        .event-date {
            font-size: 16px;
            color: #888;
            margin-top: 8px;
        }
        
        .read-more {
            position: absolute;
            right: 18px;
            bottom: 18px;
            background: #1a237e;
            color: #fff;
            padding: 8px 18px;
            border-radius: 6px;
            font-size: 15px;
            text-decoration: none;
            font-weight: 500;
        }
        
        .back-btn {
            background: #23408e;
            color: #fff;
            font-weight: bold;
            border-radius: 6px;
            padding: 8px 18px;
            text-decoration: none;
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
            
            .container {
                padding: 16px;
            }
            
            .page-header {
                font-size: 18px;
                padding: 8px 16px;
                margin-bottom: 16px;
            }
            
            .event-card {
                margin-bottom: 20px;
                border-radius: 10px;
            }
            
            .event-content {
                font-size: 18px;
                padding: 20px 16px 45px 16px;
            }
            
            .event-date {
                font-size: 15px;
            }
            
            .read-more {
                right: 16px;
                bottom: 16px;
                padding: 6px 16px;
                font-size: 14px;
            }
        }
        
        @media (max-width: 480px) {
            .header-bar {
                padding: 0 12px;
            }
            
            .logo-text {
                font-size: 14px !important;
            }
            
            .container {
                padding: 12px;
            }
            
            .page-header {
                font-size: 16px;
                padding: 6px 12px;
            }
            
            .event-card {
                margin-bottom: 16px;
                border-radius: 8px;
            }
            
            .event-content {
                font-size: 16px;
                padding: 16px 12px 40px 12px;
            }
            
            .event-date {
                font-size: 14px;
            }
            
            .read-more {
                right: 12px;
                bottom: 12px;
                padding: 5px 14px;
                font-size: 13px;
            }
            
            .back-btn {
                padding: 6px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
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
    
    <div class="container">
        <div class="page-header">EVENTS</div>
        <div class="event-card">
            <img src="{{ asset('images/event1.png') }}" alt="event1">
            <div class="event-content">
                UdD hosts first Luzon leg of GMA Masterclass Series
                <div class="event-date">March 6, 2024</div>
            </div>
            <a href="/event/1" class="read-more">Read More</a>
        </div>
        <div class="event-card">
            <img src="{{ asset('images/event2.png') }}" alt="event2">
            <div class="event-content">
                SHS - Robotics Competition in Universidad
                <div class="event-date">March 27, 2025</div>
            </div>
            <a href="/event/2" class="read-more">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/event3.png') }}" alt="event4" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 48px 18px;font-size:20px;line-height:1.5;color:#222;">
                Intramural 2025<br>
                <span style="font-size:16px;color:#888;">March 31, 2025</span>
            </div>
            <a href="/event/3" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/event4.png') }}" alt="event4" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 48px 18px;font-size:20px;line-height:1.5;color:#222;">
                Hear the Roar of the Savannah! Universidad de Dagupan Cheerdance Competition 2024 Electrifies Universidad de Dagupan Intramurals<br>
                <span style="font-size:16px;color:#888;">April 13, 2024</span>
            </div>
            <a href="/event/4" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/event5.png') }}" alt="event5" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 48px 18px;font-size:20px;line-height:1.5;color:#222;">
                Binibining Universidad de Dagupan 2024: The Grand Coronation<br>
                <span style="font-size:16px;color:#888;">April 12, 2024</span>
            </div>
            <a href="/event/5" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/event6.png') }}" alt="event6" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 48px 18px;font-size:20px;line-height:1.5;color:#222;">
                40 Years of UdD Excellence: UdD launches their first ever Coffee Table Book!<br>
                <span style="font-size:16px;color:#888;">March 9, 2024</span>
            </div>
            <a href="/event/6" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/event7.png') }}" alt="event7" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 48px 18px;font-size:20px;line-height:1.5;color:#222;">
                UdD Celebrates 2nd Year as a University: Another Year of Recollection<br>
                <span style="font-size:16px;color:#888;">December 18, 2023</span>
            </div>
            <a href="/event/7" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/event8.png') }}" alt="event8" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 48px 18px;font-size:20px;line-height:1.5;color:#222;">
                Light Up the Night! UdD Celebrate Our 2nd Uni Anni Lighting Ceremony<br>
                <span style="font-size:16px;color:#888;">December 14, 2023</span>
            </div>
            <a href="/event/8" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/event9.png') }}" alt="event9" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 48px 18px;font-size:20px;line-height:1.5;color:#222;">
                Pamaskong Handog 2023: Spreading Holiday Cheer One Blessing at a Time.<br>
                <span style="font-size:16px;color:#888;">December 13, 2023</span>
            </div>
            <a href="/event/9" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/event10.png') }}" alt="event10" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 48px 18px;font-size:20px;line-height:1.5;color:#222;">
                Kick-Off Party for Freshmen and Transferees<br>
                <span style="font-size:16px;color:#888;">August 4, 2025</span>
            </div>
            <a href="/event/10" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/event11.png') }}" alt="event11" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 48px 18px;font-size:20px;line-height:1.5;color:#222;">
                Freshmen Kick-Off Orientation 2023: U Dare to Dream!<br>
                <span style="font-size:16px;color:#888;">September 9, 2023</span>
            </div>
            <a href="/event/11" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;">Read More</a>
        </div>
        <div style="margin-top:32px;text-align:center;">
            <a href="/about" class="back-btn">Back to About</a>
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
</body>
</html>
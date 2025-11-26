<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All News - Universidad de Dagupan</title>
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
        
        .news-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.09);
            border: 1px solid #dbeafe;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }
        
        .news-card img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        
        .news-content {
            padding: 24px 18px 18px 18px;
            font-size: 20px;
            line-height: 1.5;
            color: #222;
            padding-bottom: 60px;
        }
        
        .news-date {
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
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        
        .back-btn {
            background: #23408e;
            color: #fff;
            font-weight: bold;
            border-radius: 6px;
            padding: 8px 24px;
            font-size: 15px;
            border: none;
            text-decoration: none;
            display: inline-block;
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
            
            .news-card {
                margin-bottom: 20px;
                border-radius: 10px;
            }
            
            .news-content {
                font-size: 18px;
                padding: 20px 16px 16px 16px;
                padding-bottom: 50px;
            }
            
            .news-date {
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
            
            .news-card {
                margin-bottom: 16px;
                border-radius: 8px;
            }
            
            .news-content {
                font-size: 16px;
                padding: 16px 12px 12px 12px;
                padding-bottom: 45px;
            }
            
            .news-date {
                font-size: 14px;
            }
            
            .read-more {
                right: 12px;
                bottom: 12px;
                padding: 5px 14px;
                font-size: 13px;
            }
            
            .back-btn {
                padding: 6px 20px;
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
        <div class="page-header">NEWS</div>
        <div class="news-card">
            <img src="{{ asset('images/news1.png') }}" alt="news1">
            <div class="news-content">
                UdD first ever escalator
                <div class="news-date">June 3, 2024</div>
            </div>
            <a href="/news/1" class="read-more">Read More</a>
        </div>
        <div class="news-card">
            <img src="{{ asset('images/news2.png') }}" alt="news2">
            <div class="news-content">
                Capilano University honored Universidad de Dagupan as its Most Outstanding Global Partner
                <div class="news-date">August 25, 2025</div>
            </div>
            <a href="/news/2" class="read-more">Read More</a>
        </div>
        <div class="news-card">
            <img src="{{ asset('images/news3.png') }}" alt="news3">
            <div class="news-content">
                UdD achieves ISO 21001:2018 Certification, a First in Region 1
                <div class="news-date">January 17, 2025</div>
            </div>
            <a href="/news/3" class="read-more">Read More</a>
        </div>
        <div class="news-card">
            <img src="{{ asset('images/news4.png') }}" alt="news4">
            <div class="news-content">
                Universidad de Dagupan Achieves 100% Passing Rate in Nurses Licensure Exam
                <div class="news-date">November 28, 2024</div>
            </div>
            <a href="/news/4" class="read-more">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/news5.png') }}" alt="news5" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 18px 18px;font-size:20px;line-height:1.5;color:#222;">
                Universidad de Dagupan is now an official signatory of The SDG Accord UdD Staff<br>
                <span style="font-size:16px;color:#888;">May 22, 2025</span>
            </div>
            <a href="/news/5" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;box-shadow:0 2px 8px rgba(0,0,0,0.07);">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/news6.png') }}" alt="news6" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 18px 18px;font-size:20px;line-height:1.5;color:#222;">
                UdD signs MOA with Smartbridge for Internship and Enhancement Program<br>
                <span style="font-size:16px;color:#888;">May 10, 2025</span>
            </div>
            <a href="/news/6" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;box-shadow:0 2px 8px rgba(0,0,0,0.07);">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/news7.png') }}" alt="news7" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 18px 18px;font-size:20px;line-height:1.5;color:#222;">
                Universidad de Dagupan proves once again it's the HOT spot — Home Of Topnotchers<br>
                <span style="font-size:16px;color:#888;">April 30, 2025</span>
            </div>
            <a href="/news/7" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;box-shadow:0 2px 8px rgba(0,0,0,0.07);">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/news8.png') }}" alt="news8" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 18px 18px;font-size:20px;line-height:1.5;color:#222;">
                Universidad de Dagupan: The First HEI in the Philippines to Offer Training in Applied Behavior Analysis.<br>
                <span style="font-size:16px;color:#888;">April 7, 2025</span>
            </div>
            <a href="/news/8" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;box-shadow:0 2px 8px rgba(0,0,0,0.07);">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/news9.png') }}" alt="news9" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 18px 18px;font-size:20px;line-height:1.5;color:#222;">
                UdD rolls out Eco-Friendly E-Jeeps in Test Run<br>
                <span style="font-size:16px;color:#888;">January 29, 2025</span>
            </div>
            <a href="/news/9" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;box-shadow:0 2px 8px rgba(0,0,0,0.07);">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/news10.png') }}" alt="news10" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 18px 18px;font-size:20px;line-height:1.5;color:#222;">
                Milpitas Vice Mayor visits UdD, hints at future partnership<br>
                <span style="font-size:16px;color:#888;">April 3, 2025</span>
            </div>
            <a href="/news/10" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;box-shadow:0 2px 8px rgba(0,0,0,0.07);">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/news11.png') }}" alt="news11" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 18px 18px;font-size:20px;line-height:1.5;color:#222;">
                UdD: A Proud Partner in Pangasinan's Development<br>
                <span style="font-size:16px;color:#888;">April 4, 2025</span>
            </div>
            <a href="/news/11" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;box-shadow:0 2px 8px rgba(0,0,0,0.07);">Read More</a>
        </div>
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.09);border:1px solid #dbeafe;max-width:900px;margin-bottom:32px;position:relative;">
            <img src="{{ asset('images/news12.png') }}" alt="news12" style="width:100%;max-width:900px;height:auto;object-fit:cover;border-radius:12px 12px 0 0;">
            <div style="padding:24px 18px 18px 18px;font-size:20px;line-height:1.5;color:#222;">
                UDD's Annual Date With Special Friend<br>
                <span style="font-size:16px;color:#888;">February 14, 2025</span>
            </div>
            <a href="/news/12" style="position:absolute;right:18px;bottom:18px;background:#1a237e;color:#fff;padding:8px 18px;border-radius:6px;font-size:15px;text-decoration:none;font-weight:500;box-shadow:0 2px 8px rgba(0,0,0,0.07);">Read More</a>
        </div>
        <div style="margin-top:32px;text-align:center;">
            <a href="/about" class="back-btn">Back to Home</a>
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

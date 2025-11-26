<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item['title'] ?? 'News Detail' }}</title>
    <style>
        body {
            background: #f4f7fb;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
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
            max-width: 700px;
            margin: 40px auto;
            padding: 0;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.09);
            overflow: hidden;
        }
        .header {
            padding: 32px 32px 0 32px;
            text-align: center;
        }
        .title {
            font-size: 2rem;
            font-weight: bold;
            color: #222;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        .meta {
            color: #888;
            font-size: 15px;
            margin-bottom: 18px;
        }
        .news-image {
            width: 100%;
            max-width: 480px;
            display: block;
            margin: 0 auto 18px auto;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.09);
            transition: transform 0.2s;
        }
        .news-image:hover {
            transform: scale(1.03);
        }
        .desc {
            font-size: 17px;
            color: #222;
            margin: 0 32px 32px 32px;
            line-height: 1.7;
            background: #f4f7fb;
            border-radius: 10px;
            padding: 18px;
        }
        .btn-back {
            display: inline-block;
            margin: 0 0 24px 32px;
            padding: 10px 22px;
            background: #888;
            color: #fff;
            font-weight: 500;
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.09);
            text-decoration: none;
            transition: background 0.2s, box-shadow 0.2s;
        }
        .btn-back:hover {
            background: #222;
            box-shadow: 0 4px 16px rgba(0,0,0,0.13);
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
                margin: 20px 16px;
                border-radius: 12px;
            }
            
            .header {
                padding: 24px 20px 0 20px;
            }
            
            .title {
                font-size: 1.5rem;
            }
            
            .desc {
                font-size: 16px;
                margin: 0 20px 24px 20px;
                padding: 16px;
            }
            
            .btn-back {
                margin: 0 0 20px 20px;
                padding: 8px 18px;
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
                margin: 16px 8px;
            }
            
            .header {
                padding: 20px 16px 0 16px;
            }
            
            .title {
                font-size: 1.25rem;
                line-height: 1.3;
            }
            
            .meta {
                font-size: 14px;
            }
            
            .news-image {
                border-radius: 8px;
            }
            
            .desc {
                font-size: 15px;
                margin: 0 16px 20px 16px;
                padding: 14px;
                border-radius: 8px;
            }
            
            .btn-back {
                margin: 0 0 16px 16px;
                padding: 6px 16px;
                font-size: 13px;
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
        <a href="{{ url()->previous() ?? url('/news') }}" class="btn-back">&#8592; Back</a>
        <div class="header">
            <div class="title">{{ $item['title'] ?? '' }}</div>
            <div class="meta">{{ $item['date'] ?? '' }}</div>
            @if(isset($item['image']))
                <img src="{{ $item['image'] }}" alt="news Image" class="news-image">
            @endif
        </div>
        <div class="desc">
            {{ $item['description'] ?? '' }}
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

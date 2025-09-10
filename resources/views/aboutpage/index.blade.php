<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    body { background: #fff; margin: 0; font-family: 'Segoe UI', Arial, sans-serif; }
    .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    }
    .section-header {
    display: block;
    background: #23408e;
    color: #fff;
    font-size: 32px;
    font-weight: 700;
    text-align: center;
    margin-left: -24px;
    margin-right: -24px;
    padding: 18px 0;
    margin-bottom: 32px;
    letter-spacing: 1px;
    border: none;
    border-radius: 0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .about-row {
        display: flex;
        gap: 48px;
        align-items: flex-start;
        margin-bottom: 48px;
        flex-wrap: wrap;
    }
    .about-left {
        flex: 2;
        min-width: 280px;
    }
    .about-left .about-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 12px;
        color: #23408e;
        display: flex;
        align-items: center;
    }
    .about-left .about-desc {
        font-size: 17px;
        color: #222;
        line-height: 1.7;
        margin-bottom: 0;
    }
    .about-right {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 220px;
    }
    .about-right img {
        width: 100%;
        max-width: 340px;
        height: auto;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #dbeafe;
        box-shadow: 0 2px 12px rgba(0,0,0,0.09);
    }
    .divider {
        width: 100%;
        height: 1px;
        background: #eaeaea;
        margin: 32px 0;
        border: none;
    }
    .grid-row {
        display: flex;
        gap: 32px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }
    .grid-item {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.09);
    border: 1px solid #dbeafe;
    flex: 1 1 280px;
    min-width: 260px;
    max-width: 340px;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    padding: 0;
    }
    .grid-item img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 12px 12px 0 0;
    margin-bottom: 0;
    background: #fff;
    }
    .grid-item .caption {
    font-size: 16px;
    color: #222;
    text-align: left;
    font-weight: 400;
    margin: 12px 0 0 0;
    padding: 0 16px 16px 16px;
    }
    .more-btn {
    background: #0033cc;
    color: #fff;
    font-weight: bold;
    border-radius: 0;
    padding: 12px 32px;
    font-size: 18px;
    border: none;
    text-decoration: none;
    display: inline-block;
    margin: 0 0 24px 0;
    box-shadow: none;
    transition: background 0.2s;
    }
    .more-btn:hover {
        background: #1a237e;
    }
        .header-bar {
            background: #eaeaea;
            color: #1a237e;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            height: 56px;
        }
        .header-bar img {
            height: 44px;
            width: 44px;
            object-fit: contain;
            margin-right: 12px;
        }
        .header-bar .logo-text {
            font-size: 22px;
            font-weight: bold;
            color: #1a237e;
            letter-spacing: 1px;
        }
        .header-bar nav {
            display: flex;
            gap: 32px;
        }
        .header-bar nav a {
            color: #23408e;
            font-weight: bold;
            font-size: 18px;
            text-decoration: none;
            transition: color 0.2s;
        }
        .header-bar nav a:hover {
            color: #1a237e;
        }
        .banner {
            position: relative;
            height: 420px;
            background: url('{{ asset('images/background.png') }}') no-repeat center center;
            background-size: cover;
            overflow: hidden;
            border-bottom: 6px solid #3a5a8c;
        }
        .banner-bg {
            display: none;
        }
        .main-content {
            background: #fff;
            padding: 0;
        }
        .white-box {
            background: none;
            border-radius: 0;
            margin: 0 auto;
            max-width: 1400px;
            padding: 0 32px;
            box-shadow: none;
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
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #dbeafe;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
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
    </style>
</head>
<body>
    <div class="header-bar">
        <div style="display: flex; align-items: center;">
            <img src="{{ asset('images/uddlogo.png') }}" alt="UDD Logo">
            <span class="logo-text">UNIVERSIDAD DE DAGUPAN</span>
        </div>
        <nav style="display: flex; gap: 32px; font-size: 17px; font-weight: bold;">
               <a href="/index" style="color: #1a237e; text-decoration: none;">About</a>
               <a href="/welcome" style="color: #1a237e; text-decoration: none;">Home</a>
               <a href="/contact" style="color: #1a237e; text-decoration: none;">Contact Us</a>
               <a href="/apply" style="color: #1a237e; text-decoration: none;">Apply</a>
               <a href="/login" style="color: #1a237e; text-decoration: none;">Login</a>
		</nav>
    </div>
    <div class="banner"></div>
    <main class="main-content">
        <div class="container">
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
</body>
</html>
        
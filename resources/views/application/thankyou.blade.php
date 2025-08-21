@extends('layouts.guest')

@section('content')
<div style="background: #222; min-height: 100vh; font-family: Arial, sans-serif;">
    <!-- Header with Logo and Nav -->
<header style="background: #fff; padding: 10px 40px; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <img src="/images/uddlogo.png" alt="UDD Logo" style="width: 45px; height: 45px;">
            <div style="font-size: 16px; font-weight: bold; color: #1a237e; line-height: 1.2;">
                UNIVERSIDAD DE DAGUPAN
            </div>
        </div>
		<nav style="display: flex; gap: 28px; font-size: 15px; font-weight: bold;">
			<a href="/index" style="color: #1a237e; text-decoration: none;">About</a>
			<a href="#" style="color: #1a237e; text-decoration: none;">Home</a>
			<a href="#" style="color: #1a237e; text-decoration: none;">Contact Us</a>
			<a href="/apply" style="color: #1a237e; text-decoration: none;">Apply</a>
			<a href="/login" style="color: #1a237e; text-decoration: none;">Login</a>
		</nav>
	</header>

    <!-- Banner -->
    <section style="position: relative; height: 320px; border-bottom: 6px solid #3a5a8c; overflow: hidden;">
        <div style="position: absolute; inset: 0; z-index: 1;">
            <img src="/images/application.png" alt="Application Banner" style="width: 100%; height: 100%; object-fit: cover; filter: blur(4px) brightness(0.85);">
        </div>
        <div style="position: relative; z-index: 2; height: 100%; display: flex; align-items: center;">
            <div style="background: #fff; padding: 36px 110px; border-radius: 6px; margin-left: 80px; display: flex; align-items: center; justify-content: center; height: 180px; box-shadow: 0 4px 24px rgba(0,0,0,0.10);">
                <span style="font-size: 62px; font-weight: bold; color: #002c77; letter-spacing: 2px; text-align: center; display: block;">Thank<br>You!</span>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main style="background: #4a6ba3; padding: 40px 0; min-height: 600px; display: flex; justify-content: center; align-items: flex-start;">
        <div style="max-width: 900px; width: 100%; background: #fff; border-radius: 12px; box-shadow: 0 4px 24px rgba(0,0,0,0.15); padding: 32px 32px 32px 32px;">
            <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 12px;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <img src="/images/uddlogo.png" alt="UDD Logo" style="width: 55px; height: 55px;">
                    <div style="font-size: 16px; font-weight: bold; color: #1a237e; line-height: 1.2;">
                        UNIVERSIDAD DE DAGUPAN<br>
                        <span style="font-size: 12px; font-weight: normal; color: #333;">(Formerly Colegio de Dagupan)</span>
                    </div>
                </div>
                <div style="margin-left: auto; text-align: right; font-size: 13px; font-weight: bold; line-height: 1.4;">
                    Student Assistant Application Form<br>
                    UNIVERSIDAD DE DAGUPAN<br>
                    Arellano St., Dagupan City,<br>
                    Pangasinan
                </div>
            </div>
            <hr style="margin: 10px 0 18px 0;">
            <div style="font-size: 17px; color: #222; margin-bottom: 18px;">You have successfully submitted your form. Please wait a confirmation to the email you provided.</div>
            <div style="min-height: 350px;"></div>
        </div>
    </main>

    <!-- Footer -->
    <footer style="background: #2a3a5a; color: #fff; text-align: center; font-size: 13px; padding: 18px 0; margin-top: 0;">
        &copy; 2023 - 2024 by MRCY Inc., a non-profit organization. All rights reserved.
    </footer>
</div>
@endsection

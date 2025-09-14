@extends('layouts.guest')

@section('title', 'Student Assistants Society')

@section('content')

<div style="background: #f4f7fb; min-height: 100vh; font-family: 'Segoe UI', Arial, sans-serif;">

	<!-- Header with Logo and Nav -->
	<div class="header-bar" style="background: #eaeaea; color: #1a237e; display: flex; align-items: center; justify-content: space-between; padding: 0 24px; height: 56px;">
		<div style="display: flex; align-items: center;">
			<img src="/images/uddlogo.png" alt="UDD Logo" style="height: 44px; width: 44px; object-fit: contain; margin-right: 12px;">
			<span class="logo-text" style="font-size: 22px; font-weight: bold; color: #1a237e; letter-spacing: 1px;">UNIVERSIDAD DE DAGUPAN</span>
		</div>
		<nav style="display: flex; gap: 32px;">
			<a href="/about" style="color: #23408e; font-weight: bold; font-size: 18px; text-decoration: none; transition: color 0.2s;">About</a>
			<a href="/welcome" style="color: #23408e; font-weight: bold; font-size: 18px; text-decoration: none; transition: color 0.2s;">Home</a>
			   <a href="/contact" style="color: #23408e; font-weight: bold; font-size: 18px; text-decoration: none; transition: color 0.2s;">Contact Us</a>
			<a href="/apply" style="color: #23408e; font-weight: bold; font-size: 18px; text-decoration: none; transition: color 0.2s;">Apply</a>
			<a href="/login" style="color: #23408e; font-weight: bold; font-size: 18px; text-decoration: none; transition: color 0.2s;">Login</a>
		</nav>
	</div>

	<!-- Banner -->
	<section style="position: relative; height: 320px; border-bottom: 6px solid #3a5a8c; overflow: hidden; background: #e3eaf7;">
		<img src="/images/sas.png" alt="SAS Banner" style="width: 100%; height: 100%; object-fit: cover; display: block;">
	</section>

	<!-- Main Content -->
	<main style="background: linear-gradient(135deg, #4a6ba3 0%, #6a8bc7 100%); padding: 48px 0; min-height: 600px; display: flex; justify-content: center; align-items: flex-start;">
		<div style="max-width: 980px; width: 100%; background: #fff; border-radius: 18px; box-shadow: 0 8px 32px rgba(0,0,0,0.10); padding: 56px 56px 56px 56px;">
			
			<!-- Introduction -->
			<div style="font-size: 18px; color: #333; margin-bottom: 32px; line-height: 1.5; font-weight: normal; text-align: center;">
				<strong>The Student Assistants Society (SAS) provides students with opportunities to gain work experience while contributing to the university community. Through dedication, resilience, and a passion for service, our student assistants grow both personally and professionally.</strong>
			</div>

			<!-- Mission -->
			<div style="display: flex; gap: 32px; justify-content: center; margin-bottom: 38px;">
				<div style="flex: 1; min-width: 220px;">
					<div style="font-weight: bold; color: #23408e; margin-bottom: 10px; font-size: 18px;">Mission</div>
					<div style="font-size: 16px; color: #333; line-height: 1.5;">To empower student assistants by fostering responsibility, work ethics, and professional skills through valuable service to the university.</div>
				</div>
				<div style="flex: 1; min-width: 220px;">
					<div style="font-weight: bold; color: #23408e; margin-bottom: 10px; font-size: 18px;">Vision</div>
					<div style="font-size: 16px; color: #333; line-height: 1.5;">A community of student assistants committed to excellence, integrity, and academic growth.</div>
				</div>
			</div>

			<!-- Main content layout with images on left, text on right -->
			<div style="display: flex; gap: 32px; align-items: flex-start;">
				<!-- Left column - Images -->
				<div style="display: flex; flex-direction: column; gap: 18px; flex-shrink: 0;">
					<img src="/images/sas1.png" alt="SAS Photo 1" style="width: 260px; height: 170px; object-fit: cover; border-radius: 10px; border: 1px solid #dbeafe; box-shadow: 0 2px 8px rgba(0,0,0,0.07);">
					<img src="/images/sas2.png" alt="SAS Photo 2" style="width: 260px; height: 170px; object-fit: cover; border-radius: 10px; border: 1px solid #dbeafe; box-shadow: 0 2px 8px rgba(0,0,0,0.07);">
					<img src="/images/sas2.png" alt="SAS Photo 3" style="width: 260px; height: 170px; object-fit: cover; border-radius: 10px; border: 1px solid #dbeafe; box-shadow: 0 2px 8px rgba(0,0,0,0.07);">
				</div>

				<!-- Right column - Text content -->
				<div style="width: 100%; max-width: 520px; font-size: 18px; color: #222; line-height: 1.8; align-self: stretch; display: flex; flex-direction: column; justify-content: space-between;">
					<!-- Apply section -->
					<div style="margin-bottom: 38px; font-size: 20px;">
						<div style="margin-bottom: 8px;">If you're interested in becoming a student assistant, click the button below to fill out the application form and start your SAS journey today.</div>
						<a href="/apply" style="color: #1a237e; font-weight: bold; text-decoration: underline; display: inline-block;">🔗 Apply Now</a>
					</div>

					<!-- Benefits section -->
					<div style="margin-bottom: 38px;">
						<div style="font-weight: bold; margin-bottom: 14px; color: #23408e; font-size: 19px;">Benefits of Being a Student Assistant</div>
						<ul style="margin: 0; padding-left: 22px; line-height: 1.8; font-size: 17px;">
							<li>Tuition discounts or financial assistance</li>
							<li>Real-world work experience within the university</li>
							<li>Professional and personal growth</li>
							<li>Flexible hours that fit your academic schedule</li>
							<li>Skill development in communication, leadership, and time management</li>
						</ul>
					</div>

					<!-- Testimonial section -->
					<div style="font-size: 17px;">
						<div style="font-style: italic; margin-bottom: 10px; line-height: 1.7; color: #23408e;">“Being a student assistant helped me balance work and study while learning new skills. It shaped me into who I am today.”</div>
						<div style="font-size: 14px; color: #666; font-weight: bold;">— Former SAS Member</div>
					</div>
				</div>
			</div>

		</div>
	</main>

	<!-- Footer -->
	<footer style="background: #1a237e; color: #fff; text-align: center; font-size: 13px; padding: 18px 0; margin-top: 0; letter-spacing: 1px;">
		&copy; 2023 - 2024 by MRCY Inc., a non-profit organization. All rights reserved.
	</footer>
</div>
@endsection
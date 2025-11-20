<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AssisTrack SAS Login</title>
<style>
    @media (max-width: 900px) {
        main {
            height: auto;
            min-height: 100vh;
            align-items: flex-start;
        }
        .container {
            flex-direction: column;
            width: 95vw;
            min-width: 0;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
        }
        .banner {
            width: 100%;
            padding: 32px 16px;
            border-radius: 16px 16px 0 0;
        }
        .banner img {
            width: 180px;
        }
        .banner-title {
            font-size: 2rem;
        }
        .login-card {
            width: 100%;
            padding: 32px 16px;
            border-left: none;
            border-radius: 0 0 16px 16px;
        }
        h2 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 600px) {
        main {
            padding-top: 24px;
            padding-bottom: 0;
            min-height: 100vh;
            box-sizing: border-box;
        }
        .container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        .login-card {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .container {
            width: 100vw;
            border-radius: 0;
            box-shadow: none;
        }
        .banner {
            padding: 20px 8px;
        }
        .banner img {
            width: 120px;
        }
        .banner-title {
            font-size: 1.2rem;
        }
        .banner-subtitle {
            font-size: 0.95rem;
        }
        .login-card {
            padding: 20px 8px;
        }
        h2 {
            font-size: 1.1rem;
        }
        label, .return-home, .links a {
            font-size: 0.95rem;
        }
        .login-btn {
            font-size: 1rem;
            padding: 10px 0;
        }
    }
    html, body {
        min-height: 100vh;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Arial, sans-serif;
        background: #f3f4f6;
    }

    .background {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        width: 100vw;
        height: 100vh;
        background: url('/images/application.png') no-repeat center center/cover;
        filter: brightness(0.95);
        z-index: 0;
    }

    .overlay {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0,0,0,0.15);
        z-index: 1;
    }

    main {
        position: relative;
        z-index: 3;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        width: 100vw;
        box-sizing: border-box;
        padding: 0;
    }

    .container {
        display: flex;
        align-items: stretch;
        justify-content: center;
        border-radius: 20px;
        box-shadow: 0 10px 32px rgba(0,0,0,0.15);
        overflow: hidden;
        background: transparent;
        backdrop-filter: blur(4px);
        max-width: 960px;
        width: 100%;
        margin: 0 auto;
    }

    /* LEFT PANEL */
    .banner {
        background: rgba(179, 205, 250, 0.65);
        width: 480px;
        min-width: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 40px;
        backdrop-filter: blur(8px);
        box-sizing: border-box;
    }

    .banner img {
        width: 300px;
        margin-bottom: 20px;
    }

    .banner-title {
        font-size: 2.4rem;
        font-weight: 800;
        color: #111;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .banner-subtitle {
        font-size: 1.1rem;
        color: #111;
        font-weight: 400;
    }

    /* RIGHT LOGIN PANEL */
    .login-card {
        width: 480px;
        min-width: 0;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 50px 40px;
        backdrop-filter: blur(8px);
        border-left: 1px solid rgba(255,255,255,0.3);
        box-sizing: border-box;
    }
    @media (max-width: 900px) {
        main {
            min-height: 100vh;
            align-items: flex-start;
            padding: 0;
        }
        .container {
            flex-direction: column;
            width: 100vw;
            min-width: 0;
            border-radius: 0;
            box-shadow: none;
            margin: 0;
        }
        .banner {
            width: 100vw;
            min-width: 0;
            padding: 32px 16px;
            border-radius: 0;
        }
        .banner img {
            width: 180px;
        }
        .banner-title {
            font-size: 2rem;
        }
        .login-card {
            width: 100vw;
            min-width: 0;
            padding: 32px 16px;
            border-left: none;
            border-radius: 0;
        }
        h2 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 600px) {
        main {
            padding: 0;
        }
        .container {
            width: 100vw;
            min-width: 0;
            border-radius: 0;
            box-shadow: none;
            margin: 0;
        }
        .banner {
            padding: 20px 18px;
        }
        .banner img {
            width: 120px;
        }
        .banner-title {
            font-size: 1.2rem;
        }
        .banner-subtitle {
            font-size: 0.95rem;
        }
        .login-card {
            padding: 20px 18px;
        }
        h2 {
            font-size: 1.1rem;
        }
        label, .return-home, .links a {
            font-size: 0.95rem;
        }
        .login-btn {
            font-size: 1rem;
            padding: 10px 0;
        }
    }

    h2 {
        text-align: center;
        font-size: 1.9rem;
        font-weight: 700;
        color: #23408e;
        margin-bottom: 1.5rem;
    }

    label {
        font-size: 1rem;
        color: #23408e;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .input-wrapper {
        position: relative;
        display: block;
        width: 100%;
    }

    input[type="email"], 
    input[type="password"],
    input[type="text"] {
        width: 100%;
        border: 1.5px solid #23408e;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 1rem;
        background: rgba(247, 250, 255, 0.9);
        outline: none;
        transition: border 0.2s;
        box-sizing: border-box;
    }

    .input-wrapper input[type="password"],
    .input-wrapper input[type="text"] {
        padding-right: 50px;
    }

    input[type="email"]:focus, input[type="password"]:focus {
        border-color: #1a2e6d;
    }

    .toggle-password {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 1.1rem;
        color: #23408e;
        background: transparent;
        border: none;
        padding: 4px 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        user-select: none;
        z-index: 10;
        line-height: 1;
    }

    .toggle-password:hover {
        opacity: 0.6;
    }

    .toggle-password:focus {
        outline: none;
    }

    .toggle-password:active {
        opacity: 0.4;
    }

    .login-btn {
        width: 100%;
        padding: 12px 0;
        background: #23408e;
        color: #fff;
        font-size: 1.15rem;
        font-weight: 700;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(35,64,142,0.08);
        transition: background 0.2s;
    }

    .login-btn:hover {
        background: #1b3273;
    }

    .links {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.5rem;
        margin-bottom: 1.25rem;
    }

    .links a {
        color: #23408e;
        font-size: 0.95rem;
        text-decoration: underline;
    }

    .links a:hover {
        color: #1a2e6d;
    }

    .return-home {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-top: 1.25rem;
        text-decoration: none;
        color: #23408e;
        font-size: 1rem;
        font-weight: 500;
    }

    .return-home:hover {
        color: #1a2e6d;
    }

    .return-home svg {
        margin-right: 4px;
    }
</style>
</head>
<body>
    <div class="background"></div>
    <div class="overlay"></div>

    <main>
        <div class="container">
            <!-- Left Blue Banner -->
            <div class="banner">
                <img src="/images/assistracklogo.png" alt="AssisTrack Logo">
                <div class="banner-subtitle">AssisTrack SAS Login</div>
            </div>

            <!-- Right Login Panel -->
            <div class="login-card">
                <h2>Login to Your Account</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <input id="password" type="password" name="password" required autocomplete="current-password">
                            <button type="button" class="toggle-password" data-target="password" aria-label="Toggle password visibility">
                                <span class="eye-icon">&#128065;</span>
                            </button>
                        </div>
                    </div>

                    <div style="display:flex; align-items:center; gap:8px; margin-bottom:0.5rem;">
                        <input id="remember_me" type="checkbox" name="remember" style="accent-color:#23408e;">
                        <label for="remember_me" style="margin:0;">Remember me</label>
                    </div>

                    <div class="links">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                        @endif
                        <a href="{{ route('register') }}">Sign up</a>
                    </div>

                    <button type="submit" class="login-btn">Log In</button>

                    <a href="/welcome" class="return-home">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h5a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h5a1 1 0 001-1V10"/>
                        </svg>
                        Return Home
                    </a>
                </form>
            </div>
        </div>
    </main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toggle-password').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const input = document.getElementById(this.dataset.target);
            const eyeIcon = this.querySelector('.eye-icon');
            
            if (input) {
                if (input.type === 'password') {
                    input.type = 'text';
                    eyeIcon.innerHTML = '&#128064;';
                } else {
                    input.type = 'password';
                    eyeIcon.innerHTML = '&#128065;';
                }
            }
        });
    });
});
</script>
</body>
</html>
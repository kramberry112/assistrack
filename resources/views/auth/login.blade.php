
<style>
    html, body {
        height: 100vh;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }
    .banner {
        background: #b3cdfa;
        box-shadow: 0 8px 32px rgba(0,0,0,0.10);
        border-radius: 18px;
        width: 420px;
        padding: 40px 36px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
    }
    .banner-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #222;
        letter-spacing: 2px;
        margin-bottom: 8px;
        text-align: center;
    }
    .banner-subtitle {
        font-size: 1.15rem;
        color: #222;
        font-weight: 400;
        text-align: center;
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
</style>
<div style="position: relative; height: 100vh; font-family: 'Segoe UI', Arial, sans-serif; overflow: hidden;">
    <img src="/images/application.png" alt="Background" style="position: absolute; top: 0; left: 0; width: 100vw; height: 100vh; object-fit: cover; z-index: 0; filter: brightness(0.95);">
    <div style="position: absolute; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); z-index: 1;"></div>

    <main style="min-height: 100vh; display: flex; justify-content: center; align-items: center; position: relative; z-index: 3;">
        <div style="display: flex; flex-direction: row; align-items: center; gap: 48px;">
            <div class="banner">
                <div class="banner-title">AssisTrack SAS Login</div>
                <div class="banner-subtitle">Sign in to your account</div>
            </div>
            <div style="width: 420px; background: #fff; border-radius: 18px; box-shadow: 0 8px 32px rgba(0,0,0,0.10); padding: 40px 36px; margin-left: 32px;">
                <!-- ...existing login form... -->
                <h2 style="text-align: center; font-size: 2rem; font-weight: 700; color: #23408e; margin-bottom: 1.5rem; letter-spacing: 1px;">Login to Your Account</h2>
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div style="margin-bottom: 1.25rem;">
                        <label for="email" style="font-size: 1rem; color: #23408e; font-weight: 600; margin-bottom: 0.5rem; display: block;">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" style="width: 100%; border: 1.5px solid #23408e; border-radius: 8px; padding: 10px 12px; font-size: 1rem; margin-top: 4px; background: #f7faff; transition: border 0.2s; outline: none;">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div style="margin-bottom: 1.25rem;">
                        <label for="password" style="font-size: 1rem; color: #23408e; font-weight: 600; margin-bottom: 0.5rem; display: block;">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" style="width: 100%; border: 1.5px solid #23408e; border-radius: 8px; padding: 10px 12px; font-size: 1rem; margin-top: 4px; background: #f7faff; transition: border 0.2s; outline: none;">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div style="margin-bottom: 1.25rem; display: flex; align-items: center;">
                        <input id="remember_me" type="checkbox" name="remember" style="margin-right: 8px; accent-color: #23408e;">
                        <label for="remember_me" style="font-size: 0.95rem; color: #23408e;">Remember me</label>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-size: 0.95rem; color: #23408e; text-decoration: underline;">Forgot your password?</a>
                        @endif
                        <a href="{{ route('register') }}" style="font-size: 0.95rem; color: #23408e; text-decoration: underline;">Sign up</a>
                    </div>
                    <button type="submit" class="login-btn">Log in</button>
                    <a href="/welcome" style="display: flex; align-items: center; justify-content: flex-end; gap: 4px; text-align: right; margin-top: 1.25rem; color: #23408e; font-size: 1rem; font-family: 'Segoe UI', 'Inter', Arial, sans-serif; font-weight: 500; letter-spacing: 0.3px; text-decoration: none; transition: color 0.2s;">
                        <span style="display: inline-flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="margin-right: 2px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h5a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h5a1 1 0 001-1V10"/></svg>
                        </span>
                        <span>Return Home</span>
                    </a>
                </form>
            </div>
        </div>
    </main>
</div>

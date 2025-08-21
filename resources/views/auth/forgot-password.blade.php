
<style>
    html, body {
        height: 100vh;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }
</style>
<div style="position: relative; height: 100vh; font-family: 'Segoe UI', Arial, sans-serif; overflow: hidden;">
    <img src="/images/application.png" alt="Background" style="position: absolute; top: 0; left: 0; width: 100vw; height: 100vh; object-fit: cover; z-index: 0; filter: brightness(0.95);">
    <div style="position: absolute; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.15); z-index: 1;"></div>

    <main style="min-height: 100vh; display: flex; justify-content: center; align-items: center; position: relative; z-index: 3;">
        <div style="width: 420px; background: #fff; border-radius: 18px; box-shadow: 0 8px 32px rgba(0,0,0,0.10); padding: 40px 36px;">
            <h2 style="text-align: center; font-size: 28px; font-weight: bold; color: #23408e; margin-bottom: 24px;">Forgot your password?</h2>
            <div style="margin-bottom: 18px; font-size: 15px; color: #444; text-align: center;">
                {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div style="margin-bottom: 18px;">
                    <label for="email" style="font-size: 15px; color: #23408e; font-weight: bold;">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus style="width: 100%; border: 1px solid #b0b8d1; border-radius: 6px; padding: 8px; font-size: 16px; margin-top: 4px;">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <button type="submit" style="width: 100%; padding: 10px 0; background: #23408e; color: #fff; font-size: 18px; font-weight: bold; border: none; border-radius: 6px; cursor: pointer; transition: background 0.2s;">Email Password Reset Link</button>
            </form>
        </div>
    </main>
</div>

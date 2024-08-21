<x-auth-layout formTitle="Login to your account" title="Login">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">{{ __('Email') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" placeholder="your@email.com" autocomplete="off">
            <x-input-error :messages="$errors->get('email')" />
        </div>
        <div class="mb-2">
            <label class="form-label">
                {{ __('Password') }}
                <span class="form-label-description d-none">
                    <a href="./forgot-password.html">{{ __('Lupa password') }}</a>
                </span>
            </label>
            <div class="input-group input-group-flat">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Your password" name="password" autocomplete="off">
            </div>
        </div>
        <x-input-error :messages="$errors->get('password')" />
        <div class="mb-2">
            <label class="form-check">
                <input type="checkbox" class="form-check-input" name="remember" @if(old('remember')) checked @endif />
                <span class="form-check-label">Remember me on this device</span>
            </label>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">
                {{ __('Sign in') }}
            </button>
        </div>
    </form>

    <x-slot name="to_sign_up">
        <div class="text-center text-muted mt-3">
            Don't have account yet? <a href="{{ url('register') }}" tabindex="-1">Sign up</a>
        </div>
    </x-slot>
</x-auth-layout>

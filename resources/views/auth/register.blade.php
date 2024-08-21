<x-auth-layout formTitle="Create new account" title="Registrasi">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">{{ __('Nama lengkap') }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" placeholder="Nama lengkap" autocomplete="off">
            <x-input-error :messages="$errors->get('name')" />
        </div>
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
        <div class="mb-2">
            <label class="form-label">
                {{ __('Konfirmasi Password') }}
                <span class="form-label-description d-none">
                    <a href="./forgot-password.html">{{ __('Lupa password') }}</a>
                </span>
            </label>
            <div class="input-group input-group-flat">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    placeholder="Konfirmasi Password" name="password_confirmation" autocomplete="off">
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">
                {{ __('Sign up') }}
            </button>
        </div>
    </form>

    <x-slot name="to_sign_up">
        <div class="text-center text-muted mt-3">
            Already have account? <a href="{{ url('login') }}" tabindex="-1">Sign in</a>
        </div>
    </x-slot>
</x-auth-layout>

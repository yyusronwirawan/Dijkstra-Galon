<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Perbarui Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Pastikan anda menggunakan password yang kuat dan random untuk memastikan password anda aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mb-3">
            <label class="form-label">Password saat ini</label>
            <input type="password" name="current_password" class="form-control" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>
        <div class="mb-3">
            <label class="form-label">Password baru</label>
            <input type="password" name="password" class="form-control" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>
        <div class="mb-3">
            <label class="form-label">Konfirmasi password baru</label>
            <input type="password" name="password_confirmation" class="form-control" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mb-3">
            <x-primary-button>{{ __('Perbarui') }}</x-primary-button>
        </div>

        @if(session('status') === 'password-updated')
        <x-alert class="bg-success">
                Update Password profil berhasil
            </x-alert>
        @endif
    </form>
</section>

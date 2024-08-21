<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi profil akun kamu dan alamat email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label class="form-label">Nama lengkap</label>
            <input type="text" class="form-control" name="name"
                value="{{ old('name',$user->name) }}" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email"
                value="{{ old('email',$user->email) }}" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="mb-3">
            <x-primary-button>{{ __('Perbarui') }}</x-primary-button>
        </div>
        @if(session('status') === 'profile-updated')
            <x-alert class="bg-success">
                Update informasi profil berhasil
            </x-alert>
        @endif

    </form>
</section>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Perbarui Foto Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Perbarui foto profil pengguna') }}
        </p>
    </header>

    <form method="post" action="{{ route('picture.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <input type="file" class="form-control{{ $errors->get('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Konfirmasi Password" name="image" />
            <x-input-error :messages="$errors->updatePassword->get('image')" class="mt-2" />
        </div>

        @if(Auth::user()->getFirstMediaUrl() != '')
        <div class="mb-2">
            <img src="{{ Auth::user()->getFirstMediaUrl() }}" class="rounded" style="width:100px;height: 100px;object-fit: cover;" />
        </div>
        @endif

        <div class="mb-3">
            <x-primary-button>{{ __('Perbarui') }}</x-primary-button>
        </div>

        @if(session('status') === 'picture-updated')
            <x-alert class="bg-success">
                Update informasi profil berhasil
            </x-alert>
        @endif
    </form>
</section>

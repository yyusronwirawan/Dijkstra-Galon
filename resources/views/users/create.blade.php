<x-app-layout title="Tambah Pengguna">

    <x-slot name="pretitle">
        {{ __('Tambah') }}
    </x-slot>

    <x-slot name="pagetitle">
        {{ __('Pengguna') }}
    </x-slot>
    <div class="container-xl">
        <div class="col-12">
            @if(session('status'))
                <x-alert class="mb-2">
                    {{session('status')}}
                </x-alert>
            @endif

            <div class="card">
                <div class="card-body">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Informasi profil dan password pengguna.
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Perbarui informasi profil akun kamu dan alamat email.Pastikan anda menggunakan password yang kuat dan random untuk memastikan password anda aman.
                        </p>
                    </header>
                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        @include('users._form')
                        <div class="mb-3">
                            <x-primary-button>{{ __('Tambah Pengguna') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

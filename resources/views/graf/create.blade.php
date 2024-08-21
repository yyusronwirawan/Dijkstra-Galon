<x-app-layout title="Tambah Graf">

    <x-slot name="pretitle">
        {{ __('Tambah') }}
    </x-slot>

    <x-slot name="pagetitle">
        {{ __('Graf') }}
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
                            Formulir buat Graf baru
                        </h2>
                    </header>
                    <form method="POST" action="{{ route('grafs.store') }}" enctype="multipart/form-data">
                        @include('graf._form')
                        <div class="mt-3">
                            <x-primary-button>{{ __('Tambah Data') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

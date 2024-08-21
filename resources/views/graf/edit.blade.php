<x-app-layout title="Perbarui Pengguna">

    <x-slot name="pretitle">
        {{ __('Perbarui') }}
    </x-slot>

    <x-slot name="pagetitle">
        {{ __('Pengguna') }}
    </x-slot>
    <div class="container-xl">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Formulir perbarui Lahan
                        </h2>
                    </header>
                    <form method="POST" action="{{ route('lahans.update',[$lahan->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        @include('lahan._form')
                        <input type="hidden" name="id" value="{{ $lahan->id }}"/>
                        <div class="mb-3">
                            <x-primary-button>{{ __('Perbarui Data') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

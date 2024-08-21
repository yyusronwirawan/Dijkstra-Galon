<x-app-layout title="Profil">

    <x-slot name="pretitle">
        {{ __('Pengaturan') }}
    </x-slot>

    <x-slot name="pagetitle">
        {{ __('Profil') }}
    </x-slot>


    <div class="container-xl">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                            @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                            @include('profile.partials.update-picture-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

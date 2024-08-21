<x-app-layout title="Detail Pengguna">

    <x-slot name="pretitle">
        {{ __('Detail') }}
    </x-slot>

    <x-slot name="pagetitle">
        {{ __('Pengguna') }}
    </x-slot>
    <div class="container-xl">
        <div class="col-12">
            <div class="d-flex align-items-center gap-5">
                @if(File::exists($user->getFirstMediaUrl()))
                    <img src="{{ asset('img/default/test.jpg') }}" class="rounded-pill"
                        style="width:100px;height: 100px;object-fit:cover;" />
                @else
                    <x-default-image style="width:100px;height: 100px;object-fit:cover" />
                @endif
                <div class="d-flex flex-column align-items-start flex-wrap">
                    <span class="h3">{{ $user->name }}</span>
                    <span class="h4">{{ $user->email }}</span>
                    <span
                        class="badge rounded-pill text-bg-primary p-2">{{ Illuminate\support\Arr::join($user->getRoleNames()->toArray(),', ',' dan ') }}</span>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>

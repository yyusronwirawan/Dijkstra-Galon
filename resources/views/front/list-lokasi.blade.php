<x-front-layout title="List Lokasi">

    <x-slot name="style">
        <style>
            .img-ct{
                object-fit: cover;
                height:15rem;
            }
        </style>
    </x-slot>

    <div class="container-xl">
        <div class=" my-5">
            <h3>List Lokasi</h3>
            <div class="row">
                @foreach($lokasis as $lokasi)
                <div class="col-6 col-md-4 col-lg-3 mb-3">
                    <a href="{{ route('lokasi.detail',$lokasi->id) }}" class="text-decoration-none text-secondary">
                    <div class="card">
                        @if($lokasi->getFirstMediaUrl())
                        <img src="{{ $lahan->getFirstMediaUrl('default') }}" class="card-img-top img-ct" alt="..." />
                        @else
                        <img src="{{ asset('img/default/default.png') }}" class="card-img-top img-ct"
                            alt="{{ $lokasi->nama }}" />
                        @endif
                        <div class="card-body">
                            <h3 class="card-text">{{ $lokasi->nama }}<h3/>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach

                {{ $lokasis->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>

</x-front-layout>

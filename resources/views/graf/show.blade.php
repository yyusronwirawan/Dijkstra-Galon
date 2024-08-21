<x-app-layout title="Detail Lahan">
    <x-slot name="head">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
            integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet">
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>
    </x-slot>

    <x-slot name="pretitle">
        {{ __('Detail') }}
    </x-slot>

    <x-slot name="pagetitle">
        {{ __('Lahan') }}
    </x-slot>
    <div class="container-xl">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    @if($lahan->getFirstMediaUrl('default'))
                    <img src="{{ $lahan->getFirstMediaUrl('default') }}" class="rounded"
                        style="width:100%;height: 250px;object-fit:cover;" />
                    @else
                    <x-default-image style="width:100%;height: 250px;object-fit:cover" class="rounded" />
                    @endif
                </div>
                <table class="table table-sm table-borderless">
                    <tr>
                        <th>Nama</th>
                        <td></td>
                        <td>{{ $lahan->nama }}</td>
                    </tr>
                    <tr>
                        <th>Pemilik</th>
                        <td></td>
                        <td>{{ $lahan->nama_pemilik }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td></td>
                        <td>{{ $lahan->alamat_pemilik }}</td>
                    </tr>
                    <tr>
                        <th>No Hp</th>
                        <td></td>
                        <td><a href="tel:{{ $lahan->no_hp }}">{{ $lahan->no_hp }}</a></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td></td>
                        <td>{{ $lahan->harga }}</td>
                    </tr>
                    <tr>
                        <th>Estimasi Panen</th>
                        <td></td>
                        <td>{{ $lahan->estimasi_panen }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-9">
                <div id="map" style="height:60vh;width:100%"></div>
            </div>
        </div>
    </div>

    <script>
        var lat = {{ $lahan ?$lahan-> node -> latitude : env('DEFAULT_LAT') }}
        var lng = {{ $lahan ?$lahan-> node -> longitude : env('DEFAULT_LNG') }}
        var map = L.map('map').setView([lat, lng], 13);
        var marker = {};
        var input_lat = document.querySelector('[name=latitude]')
        var input_lng = document.querySelector('[name=longitude]')

        @if ($lahan)
            marker = L.marker([lat, lng], { }).addTo(map)
        @endif
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: '© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>',
            tileSize: 512,
            maxZoom: 18,
            zoomOffset: -1,
            id: 'mapbox/streets-v12',
            accessToken: 'pk.eyJ1IjoiZWZhbGFyZGFuIiwiYSI6ImNrb3ZhOHQ0ZTA1aWUydnFrM2dieDl4dXAifQ.fK4aUzElWouNwOWx3tLKxw'
        }).addTo(map);
    </script>

</x-app-layout>

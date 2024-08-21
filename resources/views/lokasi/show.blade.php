<x-app-layout title="Detail lokasi">
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
        {{ __('lokasi') }}
    </x-slot>
    <div class="container-xl">
        <div class="row">
            <div class="col-12 col-md-3">
                <table class="table table-sm table-borderless">
                    <tr>
                        <th>Nama</th>
                        <td></td>
                        <td>{{ $lokasi->nama }}</td>
                    </tr>
                    <tr>
                        <th>No Hp</th>
                        <td></td>
                        <td><a href="tel:{{ $lokasi->no_hp }}">{{ $lokasi->no_hp }}</a></td>
                    </tr>
                    <th>Alamat</th>
                        <td></td>
                        <td>{{ $lokasi->alamat_pemilik }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-9">
                <div id="map" style="height:60vh;width:100%"></div>
            </div>
        </div>
    </div>

    <script>
        var lat = {{ $lokasi ? $lokasi->node->latitude : env('DEFAULT_LAT') }}
        var lng = {{ $lokasi ? $lokasi->node->longitude : env('DEFAULT_LNG') }}
        var map = L.map('map').setView([lat, lng], 13);
        var marker = {};
        var input_lat = document.querySelector('[name=latitude]')
        var input_lng = document.querySelector('[name=longitude]')

        @if ($lokasi)
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

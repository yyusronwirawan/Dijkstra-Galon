<x-front-layout title="{{ $lokasi->nama }}">

    <x-slot name="style">
        <style>
            .img-ct {
                object-fit: cover;
                height: 15rem;
            }
        </style>
    </x-slot>

    <x-slot name="head">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
            integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet">
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    </x-slot>

    <div class="container-xl">
        <div class=" my-5">
            <h1>Detail Lokasi</h1>
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3 mb-3">
                    @if($lokasi->getFirstMediaUrl())
                    <img src="{{ $lokasi->getFirstMediaUrl('default') }}" class="card-img-top rounded img-ct mb-2" alt="..." />
                        @else
                        <img src="{{ asset('img/default/default.png') }}" class="card-img-top rounded img-ct mb-2"
                            alt="{{ $lokasi->nama }}" />
                        @endif
                        <div class="card">
                            <div class="card-body">
                            <p class="fw-light fst-italic">* Informasi lokasi</p>
                            <table class="table table-sm table-striped">
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $lokasi->nama }}</td>
                                </tr>
                                <tr>
                                    <th>No Hp</th>
                                    <td>{{ $lokasi->no_hp }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $lokasi->alamat_pemilik }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="map" style="min-height:35rem;" class="col-12 col-md-8 col-lg-9">
                </div>
            </div>
        </div>


        <script>

var lat = {{ $lokasi->node->latitude }}
var lng = {{ $lokasi->node->longitude }}

var map = L.map('map').setView([lat, lng], 20);
var nodes = {};
var markers = [];
var input_lat = document.querySelector('[name=latitude]')
var input_lng = document.querySelector('[name=longitude]')

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: '© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>',
    tileSize: 512,
    maxZoom: 18,
    zoomOffset: -1,
    id: 'mapbox/streets-v12',
    accessToken: '{{ env('MAPBOX_TOKEN') }}'
}).addTo(map);


async function getNodes() {
    nodes = await fetch('{{ route('home.nodes') }}')
        .then(res => res.json())
        .then(json => json)
}

var lokasiIcon = L.icon({
    iconUrl: '{{ asset('static/map/marker-red.png') }}',
    iconSize: [19, 25],
});
var nodeIcon = L.icon({
    iconUrl: '{{ asset('static/map/marker-blue.png') }}',
    iconSize: [19, 25],
});

async function showMarkers() {
    await getNodes()
    nodes.map((e) => {
        console.log(e)
        markers.push(
            L.marker([e.latitude, e.longitude],{icon: e.lokasi == null ? lokasiIcon : nodeIcon}).addTo(map)
                .bindPopup(`
                <div class='d-flex flex-column'>
                    <b class='mb-2'>
                        ${e.lokasi ? e.lokasi.nama : 'Node' + e.id}
                    </div>
                `)
        )
    })
}

showMarkers();
</script>
</x-front-layout>

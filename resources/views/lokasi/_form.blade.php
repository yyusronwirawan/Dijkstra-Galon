@csrf
<x-slot name="head">
    <link rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
        crossorigin />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
        crossorigin></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css"
        rel="stylesheet">
    <script
        src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>
</x-slot>

<div class="row">
    <div class="col-12 col-md-6">
        <!-- form -->
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text"
                class="form-control {{ $errors->get('nama') ? 'is-invalid' : '' }}"
                placeholder="Masukan nama lokasi" name="nama"
                value="{{ old('nama',$lokasi->nama ?? '') }}" />
            <x-input-error :messages="$errors->get('nama')" />
        </div>
        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text"
                class="form-control {{ $errors->get('no_hp') ? 'is-invalid' : '' }}"
                placeholder="Masukan no hp pemilik" name="no_hp"
                value="{{ old('no_hp',$lokasi->no_hp ?? '') }}" />
            <x-input-error :messages="$errors->get('no_hp')" />
        </div>
        <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" 
                    class="form-control {{ $errors->get('alamat_pemilik') ? 'is-invalid' : '' }}"
                        placeholder="Masukan alamat pelanggan" name="alamat_pemilik"
                        value="{{ old('alamat_pemilik',$lokasi->alamat_pemilik ?? '') }}" />
                    <x-input-error :messages="$errors->get('alamat_pemilik')" />
                </div>
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Latitude</label>
                    <input type="text"
                        class="form-control {{ $errors->get('latitude') ? 'is-invalid' : '' }}"
                        placeholder="Masukan Latitude" name="latitude"
                        value="{{ old('latitude',$lokasi->node->latitude ?? '') }}" />
                    <x-input-error :messages="$errors->get('latitude')" />
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Longitude</label>
                    <input type="text"
                        class="form-control {{ $errors->get('longitude') ? 'is-invalid' : '' }}"
                        placeholder="Masukan Longitude" name="longitude"
                        value="{{ old('longitude',$lokasi->node->longitude ?? '') }}" />
                    <x-input-error :messages="$errors->get('longitude')" />
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div id="map" style="height:100%;width:100%">

        </div>
    </div>
</div>
<script>
    @isset($lokasi)
    var lat = {{ $lokasi ? $lokasi->node->latitude : env('DEFAULT_LAT') }}
    var lng = {{ $lokasi ? $lokasi->node->longitude : env('DEFAULT_LNG') }}
    @else
    var lat = {{ env('DEFAULT_LAT') }}
    var lng = {{ env('DEFAULT_LNG') }}
    @endisset
    var map = L.map('map').setView([lat, lng], 13);
    var marker = {};
    var input_lat = document.querySelector('[name=latitude]')
    var input_lng = document.querySelector('[name=longitude]')

    @isset($lokasi)
    marker = L.marker([lat, lng], { draggable: true }).addTo(map)
    dragEndMarker({})
    @endif
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: '© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>',
        tileSize: 512,
        maxZoom: 18,
        zoomOffset: -1,
        id: 'mapbox/streets-v12',
        accessToken: 'pk.eyJ1IjoiZWZhbGFyZGFuIiwiYSI6ImNrb3ZhOHQ0ZTA1aWUydnFrM2dieDl4dXAifQ.fK4aUzElWouNwOWx3tLKxw'
    }).addTo(map);

    function addMarker(e) {
        let { lat, lng } = e.latlng
        if (marker.hasOwnProperty('_latlng')) {
            marker.remove();
        }
        marker = L.marker([lat, lng], { draggable: true }).addTo(map)
        input_lat.value = lat, input_lng.value = lng
        dragEndMarker(e)
    }

    function dragEndMarker(e) {
        marker.on('moveend', function (e) {
            addMarker({latlng:e.target._latlng})
        })
    }

    map.on('click', addMarker)
</script>

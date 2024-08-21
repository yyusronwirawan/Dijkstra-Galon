<x-front-layout title="Home">

    <x-slot name="style">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
        <style>
            @media (min-width: 0px) and (max-width:768px){
                #map{
                    min-height: calc(100vh - 60px);
                    width: 100%;
                }
            }
            @media (min-width: 768px) {
                #map{
                    min-height: calc(100vh - 120px);
                    width: 100%;
                }
            }

        </style>
    </x-slot>

    @csrf
    <x-slot name="head">
        <meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
            integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet">
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

    </x-slot>

    <div id="map"></div>

    <!-- Modal detail perhitungan-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Perhitungan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="detail_perhitungan"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" data-bs-scroll="true"   data-bs-backdrop="false" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Keterangan</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">
    <div class="row">
        <div class="col-12 col-md-4 mb-2">
      <div class="">
        Jarak
      </div>
    <h1 class="card-title fw-bolder h1" id="distance">0 Km</h1>
    <div class="">
        Waktu yang ditempuh
      </div>
    <h1 class="card-title fw-bolder h1" id="time">0 menit</h1>
        </div>
        <div class="col-12 col-md-4 mb-2" >
                <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="12" cy="11" r="3" />
  <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
</svg>
                            Start
                        </div>
                        <h3 class="card-title fw-bolder h3" id="start">....</h3>

                    </div>
                    <div>
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-current-location" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="12" cy="12" r="3" />
  <circle cx="12" cy="12" r="8" />
  <line x1="12" y1="2" x2="12" y2="4" />
  <line x1="12" y1="20" x2="12" y2="22" />
  <line x1="20" y1="12" x2="22" y2="12" />
  <line x1="2" y1="12" x2="4" y2="12" />
</svg>
                            End
                        </div>
                        <h3 class="card-title fw-bolder h3" id="end">...</h3>
                    </div>
                </div>
                <div class="d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-route" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="6" cy="19" r="2" />
  <circle cx="18" cy="5" r="2" />
  <path d="M12 19h4.5a3.5 3.5 0 0 0 0 -7h-8a3.5 3.5 0 0 1 0 -7h3.5" />
</svg>
                    <div>Rute</div>
                </div>
                <h3 id="rute">...</h3>
</div>
        </div>
        <div class="col-12 col-md-4">
            <div class="d-flex justify-content-start justify-content-md-end flex-column align-items-md-end">
                <p>Berikut adalah detail perhitungan Djikstra</p>
            <!-- Button trigger modal -->
<button type="button" class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Detail Perhitungan
</button>
            </div>
        </div>
    </div>
  </div>
</div>



    <script>
var lat = {{ env('DEFAULT_LAT') }}
var lng = {{ env('DEFAULT_LNG') }}

var map = L.map('map').setView([lat, lng], 13);
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

var lahanIcon = L.icon({
    iconUrl: '{{ asset('static/map/marker-red.png') }}',
    iconSize: [19, 25],
});
var nodeIcon = L.icon({
    iconUrl: '{{ asset('static/map/marker-blue.png') }}',
    iconSize: [19, 25],
});
var currentIcon = L.icon({
    iconUrl: '{{ asset('static/map/marker-green.png') }}',
    iconSize: [19, 25],
});

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position){
        current_lat = position.coords.latitude;
        current_lng = position.coords.longitude;
        L.marker([current_lat,current_lng],{icon:currentIcon}).addTo(map).bindPopup(
            `<button class="btn btn-primary" id="current" onclick="event.preventDefault();setCurrentAsStart(this,${current_lat},${current_lng})">Set start</button>`
        );
    });
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
getLocation();

async function showMarkers() {
    await getNodes()
    nodes.map((e) => {
        markers.push(
            L.marker([e.latitude, e.longitude],{icon: e.lokasi == null ? lahanIcon : nodeIcon}).addTo(map)
                .bindPopup(`
                <div class='d-flex flex-column' style='width:15rem'>
                    <b class='mb-2'>
                        ${e.lokasi ? e.lokasi.nama+' (Node ' + e.id+')' : 'Node ' + e.id}
                        </b>
                         ${e.lokasi ?
                        `<table class='table table-sm table-nowrap'>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <td>${e.lokasi.nama}</td>
                            </tr>
                            <tr>
                                <th>Alamat Pelanggan</th>
                                <td>${e.lokasi.alamat_pemilik}</td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td>${e.lokasi.no_hp}</td>
                            </tr>
                        </table>`
                         : ''}

                        <br/>
                        <div class='d-flex gap-1 mt-2 mb-2'>
                            <button class='btn btn-primary w-50 btn-block' onClick='event.preventDefault();setStart(${e.id},${e.latitude},${e.longitude})'>Set Start</button>
                            <button class='btn btn-primary w-50 btn-block' onClick='event.preventDefault();setEnd(${e.id},${e.latitude},${e.longitude})'>Set End</button>
                            </div>
                            <button class='btn col-12' onClick='event.preventDefault();getRoute()'>Dapatkan Rute</button>
                    </div>
                `)
        )
    })
}

showMarkers();

var start;
var start_coord;
var end;
var end_coord;

function setCurrentAsStart(e,lat,lng){
    var url = new URL('{{ route('setCurrentAsStart') }}');
    url.search = new URLSearchParams({lat,lng});
    fetch(url)
}

function setStart(id){
    var url = new URL('{{ route('setStartPoint') }}');
    url.search = new URLSearchParams({id:id}).toString()
    fetch(url)
}

function setEnd(id,lat,lng){
    var url = new URL('{{ route('setEndPoint') }}');
    url.search = new URLSearchParams({id:id}).toString()
    fetch(url)
}

// create a function to make a directions request
var polyline;

function createPolyline(latlngs){

    if(polyline){
        polyline.remove()
    }
    var _latlngs = latlngs.map(e => {
        return JSON.parse(e)
    })

    var latlngs = [];
    _latlngs.forEach(e => {
        e.forEach(f => {
            latlngs.push([f[1],f[0]])
        })
    })

    polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);

    // zoom the map to the polyline
    map.fitBounds(polyline.getBounds());
}

const bsOffcanvas = new bootstrap.Offcanvas('#offcanvasBottom')
function getRoute() {
    bsOffcanvas.show();
    var url = new URL('{{ route('getShortestPath') }}');
        fetch(url)
        .then(e => e.json())
        .then(json => {
            // console.log(json.coordinates)
            if(json.coordinates.length > 0){
                console.log(json)
                createPolyline(json.coordinates);
                document.querySelector('#distance').innerHTML = json.distance;
                document.querySelector('#time').innerHTML = json.time;
                document.querySelector('#start').innerHTML = json.start.lokasi ? json.start.lokasi.nama : `Node ${json.start.id}`;
                document.querySelector('#end').innerHTML = json.end.lokasi ? json.end.lokasi.nama : `Node ${json.end.id}`;
                document.querySelector('#rute').innerHTML = json.path;
                document.querySelector('#detail_perhitungan').innerHTML = json.perhitungan;
            }else{
                alert('Rute tidak ditemukan')
                            document.querySelector('#distance').innerHTML = '- Km';
                document.querySelector('#rute').innerHTML = '....';
                document.querySelector('#detail_perhitungan').innerHTML = 'Rute tidak ditemukan';
            }
        })
}


</script>
</x-front-layout>

@csrf
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

<div class="row">
    <div class="col-12 col-md-4">
        <!-- form -->
        <div class="mb-3">
            <label class="form-label">Start</label>
            <select id="select-start" name="start" placeholder="Start">
                <option value="">Start</option>
                @foreach($nodes as $node)
                <option value="{{ $node->id }}">
                    {{ $node->lahan ? $node->lahan->nama : 'Node '.$node->id }}
                </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('nama')" />
        </div>
        <div class="mb-3">
            <label class="form-label">End</label>
            <select id="select-end" name="end" placeholder="End">
                <option value="">End</option>
                @foreach($nodes as $node)
                <option value="{{ $node->id }}">
                    {{ $node->lahan ? $node->lahan->nama : 'Node '.$node->id }}
                </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('nama')" />
        </div>
        <div class="mb-3">
            <label class="form-label">Jarak</label>
            <input type="text" class="form-control {{ $errors->get('jarak') ? 'is-invalid' : '' }}"
                placeholder="Masukan jarak" name="jarak" value="{{ old('jarak',$lahan->jarak ?? '') }}" />
            <x-input-error :messages="$errors->get('jarak')" />
        </div>
        <div class="d-none">
            <label class="form-label">Rute</label>
            <textarea class="form-control {{ $errors->get('rute') ? 'is-invalid' : '' }}" rows="10"
                placeholder="Rute" name="rute"></textarea>
            <x-input-error :messages="$errors->get('rute')" />
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div id="map" style="height:100%;width:100%;min-height: 400px;">

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    var control_start = new TomSelect('#select-start')
    var control_end = new TomSelect('#select-end')
</script>
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


// ---------------- add marker ---------------
var marker;
function addMarker(e) {
    let { lat, lng } = e.latlng
    if (marker) {
        marker.remove();
    }
    marker = L.marker([lat, lng], { draggable: true }).addTo(map)
    dragEndMarker(e)
}

function popUpContent(e){
    let {lat,lng} = e.latlng
    let html = `
    <div style="min-width:200px;">
    <input type="text" class="form-control mb-1" id="nodeLat" value="${lat}"/>
    <input type="text" class="form-control mb-1" id="nodeLng" value="${lng}"/>
    <button class='btn btn-success w-100' onclick='event.preventDefault();addNode()'>Tambah Node</button>
    </div>`;
    marker.bindPopup(html).openPopup();
}

function dragEndMarker(e) {
    popUpContent(e)
    marker.on('moveend', function (e) {
        addMarker({latlng:e.target._latlng})
    })
}

async function addNode(){
    let lat = document.getElementById('nodeLat').value
    let lng = document.getElementById('nodeLng').value
    const response = await fetch(`{{ route('grafs.nodes') }}`, {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({latitude: lat, longitude:lng})
  })
  marker.remove()
    showMarkers()
}

map.on('click', addMarker)
// ---------------- end add marker ---------------

async function getNodes() {
    nodes = await fetch('{{ route('grafs.nodes') }}')
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

async function showMarkers() {
    await getNodes()
    nodes.map((e) => {
        console.log(e)
        markers.push(
            L.marker([e.latitude, e.longitude],{icon: e.lokasi == null ? lahanIcon : nodeIcon}).addTo(map)
                .bindPopup(`
                <div class='d-flex flex-column'>
                    <b class='mb-2'>
                        ${e.lokasi ? e.lokasi.nama+' (Node '+e.id+')' : 'Node' + e.id}
                        </b>
                        <div class='d-flex gap-1 mb-2'>
                            <button class='btn btn-primary' onClick='event.preventDefault();setStart(${e.id},${e.latitude},${e.longitude})'>Set Start</button>
                            <button class='btn btn-primary' onClick='event.preventDefault();setEnd(${e.id},${e.latitude},${e.longitude})'>Set End</button>
                            ${
                                e.lokasi == undefined ?
                                `<button class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash m-0 p-0" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <line x1="4" y1="7" x2="20" y2="7" />
                                    <line x1="10" y1="11" x2="10" y2="17" />
                                    <line x1="14" y1="11" x2="14" y2="17" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                    </button>`
                                :
                                ''
                            }
                            </div>
                            <button class='btn' onClick='event.preventDefault();getRoute()'>Dapaatkan Rute</button>
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

function setStart(id,lat,lng){
    control_start.setValue(id)
    start = id;
    start_coord = [lat,lng]
    console.log('start',start,start_coord)
}

function setEnd(id,lat,lng){
    control_end.setValue(id)
    end = id;
    end_coord = [lat,lng]
    console.log('end',end,end_coord)
}

    // create a function to make a directions request
var polyline;
async function getRoute() {
//  console.log(polyline);

    if(polyline){
        polyline.remove();
    }

    if(!start){
            alert('Titik awal belum dipilih')
            return false;
        }
        if(!end){
            alert('Titik akhir belum dipilih')
            return false;
        }
  // make a directions request using cycling profile
  // an arbitrary start will always be the same
  // only the end or destination will change
  const query = await fetch(
    `https://api.mapbox.com/directions/v5/mapbox/driving/${start_coord[1]},${start_coord[0]};${end_coord[1]},${end_coord[0]}?steps=true&geometries=geojson&access_token={{ env('MAPBOX_TOKEN') }}`,
    { method: 'GET' }
  );
  const json = await query.json();
  const distance = json.routes[0].distance;
  const data = json.routes[0];

  console.log(data.geometry.coordinates.toString());
  const route = [];
  data.geometry.coordinates.map(e => {
        route.push([e[1],e[0]]);
    })

 polyline = L.polyline(route, {color: 'red'}).addTo(map);
 map.fitBounds(polyline.getBounds());
 document.querySelector('[name="rute"]').value = JSON.stringify(data.geometry.coordinates)
 document.querySelector('[name="jarak"]').value = distance
}


</script>

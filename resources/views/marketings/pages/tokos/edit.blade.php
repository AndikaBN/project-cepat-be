<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Edit Toko</title>
    <style>
        .text-center {
            text-align: center;
        }

        #map {
            width: 100%;
            height: 90vh;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
</head>

<body>
    <h1 class='text-center'>Edit Toko </h1>
    <div id='map'></div>
    <form method="POST" action="{{ route('toko.update', $toko->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="latitude">Latitude:</label>
            <input type="text" id="latitude" name="latitude" value="{{ $toko->latitude }}" readonly>
        </div>
        <div>
            <label for="longitude">Longitude:</label>
            <input type="text" id="longitude" name="longitude" value="{{ $toko->longitude }}" readonly>
        </div>
        <div>
            <label for="nama_toko">Nama Toko:</label>
            <input type="text" id="nama_toko" name="nama_toko" value="{{ $toko->nama_toko }}" required>
        </div>
        <div>
            <label for="area">Area:</label>
            <input type="text" id="area" name="area" value="{{ $toko->area }}" required>
        </div>
        <div>
            <button type="submit">Update Toko</button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        let map = L.map('map').setView([{{ $toko->latitude }}, {{ $toko->longitude }}], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        const redIcon = new L.Icon({
            iconUrl: '/img/market.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.4/images/marker-shadow.png',
            iconSize: [41, 61],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        const marker = L.marker([{{ $toko->latitude }}, {{ $toko->longitude }}], {
            draggable: true,
            icon: redIcon
        }).addTo(map);

        map.on('click', function(e) {
            const {
                lat,
                lng
            } = e.latlng;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            marker.setLatLng([lat, lng]);
        });

        marker.on('dragend', function(e) {
            const {
                lat,
                lng
            } = marker.getLatLng();
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    </script>
</body>

</html>

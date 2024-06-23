<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Leaflet Maps</title>
    <style>
        #map {
            width: 100%;
            height: 500px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>
<body>
    <h1>Lokasi check in sales {{ $user->name }} pada tanggal {{ $date }}</h1>
    <div id="map"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-8.609471, 116.135256], 13);

        L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        }).addTo(map);

        function addMarkers(checkins) {
            checkins.forEach(function(checkin) {
                var marker = L.marker([checkin.latitude, checkin.longitude]).addTo(map);
                marker.bindPopup(`<b>Latitude:</b> ${checkin.latitude}<br><b>Longitude:</b> ${checkin.longitude}`);
            });
        }

        var checkins = @json($checkins);

        $(document).ready(function() {
            addMarkers(checkins);
        });
    </script>
</body>
</html>

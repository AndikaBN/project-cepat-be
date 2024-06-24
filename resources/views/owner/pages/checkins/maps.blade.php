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
        // Initialize the map with the desired view and zoom level
        var map = L.map('map').setView([-8.609471, 116.135256], 13);

        // Use OpenStreetMap tile layer to avoid default markers
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);

        // Function to add markers from the database check-ins and draw lines
        function addMarkersAndLines(checkins) {
            var latlngs = [];
            checkins.forEach(function(checkin) {
                // Create a marker for each check-in
                var marker = L.marker([checkin.latitude, checkin.longitude]).addTo(map);
                // Bind a popup to the marker displaying latitude and longitude
                marker.bindPopup(`<b>Latitude:</b> ${checkin.latitude}<br><b>Longitude:</b> ${checkin.longitude}`);
                // Add the marker position to the latlngs array
                latlngs.push([checkin.latitude, checkin.longitude]);
            });
            // Create a polyline connecting all the markers
            if (latlngs.length > 1) {
                var polyline = L.polyline(latlngs, {
                    color: 'blue'
                }).addTo(map);
            }
        }

        // Retrieve the check-ins data from the backend
        var checkins = @json($checkins);

        // Wait for the document to be fully loaded before adding markers and lines
        $(document).ready(function() {
            addMarkersAndLines(checkins);
        });
    </script>
</body>

</html>

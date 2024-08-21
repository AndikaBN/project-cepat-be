<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Leaflet Maps</title>
    <style>
        #map {
            width: 100vw;
            height: 100vh;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>

<body>
    <h1>Lokasi check in sales {{ $user->name }} pada tanggal {{ $date }}</h1>
    <div id="map"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                // Extract the check-in and check-out times
                var checkInTime = new Date(checkin.first_checkin).toLocaleTimeString();
                var checkOutTime = new Date(checkin.last_checkout).toLocaleTimeString();

                // Tambahkan informasi urutan kunjungan
                var visitOrder = `Kunjungan ${checkin.visit_order}`;

                // Bind a popup to the marker displaying check-in and check-out times with visit order
                marker.bindPopup(`
            <b>${visitOrder}</b><br>
            <b>Outlet:</b> ${checkin.outlet_name}<br>
            <b>Jam Check-in:</b> ${checkInTime}<br>
            <b>Jam Check-out:</b> ${checkOutTime}<br>
            
            <b>Jumlah Transaksi:</b> ${checkin.total_orders}<br>
            <b>Jumlah Tagihan:</b> Rp${checkin.total_billing.toLocaleString()}
        `);

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

        // Function to add toko markers
        function addTokoMarkers(tokos) {
            tokos.forEach(function(toko) {
                // Create a marker for each toko
                var marker = L.marker([toko.latitude, toko.longitude], {
                    icon: redIcon
                }).addTo(map);
                // Bind a popup to the marker displaying toko information
                marker.bindPopup(`<b>Nama Toko:</b> ${toko.nama_toko}<br><b>Area:</b> ${toko.area}`);
            });
        }

        // Define red icon for toko markers
        var redIcon = new L.Icon({
            iconUrl: '/img/departmentstore.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Retrieve the check-ins and toko data from the backend
        var checkins = @json($checkins);
        var tokos = @json($tokos);

        // Wait for the document to be fully loaded before adding markers and lines
        $(document).ready(function() {
            addMarkersAndLines(checkins);
            addTokoMarkers(tokos);
        });
    </script>
</body>

</html>

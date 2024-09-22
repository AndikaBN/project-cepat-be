<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Leaflet Maps</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        #container {
            display: flex;
        }

        #details {
            width: 300px;
            padding: 10px;
            background-color: #f4f4f4;
            border-right: 2px solid #ccc;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        #map {
            flex: 1;
            height: 100vh;
        }

        #filterToko {
            width: 300px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 2px solid #ccc;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            font-family: Arial, sans-serif;
        }

        #filterToko h3 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .accordion {
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 8px;
            cursor: pointer;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            font-size: 16px;
            position: relative;
        }

        .accordion::after {
            content: '\25BC';
            /* Down arrow */
            position: absolute;
            right: 10px;
            font-size: 12px;
            transition: transform 0.3s;
        }

        .accordion.active::after {
            transform: rotate(180deg);
            /* Up arrow */
        }

        .panel {
            display: none;
            overflow: hidden;
            padding: 10px;
            background-color: white;
            border: 1px solid #ccc;
            border-top: none;
        }

        /* When the panel is active */
        .panel.active {
            display: block;
        }


        .accordion:hover {
            background-color: #ddd;
        }

        .panel {
            display: none;
            overflow: hidden;
            padding: 10px;
            background-color: white;
            border: 1px solid #ccc;
            border-top: none;
        }

        .visit-order {
            font-size: 20px;
            font-weight: bold;
            color: red;
            text-align: center;
            padding: 0px;
            position: absolute;
            top: 0px;
            /* Adjust based on your icon size */
            left: 100%;
            transform: translateX(-50%);
            background-color: white;
            border-radius: 100%;
            /* Make the background circular */
            width: 30px;
            /* Adjust width to make it circular */
            height: 30px;
            /* Adjust height to match width */
            line-height: 30px;
            /* Center the text vertically */
            z-index: 1000;
            text-shadow:
                -1px -1px 0 #000,
                1px -1px 0 #000,
                -1px 1px 0 #000,
                1px 1px 0 #000;
            /* Black shadow creates a border effect */
        }

        .custom-icon {
            position: relative;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>

<body>
    <div id="container">
        <div id="details">
            <!-- Details section on the left (no changes here) -->
        </div>

        <div id="map">
            <!-- Map in the center -->
        </div>

        <div id="filterToko">
            <h3>Filter Toko</h3>

            <div class="accordion">Filter Area</div>
            <div class="panel">
                <label for="areaFilter">Area:</label>
                <div id="areaFilter">
                    <!-- Populate area checkboxes dynamically -->
                </div>
            </div>

            <div class="accordion">Filter Daerah</div>
            <div class="panel">
                <label for="daerahFilter">Daerah:</label>
                <div id="daerahFilter">
                    <!-- Populate daerah checkboxes dynamically -->
                </div>
            </div>

            <button onclick="filterTokoMarkers()">Filter Toko</button>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialize the map with the desired view and zoom level
        var map = L.map('map').setView([-8.609471, 116.135256], 13);

        // Use OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20
        }).addTo(map);

        // Function to format duration in hours and minutes
        function formatDuration(start, end) {
            var startTime = new Date(start);
            var endTime = new Date(end);
            var duration = Math.floor((endTime - startTime) / 60000); // Duration in minutes
            var hours = Math.floor(duration / 60);
            var minutes = duration % 60;
            return hours + 'h ' + minutes + 'm';
        }

        // Function to calculate distance between two lat/lng points in meters
        function calculateDistance(lat1, lon1, lat2, lon2) {
            var R = 6371000; // Radius of the Earth in meters
            var dLat = (lat2 - lat1) * Math.PI / 180;
            var dLon = (lon2 - lon1) * Math.PI / 180;
            var a =
                0.5 - Math.cos(dLat) / 2 +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                (1 - Math.cos(dLon)) / 2;
            return R * 2 * Math.asin(Math.sqrt(a));
        }

        // Function to add markers from the database check-ins and draw lines
        function addMarkersAndLines(checkins, tokos) {
            var latlngs = [];
            var detailsHtml = '';

            checkins.forEach(function(checkin, index) {

                var checkInTime = new Date(checkin.created_at).toLocaleTimeString();
                var checkOutTime;

                if (checkin.updated_at) {
                    checkOutTime = new Date(checkin.updated_at).toLocaleTimeString();
                } else {
                    checkOutTime = 'Waktu Check-out Tidak Tersedia';
                }



                var duration = checkin.updated_at ? formatDuration(checkin.created_at, checkin.updated_at) :
                    'Durasi Tidak Tersedia';

                // Lanjutkan dengan kode yang lain seperti biasa...
                var nearestToko = null;
                var minDistance = Infinity;

                tokos.forEach(function(toko) {
                    var distance = calculateDistance(checkin.latitude, checkin.longitude, toko.latitude,
                        toko.longitude);
                    if (distance < minDistance) {
                        minDistance = distance;
                        nearestToko = toko;
                    }
                });

                var markerColor = (minDistance <= 10) ? 'biru' : 'merah';
                var status = (markerColor === 'biru') ? 'Berhasil Check-in' : 'Gagal Check-in';

                var customIcon = L.divIcon({
                    className: 'custom-icon',
                    html: `
                    <div class="visit-order">${index + 1}</div>
                    <img src="/img/map${markerColor}.png" width="60" height="60" />
                `,
                    iconSize: [30, 30],
                    iconAnchor: [15, 30]
                });

                var marker = L.marker([checkin.latitude, checkin.longitude], {
                    icon: customIcon
                }).addTo(map);

                latlngs.push([checkin.latitude, checkin.longitude]);

                if (markerColor === 'merah' && nearestToko) {
                    var tokoMarker = L.marker([nearestToko.latitude, nearestToko.longitude], {
                        icon: redIcon
                    }).addTo(map);

                    tokoMarker.bindPopup(`<b>${nearestToko.nama_toko}</b><br>${nearestToko.area}`).openPopup();

                    tokoMarker.on('mouseover', function() {
                        this.openPopup();
                    });

                    tokoMarker.on('mouseout', function() {
                        this.closePopup();
                    });
                }

                detailsHtml += `
                    <div class="accordion">Kunjungan ${index + 1}</div>
                    <div class="panel">
                        <b>Outlet:</b> ${checkin.outlet_name}<br>
                        <b>Jam Check-in:</b> ${checkInTime}<br>
                        <b>Jam Check-out:</b> ${checkOutTime}<br>
                        <b>Durasi:</b> ${duration}<br>
                        <b>Status:</b> ${status}<br>
                        <b>Jumlah Transaksi:</b> ${checkin.total_orders}<br>
                        <b>Jumlah Tagihan:</b> Rp${(checkin.total_billing || 0).toLocaleString()}
                    </div>
                `;
            });


            // Create a polyline connecting all the markers
            if (latlngs.length > 1) {
                L.polyline(latlngs, {
                    color: 'blue'
                }).addTo(map);
            }

            // Update the details section
            $('#details').html(detailsHtml);

            // Attach click event to accordion
            var acc = document.getElementsByClassName("accordion");
            for (var i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.display === "block") {
                        panel.style.display = "none";
                    } else {
                        panel.style.display = "block";
                    }
                });
            }
        }

        // Define red icon for toko markers
        var redIcon = L.icon({
            iconUrl: '/img/departmentstore.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });


        function addTokoMarkers(tokos) {
            tokos.forEach(function(toko) {
                var marker = L.marker([toko.latitude, toko.longitude], {
                    icon: redIcon // Menggunakan redIcon yang sudah didefinisikan
                }).addTo(map);

                // Tambahkan popup dengan nama toko
                marker.bindPopup(`<b>${toko.nama_toko}</b>`);

                marker.on('mouseover', function() {
                    console.log('Mouse over marker:', toko.nama_toko);
                    marker.openPopup();
                });

                marker.on('mouseout', function() {
                    console.log('Mouse out of marker:', toko.nama_toko);
                    marker.closePopup();
                });

            });
        }



        // Fetch checkins and tokos data from the server
        var checkins = @json($checkins);
        var tokos = @json($tokos);

        // Document ready function
        $(document).ready(function() {
            addMarkersAndLines(checkins, tokos);
            addTokoMarkers(tokos);
        });

        // Populate Area checkboxes dynamically
        // Populate Area checkboxes dynamically
        function populateAreaOptions() {
            var areas = [...new Set(tokos.map(toko => toko.area))]; // Get unique areas
            var areaContainer = document.getElementById('areaFilter');

            areas.forEach(function(area) {
                var checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.value = area;
                checkbox.name = 'area';

                // Tambahkan event listener untuk memanggil filterDaerahOptions saat checkbox area diubah
                checkbox.addEventListener('change', filterDaerahOptions);

                var label = document.createElement('label');
                label.appendChild(checkbox);
                label.appendChild(document.createTextNode(area));

                areaContainer.appendChild(label);
            });
        }


        // Populate Daerah checkboxes dynamically
        // Filter daerah berdasarkan area yang dipilih
        function filterDaerahOptions() {
            var selectedAreas = Array.from(document.querySelectorAll('input[name="area"]:checked')).map(checkbox => checkbox
                .value);
            var daerahContainer = document.getElementById('daerahFilter');

            // Clear existing daerah options
            daerahContainer.innerHTML = '';

            if (selectedAreas.length > 0) {
                // Filter daerah berdasarkan area yang dipilih
                var daerahs = [...new Set(tokos.filter(toko => selectedAreas.includes(toko.area)).map(toko => toko
                    .daerah))];

                daerahs.forEach(function(daerah) {
                    var checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.value = daerah;
                    checkbox.name = 'daerah';

                    var label = document.createElement('label');
                    label.appendChild(checkbox);
                    label.appendChild(document.createTextNode(daerah));

                    daerahContainer.appendChild(label);
                });
            }
        }


        // Function to filter Toko markers based on selected area and daerah
        // Function to filter Toko markers based on selected area and daerah
        function filterTokoMarkers() {
            var selectedAreas = Array.from(document.querySelectorAll('input[name="area"]:checked')).map(checkbox => checkbox
                .value);
            var selectedDaerahs = Array.from(document.querySelectorAll('input[name="daerah"]:checked')).map(checkbox =>
                checkbox.value);

            // Filter tokos based on the selected filters
            var filteredTokos = tokos.filter(function(toko) {
                return (selectedAreas.length === 0 || selectedAreas.includes(toko.area)) &&
                    (selectedDaerahs.length === 0 || selectedDaerahs.includes(toko.daerah));
            });

            // Remove existing toko markers from the map
            tokoMarkers.forEach(marker => map.removeLayer(marker));
            tokoMarkers = [];

            // Add filtered toko markers to the map
            filteredTokos.forEach(function(toko) {
                var marker = L.marker([toko.latitude, toko.longitude], {
                    icon: redIcon
                }).addTo(map);
                tokoMarkers.push(marker);

                // Tambahkan kembali event untuk popup
                marker.bindPopup(`<b>${toko.nama_toko}</b><br>${toko.area}`);

                marker.on('mouseover', function() {
                    marker.openPopup();
                });

                marker.on('mouseout', function() {
                    marker.closePopup();
                });
            });
        }



        // Add toko markers array to store markers
        var tokoMarkers = [];

        // Populate area filter options on document ready
        $(document).ready(function() {
            populateAreaOptions();
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check-Ins Map</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        #container {
            display: flex;
            height: 100vh;
            position: relative;
            transition: all 0.3s ease;
        }

        #map {
            flex: 1;
            transition: flex 0.3s ease;
            height: 100%;
        }

        #details {
            width: 300px;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            border-left: 2px solid #ccc;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        #details.hidden {
            width: 0;
            padding: 0;
            border-left: none;
            box-shadow: none;
            transform: translateX(100%);
            overflow: hidden;
            /* Ensure no overflow when hidden */
        }

        #toggle-button {
            position: absolute;
            top: 11px;
            left: 190px;
            padding: 10px;
            background-color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            font-size: 14px;
            z-index: 10;
        }

        .accordion {
            background-color: rgba(238, 238, 238, 0.8);
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
            position: absolute;
            right: 10px;
            font-size: 12px;
            transition: transform 0.3s;
        }

        .accordion.active::after {
            transform: rotate(180deg);
        }

        .panel {
            display: none;
            /* Initially hide the panel */
            overflow: hidden;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid #ccc;
            border-top: none;
        }

        #filter-panel {
            position: absolute;
            top: 70px;
            left: 10px;
            width: calc(100% - 20px);
            max-width: 1360px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 15;
            display: none;
            /* Initially hidden */
        }

        #filter-panel.show {
            display: block;
            /* Show when class "show" is added */
        }

        #filter-panel h3 {
            margin: 5px;
            font-size: 16px;
        }

        #area-filters,
        #daerah-filters {
            display: flex;
            flex-wrap: wrap;
        }

        #area-filters label,
        #daerah-filters label {
            padding: 3px;
            width: 200px;
            font-size: 12px;
        }

        #filter-panel input[type="checkbox"] {
            margin-right: 3px;
        }

        #toggle-filter-button {
            position: absolute;
            top: 11px;
            left: 230px;
            padding: 11px;
            background-color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            font-size: 14px;
            z-index: 10;
        }

        #toggle-name {
            position: absolute;
            top: 11px;
            left: 300px;
            padding: 11px;
            background-color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            font-size: 14px;
            z-index: 10;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="map"></div>
        <div id="details"></div>
    </div>

    <button id="toggle-filter-button">Outlet</button>

    <div id="toggle-name">{{ $user->name }}</div>

    <!-- Filter Panel -->
    <div id="filter-panel">
        <h3>Filter Area</h3>
        <div id="area-filters"></div>
        <h3>Filter Daerah</h3>
        <div id="daerah-filters"></div>
    </div>


    <button id="toggle-button">☰</button> <!-- Moved outside container -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHmbpls7x8mNB1PNiiSuv5GRTGIoqEoQI&libraries=geometry"
        async defer></script>
    <script>
        let map;
        let checkinMarkers = [];
        let tokoMarkers = [];
        const checkins = @json($checkins);
        const tokos = @json($tokos);

        console.log("Checkins data:", checkins);

        // Inisialisasi Map
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: -8.609471,
                    lng: 116.135256
                },
                zoom: 13,
            });

            addMarkersAndLines(checkins, tokos);
            addTokoMarkers(tokos);
            populateAreaOptions();

            const visits = groupCheckinCheckout(checkins);
            if (Array.isArray(visits) && Array.isArray(tokos)) {
                addMarkersAndLines(checkins, tokos);

            } else {
                console.error('Data format is not correct:', visits, tokos);
            }
        }

        function groupCheckinCheckout(checkins) {
            const visitMap = {};
            let previousCheckout = null;
            const startOfDay = new Date(checkins[0].created_at);
            startOfDay.setHours(8, 30, 0, 0);

            checkins.forEach((checkin) => {
                const outletName = checkin.outlet_name;
                if (!visitMap[outletName]) {
                    visitMap[outletName] = {
                        checkin: null,
                        checkout: null
                    };
                }
                if (checkin.status === 'checkin') {
                    visitMap[outletName].checkin = checkin;
                } else if (checkin.status === 'checkout') {
                    visitMap[outletName].checkout = checkin;
                }
            });

            return Object.values(visitMap).map((visit, index) => {
                const {
                    checkin,
                    checkout
                } = visit;
                if (checkin && checkout) {
                    const durationMs = new Date(checkout.created_at) - new Date(checkin.created_at);
                    const totalSeconds = Math.floor(durationMs / 1000);
                    const minutes = Math.floor(totalSeconds / 60);
                    const seconds = totalSeconds % 60;

                    let travelDuration = null;
                    if (index === 0) {
                        const checkinTime = new Date(checkin.created_at);
                        const travelDurationMs = checkinTime - startOfDay;
                        const travelSeconds = Math.floor(travelDurationMs / 1000);
                        const travelMinutes = Math.floor(travelSeconds / 60);
                        const travelSecs = travelSeconds % 60;
                        travelDuration = {
                            minutes: travelMinutes,
                            seconds: travelSecs
                        };
                    } else if (previousCheckout) {
                        const travelDurationMs = new Date(checkin.created_at) - new Date(previousCheckout);
                        const travelSeconds = Math.floor(travelDurationMs / 1000);
                        const travelMinutes = Math.floor(travelSeconds / 60);
                        const travelSecs = travelSeconds % 60;
                        travelDuration = {
                            minutes: travelMinutes,
                            seconds: travelSecs
                        };
                    }

                    previousCheckout = checkout.created_at;

                    return {
                        ...checkin,
                        checkout,
                        duration: {
                            minutes,
                            seconds
                        },
                        travelDuration
                    };
                }
                return null;
            }).filter(visit => visit !== null);
        }

        function addMarkersAndLines(checkins, tokos) {
            let path = [];
            let detailsHtml = '';

            checkins.forEach(function(checkin, index) {
                const checkInTime = new Date(checkin.created_at).toLocaleTimeString();
                const checkOutTime = checkin.updated_at ?
                    new Date(checkin.updated_at).toLocaleTimeString() :
                    'Waktu Check-out Tidak Tersedia';

                const duration = checkin.updated_at ?
                    formatDuration(new Date(checkin.created_at), new Date(checkin.updated_at)) :
                    'Durasi Tidak Tersedia';

                let nearestToko = null;
                let minDistance = Infinity;
                tokos.forEach(function(toko) {
                    const distance = calculateDistance(checkin.latitude, checkin.longitude, toko.latitude,
                        toko.longitude);
                    if (distance < minDistance) {
                        minDistance = distance;
                        nearestToko = toko;
                    }
                });

                const markerColor = minDistance <= 10 ? 'blue' : 'red';
                const status = markerColor === 'blue' ? 'Berhasil Check-in' : 'Gagal Check-in';

                const marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(checkin.latitude),
                        lng: parseFloat(checkin.longitude),
                    },
                    map,
                    label: {
                        text: `${index + 1}`,
                        color: '#fff',
                        fontWeight: 'bold',
                        fontSize: '12px',
                    },
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 10,
                        fillColor: markerColor,
                        fillOpacity: 1,
                        strokeWeight: 2,
                        strokeColor: '#fff',
                    },
                });

                path.push(marker.getPosition());

                if (markerColor === 'red' && nearestToko) {
                    const tokoMarker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(nearestToko.latitude),
                            lng: parseFloat(nearestToko.longitude),
                        },
                        map,
                        icon: {
                            path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                            scale: 5,
                            fillColor: 'red',
                            fillOpacity: 1,
                            strokeWeight: 2,
                            strokeColor: 'black',
                        },
                    });

                    const tokoInfo = `
                <b>${nearestToko.nama_toko}</b><br>
                ${nearestToko.area}
                `;
                    const infoWindow = new google.maps.InfoWindow({
                        content: tokoInfo
                    });

                    tokoMarker.addListener('mouseover', () => infoWindow.open(map, tokoMarker));
                    tokoMarker.addListener('mouseout', () => infoWindow.close());
                }

                detailsHtml += `
                    <div class="accordion">Kunjungan ${index + 1}</div>
                    <div class="panel">
                        <b>Outlet:</b> ${checkin.outlet_name || 'N/A'}<br>
                        <b>Jam Check-in:</b> ${checkInTime}<br>
                        <b>Jam Check-out:</b> ${checkOutTime}<br>
                        <b>Durasi:</b> ${duration}<br>
                        <b>Status:</b> ${status}<br>
                        <b>Jumlah Transaksi:</b> ${checkin.total_orders || 0}<br>
                        <b>Jumlah Tagihan:</b> Rp${(checkin.total_billing || 0).toLocaleString()}<br>
                        ${checkin.image ? `<b>Foto:</b><br><img src="{{ asset('${checkin.image}') }}" alt="Check-in Image" style="max-width: 100%; height: auto; margin-top: 10px;">` : ''}
                    </div>
                    `;
            });

            if (path.length > 1) {
                const polyline = new google.maps.Polyline({
                    path,
                    geodesic: true,
                    strokeColor: '#0000FF',
                    strokeOpacity: 1.0,
                    strokeWeight: 2,
                });
                polyline.setMap(map);
            }

            document.getElementById('details').innerHTML = detailsHtml;

            const acc = document.getElementsByClassName('accordion');
            for (let i = 0; i < acc.length; i++) {
                acc[i].addEventListener('click', function() {
                    this.classList.toggle('active');
                    const panel = this.nextElementSibling;
                    panel.style.display = panel.style.display === 'block' ? 'none' : 'block';
                });
            }
        }

        function calculateDistance(lat1, lng1, lat2, lng2) {
            const R = 6371;
            const dLat = ((lat2 - lat1) * Math.PI) / 180;
            const dLng = ((lng2 - lng1) * Math.PI) / 180;
            const a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos((lat1 * Math.PI) / 180) *
                Math.cos((lat2 * Math.PI) / 180) *
                Math.sin(dLng / 2) *
                Math.sin(dLng / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        function formatDuration(start, end) {
            const diff = Math.abs(end - start);
            const minutes = Math.floor(diff / 60000);
            const hours = Math.floor(minutes / 60);
            return `${hours} jam ${minutes % 60} menit`;
        }

        function addTokoMarkers(tokos) {
            tokoMarkers = tokos.map((toko) => {
                const marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(toko.latitude),
                        lng: parseFloat(toko.longitude)
                    },
                    map,
                    icon: {
                        url: "/img/departmentstore.png",
                        scaledSize: new google.maps.Size(25, 41),
                    },
                });

                const infoWindow = new google.maps.InfoWindow({
                    content: `<b>${toko.nama_toko}</b><br>${toko.area}`,
                });

                marker.addListener("mouseover", () => infoWindow.open(map, marker));
                marker.addListener("mouseout", () => infoWindow.close());

                return marker;
            });
        }

        // Filter Markers
        function filterTokoMarkers() {
            const selectedAreas = Array.from(document.querySelectorAll('input[name="area"]:checked')).map((checkbox) =>
                checkbox.value);
            const selectedDaerahs = Array.from(document.querySelectorAll('input[name="daerah"]:checked')).map((checkbox) =>
                checkbox.value);

            tokoMarkers.forEach((marker, index) => {
                const toko = tokos[index];
                const isVisible = (!selectedAreas.length || selectedAreas.includes(toko.area)) &&
                    (!selectedDaerahs.length || selectedDaerahs.includes(toko.daerah));
                marker.setVisible(isVisible);
            });
        }

        // Populate Area Filter
        function populateAreaOptions() {
            const areas = [...new Set(tokos.map((toko) => toko.area))];
            const areaFilter = document.getElementById("area-filters");
            areaFilter.innerHTML = areas.map((area) =>
                `<label><input type="checkbox" name="area" value="${area}"> ${area}</label>`
            ).join("");

            const daerahFilter = document.getElementById("daerah-filters");
            areaFilter.addEventListener("change", () => {
                const selectedAreas = Array.from(document.querySelectorAll('input[name="area"]:checked')).map((
                    checkbox) => checkbox.value);
                const daerahs = [...new Set(tokos.filter((toko) => selectedAreas.includes(toko.area)).map((toko) =>
                    toko.daerah))];
                daerahFilter.innerHTML = daerahs.map((daerah) =>
                    `<label><input type="checkbox" name="daerah" value="${daerah}"> ${daerah}</label>`
                ).join("");
            });
        }

        document.getElementById('toggle-button').addEventListener('click', () => {
            const details = document.getElementById('details');
            details.classList.toggle('hidden');
            setTimeout(() => {
                google.maps.event.trigger(map, 'resize');
            }, 300);
        });

        function initFilters(tokos) {
            const areaFilters = document.getElementById('area-filters');
            const daerahFilters = document.getElementById('daerah-filters');

            // Get unique and sorted values for areas and daerahs
            const areas = [...new Set(tokos.map(toko => toko.area))].sort();
            const daerahs = [...new Set(tokos.map(toko => toko.daerah))].sort();

            // Create checkboxes for areas
            areas.forEach(area => {
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.value = area;
                checkbox.id = `area-${area}`;
                checkbox.classList.add('area-checkbox');
                checkbox.addEventListener('change', updateMarkers);

                const label = document.createElement('label');
                label.for = checkbox.id;
                label.textContent = area;

                areaFilters.appendChild(checkbox);
                areaFilters.appendChild(label);
                areaFilters.appendChild(document.createElement('br'));
            });

            // Create checkboxes for daerahs
            daerahs.forEach(daerah => {
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.value = daerah;
                checkbox.id = `daerah-${daerah}`;
                checkbox.classList.add('daerah-checkbox');
                checkbox.addEventListener('change', updateMarkers);

                const label = document.createElement('label');
                label.for = checkbox.id;
                label.textContent = daerah;

                daerahFilters.appendChild(checkbox);
                daerahFilters.appendChild(label);
                daerahFilters.appendChild(document.createElement('br'));
            });
        }

        function updateMarkers() {
            const selectedAreas = Array.from(document.querySelectorAll('.area-checkbox:checked')).map(cb => cb.value);
            const selectedDaerahs = Array.from(document.querySelectorAll('.daerah-checkbox:checked')).map(cb => cb.value);

            const filteredTokos = tokos.filter(toko => {
                return (selectedAreas.length === 0 || selectedAreas.includes(toko.area)) &&
                    (selectedDaerahs.length === 0 || selectedDaerahs.includes(toko.daerah));
            });

            clearMarkers();

            filteredTokos.forEach(toko => {
                const position = new google.maps.LatLng(parseFloat(toko.latitude), parseFloat(toko.longitude));
                const marker = new google.maps.Marker({
                    position,
                    map,
                    title: toko.nama_toko,
                    icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
                });

                markers.push(marker);
            });
        }

        function clearMarkers() {
            markers.forEach(marker => marker.setMap(null));
            markers = [];
        }

        document.getElementById('toggle-filter-button').addEventListener('click', () => {
            document.getElementById('filter-panel').classList.toggle('show');
        });

        document.addEventListener('DOMContentLoaded', () => {
            initFilters(tokos);
            initMap();
        });

        window.onload = initMap;
    </script>

</body>

</html>

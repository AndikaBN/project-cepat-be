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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <h1 class='text-center'>Edit Toko</h1>
    <div id='map'></div>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="tokoModal" tabindex="-1" role="dialog" aria-labelledby="tokoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tokoModalLabel">Edit Toko</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modalForm" method="POST" action="{{ route('toko.update', $toko->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="modalLatitude">Latitude</label>
                            <input type="text" class="form-control" id="modalLatitude" name="latitude" value="{{ $toko->latitude }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="modalLongitude">Longitude</label>
                            <input type="text" class="form-control" id="modalLongitude" name="longitude" value="{{ $toko->longitude }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="modalNamaToko">Nama Toko</label>
                            <input type="text" class="form-control" id="modalNamaToko" name="nama_toko" value="{{ $toko->nama_toko }}" required>
                        </div>
                        <div class="form-group">
                            <label for="modalArea">Area</label>
                            <input type="text" class="form-control" id="modalArea" name="area" value="{{ $toko->area }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Toko</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        let map = L.map('map').setView([{{ $toko->latitude }}, {{ $toko->longitude }}], 13);

        L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        const redIcon = new L.Icon({
            iconUrl: '/img/departmentstore.png',
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
            const { lat, lng } = e.latlng;
            document.getElementById('modalLatitude').value = lat;
            document.getElementById('modalLongitude').value = lng;
            $('#tokoModal').modal('show');
        });

        marker.on('dragend', function(e) {
            const { lat, lng } = marker.getLatLng();
            document.getElementById('modalLatitude').value = lat;
            document.getElementById('modalLongitude').value = lng;
            $('#tokoModal').modal('show');
        });

        // Set default values to modal when modal is shown
        $('#tokoModal').on('show.bs.modal', function (event) {
            document.getElementById('modalLatitude').value = marker.getLatLng().lat;
            document.getElementById('modalLongitude').value = marker.getLatLng().lng;
            document.getElementById('modalNamaToko').value = '{{ $toko->nama_toko }}';
            document.getElementById('modalArea').value = '{{ $toko->area }}';
        });
    </script>
</body>

</html>

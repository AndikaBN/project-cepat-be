@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <style>
        /* Additional CSS for modal and map */
        #mapModal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        #mapModal .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        #map {
            width: 100%;
            height: 400px;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <!-- Existing content -->

            <!-- Modal for Google Maps -->
            <div id="mapModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="map"></div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    <script>
        // Script to handle modal and map display
        function initMap(lat, lng) {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: lat, lng: lng},
                zoom: 15
            });
            new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: map
            });
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            var modal = document.getElementById("mapModal");
            var span = document.getElementsByClassName("close")[0];

            document.querySelectorAll('.btn-view-map').forEach(button => {
                button.onclick = function() {
                    var lat = parseFloat(this.getAttribute('data-lat'));
                    var lng = parseFloat(this.getAttribute('data-lng'));
                    modal.style.display = "block";
                    initMap(lat, lng);
                }
            });

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>
@endpush

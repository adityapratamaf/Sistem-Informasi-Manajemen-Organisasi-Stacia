@extends('layout.master')

@section('judul')
    Map
@endsection

@push('script')
    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endpush

@section('isi')
    {{-- ======================================== --}}
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-sm-6">
                        {{-- <h5 class="m-0 float-sm-left"> # </h5> --}}
                        {{-- <a href="/pengumuman/create" class="mx-2 float-sm-left btn btn-primary btn-sm" data-toggle="tooltip"
                            data-placement="top" title="Tambah"> <i class="fas fa-database"></i>
                        </a> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Menu</a></li>
                            <li class="breadcrumb-item active">Map</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> <b>Map</b> </h3>
                    </div>

                    <div class="card-body">
                        <div id="map" style="height: 500px;"></div>

                        {{-- ========== Script Map ========== --}}
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // inisialisasi tampilan peta Indonesia
                                var map = L.map('map').setView([-1.7, 120.0], 5);

                                L.tileLayer(
                                    'https://tile.opentopomap.org/{z}/{x}/{y}.png', {
                                        maxZoom: 17, // Maksimal zoom untuk OpenTopoMap
                                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="https://opentopomap.org/">OpenTopoMap</a>'
                                    }
                                ).addTo(map);

                                // L.tileLayer(
                                //     'https://{s}.tile-cyclosm.openstreetmap.fr/cyclosm/{z}/{x}/{y}.png', {
                                //         maxZoom: 20, // CyclOSM mendukung hingga zoom level 20
                                //         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="https://cyclosm.org/">CyclOSM</a>'
                                //     }
                                // ).addTo(map);

                                // array untuk menyimpan koordinat polyline
                                var coordinates = [];

                                // polyline yang akan diperbarui
                                var polyline = L.polyline([], {
                                    color: 'blue',
                                    weight: 4,
                                    opacity: 0.7
                                }).addTo(map);

                                // fungsi untuk menghitung jarak total
                                function calculateTotalDistance(coords) {
                                    var totalDistance = 0;
                                    for (var i = 1; i < coords.length; i++) {
                                        var point1 = L.latLng(coords[i - 1]);
                                        var point2 = L.latLng(coords[i]);
                                        totalDistance += point1.distanceTo(point2); // Jarak dalam meter
                                    }
                                    return totalDistance / 1000; // Konversi ke kilometer
                                }

                                // event listener untuk klik dua kali
                                map.on('dblclick', function(e) {
                                    // Tambahkan koordinat baru ke array
                                    var lat = e.latlng.lat;
                                    var lng = e.latlng.lng;
                                    coordinates.push([lat, lng]);

                                    // perbarui polyline dengan koordinat baru
                                    polyline.setLatLngs(coordinates);

                                    // hitung jarak total
                                    var totalDistance = calculateTotalDistance(coordinates);

                                    // tambahkan marker di titik baru dengan popup
                                    var marker = L.marker([lat, lng]).addTo(map);
                                    marker.bindPopup(
                                        'Koordinat: ' + lat.toFixed(6) + ', ' + lng.toFixed(6) +
                                        '<br>Jarak Total: ' + totalDistance.toFixed(2) + ' km'
                                    ).openPopup();
                                });

                            });
                        </script>
                        {{-- ========== Script Map ========== --}}

                    </div>

                </div>

            </div>
        </section>

    </div>
    {{-- ======================================== --}}
@endsection

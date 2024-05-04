<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Poppins:wght@400;500;700&display=swap"
        rel="stylesheet">

    {{-- My Style --}}
    <link rel="stylesheet" href="{{ url('css/pegawaiDl.css') }}">

    {{-- Logo Title Bar --}}
    <link rel="icon" href="{{ url('img/KPU_Logo.png') }}">

    <title>Dashboard</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container col-12">
            <a>ABSENSI & LAPORAN BULANAN PEGAWAI</a>
            <img src="{{ url('img/KPU_Logo.png') }}" alt="" width="50" height="59"
                class="d-inline-block align-text-center">
                <div class="dropdown">
                    <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                        aria-expanded="false" style="color: white; font-weight:bold">
                        KOMISI PEMILIHAN UMUM KOTA BATU <img src="{{ url('img/profile.png') }}" alt="" width="45"
                            height="45" style="margin-left: 10px">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ url('/logout') }}">Log out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    {{-- card --}}
    <form action="{{ url('/dashboardPegawai/dinasLuar/store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container col-4 d-flex justify-content-center">
            <div class="card">
                <p style="color: #C72B41; font-weight: 800; padding-bottom: 20px">Form Absensi Dinas Luar</p>
                <!-- Include a field for the tanggal input -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input class="form-control" type="date" id="tanggal" name="tanggal" onchange="checkDateValidity(this)">
                </div>
                <!-- Include fields for jam_datang and jam_pulang -->
                <div class="mb-3">
                    <label for="jam_datang" class="form-label">Jam Datang</label>
                    <input class="form-control" type="time" id="jam_datang" name="jam_datang">
                </div>
                <div class="mb-3">
                    <label for="jam_pulang" class="form-label">Jam Pulang</label>
                    <input class="form-control" type="time" id="jam_pulang" name="jam_pulang">
                </div>

                {{-- Upload surat --}}
                <div class="mb-3">
                    <label for="formFileDisabled" class="form-label" style="padding-top: 10px">Surat Tugas</label>
                    <input class="form-control" type="file" id="formFileDisabled" name="file">
                </div>
                {{-- Lokasi --}}
                <p>Lokasi saat ini</p>
                <div id="map" style="height: 300px;"></div>

                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">

                {{-- <button style="margin-top: 10px; background-color: #C72B41; border: none; color: white"
                    onclick="getLocation()">Gunakan lokasi saat ini</button> --}}
                <button style="margin-top: 10px; background-color: #C72B41; border: none; color: white"
                    type="submit">Simpan</button>
                <button style="margin-top: 10px; background-color: #C72B41; border: none; color: white"
                    onclick="refreshMap()">Refresh Map</button> {{-- Add this line for the Refresh Map button --}}
                <p style="padding-bottom: 20px; text-align: center; padding-top: 40px">
                    <a href="{{ url('dashboardPegawai') }}" class="kembali-btn">Kembali</a>
                </p>
            </div>
        </div>
    </form>

    </div>
    <img src={{ url('img/peta.png') }} alt="" class="map">

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- Script untuk batasan tanggal --}}
    <script>
        function checkDateValidity(input) {
            var selectedDate = new Date(input.value);
            var currentDate = new Date();
    
            // Menghilangkan informasi waktu (jam, menit, detik) dari currentDate
            currentDate.setHours(0, 0, 0, 0);
    
            if (selectedDate < currentDate) {
                alert("Anda tidak dapat memilih tanggal yang sudah terlewat.");
                input.value = ''; // Mengosongkan input tanggal
            }
        }
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        var map = L.map('map').setView([-6.2088, 106.8456], 15); // Initialize map with default coordinates

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker;

        // Function to update the user's live location
        function updateLiveLocation(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            // Update hidden input fields with live location
            document.getElementById('longitude').value = lng;
            document.getElementById('latitude').value = lat;

            // Update map view
            map.setView([lat, lng]);

            // Add or move marker
            if (!marker) {
                marker = L.marker([lat, lng]).addTo(map);
                marker.bindPopup("Current Location").openPopup(); // Add popup with label
            } else {
                marker.setLatLng([lat, lng]);
            }
        }

        // Function to handle errors in geolocation
        function handleLocationError(error) {
            console.error('Error getting user location:', error.message);
        }

        // Watch user's position and update location continuously
        var watchId = navigator.geolocation.watchPosition(updateLiveLocation, handleLocationError);

        // Stop watching user's position when the page is unloaded
        window.addEventListener('unload', function() {
            navigator.geolocation.clearWatch(watchId);
        });

        // Function to refresh the map
        function refreshMap() {
            map.setView([-6.2088, 106.8456], 15); // Reset map view to default coordinates
            if (marker) {
                map.removeLayer(marker); // Remove marker if it exists
                marker = null; // Reset marker variable
            }
        }
    </script>

    </script>



</body>

</html>

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
    <link rel="stylesheet" href="css/dashboard.css">

    {{-- Logo Title Bar --}}
    <link rel="icon" href="img/KPU_Logo.png">

    <title>Dashboard</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container col-12">
            <a>SISTEM ABSENSI & LAPORAN BULANAN PEGAWAI</a>
            <img src="img/KPU_Logo.png" alt="" width="50" height="59"
                class="d-inline-block align-text-center">
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false" style="color: white; font-weight:bold">
                    KOMISI PEMILIHAN UMUM KOTA BATU <img src="img/profile.png" alt="" width="45"
                        height="45" style="margin-left: 10px">
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ url('/logout') }}">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif
            <p class="sapaan">Selamat Datang, {{ auth()->user()->name }}</p>
            <p class="motivasi">Silahkan untuk melakukan absensi kehadiran anda hari ini. Mari
                <br>bersama sama menjaga integritas dan
                profesionalitas KPU Kota Batu <br>dengan selalu tepat waktu dan disiplin dalam absensi
            </p>

            <img src="img/KPU_Logoo.png" alt="" class="logo">
            
            {{-- Card Menu --}}
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ url('/dashboardPegawai/codePegawai') }}" class="cardScan">
                        <div class="judul">
                            <p>Qr code</p>
                        </div>
                        <div class="icon">
                            <img src="img/riwayat.png" alt="" width="90" height="92">
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('/dashboardPegawai/dinasLuar') }}" class="cardScan">
                        <div class="judul">
                            <p>Dinas Luar</p>
                        </div>
                        <div class="icon">
                            <img src="img/riwayat.png" alt="" width="90" height="92">
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('/dashboardPegawai/izin') }}" class="cardScan">
                        <div class="judul">
                            <p>Izin</p>
                        </div>
                        <div class="icon">
                            <img src="img/izin.png" alt="" width="90" height="92">
                        </div>
                    </a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ url('/dashboardPegawai/cuti') }}" class="cardScan">
                        <div class="judul">
                            <p>Cuti</p>
                        </div>
                        <div class="icon">
                            <img src="img/izin.png" alt="" width="90" height="92">
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('/dashboardPegawai/riwayatAbsen') }}" class="cardScan">
                        <div class="judul">
                            <p>Riwayat Absen</p>
                        </div>
                        <div class="icon">
                            <img src="img/riwayat.png" alt="" width="90" height="92">
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('/dashboardPegawai/codePegawai/pulang') }}" class="cardScan">
                        <div class="judul">
                            <p>Pulang</p>
                        </div>
                        <div class="icon">
                            <img src="img/riwayat.png" alt="" width="90" height="92">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <img src="img/peta.png" alt="" class="map">

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
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
</body>

</html>

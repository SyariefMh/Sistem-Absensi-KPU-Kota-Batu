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
    <link rel="stylesheet" href="{{ url('css/izin.css') }}">

    {{-- Logo Title Bar --}}
    <link rel="icon" href="{{ url('img/KPU_Logo.png') }}">

    <title>Dashboard</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container col-12">
            <a>KOMISI PEMILIHAN UMUM KOTA BATU</a>
            <img src="{{ url('img/KPU_Logo.png') }}" alt="" width="50" height="59"
                class="d-inline-block align-text-center">
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false" style="color: white; font-weight:bold">
                    Pegawai, {{ auth()->user()->name }} <img src="{{ url('img/profile.png') }}" alt=""
                        width="45" height="45" style="margin-left: 10px">
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#modal_profile">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ url('/logout') }}">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- card --}}
    <form action="{{ url('/dashboardPegawai/izin/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <div class="container col-md-4 col-sm-8 col-12 d-flex justify-content-center" style="margin-top: 60px">
            <div class="card w-100" style="max-width: 500px; height: 500px;">
                <p style="color: #C72B41; font-weight: 800; padding-bottom: 20px">Form Absensi Izin</p>
                <!-- Include a field for the tanggal input -->
                {{-- alert --}}
                @if ($errors->any())
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16"
                            role="img" aria-label="Warning:">
                            <path
                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                        <div class="error-messages" style="font-size: 12px">
                            @foreach ($errors->all() as $error)
                                <span>{{ $error }}</span>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
    
                {{-- end alert --}}
                {{-- Tanggal --}}
                <p style="color: #C72B41">Tanggal awal</p>
                <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal"
                    onchange="checkDateValidity(this)">
                <p style="color: #C72B41">tanggal akhir</p>
                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir"
                    onchange="checkDateValidity(this)">
                {{-- Upload surat --}}
                <div class="mb-3">
                    <label for="file" class="form-label" style="padding-top: 10px; color: #C72B41">Surat
                        Izin</label>
                    <input name="file" class="form-control" type="file" id="file">
                </div>
                <button type="submit"
                    style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan
                </button>
                <p style="padding-bottom: 10px; text-align: center; padding-top: 10px">
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

    {{-- Script batasan untuk tanggal --}}
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
</body>

</html>

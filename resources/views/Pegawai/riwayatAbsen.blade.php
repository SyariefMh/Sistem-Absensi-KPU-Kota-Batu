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
    <link rel="stylesheet" href="{{ url('css/riwayatAbsen.css') }}">

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
    <div class="container col-4 d-flex justify-content-center">
        <div class="card">
            <p style="font-weight: 900">Riwayat Absen</p>
            @foreach ($combinedData as $data)
                <div class="history" style="margin-bottom: 10px">
                    <div class="row justify-content-center">
                        <div class="col-lg-3">
                            <p>{{ $data->tanggal }}</p>
                        </div>
                        <div class="col-lg-3">
                            <p>
                                @if ($data->jam_datang || $data->jam_pulang)
                                    {{ $data->jam_datang ?? '-' }} - {{ $data->jam_pulang ?? '-' }}
                                @else
                                    -
                                @endif
                            </p>

                        </div>
                        <div class="col-lg-3">
                            <p>{{ $data->Keterangan }}</p>
                        </div>
                        {{-- <div class="col-lg-2" style="padding-top: 5px">
                            <img src="img/checklist.png" alt="">
                        </div> --}}
                        <div class="col-lg-6" style="padding-top: 5px">
                            @if ($data->status == 'Tepat Waktu')
                                <p>{{ $data->status }}</p> <img src="{{ asset('img/checklist.png') }}" alt="">
                            @elseif($data->status == 'Terlambat')
                                <p>{{ $data->status }}</p> <img src="{{ asset('img/icon cros.png') }}" alt="">
                            @else
                                <p>{{ $data->status }}</p> <img src="{{ asset('img/checklist_blue.png') }}"
                                    alt="">
                            @endif
                        </div>

                        {{-- <p>{{ $data->status }}</p> --}}

                    </div>
                </div>
            @endforeach
        </div>
    </div>

    </div>
    <img src={{ url('img/peta.png') }} alt="" class="map">

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

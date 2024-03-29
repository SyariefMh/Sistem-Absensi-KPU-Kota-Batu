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
    <link rel="stylesheet" href="{{ url('css/cuti.css') }}">

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
            <a>KOMISI PEMILIHAN UMUM KOTA BATU</a>
        </div>
    </nav>
    {{-- card --}}
    <form action="{{ url('/dashboardPegawai/cuti/store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container col-4 d-flex justify-content-center" style="margin-top: 60px">
            <div class="card">
                <p style="color: #C72B41; font-weight: 800; padding-bottom: 20px">Form Absensi Izin</p>

                <p style="color: #C72B41">Nip Pegawai</p>
                <p>{{ $user->nip }}</p>

                {{-- Tanggal --}}
                <p style="color: #C72B41">Tanggal awal</p>
                <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal">
                <p style="color: #C72B41">tanggal akhir</p>
                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
                {{-- Upload surat --}}
                <div class="mb-3">
                    <label for="file" class="form-label" style="padding-top: 10px; color: #C72B41">Surat
                        Tugas</label>
                    <input name="file" class="form-control" type="file" id="file">
                </div>
                <button type="submit"
                    style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan
                </button>
                <p style="padding-bottom: 0px; text-align: center; padding-top: 10px">
                    <a href="{{ url('Pegawai.dashboardPegawai') }}" class="kembali-btn">Kembali</a>
                </p>
            </div>
        </div>
    </form>
    {{-- <div class="container col-4 d-flex justify-content-center" style="margin-top: 60px">
        <div class="cardd">
            <p style="color: #C72B41; font-weight: 800; padding-bottom: 20px">Form Cuti</p>
            
            <p style="color: #C72B41">Nip Pegawai</p>
            <p>{{ $user->nip }}</p>
            
            <p style="color: #C72B41; padding-top: 10px">Tanggal</p>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="2023-07-21"
                format="YYYY-MM-DD">
            
            <p style="padding-top: 10px; color: #C72B41">Lama Izin</p>
            <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm"
                aria-label=".form-control-sm example">
            
            <div class="mb-3">
                <label for="formFileDisabled" class="form-label" style="padding-top: 10px; color: #C72B41">Surat
                    Tugas</label>
                <input class="form-control" type="file" id="formFileDisabled">
            </div>
            <button style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan</button>
        </div>
    </div> --}}
    </div>
    <img src="img/peta.png" alt="" class="position-absolute end-0 bottom-0" width="1115">

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

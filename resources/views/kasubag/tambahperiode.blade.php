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
    <link rel="stylesheet" href="{{ asset('css/tambahPegawai.css') }}
    ">

    {{-- Logo Title Bar --}}
    <link rel="icon" href="img/KPU_Logo.png">

    <title>Dashboard</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container col-12">
            <a>ABSENSI & LAPORAN BULANAN PEGAWAI</a>
            <img src="{{ asset('img/KPU_Logo.png') }}" alt="" width="50" height="59"
                class="d-inline-block align-text-center">
            <a>KOMISI PEMILIHAN UMUM KOTA BATU</a>
        </div>
        <div class="container" style="color: black">
            <p style="padding-bottom: 0px; text-align: center; padding-top: 10px;">
                <a href="{{ url('dashboardKasubag/periode') }}" class="btn btn-primary"
                    style="background-color: #C72B41;">Kembali</a>
            </p>
        </div>
        <div class="container" style=" margin-top: 10px; font-size: 20px; color: black">
            Cek dan Rekap Absensi Pegawai
        </div>
        {{-- <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div> --}}
        <div class="container">
            <form action="{{ url('dashboardKasubag/periode/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <p style="padding-top: 10px">Tahun : </p>
                <div class="input" style="margin-right: 800px">
                    <input name="periode_tahun" class="form-control form-control-sm underline" type="text"
                        placeholder="ex. 2024" aria-label=".form-control-sm example" style="width: 400px">
                    @error('periode_tahun')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror
                </div>
                <p style="padding-top: 10px">Bulan : </p>
                <div class="input" style="margin-right: 800px">
                    <select name="periode_bulan" class="form-control form-control-sm"
                        aria-label=".form-control-sm example" style="width: 400px; background: white">
                        <option value="disabled">Pilih Bulan</option>
                        @foreach ($bulanOptions as $bulan)
                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                        @endforeach
                    </select>
                    @error('periode_bulan')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror
                </div>
                <p style="padding-top: 10px">Nama Jabatan : </p>
                <div class="input" style="margin-right: 800px">
                    <input name="nama_jabatan" class="form-control form-control-sm underline" type="text"
                        placeholder="ex. Rudi Gumilar" aria-label=".form-control-sm example" style="width: 400px">
                    @error('nama_jabatan')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror
                </div>
                <p style="padding-top: 10px">NIP : </p>
                <div class="input" style="margin-right: 800px">
                    <input name="nip_nama_jabatan" class="form-control form-control-sm underline" type="text"
                        placeholder="ex. 9999999999999999" aria-label=".form-control-sm example" style="width: 400px">
                    @error('nip_nama_jabatan')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror
                </div>
                <p style="padding-top: 10px">Status : </p>
                <div class="input" style="margin-right: 800px">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" value="1" checked>
                        <label class="form-check-label" for="radioActive">
                            Aktif
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" value="0">
                        <label class="form-check-label" for="radioFailed">
                            Tidak aktif
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>

        </div>
    </nav>
    {{--   --}}
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

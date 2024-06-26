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
            <a>KOMISI PEMILIHAN UMUM KOTA BATU</a>
            <img src="{{ asset('img/KPU_Logo.png') }}" alt="" width="50" height="59"
                class="d-inline-block align-text-center">
                <div class="dropdown">
                    <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                        aria-expanded="false" style="color: #C72B41; font-weight:bold">
                        {{ auth()->user()->name }} <img src="{{ url('img/profile.png') }}" alt=""
                        width="45" height="45" style="margin-left: 10px">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ url('/logout') }}">Log out</a></li>
                    </ul>
                </div>
        </div>
        <div class="container" style="color: black">
            <div class="container" style="color: black">
                <a href="{{ url('dashboardKasubag/kepegawaian') }}" class="btn btn-primary"
                        style="background-color: #C72B41;">Kembali</a>
            </div>
            <p class="" style="margin-left: 10px; margin-top: 10px; font-size: 20px; color: black">Edit Data Pegawai</p>
        </div>
        <div class="container">
            <form action="{{ url('dashboardKasubag/kepegawaian/update/' . $users->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <p style="padding-top: 10px">Nama : </p>
                <div class="input" style="margin-right: 800px">
                    <input name="name" class="form-control form-control-sm underline" type="text"
                        placeholder=".form-control-sm" aria-label=".form-control-sm example" style="width: 400px"
                        value="{{ $users->name }}">
                </div>
                <p style="padding-top: 10px">Role : </p>
                <div class="input" style="margin-right: 800px">
                    <select name="role" class="form-select form-select-sm" aria-label=".form-select-sm example"
                        style="width: 400px">
                        <option value="pegawai" {{ $users->role == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                        <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="kasubag umum" {{ $users->role == 'kasubag umum' ? 'selected' : '' }}>Kasubag Umum
                        </option>
                    </select>
                </div>

                <p style="padding-top: 10px">Password : </p>
                <div class="input" style="margin-right: 800px">
                    <input name="password" class="form-control form-control-sm underline" type="password"
                        placeholder=".form-control-sm" aria-label=".form-control-sm example" style="width: 400px">
                </div>
                <p style="padding-top: 10px">Jabatan : </p>
                <div class="input" style="margin-right: 800px">
                    <select name="jabatan" class="form-select form-select-sm" aria-label=".form-select-sm example"
                        style="width: 400px">
                        <option value="PNS" {{ $users->jabatan == 'PNS' ? 'selected' : '' }}>PNS</option>
                        <option value="PPNPN" {{ $users->jabatan == 'PPNPN' ? 'selected' : '' }}>PPNPN</option>
                        <option value="Jagat Saksana (Satpam)"
                            {{ $users->jabatan == 'Jagat Saksana (Satpam)' ? 'selected' : '' }}>Jagat Saksana (Satpam)
                        </option>
                    </select>
                </div>
                <p style="padding-top: 10px">NIP : </p>
                <div class="input" style="margin-right: 800px">
                    <input name="nip" class="form-control form-control-sm underline" type="text"
                        placeholder=".form-control-sm" aria-label=".form-control-sm example" style="width: 400px"
                        value="{{ $users->nip }}">
                </div>
                <p style="padding-top: 10px">Pangkat : </p>
                <div class="input" style="margin-right: 800px">
                    <input name="pangkat" class="form-control form-control-sm underline" type="text"
                        placeholder=".form-control-sm" aria-label=".form-control-sm example" style="width: 400px"
                        value="{{ $users->pangkat }}">
                </div>
                <p style="padding-top: 10px">Golongan : </p>
                <div class="input" style="margin-right: 800px">
                    <input name="golongan" class="form-control form-control-sm underline" type="text"
                        placeholder=".form-control-sm" aria-label=".form-control-sm example" style="width: 400px"
                        value="{{ $users->golongan }}">
                </div>
                <div class="mb-3 d-flex">
                    <label for="formFileDisabled" class="form-label" style="padding-top: 10px; color: #C72B41">Tanda
                        Tangan
                        : </label>
                    <input name="tandatanggan" class="form-control" type="file" id="formFileDisabled">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
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

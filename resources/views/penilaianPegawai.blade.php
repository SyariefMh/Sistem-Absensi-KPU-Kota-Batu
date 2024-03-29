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
    <link rel="stylesheet" href="css/penilaianPegawai.css">

    {{-- Logo Title Bar --}}
    <link rel="icon" href="img/KPU_Logo.png">

    <title>Dashboard</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container col-12">
            <a>ABSENSI & LAPORAN BULANAN PEGAWAI</a>
            <img src="img/KPU_Logo.png" alt="" width="50" height="59"
                class="d-inline-block align-text-center">
            <a>KOMISI PEMILIHAN UMUM KOTA BATU</a>
        </div>
        <div class="container col-12" style="color: black; justify-content: center">
            <p>Laporan Bulanan Pegawai Pemerintah Non Pegawai Negeri</p>
        </div>
        <div class="container">
            <p style="padding-top: 10px">Nama : </p>
            <div class="input" style="margin-right: 800px">
                <input class="form-control form-control-sm underline" type="text" placeholder=".form-control-sm"
                    aria-label=".form-control-sm example" style="width: 400px">
            </div>
            <p style="padding-top: 10px">Jabatan : </p>
            <div class="input" style="margin-right: 800px">
                <input class="form-control form-control-sm underline" type="text" placeholder=".form-control-sm"
                    aria-label=".form-control-sm example" style="width: 400px">
            </div>
            <p style="padding-top: 10px">Unit Kerja : </p>
            <div class="input" style="margin-right: 800px">
                <input class="form-control form-control-sm underline" type="text" placeholder=".form-control-sm"
                    aria-label=".form-control-sm example" style="width: 400px">
            </div>
            <p style="padding-top: 10px">Periode : </p>
            <div class="input" style="margin-right: 800px">
                <input class="form-control form-control-sm underline" type="text" placeholder=".form-control-sm"
                    aria-label=".form-control-sm example" style="width: 400px">
            </div>
        </div>
        </div>
    </nav>
    <div class="container">
        <p>A. Presensi Kehadiran</p>
        <table class="table table-bordered">
            <thead>
                <colgroup>
                    <col width="10px">
                    <col width="500px">
                    <col width="500px">
                </colgroup>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Aspek</th>
                    <th scope="col">Kriteria</th>
                    <th scope="col">Penilaian</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas dalam
                        satu bulan</td>
                    <td>Jam Kerja Pramubakti Pukul 07.00 - 16.00 WIB</td>
                    <td>83</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas dalam
                        satu bulan</td>
                    <td>Jam Kerja Pramubakti Pukul 07.00 - 16.00 WIB</td>
                    <td>83</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container">
        <button style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan</button>
    </div>
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

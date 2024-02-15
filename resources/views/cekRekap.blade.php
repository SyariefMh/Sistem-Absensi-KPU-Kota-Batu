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
    <link rel="stylesheet" href="css/cekRekap.css">

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
        <div class="container" style="color: black">
            <div class="container d-flex">
                <div class="container col-6" style="text-align: start; margin-top: 10px; font-size: 20px">
                    Cek dan Rekap Absensi Pegawai
                </div>
                <div class="container col-6">
                    <div class="tgl" style="float: right">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="2023-07-21"
                            format="YYYY-MM-DD">
                    </div>
                </div>
            </div>
            {{-- tabel --}}
            <div class="container">
                <table class="table table-bordered">
                    <p style="margin-top: 40px; margin-left: 25px">Presensi PPNPN</p>
                    <thead>
                        <tr>
                            <th>Nomer</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Jam Datang</th>
                            <th>Jam Pulang</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td style="text-align: left">Maulana Syarief</td>
                            <td>Tenaga Administrasi</td>
                            <td>08:00</td>
                            <td>17:00</td>
                            <td>2023-07-20</td>
                            <td>Hadir</td>
                            <td><a href="#">Lihat</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td style="text-align: left">Jane Doe</td>
                            <td>Tenaga Administrasi</td>
                            <td>09:00</td>
                            <td>18:00</td>
                            <td>2023-07-21</td>
                            <td>Izin</td>
                            <td><a href="#">Lihat</a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td style="text-align: left">John Smith</td>
                            <td>Tenaga Administrasi</td>
                            <td>10:00</td>
                            <td>19:00</td>
                            <td>2023-07-22</td>
                            <td>Cuti</td>
                            <td><a href="#">Lihat</a></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <p style="margin-top: 40px; margin-left: 25px">Presensi Jagat Saksana (SATPAM)</p>
                    <thead>
                        <tr>
                            <th>Nomer</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Jam Datang</th>
                            <th>Jam Pulang</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td style="text-align: left">Maulana Syarief</td>
                            <td>Tenaga Administrasi</td>
                            <td>08:00</td>
                            <td>17:00</td>
                            <td>2023-07-20</td>
                            <td>Hadir</td>
                            <td><a href="#">Lihat</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td style="text-align: left">Jane Doe</td>
                            <td>Tenaga Administrasi</td>
                            <td>09:00</td>
                            <td>18:00</td>
                            <td>2023-07-21</td>
                            <td>Izin</td>
                            <td><a href="#">Lihat</a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td style="text-align: left">John Smith</td>
                            <td>Tenaga Administrasi</td>
                            <td>10:00</td>
                            <td>19:00</td>
                            <td>2023-07-22</td>
                            <td>Cuti</td>
                            <td><a href="#">Lihat</a></td>
                        </tr>
                    </tbody>
                </table>
                <div style="position: absolute; right: 130px;">
                    <button type="submit" class="btn" style="width: 200px">Print Rekap</button>
                </div>
            </div>
        </div>
        </div>
    </nav>

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

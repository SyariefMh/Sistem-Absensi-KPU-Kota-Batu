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
            <div class="row">
                <p style="padding-top: 10px">Nama : {{ $nilai->name }}</p>
                <p style="padding-top: 10px">Jabatan : {{ $nilai->jabatan }}</p>
                <p style="padding-top: 10px">Unit Kerja : Komisi Pemilihan Umum Kota Batu</p>
                <?php
                $bulan_tahun = date('F Y');
                ?>
                <p style="padding-top: 10px">Periode : {{ $periodeall->periode_bulan }} - {{ $periodeall->periode_tahun }}</p>
            </div>
        </div>

    </nav>
    {{-- Nilai A --}}
    <div class="container">
        <h5>A. Presensi Kehadiran</h5>
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
                    <form action="{{ route('simpan.nilai.a') }}" method="POST">
                        @csrf
                        <!-- Input Tersembunyi untuk user_id -->
                        <input type="hidden" name="user_id" value="{{ $nilai->id }}">
                        <!-- Input Tersembunyi untuk periode_id (disesuaikan dengan id periode yang ingin disimpan) -->
                        <input type="hidden" name="periode_id" value="{{ $periode }}">
                        <!-- Isi formulir -->
                        <td>
                            <div class="form" style="width: 480px;">
                                <div class="form" style="width: 480px;">
                                    <textarea name="kriteria1" class="form-control">{{ isset($dataNilai) ? $dataNilai->kriteria1 : '' }}</textarea>
                                </div>
                                
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai1" class="form-control"  min="0" max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai1 : '' }}" />
                            </div>
                        </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas dalam
                        satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria2" class="form-control">{{ isset($dataNilai) ? $dataNilai->kriteria2 : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai2" class="form-control"  min="0" max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai2 : '' }}" />
                            </div>
                        </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Jumlah hari tidak hadir tanpa alasan yang sah dalam satu bulan</td>
                    <td>
                        <div class="form" style="width: 480px;">
                            <textarea name="kriteria3" class="form-control">{{ isset($dataNilai) ? $dataNilai->kriteria3 : '' }}</textarea>
                        </div>
                    </td>
                    <td>
                        <div class="form" style="width: 100px;">
                            <input type="number" name="nilai3" class="form-control"  min="0" max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai3 : '' }}" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Jumlah izin karena sakit atau alasan lain dalam satu bulan</td>
                    <td>
                        <div class="form" style="width: 480px;">
                            <textarea name="kriteria4" class="form-control">{{ isset($dataNilai) ? $dataNilai->kriteria4 : '' }}</textarea>
                        </div>
                    </td>
                    <td>
                        <div class="form" style="width: 100px;">
                            <input type="number" name="nilai4" class="form-control"  min="0" max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai4 : '' }}" />
                        </div>
                    </td>
                </tr>
                <p>izin &nbsp; hadir &nbsp; cuti</p>
                {{-- <button type="submit"
                    style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan</button> --}}
            </tbody>
        </table>
        <div class="container">
            <!-- Tombol Simpan -->
            <button type="submit"
                style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan</button>
        </div>
        </form>
    </div>

    {{-- Nilai B --}}
    <div class="container">
        <h5>B. Presensi Kehadiran</h5>
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
                    <form action="{{ route('simpan.nilai.b') }}" method="POST">
                        @csrf
                        <!-- Input Tersembunyi untuk user_id -->
                        <input type="hidden" name="user_id" value="{{ $nilai->id }}">
                        <!-- Input Tersembunyi untuk periode_id (disesuaikan dengan id periode yang ingin disimpan) -->
                        <input type="hidden" name="periode_id" value="{{ $periode }}">
                        <!-- Isi formulir -->
                        <td>
                            <div class="form" style="width: 480px;">
                                <div class="form" style="width: 480px;">
                                    <textarea name="kriteria1" class="form-control">{{ isset($dataNilaiB) ? $dataNilaiB->kriteria1 : '' }}</textarea>
                                </div>
                                
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai1" class="form-control"  min="0" max="100" value="{{ isset($dataNilaiB) ? $dataNilaiB->nilai1 : '' }}" />
                            </div>
                        </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas dalam
                        satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria2" class="form-control">{{ isset($dataNilaiB) ? $dataNilaiB->kriteria2 : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai2" class="form-control"  min="0" max="100" value="{{ isset($dataNilaiB) ? $dataNilaiB->nilai2 : '' }}" />
                            </div>
                        </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Jumlah hari tidak hadir tanpa alasan yang sah dalam satu bulan</td>
                    <td>
                        <div class="form" style="width: 480px;">
                            <textarea name="kriteria3" class="form-control">{{ isset($dataNilaiB) ? $dataNilaiB->kriteria3 : '' }}</textarea>
                        </div>
                    </td>
                    <td>
                        <div class="form" style="width: 100px;">
                            <input type="number" name="nilai3" class="form-control"  min="0" max="100" value="{{ isset($dataNilaiB) ? $dataNilaiB->nilai3 : '' }}" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Jumlah izin karena sakit atau alasan lain dalam satu bulan</td>
                    <td>
                        <div class="form" style="width: 480px;">
                            <textarea name="kriteria4" class="form-control">{{ isset($dataNilaiB) ? $dataNilaiB->kriteria4 : '' }}</textarea>
                        </div>
                    </td>
                    <td>
                        <div class="form" style="width: 100px;">
                            <input type="number" name="nilai4" class="form-control"  min="0" max="100" value="{{ isset($dataNilaiB) ? $dataNilaiB->nilai4 : '' }}" />
                        </div>
                    </td>
                </tr>
                <p>izin &nbsp; hadir &nbsp; cuti</p>
                {{-- <button type="submit"
                    style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan</button> --}}
            </tbody>
        </table>
        <div class="container">
            <!-- Tombol Simpan -->
            <button type="submit"
                style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan</button>
        </div>
        </form>
    </div>
    {{-- Nilai C --}}

    <div class="container">
        <h5>C. Presensi Kehadiran</h5>
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
                    <form action="{{ route('simpan.nilai.c') }}" method="POST">
                        @csrf
                        <!-- Input Tersembunyi untuk user_id -->
                        <input type="hidden" name="user_id" value="{{ $nilai->id }}">
                        <!-- Input Tersembunyi untuk periode_id (disesuaikan dengan id periode yang ingin disimpan) -->
                        <input type="hidden" name="periode_id" value="{{ $periode }}">
                        <!-- Isi formulir -->
                        <td>
                            <div class="form" style="width: 480px;">
                                <div class="form" style="width: 480px;">
                                    <textarea name="kriteria1" class="form-control">{{ isset($dataNilaiC) ? $dataNilaiC->kriteria1 : '' }}</textarea>
                                </div>
                                
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai1" class="form-control"  min="0" max="100" value="{{ isset($dataNilaiC) ? $dataNilaiC->nilai1 : '' }}" />
                            </div>
                        </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas dalam
                        satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria2" class="form-control">{{ isset($dataNilaiC) ? $dataNilaiC->kriteria2 : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai2" class="form-control"  min="0" max="100" value="{{ isset($dataNilaiC) ? $dataNilaiC->nilai2 : '' }}" />
                            </div>
                        </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Jumlah hari tidak hadir tanpa alasan yang sah dalam satu bulan</td>
                    <td>
                        <div class="form" style="width: 480px;">
                            <textarea name="kriteria3" class="form-control">{{ isset($dataNilaiC) ? $dataNilaiC->kriteria3 : '' }}</textarea>
                        </div>
                    </td>
                    <td>
                        <div class="form" style="width: 100px;">
                            <input type="number" name="nilai3" class="form-control"  min="0" max="100" value="{{ isset($dataNilaiC) ? $dataNilaiC->nilai3 : '' }}" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Jumlah izin karena sakit atau alasan lain dalam satu bulan</td>
                    <td>
                        <div class="form" style="width: 480px;">
                            <textarea name="kriteria4" class="form-control">{{ isset($dataNilaiC) ? $dataNilaiC->kriteria4 : '' }}</textarea>
                        </div>
                    </td>
                    <td>
                        <div class="form" style="width: 100px;">
                            <input type="number" name="nilai4" class="form-control"  min="0" max="100" value="{{ isset($dataNilaiC) ? $dataNilaiC->nilai4 : '' }}" />
                        </div>
                    </td>
                </tr>
                <p>izin &nbsp; hadir &nbsp; cuti</p>
                {{-- <button type="submit"
                    style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan</button> --}}
            </tbody>
        </table>
        <div class="container">
            <!-- Tombol Simpan -->
            <button type="submit"
                style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan</button>
        </div>
        </form>
    </div>
    
    {{-- <div class="container">
        <button style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan</button>
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

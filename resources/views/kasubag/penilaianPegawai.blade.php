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
    <link rel="stylesheet" href="{{ asset('css/penilaianPegawai.css') }}">

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
        <div class="container col-12" style="color: black; justify-content: center; margin-top: 20px">
            <p>Laporan Bulanan Pegawai Pemerintah Non Pegawai Negeri</p>
        </div>
        <div class="container" style="color: black">
            <div class="row">
                <p style="padding-top: 10px">Nama : {{ $nilai->name }}</p>
                <p style="padding-top: 10px">Jabatan : {{ $nilai->jabatan }}</p>
                <p style="padding-top: 10px">Unit Kerja : Komisi Pemilihan Umum Kota Batu</p>
                <?php
                $bulan_tahun = date('F Y');
                ?>
                <p style="padding-top: 10px">Periode : {{ $periodeall->periode_bulan }} -
                    {{ $periodeall->periode_tahun }}</p>
            </div>
        </div>

    </nav>
    {{-- Nilai A --}}
    <form action="{{ route('simpan.nilai') }}" method="POST" onsubmit="return validateForm()">
        @csrf
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
                        <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                            dalam
                            satu bulan</td>
                        <!-- Input Tersembunyi untuk user_id -->
                        <input type="hidden" name="user_id" value="{{ $nilai->id }}">
                        <!-- Input Tersembunyi untuk periode_id (disesuaikan dengan id periode yang ingin disimpan) -->
                        <input type="hidden" name="periode_id" value="{{ $periode }}">
                        <!-- Isi formulir -->
                        <td>
                            <div class="form" style="width: 490px;">
                                <div class="form" style="width: 480px;">
                                    <textarea name="kriteria1_A" class="form-control" style="width: 450px" placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria1_A : '' }}</textarea>
                                </div>

                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai1_A" class="form-control" placeholder="Masukkan nilai" min="0" max="100"
                                    value="{{ isset($dataNilai) ? $dataNilai->nilai1_A : '' }}" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                            dalam
                            satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria2_A" class="form-control" style="width: 450px" placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria2_A : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai2_A" class="form-control" placeholder="Masukkan nilai" min="0" max="100"
                                    value="{{ isset($dataNilai) ? $dataNilai->nilai2_A : '' }}" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Jumlah hari tidak hadir tanpa alasan yang sah dalam satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria3_A" class="form-control"style="width: 450px" placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria3_A : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai3_A" class="form-control" placeholder="Masukkan nilai" min="0" max="100"
                                    value="{{ isset($dataNilai) ? $dataNilai->nilai3_A : '' }}" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Jumlah izin karena sakit atau alasan lain dalam satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria4_A" class="form-control" style="width: 450px" placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria4_A : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai4_A" class="form-control" placeholder="Masukkan nilai" min="0"
                                    max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai4_A : '' }}" />
                            </div>
                        </td>
                    </tr>
                    <p>izin &nbsp;{{ $jumlahizin }} hadir &nbsp;{{ $totalCount }} cuti &nbsp;{{ $jumlahcuti }}
                    </p>
                    {{-- parshing data dari javascrip dan di lempar ke HTML --}}
                    <p class="alfa"></p>

                    <p>terlambat &nbsp;{{ $terlambat }}</p>
                    {{-- <button type="submit"
                    style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan</button> --}}
                </tbody>
            </table>
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
                        <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                            dalam
                            satu bulan</td>

                        <!-- Input Tersembunyi untuk user_id -->
                        <input type="hidden" name="user_id" value="{{ $nilai->id }}">
                        <!-- Input Tersembunyi untuk periode_id (disesuaikan dengan id periode yang ingin disimpan) -->
                        {{-- <input type="hidden" name="periode_id" value="{{ $periode }}"> --}}
                        <!-- Isi formulir -->
                        <td>
                            <div class="form" style="width: 480px;">
                                <div class="form" style="width: 480px;">
                                    <textarea name="kriteria1_B" class="form-control"style="width: 450px"placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria1_B : '' }}</textarea>
                                </div>

                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai1_B" class="form-control"placeholder="Masukkan nilai" min="0"
                                    max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai1_B : '' }}" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                            dalam
                            satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria2_B" class="form-control"style="width: 450px"placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria2_B : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai2_B" class="form-control"placeholder="Masukkan nilai" min="0"
                                    max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai2_B : '' }}" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Jumlah hari tidak hadir tanpa alasan yang sah dalam satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria3_B" class="form-control"style="width: 450px"placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria3_B : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai3_B" class="form-control"placeholder="Masukkan nilai" min="0"
                                    max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai3_B : '' }}" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Jumlah izin karena sakit atau alasan lain dalam satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria4_B" class="form-control"style="width: 450px"placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria4_B : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai4_B" class="form-control"placeholder="Masukkan nilai" min="0"
                                    max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai4_B : '' }}" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Jumlah izin karena sakit atau alasan lain dalam satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria5_B" class="form-control"style="width: 450px"placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria5_B : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai5_B" class="form-control"placeholder="Masukkan nilai" min="0"
                                    max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai5_B : '' }}" />
                            </div>
                        </td>
                    </tr>
                    {{-- <button type="submit"
                    style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan</button> --}}
                </tbody>
            </table>
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
                        <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                            dalam
                            satu bulan</td>
                        <!-- Input Tersembunyi untuk user_id -->
                        <input type="hidden" name="user_id" value="{{ $nilai->id }}">
                        <!-- Input Tersembunyi untuk periode_id (disesuaikan dengan id periode yang ingin disimpan) -->
                        <input type="hidden" name="periode_id" value="{{ $periode }}">
                        <!-- Isi formulir -->
                        <td>
                            <div class="form" style="width: 480px;">
                                <div class="form" style="width: 480px;">
                                    <textarea name="kriteria1_C" class="form-control"style="width: 450px"placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria1_C : '' }}</textarea>
                                </div>

                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai1_C" class="form-control"placeholder="Masukkan nilai" min="0"
                                    max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai1_C : '' }}" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                            dalam
                            satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria2_C" class="form-control"style="width: 450px"placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria2_C : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai2_C" class="form-control"placeholder="Masukkan nilai" min="0"
                                    max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai2_C : '' }}" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Jumlah hari tidak hadir tanpa alasan yang sah dalam satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria3_C" class="form-control"style="width: 450px"placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria3_C : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai3_C" class="form-control"placeholder="Masukkan nilai" min="0"
                                    max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai3_C : '' }}" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Jumlah izin karena sakit atau alasan lain dalam satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria4_C" class="form-control"style="width: 450px"placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria4_C : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai4_C" class="form-control"placeholder="Masukkan nilai" min="0"
                                    max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai4_C : '' }}" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Jumlah izin karena sakit atau alasan lain dalam satu bulan</td>
                        <td>
                            <div class="form" style="width: 480px;">
                                <textarea name="kriteria5_C" class="form-control"style="width: 450px"placeholder="Masukkan kriteria">{{ isset($dataNilai) ? $dataNilai->kriteria5_C : '' }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="form" style="width: 100px;">
                                <input type="number" name="nilai5_C" class="form-control"placeholder="Masukkan nilai" min="0"
                                    max="100" value="{{ isset($dataNilai) ? $dataNilai->nilai5_C : '' }}" />
                            </div>
                        </td>
                    </tr>
                    {{-- <button type="submit"
                    style="margin-top: 10px; background-color: #C72B41; border: none; color: white">Simpan</button> --}}
                </tbody>
            </table>
        </div>
        <div class="button-bawah d-flex" style="margin-left: 85px">
            <button type="submit"
                style="margin-top: 10px; margin-right: 10px; background-color: #C72B41; border: none; color: white; width: 100px; height: 40px; border-radius: 10px;">Simpan</button>
            <a href="{{ url('dashboardKasubag/kepegawaian') }}" class="btn btn-primary"
                style="background-color: #C72B41; height: 40px; margin-top: 10px">Kembali</a>
        </div>

    </form>
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
    <script>
        var tanggal = {!! json_encode($combinedData) !!};
        console.log(tanggal);
        // Mendapatkan tanggal saat ini
        var tanggalSekarang = new Date();

        // Mendapatkan tahun dan bulan saat ini
        var tahunIni = tanggalSekarang.getFullYear();
        var bulanIni = tanggalSekarang.getMonth() + 1; // Perhatikan bulan dimulai dari 0, jadi tambahkan 1

        // Mendapatkan tanggal awal bulan ini
        var tanggalAwal = new Date(tahunIni, bulanIni - 1, 1); // Kurangi 1 karena bulan dimulai dari 0

        // Mendapatkan tanggal akhir bulan ini
        var tanggalAkhir = new Date(tahunIni, bulanIni, 0); // Menggunakan 0 akan memberikan hari terakhir bulan sebelumnya

        // Menampilkan rentang waktu bulan ini
        console.log('Rentang waktu bulan ini:', tanggalAwal.toDateString(), '-', tanggalAkhir.toDateString());
        var tanggalTerlewat = 0;
        var tanggalKosong = 0;
        var tanggalKosongArray = [];
        // Iterasi melalui data tanggal
        // Iterasi melalui rentang tanggalAwal hingga tanggalAkhir
        for (var tanggalIterasi = new Date(tanggalAwal); tanggalIterasi <= tanggalAkhir; tanggalIterasi.setDate(
                tanggalIterasi.getDate() + 1)) {
            // Mengonversi tanggalIterasi ke dalam format yang sesuai dengan tanggalItem dari var tanggal
            var tanggalItemIterasi = tanggalIterasi.toISOString().slice(0, 10);

            // Jika tanggalItemIterasi tidak ada dalam var tanggal, maka tanggal tersebut kosong atau belum absen
            if (!tanggal.includes(tanggalItemIterasi)) {
                tanggalKosong++;
                tanggalKosongArray.push(tanggalItemIterasi);
            }
        }
        console.log('Tanggal-tanggal yang kosong atau belum absen:', tanggalKosongArray);
        // Mengisi hasil pengecekan ke dalam elemen HTML dengan class "alfa"
        var alfaElement = document.querySelector('.alfa');
        alfaElement.textContent = 'Tanggal kosong atau belum absen: ' + tanggalKosong;
    </script>

    <script>
        function validateForm() {
            // Mendapatkan nilai dari input form
            var kriteria1_A = document.getElementsByName('kriteria1_A')[0].value;
            var kriteria2_A = document.getElementsByName('kriteria2_A')[0].value;
            var kriteria3_A = document.getElementsByName('kriteria3_A')[0].value;
            var kriteria4_A = document.getElementsByName('kriteria4_A')[0].value;

            // Memeriksa apakah input form kosong
            if (kriteria1_A.trim() === '' || kriteria2_A.trim() === '' || kriteria3_A.trim() === '' || kriteria4_A
                .trim() === '') {
                alert('Inputan harus diisi');
                return false; // Mencegah form untuk melakukan submit
            }

            // Jika semua input sudah diisi, form akan di-submit
            return true;
        }
    </script>

</body>

</html>

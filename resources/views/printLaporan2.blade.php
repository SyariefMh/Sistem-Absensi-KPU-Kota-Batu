<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta charset="UTF-8"> --}}
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    {{-- <title>Cetak Laporan</title> --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'IBM Plex Sans', sans-serif;
            line-height: 1.5;
        }

        .table th,
        .table td {
            padding: 0.1rem;
            /* Mengatur padding menjadi lebih kecil */
        }

        p {
            font-size: 12px;
        }

        .mhs th,
        .mhs td {
            padding: 5px
        }

        .mhs td:first-child,
        .mhs td:last-child {
            text-align: center;
        }

        .main tr:first-child span {
            line-height: 1;
        }

        .tbl-no span {
            line-height: 1;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    {{-- kop surat --}}
    <img src="{{ asset('img/KPU_Logoo.png') }}" class="image"
        style="height: 90px; position: absolute; top: 1050px; margin-left: 50px" />

    <table align="center" border="0" cellpadding="1" class="main">
        <tbody>
            <tr>
                <td colspan="3">
                    <div align="center">
                        <span style="font-size: 20px; font-weight:600">KOMISI PEMILIHAN UMUM<br />KOTA BATU
                            <br /></span>
                        <span style="font-size: 16px;">JL. Sultan Agung No. 16 Sisir - Batu<br />Telp 0341-511123 Fax
                            0341-531866</span>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="border-bottom: 4px solid black; margin-top: 15px;"></div>
    {{-- end kop surat --}}

    {{-- judul --}}
    <p style="margin-top: 15px; text-align: center; font-weight: 700; font-size: 20px">LAPORAN BULANAN PEGAWAI
        PEMERINTAHAN NON PEGAWAI NEGERI</p>
    {{-- end Judul --}}
    {{-- COPY AN DI NOTEPAT --}}

    <!-- Loop untuk setiap pegawai -->
    @foreach ($get_nilai as $data)
        <table cellpadding="4" style="font-size: 12px">
            <tr>
                <td style="font-weight: bold;">Nama</td>
                <td>{{ $data->user->name }}</td> <!-- Mengambil data nama dari atribut 'nama' pada model Pegawai -->
            </tr>
            <tr>
                <td style="font-weight: bold;">Jabatan</td>
                <td>{{ $data->user->jabatan }}</td>
                <!-- Mengambil data jabatan dari atribut 'jabatan' pada model Pegawai -->
            </tr>
            <tr>
                <td style="font-weight: bold;">Unit Kerja</td>
                <td>KOMISI PEMILIHAN UMUM KOTA BATU</td>
                <!-- Mengambil data unit kerja dari atribut 'unit_kerja' pada model Pegawai -->
            </tr>
            <tr>
                <td style="font-weight: bold;">Periode</td>
                <td>Mei 2024</td> <!-- Tampilkan periode secara statis atau sesuaikan dengan logika aplikasi Anda -->
            </tr>
        </table>

        <caption>A. Presensi Kehadiran</caption>
        <table class="table table-bordered" border="1" cellpadding="8">
            <tr>
                <th>No.</th>
                <th>Aspek</th>
                <th>Kriteria</th>
                <th>Penilaian</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                    dalam satu bulan</td>
                <td>{{ $data->kriteria1_A }}</td>
                <td>{{ $data->nilai1_A }}</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                    dalam satu bulan</td>
                <td>{{ $data->kriteria2_A }}</td>
                <td>{{ $data->nilai2_A }}</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                    dalam satu bulan</td>
                <td>{{ $data->kriteria3_A }}</td>
                <td>{{ $data->nilai3_A }}</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                    dalam satu bulan</td>
                <td>{{ $data->kriteria4_A }}</td>
                <td>{{ $data->nilai4_A }}</td>
            </tr>
            <!-- Lanjutkan untuk baris berikutnya sesuai dengan jumlah data yang ingin ditampilkan -->
        </table>

        <caption>B. Presensi Kehadiran</caption>
        <table class="table table-bordered" border="1" cellpadding="8">
            <tr>
                <th>No.</th>
                <th>Aspek</th>
                <th>Kriteria</th>
                <th>Penilaian</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                    dalam satu bulan</td>
                <td>{{ $data->kriteria1_B }}</td>
                <td>{{ $data->nilai1_B }}</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                    dalam satu bulan</td>
                <td>{{ $data->kriteria2_B }}</td>
                <td>{{ $data->nilai2_B }}</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                    dalam satu bulan</td>
                <td>{{ $data->kriteria3_B }}</td>
                <td>{{ $data->nilai3_B }}</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                    dalam satu bulan</td>
                <td>{{ $data->kriteria4_B }}</td>
                <td>{{ $data->nilai4_B }}</td>
            </tr>
            <!-- Lanjutkan untuk baris berikutnya sesuai dengan jumlah data yang ingin ditampilkan -->
        </table>

        <caption>C. Presensi Kehadiran</caption>
        <table class="table table-bordered" border="1" cellpadding="8">
            <tr>
                <th>No.</th>
                <th>Aspek</th>
                <th>Kriteria</th>
                <th>Penilaian</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                    dalam satu bulan</td>
                <td>{{ $data->kriteria1_C }}</td>
                <td>{{ $data->nilai1_C }}</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                    dalam satu bulan</td>
                <td>{{ $data->kriteria2_C }}</td>
                <td>{{ $data->nilai2_C }}</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                    dalam satu bulan</td>
                <td>{{ $data->kriteria3_C }}</td>
                <td>{{ $data->nilai3_C }}</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Jumlah Terlambat Hadir Tidak masuk tanpa ijin atau bukan karena alasan Pelaksanaan tugas
                    dalam satu bulan</td>
                <td>{{ $data->kriteria4_C }}</td>
                <td>{{ $data->nilai4_C }}</td>
            </tr>
            <!-- Lanjutkan untuk baris berikutnya sesuai dengan jumlah data yang ingin ditampilkan -->
        </table>
    @endforeach
    {{-- @foreach ($processedData as $data)
        <table cellpadding="4" style="font-size: 12px">
            <tr>
                <td style="font-weight: bold;">Nama</td>
                <td>{{ $data['nama'] }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Jabatan</td>
                <td>{{ $data['jabatan'] }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Unit Kerja</td>
                <td>KOMISI PEMILIHAN UMUM KOTA BATU</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Periode</td>
                <td>Mei 2024</td>
            </tr>
        </table>

        @if ($data instanceof nilaiA)
            <caption>A. Presensi Kehadiran</caption>
            <table class="table table-bordered" border="1" cellpadding="8">
                <tr>
                    <th>No.</th>
                    <th>Aspek</th>
                    <th>Kriteria</th>
                    <th>Penilaian</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Aspek</td>
                    <td>Kriteria</td>
                    <td>{{ $data['nilai_A'] }}</td>
                </tr>
                <!-- Add code to display data from nilaiA -->
            </table>
        @elseif ($data instanceof nilaiB)
            <caption>B. Presensi Kehadiran</caption>
            <table class="table table-bordered" border="1" cellpadding="8">
                <tr>
                    <th>No.</th>
                    <th>Aspek</th>
                    <th>Kriteria</th>
                    <th>Penilaian</th>
                </tr>
                <!-- Add code to display data from nilaiB -->
            </table>
        @elseif ($data instanceof nilaiC)
            <!-- Add code to display data from nilaiC -->
        @endif
    @endforeach --}}



</body>

</html>

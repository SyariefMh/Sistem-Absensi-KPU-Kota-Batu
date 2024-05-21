<!DOCTYPE html>
<html>

<head>
    {{-- tempatkan style di sini --}}
    <style>
        * {
            font-family: 'IBM Plex Sans', sans-serif;
        }

        html {
            box-sizing: border-box;
        }

        header {
            position: fixed;
            margin: auto;
            top: -30;
            left: 0;
            right: 0;
            height: auto;
            /* Sesuaikan dengan tinggi header */
            background-color: #fff;
            /* Warna latar belakang header */
            /* background-color: blue; */
        }


        .logo {
            height: 90px;
            /* Sesuaikan dengan ukuran logo kamu */
        }

        .centered-text {
            text-align: center;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .tanggal {
            width: 100%;
            margin: auto;
            z-index: 1;
        }
    </style>
    {{-- end style --}}
    <title>Print Laporan Bulanan Pegawai</title>
</head>

<body>
    {{-- Kop Surat --}}
    <header>
        <table class="header-table">
            <tr>
                <td style="width: 30%;  ">
                    @php
                        $img = asset('img/KPU_Logoo.png');
                        $base_64 = base64_encode($img);
                        $img = 'data:image/png;base64,' . $base_64;
                    @endphp
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/KPU_Logoo.png'))) }}"
                        class="app-image-style" style="height:95px;margin-left: 90px" />
                </td>
                <td class="centered-text">
                    <p class="institusi"
                        style="font-size: 20px;  font-weight: bold; line-height: 1.5; margin-right: 100px; margin-bottom: 0%">
                        Komisi Pemilihan Umum
                        <br>Kota batu
                    </p>
                    <p class="alamat"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 15px;margin-top: 0%;margin-right: 100px">
                        JL. Sultan Agung No. 16 Sisir - Batu<br />Telp 0341-511123 Fax
                        0341-531866</p>
                </td>
            </tr>
        </table>
        <hr style="margin-top: 0%">
    </header>
    {{-- end Kop Surat --}}

    {{-- nomer surat --}}
    <div style="font-size: 12px; margin-top: 105px">
        <table style="border-collapse: collapse; width: 100%;">
            <tbody>
                <tr>
                    <td style="">Nomor</td>
                    <td colspan="2" style="">123445666</td>
                    <td >Batu, <?php echo date('d-m-Y'); ?> </td>
                </tr>
                <tr>
                    <td style="">Sifat</td>
                    <td colspan="2" style="">Penting</td>
                </tr>
                <tr>
                    <td style="">Lampiran</td>
                    <td colspan="2" style="">12 Halaman</td>
                </tr>
                <tr>
                    <td style="">Perihal</td>
                    <td colspan="2" style="font-weight: 600">Penyampaian Laporan Bulanan PPNPN <br> KPU Kota Batu
                        Periode Mei 2024</td>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- end nomer surat --}}

    {{-- Ucapan --}}
    <p style="font-size: 12px; margin-bottom: 0%; margin-top: 20px">Kepada <br> Yth. Sekertaris KPU Provinsi Jawa Timur</p>
    <p style="font-size: 12px; margin-top: 0%; margin-left: 25px; margin-bottom: 0%">di</p>
    <p style="font-size: 12px; margin-top: 0%; margin-left: 60px">Surabaya</p>
    

    <p style="text-indent: 50px;text-align: justify;line-height: 2;margin-top: 10px; font-size: 12px">Menindaklanjuti kembali Surat
        Sekertaris Komisi Pemilihan Umum Provinsi Jawa Timur tanggal 31 Januari 2022 Nomor : 77/SDM.05/35/2022 Perihal
        Penyampaian Laporan Bulanan PPNPN KPU Se-Jawa Timur. Dengan ini disampaikan Data Laporan Evaluasi Kinerja PPNPN
        KPU Kota Batu bulan September 2023 sebagai berikut:</p>
    {{-- end Ucapan --}}

        {{-- Table Pegawai --}}
    <table class="table table-bordered" style="font-size: 10px;">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @if ($user->jabatan == 'PNS')
                    <tr style="background-color: #f0f0f0;">
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->jabatan }}</td>
                        <td>{{ $user->pangkat }}</td>
                    </tr>
                @endif
            @endforeach

            @foreach ($users as $user)
                @if ($user->jabatan == 'PPNPN')
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->jabatan }}</td>
                        <td>{{ $user->pangkat }}</td>
                    </tr>
                @endif
            @endforeach
            @foreach ($users as $user)
                @if ($user->jabatan == 'Satpam')
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->jabatan }}</td>
                        <td>{{ $user->pangkat }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    {{-- end Table --}}
    {{-- Penutup halaman awal --}}
    <p style="text-indent: 30px; font-size: 12px">Adapun Laporan Bulanan Evaluasi Kinerja PPNPN KPU Kota Batu sebagaimana terlampir.
        Demikian untuk menjadi periksa dan atas Perhatiannya disampaikan terima kasih</p>
    <div class="tandatangan" style="margin-left: 600px; font-size: 12px">
        <p>SEKERTARIS,</p>
        <p style="margin-top: 80px">RUDI GUMILAR</p>
    </div>
    {{-- end Penutup halaman awal --}}

    {{-- judul --}}
    <p style="margin-top: 15px; text-align: center; font-weight: 700; font-size: 20px">LAPORAN BULANAN PEGAWAI
        PEMERINTAHAN NON PEGAWAI NEGERI</p>
    {{-- end Judul --}}

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

    {{-- tabel PNS --}}
    <table class="table table-bordered" id="usersTablePNS" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nomer</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Jam Datang</th>
                <th>Jam Pulang</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Kode Absen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @if ($user->jabatan == 'PNS')
                    @php
                        $foundUser = $combinedData->where('user', $user)->first();
                    @endphp
                    @if ($foundUser)
                        @foreach ($foundUser['absensi'] as $dataabsensi)
                            <tr style="background-color: #f0f0f0;">
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->jabatan }}</td>
                                <td>{{ $user->pangkat }}</td>
                                <td>{{ $dataabsensi->jam_datang }}</td>
                                <td>{{ $dataabsensi->jam_pulang }}</td>
                                <td>{{ $dataabsensi->tanggal }}</td>
                                <td>{{ $dataabsensi->Keterangan }}</td>
                                <td>{{ $dataabsensi->Status }}</td>
                                <td>{{ $dataabsensi->kode_absen }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr style="background-color: #f0f0f0;">
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->jabatan }}</td>
                            <td>{{ $user->pangkat }}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endif
                @endif
            @endforeach
            @foreach ($users as $user)
                @if ($user->jabatan == 'PPNPN')
                    @php
                        $foundUser = $combinedData->where('user', $user)->first();
                    @endphp
                    @if ($foundUser)
                        @foreach ($foundUser['absensi'] as $dataabsensi)
                            <tr style="background-color: #f0f0f0;">
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->jabatan }}</td>
                                <td>{{ $user->pangkat }}</td>
                                <td>{{ $dataabsensi->jam_datang }}</td>
                                <td>{{ $dataabsensi->jam_pulang }}</td>
                                <td>{{ $dataabsensi->tanggal }}</td>
                                <td>{{ $dataabsensi->Keterangan }}</td>
                                <td>{{ $dataabsensi->Status }}</td>
                                <td>{{ $dataabsensi->kode_absen }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr style="background-color: #f0f0f0;">
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->jabatan }}</td>
                            <td>{{ $user->pangkat }}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endif
                @endif
            @endforeach
            @foreach ($users as $user)
                @if ($user->jabatan == 'Satpam')
                    @php
                        $foundUser = $combinedData->where('user', $user)->first();
                    @endphp
                    @if ($foundUser)
                        @foreach ($foundUser['absensi'] as $dataabsensi)
                            <tr style="background-color: #f0f0f0;">
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->jabatan }}</td>
                                <td>{{ $user->pangkat }}</td>
                                <td>{{ $dataabsensi->jam_datang }}</td>
                                <td>{{ $dataabsensi->jam_pulang }}</td>
                                <td>{{ $dataabsensi->tanggal }}</td>
                                <td>{{ $dataabsensi->Keterangan }}</td>
                                <td>{{ $dataabsensi->Status }}</td>
                                <td>{{ $dataabsensi->kode_absen }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr style="background-color: #f0f0f0;">
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->jabatan }}</td>
                            <td>{{ $user->pangkat }}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endif
                @endif
            @endforeach


            {{-- @dd($combinedData); --}}
            {{-- @foreach ($combinedData as $dataabsensi)
                @if (!empty($dataabsensi['user_id']))
                    <!-- Periksa apakah $dataabsensi adalah array yang berisi data absensi atau bukan -->
                    @if ($dataabsensi['user']['jabatan'] == 'PNS')
                        <!-- Mengakses properti jabatan dari user dalam array -->
                        <tr style="background-color: #f0f0f0;">
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $dataabsensi['user']['name'] }}</td>
                            <td>{{ $dataabsensi['user']['jabatan'] }}</td>
                            <td>{{ $dataabsensi['jam_datang'] }}</td>
                            <td>{{ $dataabsensi['jam_pulang'] }}</td>
                            <td>{{ $dataabsensi['tanggal'] }}</td>
                            <td>{{ $dataabsensi['Keterangan'] }}</td>
                            <td>{{ $dataabsensi['Status'] }}</td>
                        </tr>
                    @endif
                @else
                    <tr style="background-color: #f0f0f0;">
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>---</td> <!-- Jika data kosong, tampilkan pengganti seperti '---' -->
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                        <!-- Tambahkan pengganti untuk kolom lainnya jika perlu -->
                    </tr>
                @endif
            @endforeach --}}

            {{-- @foreach ($combinedData as $dataabsensi)
                @if ($dataabsensi->jabatan == 'Satpam')
                    <tr style="background-color: #f0f0f0;">
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $dataabsensi->name }}</td>
                        <td>{{ $dataabsensi->user->jabatan }}</td>
                        <td>{{ $dataabsensi->jam_datang }}</td>
                        <td>{{ $dataabsensi->jam_pulang }}</td>
                        <td>{{ $dataabsensi->tanggal }}</td>
                        <td>{{ $dataabsensi->Keterangan }}</td>
                        <td>{{ $dataabsensi->Status }}</td>
                    </tr>
                @endif
            @endforeach --}}
            {{-- @foreach ($combinedData as $dataabsensi)
                @if ($dataabsensi->user->jabatan == 'PPNPN')
                    <tr style="background-color: #f0f0f0;">
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $dataabsensi->user->name }}</td>
                        <td>{{ $dataabsensi->user->jabatan }}</td>
                        <td>{{ $dataabsensi->jam_datang }}</td>
                        <td>{{ $dataabsensi->jam_pulang }}</td>
                        <td>{{ $dataabsensi->tanggal }}</td>
                        <td>{{ $dataabsensi->Keterangan }}</td>
                        <td>{{ $dataabsensi->Status }}</td>
                    </tr>
                @endif
            @endforeach --}}
        </tbody>
    </table>

    <script>
        const tanggalSekarang = new Date().toLocaleDateString();
        document.getElementById('tanggal-sekarang').textContent = tanggalSekarang;
    </script>
</body>

</html>

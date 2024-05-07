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
        @media print {
        /* CSS for print mode */

        /* Hide everything after a certain point */
        .break-before {
            display: none;
        }

        /* Force page break before this element */
        .break-before::before {
            content: "";
            display: block;
            page-break-before: always;
        }
        .print-page2 {
            page-break-before: always;
        }
    }
    </style>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    {{-- kop surat --}}
    <img src="{{ asset('img/KPU_Logoo.png') }}" class="app-image-style" style="height: 90px; position: absolute; top: 10px; margin-left: 50px" />

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

    {{-- nomer surat --}}
    <div style="font-size: 12px; margin-top: 15px">
        <table style="border-collapse: collapse; width: 100%;">
            <tbody>
                <tr>
                    <td style="">Nomor</td>
                    <td colspan="2" style="">123445666</td>
                    <td style="">Batu, 5 Mei 2024</td>
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
    <table style="border-collapse: collapse; font-size: 12px">
        <tr>
            <td style="padding: 8px;">Kepada</td>
        </tr>
        <tr>
            <td style="padding: 8px;">Yth. Yth. Sekertaris KPU Provinsi Jawa Timur</td>
        </tr>
        <tr>
            <td style="padding: 8px;">di</td>
        </tr>
        <tr>
            <td style="padding: 8px;">Surabaya</td>
        </tr>
    </table>

    <p style="text-indent: 50px;text-align: justify;line-height: 2;margin-top: 10px">Menindaklanjuti kembali Surat
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
    <p style="text-indent: 30px">Adapun Laporan Bulanan Evaluasi Kinerja PPNPN KPU Kota Batu sebagaimana terlampir.
        Demikian untuk menjadi periksa dan atas Perhatiannya disampaikan terima kasih</p>
    <div class="tandatangan" style="margin-left: 600px">
        <p>SEKERTARIS,</p>
        <p style="margin-top: 80px">RUDI GUMILAR</p>
    </div>
    {{-- end Penutup halaman awal --}}
    
    {{-- Bagian yang ingin muncul di halaman kedua saat dicetak --}}
    <div class="print-page2">
        @include('printLaporan2')
    </div>
</body>

</html>

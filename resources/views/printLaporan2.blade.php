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

        p{
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
    <img src="{{ asset('img/KPU_Logoo.png') }}" class="image" style="height: 90px; position: absolute; top: 1050px; margin-left: 50px" />

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
    <p style="margin-top: 15px; text-align: center; font-weight: 700">LAPORAN BULANAN PEGAWAI PEMERINTAHAN NON PEGAWAI NEGERI</p>
</body>

</html>

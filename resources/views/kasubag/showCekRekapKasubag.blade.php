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
    <link rel="stylesheet" href="{{ url('css/cekRekap.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">

    {{-- Logo Title Bar --}}
    <link rel="icon" href="{{ url('img/KPU_Logo.png') }}">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />

    <title>Dashboard</title>
    <style>
        #map-datang {
            height: 200px;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container col-12">
            <a>ABSENSI & LAPORAN BULANAN PEGAWAI</a>
            <img src="{{ url('img/KPU_Logo.png') }}" alt="" width="50" height="59"
                class="d-inline-block align-text-center">
            <a>KOMISI PEMILIHAN UMUM KOTA BATU</a>
        </div>
    </nav>

    <div class="d-flex align-items-center">
        {{-- @if (isset($cutiAttributes))
            <div class="container">
                <p>Nama : {{ $cutiAttributes->user->name }}</p>
                <p>Jabatan : {{ $cutiAttributes->user->jabatan }}</p>
                <p>Jenis Absen: Absen Cuti</p>
                <p>Jam Datang : {{ $cutiAttributes->jam_datang }}</p>
                <p>Jam Pulang : {{ $cutiAttributes->jam_pulang }}</p>
                <p>Tanggal : {{ $cutiAttributes->tanggal }}</p>
                <p>Keterangan : {{ $cutiAttributes->Keterangan }}</p>
                <p>Status : {{ $cutiAttributes->Status }}</p>
                <p>Tampilan file : <img src="{{ asset('storage/' . $cutiAttributes->file) }}" alt="Gambar"
                        style="max-width: 100px; height: auto;"></p>
            </div>
        @elseif(isset($izinAttributes))
            <div class="container">
                <p>Nama : {{ $izinAttributes->user->name }}</p>
                <p>Jabatan : {{ $izinAttributes->user->jabatan }}</p>
                <p>Jenis Absen: Absen Izin</p>
                <p>Jam Datang : {{ $izinAttributes->jam_datang }}</p>
                <p>Jam Pulang : {{ $izinAttributes->jam_pulang }}</p>
                <p>Tanggal : {{ $izinAttributes->tanggal }}</p>
                <p>Keterangan : {{ $izinAttributes->Keterangan }}</p>
                <p>Status : {{ $izinAttributes->Status }}</p>
                <p>Tampilan file : <img src="{{ asset('storage/' . $izinAttributes->file) }}" alt="Gambar"
                        style="max-width: 100px; height: auto;"></p>
            </div>
        @elseif(isset($dinlurAttributes))
            <div class="container">
                <p>Nama : {{ $dinlurAttributes->user->name }}</p>
                <p>Jabatan : {{ $dinlurAttributes->user->jabatan }}</p>
                <p>Jenis Absen: Absen Dinas Luar</p>
                <p>Jam Datang : {{ $dinlurAttributes->jam_datang }}</p>
                <p>Jam Pulang : {{ $dinlurAttributes->jam_pulang }}</p>
                <p>Tanggal : {{ $dinlurAttributes->tanggal }}</p>
                <p>Keterangan : {{ $dinlurAttributes->Keterangan }}</p>
                <p>Status : {{ $dinlurAttributes->Status }}</p>
                <p>Tampilan file : <img src="{{ asset('storage/' . $dinlurAttributes->file) }}" alt="Gambar"
                        style="max-width: 100px; height: auto;"></p>
                <p>Lokasi :
                <div id="map-datang"></div>
                </p>
            </div>
        @elseif(isset($qrcodeAttributes))
            <p>{{ $qrcodeAttributes['jam_datang'] }}</p>
            <div class="container">
                <p>Nama : {{ $qrcodeAttributes->user->name }}</p>
                <p>Jabatan : {{ $qrcodeAttributes->user->jabatan }}</p>
                <p>Jenis Absen: Absen QR Code Kantor</p>
                <p>Jam Datang : {{ $qrcodeAttributes->jam_datang }}</p>
                <p>Jam Pulang : {{ $qrcodeAttributes->jam_pulang }}</p>
                <p>Tanggal : {{ $qrcodeAttributes->tanggal }}</p>
                <p>Keterangan : {{ $qrcodeAttributes->Keterangan }}</p>
                <p>Status : {{ $qrcodeAttributes->Status }}</p>
                <p>Tampilan file : <img src="{{ asset('storage/' . $qrcodeAttributes->file) }}" alt="Gambar"
                        style="max-width: 100px; height: auto;"></p>
            </div>
        @else
            No data found.
        @endif --}}
        @if ($data)
            {{-- @dd($data); --}}
            <div class="container">
                <h1>Detail {{ $data->source }}</h1>
                <p>Nama: {{ $data->user->name }}</p>
                <p>Tanggal: {{ $data->tanggal }}</p>
                @if ($data->kode_absen === 'dinlur')
                    <p>Jenis Absen: Absen Dinas Luar</p>
                @elseif($data->kode_absen === 'izin')
                    <p>Jenis Absen: Absen Izin</p>
                @elseif($data->kode_absen === 'qrcode')
                    <p>Jenis Absen: Absen Qr Code Kantor</p>
                    @elseif($data->kode_absen === 'cuti')
                    <p>Jenis Absen: Absen Cuti</p>
                @endif
                <p>Jam Datang: {{ $data->jam_datang }}</p>
                <p>Jam Pulang: {{ $data->jam_pulang }}</p>
                <p>Keterangan: {{ $data->Keterangan }}</p>
                <p>Status: {{ $data->Status }}</p>
                @if ($data->kode_absen === 'dinlur' || $data->kode_absen === 'cuti' || $data->kode_absen === 'izin')
                    <p>Tampilan file : <img src="{{ asset('storage/' . $data->file) }}" alt="Gambar"
                            style="max-width: 100px; height: auto;"></p>
                @endif
                @if ($data->kode_absen === 'dinlur')
                    <div id="map-datang"></div>
                @endif
            @else
                <p>Data tidak ditemukan.</p>
        @endif
    </div>
    </div>

    <img src="img/peta.png" alt="" class="position-absolute end-0 bottom-0" width="1115">

    {{-- digunakan agar ketika data diambil dari tabel dinlur maka script leaflet dijalan kan --}}
    @if ($data->kode_absen === 'dinlur')
        <!-- Leaflet JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var datangMap = L.map('map-datang').setView([{{ $data->latitude }},
                    {{ $data->longitude }}
                ], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(datangMap);
                L.marker([{{ $data->latitude }}, {{ $data->longitude }}]).addTo(datangMap)
                    .bindPopup('Lokasi Datang')
                    .openPopup();
            });
        </script>
    @endif
    <script></script>
</body>

</html>

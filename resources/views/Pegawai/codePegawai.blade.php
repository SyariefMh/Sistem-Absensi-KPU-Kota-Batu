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
    <link rel="stylesheet" href="{{ url('css/pegawai.css') }}">

    {{-- Logo Title Bar --}}
    <link rel="icon" href="{{ url('img/KPU_Logo.png') }}">

    <title>Dashboard</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container col-12">
            <a>ABSENSI & LAPORAN BULANAN PEGAWAI</a>
            <img src="{{ url('img/KPU_Logo.png') }}" alt="Logo KPU" width="50" height="59"
                class="d-inline-block align-text-center">
            <a>KOMISI PEMILIHAN UMUM KOTA BATU</a>
        </div>
    </nav>
    {{-- card --}}
    <div class="container col-4 d-flex justify-content-center">
        <div class="card">
            <span id="countdown"></span>
            <p style="margin-left: 95px; color: #C72B41; font-weight: 800; padding-bottom: 20px">Scan QR Code</p>

            {{-- tempat menaruh Qr code --}}
            <div class="card-body">
                @php
                    $qrcodeGenPath = 'storage/qrcodes/' . $qrcodefilesDtg->qrcodefilesDtg . '.png';
                @endphp
                <div style="text-align: center;">
                    <img src="{{ asset('storage/' . $qrcodefilesDtg->qrcodefilesDtg) }}" alt="QR Code Kedatangan">
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ asset('storage/' . $qrcodefilesDtg->qrcodefilesDtg) }}" download>Download QR Code
                    Kedatangan</a>
            </div>
            <button id="regenerateBtn" style="display: none;" onclick="regenerateQR('{{ $id }}')">Generate QR
                Code Ulang</button>


            <p style="padding-bottom: 20px; text-align: center; padding-top: 40px">
                <a href="{{ url('dashboardPegawai') }}" class="kembali-btn">Kembali</a>
            </p>

        </div>
    </div>


    </div>

    <img src={{ url('img/peta.png') }} alt="" class="map">

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Your HTML code -->

    <script>
        // Mendefinisikan fungsi countdown di luar event listener
        function countdown() {
            var seconds = sessionStorage.getItem('countdownSeconds') ||
                60; // Mengambil waktu countdown dari sessionStorage atau default 10 detik
            var countdownElement = document.getElementById('countdown');

            function updateCountdown() {
                countdownElement.innerHTML = seconds + " detik";

                if (seconds > 0) {
                    seconds--;
                    sessionStorage.setItem('countdownSeconds',
                        seconds); // Simpan waktu countdown di sessionStorage selama countdown masih berjalan
                    setTimeout(updateCountdown, 1000); // Tunggu 1 detik
                } else {
                    // Hapus waktu countdown dari sessionStorage setelah selesai
                    // sessionStorage.removeItem('countdownSeconds');
                    // sessionStorage.setItem('countdownComplete', true); // Tandai countdown telah selesai

                    // Setelah countdown selesai, ganti gambar QR code
                    var qrCodeImg = document.querySelector('.card-body img');
                    // Ganti gambar QR code dengan parameter unik untuk menghindari cache
                    qrCodeImg.src = '{{ url('img/error.png') }}' + '?t=' + new Date().getTime();
                    qrCodeImg.style.width = '200px';
                    // Setelah countdown selesai, munculkan tombol "Generate QR Code Ulang"
                    document.getElementById('regenerateBtn').style.display = 'block';

                    // Panggil fungsi untuk mengupdate status QR Code
                    updateQRStatus('{{ $id }}');
                }
            }

            updateCountdown(); // Panggil fungsi pertama kali
        }

        // Event listener untuk memanggil countdown setelah dokumen HTML dimuat
        document.addEventListener('DOMContentLoaded', function() {
            countdown();
        });





        // Fungsi regenerateQR untuk mengirim permintaan AJAX
        function regenerateQR(id) {
            // Mengatur kembali nilai seconds ke nilai awal countdown (misalnya 5 detik)
            var seconds = 60;
            sessionStorage.setItem('countdownSeconds', seconds); // simpan kembali waktu countdown di sessionStorage
            countdown(); // panggil kembali fungsi countdown
            // Lakukan pemanggilan AJAX atau pengiriman form sesuai kebutuhan Anda
            // Contoh pengiriman form dengan fetch API
            fetch(`/dashboardPegawai/codePegawai/qrcodeDatang/${id}`, {
                    method: 'PUT',
                    body: JSON.stringify({}),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        // tambahkan header lain jika diperlukan
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Proses respons atau tindakan lain setelah berhasil menghasilkan QR code
                    console.log(data);
                    window.location.reload();
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }

        // Fungsi untuk mengupdate status QR Code
        function updateQRStatus(id) {
            fetch(`/dashboardPegawai/codePegawai/qrcodeupdateStat/${id}`, {
                    method: 'DELETE',
                    body: JSON.stringify({}),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        // tambahkan header lain jika diperlukan
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Proses respons atau tindakan lain setelah berhasil mengupdate status QR code
                    console.log(data);
                    var qrCodeImg = document.querySelector('.card-body img');
                    qrCodeImg.src = '{{ url('img/error.png') }}' + '?t=' + new Date().getTime();
                    qrCodeImg.style.width = '200px';
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }
    </script>

    <!-- Your JavaScript code -->
</body>

</html>

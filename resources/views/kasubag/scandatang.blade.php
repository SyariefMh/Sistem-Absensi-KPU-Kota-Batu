<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link rel="stylesheet" href="{{ url('css/codeAdmin.css') }}">

    {{-- Logo Title Bar --}}
    <link rel="icon" href="{{ url('img/KPU_Logo.png') }}">

    <title>Dashboard</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container col-12">
            <a>KOMISI PEMILIHAN UMUM KOTA BATU</a>
            <img src="{{ url('img/KPU_Logo.png') }}" alt="" width="50" height="59"
                class="d-inline-block align-text-center" style="margin-right: 100px">
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
    </nav>
    {{-- card --}}
    <div class="container col-4 d-flex justify-content-center">
        <div class="card">
            <p style=" color: #C72B41; font-weight: 800; padding-bottom: 20px; text-align: center">Scan Absensi Datang</p>
            {{-- Kamera --}}
            <div id="reader" style="height: 300px;"></div>
            <input type="hidden" id="qr_code_result" name="qr_code_result" value="">
            <p style="color: #C72B41; padding-bottom: 10px; text-align: center; padding-top: 150px; font-weight: 800">
                KOMISI PEMILIHAN UMUM
                <br>KOTA BATU
            </p>
            <p style="padding-bottom: 0px; text-align: center; padding-top: 10px;">
                <a href="{{ url('dashboardKasubag') }}" class="btn btn-primary"
                    style="background-color: #C72B41;">Kembali</a>
            </p>
        </div>
    </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="pulangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Absensi Datang</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="pulangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Absensi Datang</h5> <!-- Ganti id modal title -->
                </div>
                <div class="modal-body">
                    <p>Mohon Maaf anda Absensi Datang 2 kali</p>
                </div>
            </div>
        </div>
    </div>

    <img src={{ url('img/peta.png') }} alt="" class="map">

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script type="text/javascript">
        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code matched = ${decodedText}`, decodedResult);
            $('#qr_code_result').val(decodedText); // Set value to hidden input
            let id = decodedText;
            html5QrcodeScanner.clear().then(_ => {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var url = '{{ url('/dashboardKasubag/scanDatang/scan/store') }}';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _method: "POST",
                        _token: CSRF_TOKEN,
                        qrcodefilesDtg: id
                    },
                    success: function(response) {
                        console.log(response);
                        alert('berhasil');
                        window.location.href = '/dashboardKasubag/scanDatang';
                    },
                    error: function(response) {
                        console.log(response);
                        alert('gagal');
                    }
                    // error: function(error) {
                    //     if (error.responseJSON && error.responseJSON.message) {
                    //         $('#infoModal').modal('show');
                    //         console.log(error.responseJSON.message);
                    //         setTimeout(function() {
                    //             $('#infoModal').modal('hide');
                    //             window.location.href = '/dashboardAdmin/scanDatang';
                    //         }, 2500);
                    //     } else {
                    //         $('#errorModal').modal('show');
                    //         console.log(error);
                    //         setTimeout(function() {
                    //             $('#errorModal').modal('hide');
                    //             window.location.href = '/dashboardAdmin/scanDatang';
                    //         }, 2500);
                    //     }
                    // }
                });
            }).catch(error => {
                alert('something wrong');
            });
        }

        let config = {
            fps: 100,
            qrbox: {
                width: 150,
                height: 150
            },
            rememberLastUsedCamera: true,
            // Only support camera scan type.
            supportedScanTypes: [
                Html5QrcodeScanType.SCAN_TYPE_CAMERA,
                Html5QrcodeScanType.SCAN_TYPE_FILE
            ]
        };

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", config, /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>

</html>

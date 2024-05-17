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
    <link rel="stylesheet" href="css/style.css">

    {{-- boostrap icon --}}
    <link href="/node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Logo Title Bar --}}
    <link rel="icon" href="img/KPU_Logo.png">

    <title>Login Page</title>
    <style>
        body {
            background-image: url(img/peta.png);
            background-repeat: no-repeat;
            background-size: 100%;
            background-position: right -10px bottom -230px;
            ;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container col-12">
            <a>ABSENSI & LAPORAN BULANAN PEGAWAI</a>
            <a>KOMISI PEMILIHAN UMUM KOTA BATU</a>
        </div>
    </nav>

    {{-- Form Login --}}
    <div class="container col-12">
        <div class="form">
            <div class="container col-6">
                <div class="judul d-flex justify-content-center align-items-center flex-column mb-4">
                    <div class="text-center">
                        <img src="img/KPU_Logo.png" alt="" width="100" height="109" class="mx-auto">
                    </div>
                    <div class="text-center" style="margin-top: 10px; font-family: 'Inter', sans-serif;">
                        <h1 style="font-family: 'Inter', sans-serif; font-weight: 700">SIGN IN</h1>
                    </div>
                </div>

                {{-- alert --}}
                @if ($errors->any())
                    <div id="errorAlert" class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16"
                            role="img" aria-label="Warning:">
                            <path
                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                {{-- end alert --}}

                <div class="isi" style="margin-top: 0">
                    <div class="container col-10">
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" type="text" name="name" placeholder="Username"
                                    aria-label="default input example" value="{{ old('name') }}"
                                    style="background-color: transparent; border: none; border-bottom: 1px solid white; color: #E0E0E0">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="password" name="password" placeholder="Password"
                                    aria-label="default input example"
                                    style="background-color: transparent; border: none; border-bottom: 1px solid white; color: #E0E0E0">
                            </div>
                            <button type="submit" class="btn" style="width: 100%">SIGN IN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>









    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorAlert = document.getElementById('errorAlert');
            var timeout = 3000; // 3 detik

            setTimeout(function() {
                if (errorAlert) {
                    errorAlert.remove(); // Hapus elemen alert
                }
            }, timeout);
        });
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

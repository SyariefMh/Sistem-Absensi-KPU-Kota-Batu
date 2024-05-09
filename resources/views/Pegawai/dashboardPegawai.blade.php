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
    <link rel="stylesheet" href="css/dashboard.css">

    {{-- Logo Title Bar --}}
    <link rel="icon" href="img/KPU_Logo.png">

    <title>Dashboard</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container col-12">
            <a>SISTEM ABSENSI & LAPORAN BULANAN PEGAWAI</a>
            <img src="img/KPU_Logo.png" alt="" width="50" height="59"
                class="d-inline-block align-text-center">
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false" style="color: white; font-weight:bold">
                    KOMISI PEMILIHAN UMUM KOTA BATU <img src="img/profile.png" alt="" width="45"
                        height="45" style="margin-left: 10px">
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    {{-- <li><a class="dropdown-item" href="{{ url('dashboardPegawai/profile') }}">Profil</a></li> --}}
                    <li><a class="dropdown-item" href="{{ url('/logout') }}">Log out</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#modal_profile">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- modal --}}
    <div class="modal" id="modal_profile" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="profileForm" action="{{ url('dashboardPegawai/Pegawaiprofile/update/' . $users->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <p style="padding-top: 10px">Nama : </p>
                        <div class="input" style="margin-right: 800px">
                            <input name="name" class="form-control form-control-sm underline" type="text"
                                placeholder=".form-control-sm" aria-label=".form-control-sm example"
                                style="width: 400px" value="{{ $users->name }}">
                        </div>
                        <p style="padding-top: 10px">Role : </p>
                        <div class="input" style="margin-right: 800px">
                            <select name="role" class="form-select form-select-sm"
                                aria-label=".form-select-sm example" style="width: 400px" disabled>
                                <option value="pegawai" {{ $users->role == 'pegawai' ? 'selected' : '' }}>Pegawai
                                </option>
                                <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="kasubag umum" {{ $users->role == 'kasubag umum' ? 'selected' : '' }}>
                                    Kasubag Umum
                                </option>
                            </select>
                            <input type="hidden" name="role" value="{{ $users->role }}">
                        </div>
                        <p style="padding-top: 10px">Password : </p>
                        <div class="input" style="margin-right: 800px">
                            <input name="password" class="form-control form-control-sm underline" type="password"
                                placeholder=".form-control-sm" aria-label=".form-control-sm example"
                                style="width: 400px">
                        </div>
                        <p style="padding-top: 10px">Jabatan : </p>
                        <div class="input" style="margin-right: 800px">
                            <select name="jabatan" class="form-select form-select-sm"
                                aria-label=".form-select-sm example" style="width: 400px" disabled>
                                <option value="PNS" {{ $users->jabatan == 'PNS' ? 'selected' : '' }}>PNS</option>
                                <option value="PPNPN" {{ $users->jabatan == 'PPNPN' ? 'selected' : '' }}>PPNPN
                                </option>
                                <option value="Jagat Saksana (Satpam)"
                                    {{ $users->jabatan == 'Jagat Saksana (Satpam)' ? 'selected' : '' }}>Jagat Saksana
                                    (Satpam)
                                </option>
                            </select>
                            <input type="hidden" name="jabatan" value="{{ $users->jabatan }}">
                        </div>
                        <p style="padding-top: 10px">NIP : </p>
                        <div class="input" style="margin-right: 800px">
                            <input name="nip" class="form-control form-control-sm underline" type="text"
                                placeholder=".form-control-sm" aria-label=".form-control-sm example"
                                style="width: 400px" value="{{ $users->nip }}" disabled>
                            <input type="hidden" name="nip" value="{{ $users->nip }}">
                        </div>
                        <p style="padding-top: 10px">Pangkat : </p>
                        <div class="input" style="margin-right: 800px">
                            <input name="pangkat" class="form-control form-control-sm underline" type="text"
                                placeholder=".form-control-sm" aria-label=".form-control-sm example"
                                style="width: 400px" value="{{ $users->pangkat }}" disabled>
                            <input type="hidden" name="pangkat" value="{{ $users->pangkat }}">
                        </div>
                        <p style="padding-top: 10px">Golongan : </p>
                        <div class="input" style="margin-right: 800px">
                            <input name="golongan" class="form-control form-control-sm underline" type="text"
                                placeholder=".form-control-sm" aria-label=".form-control-sm example"
                                style="width: 400px" value="{{ $users->golongan }}" disabled>
                            <input type="hidden" name="golongan" value="{{ $users->golongan }}">
                        </div>
                        <div class="mb-3 d-flex">
                            <label for="formFileDisabled" class="form-label"
                                style="padding-top: 10px; color: #C72B41">Tanda
                                Tangan
                                : </label>
                            <input name="tandatanggan" class="form-control" type="file" id="formFileDisabled">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal --}}
    <div class="hero">
        <div class="container">
            {{-- alert --}}
            @if ($errors->any())
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                        aria-label="Warning:">
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

            @if (session('success'))
                <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            {{-- end alert --}}

            <p class="sapaan">Selamat Datang, {{ auth()->user()->name }}</p>
            <p class="motivasi">Silahkan untuk melakukan absensi kehadiran anda hari ini. Mari
                <br>bersama sama menjaga integritas dan
                profesionalitas KPU Kota Batu <br>dengan selalu tepat waktu dan disiplin dalam absensi
            </p>

            <img src="img/KPU_Logoo.png" alt="" class="logo">

            {{-- Card Menu --}}
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ url('/dashboardPegawai/codePegawai') }}" class="cardScan">
                        <div class="judul">
                            <p>Qr code</p>
                        </div>
                        <div class="icon">
                            <img src="img/riwayat.png" alt="" width="90" height="92">
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('/dashboardPegawai/dinasLuar') }}" class="cardScan">
                        <div class="judul">
                            <p>Dinas Luar</p>
                        </div>
                        <div class="icon">
                            <img src="img/riwayat.png" alt="" width="90" height="92">
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('/dashboardPegawai/izin') }}" class="cardScan">
                        <div class="judul">
                            <p>Izin</p>
                        </div>
                        <div class="icon">
                            <img src="img/izin.png" alt="" width="90" height="92">
                        </div>
                    </a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ url('/dashboardPegawai/cuti') }}" class="cardScan">
                        <div class="judul">
                            <p>Cuti</p>
                        </div>
                        <div class="icon">
                            <img src="img/izin.png" alt="" width="90" height="92">
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('/dashboardPegawai/riwayatAbsen') }}" class="cardScan">
                        <div class="judul">
                            <p>Riwayat Absen</p>
                        </div>
                        <div class="icon">
                            <img src="img/riwayat.png" alt="" width="90" height="92">
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('/dashboardPegawai/codePegawai/pulang') }}" class="cardScan">
                        <div class="judul">
                            <p>Pulang</p>
                        </div>
                        <div class="icon">
                            <img src="img/riwayat.png" alt="" width="90" height="92">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <img src="img/peta.png" alt="" class="map">

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        // Menggunakan setTimeout untuk menutup alert setelah 3 detik
        setTimeout(function() {
            document.getElementById('successAlert').classList.add('fade');
            setTimeout(function() {
                document.getElementById('successAlert').remove();
            }, 1000); // Menunggu efek fade selesai sebelum menghapus alert
        }, 3000);
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

    <!-- Letakkan skrip JavaScript ini di bawah tag </body> -->
    <script>
        function openModal() {
            var modal = new bootstrap.Modal(document.getElementById('modal_profile'));
            modal.show();
        }

        document.addEventListener('DOMContentLoaded', function() {
            var profileLink = document.querySelector('a.dropdown-item[href="#"]');
            profileLink.addEventListener('click', openModal);
            var profileForm = document.getElementById('profileForm');

            $('#profileForm').submit(function(event) {
                event.preventDefault(); // Mencegah pengiriman form biasa

                var formData = new FormData(this); // Buat objek FormData dari form
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                // Menambahkan token CSRF ke dalam formData
                formData.append('_token', CSRF_TOKEN);

                $.ajax({
                    url: $(this).attr('action'), // URL endpoint untuk permintaan AJAX
                    method: 'PUT', // Metode HTTP yang akan digunakan
                    data: formData, // Data yang akan dikirim
                    contentType: false, // Hindari default contentType untuk FormData
                    processData: false, // Hindari pemrosesan data FormData oleh jQuery
                    success: function(data) {
                        if (data.success) {
                            // Tutup modal jika berhasil
                            var modal = new bootstrap.Modal(document.getElementById(
                                'modal_profile'));
                            modal.hide();
                            // Tampilkan pesan sukses atau lakukan tindakan lain yang sesuai
                            console.log(data.message);
                        } else {
                            // Tampilkan pesan kesalahan jika diperlukan
                            console.error('Gagal memperbarui data');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Terjadi kesalahan:', error);
                        console.error('Status HTTP:', xhr.status);
                        console.error('Pesan Respons:', xhr.statusText);
                    }
                });
            });


        });
    </script>


</body>

</html>

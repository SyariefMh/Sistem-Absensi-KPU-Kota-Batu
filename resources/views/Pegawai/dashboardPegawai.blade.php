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

    <style>
        .fade-out {
            transition: opacity 1s ease-out;
            opacity: 0;
        }

        .sticky-alert {
            position: fixed;
            top: 20px;
            /* Sesuaikan dengan posisi vertikal yang diinginkan */
            right: 500px;
            padding: 10px;
            transition: opacity 0.5s ease-in-out;
            /* Efek transisi opacity */
        }

        .sticky-alert.fade-out {
            opacity: 0;
        }

        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }

        @media (max-width: 768px) {
            body {
                background: linear-gradient(to bottom, #C72B41, #000000);
                background-repeat: no-repeat;
                height: 650px;
            }

            .container {
                max-width: 100%;
            }

            .logo {
                display: none;
            }

            .scroll-container {
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 10px;
            }

            .scroll-container .row1,
            .scroll-container .row2 {
                display: inline-flex;
            }
        }
    </style>

    <title>Dashboard</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container col-12">
            <a>KOMISI PEMILIHAN UMUM KOTA BATU</a>
            <img src="img/KPU_Logo.png" alt="" width="50" height="59"
                class="d-inline-block align-text-center">
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false" style="color: white; font-weight:bold">
                    Pegawai, {{ auth()->user()->name }} <img src="img/profile.png" alt="" width="45"
                        height="45" style="margin-left: 10px">
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#modal_profile">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ url('/logout') }}">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- modal --}}
    <div class="modal" id="modal_profile" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Profile Pegawai</h5>
                    <button id="closeModal" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="profileForm" action="{{ url('dashboardPegawai/Pegawaiprofile/update/' . $users->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div id="updateBerhasil" class="alert alert-success" style="display: none">Berhasil di update
                        </div>
                        <div id="updateGagal" class="alert alert-danger" style="display: none">alert gagal</div>
                        <p style="padding-top: 10px">Nama : </p>
                        <div class="input" style="margin-right: 800px">
                            <input name="name" class="form-control form-control-sm underline" type="text"
                                placeholder=".form-control-sm" aria-label=".form-control-sm example"
                                style="width: 400px" value="{{ $users->name }}">
                        </div>
                        <!-- Sisipkan input tersembunyi untuk menyimpan data role -->
                        <input type="hidden" name="role" value="{{ $users->role }}">
                        <!-- Sisipkan input tersembunyi untuk menyimpan data role -->
                        <p style="padding-top: 10px">Password : </p>
                        <div class="input" style="margin-right: 800px">
                            <input name="password" class="form-control form-control-sm underline" type="password"
                                placeholder="Masukkan Password" aria-label=".form-control-sm example"
                                style="width: 400px">
                        </div>
                        <!-- Sisipkan input tersembunyi untuk menyimpan data jabatan -->
                        <input type="hidden" name="jabatan" value="{{ $users->jabatan }}">
                        <!-- Sisipkan input tersembunyi untuk menyimpan data jabatan -->
                        <!-- Sisipkan input tersembunyi untuk menyimpan data nip -->
                        <input type="hidden" name="nip" value="{{ $users->nip }}">
                        <!-- Sisipkan input tersembunyi untuk menyimpan data nip -->
                        <!-- Sisipkan input tersembunyi untuk menyimpan data pangkat -->
                        <input type="hidden" name="pangkat" value="{{ $users->pangkat }}">
                        <!-- Sisipkan input tersembunyi untuk menyimpan data pangkat -->
                        <!-- Sisipkan input tersembunyi untuk menyimpan data pangkat -->
                        <input type="hidden" name="golongan" value="{{ $users->golongan }}">
                        <!-- Sisipkan input tersembunyi untuk menyimpan data pangkat -->
                        <!-- Sisipkan input tersembunyi untuk menyimpan data tanda tangan -->
                        <p style="padding-top: 10px">Tanda Tangan : </p>
                        <div class="input" style="margin-right: 800px">
                            <input name="tandatanggan" class="form-control form-control-sm underline" type="file"
                                placeholder=".form-control-sm" aria-label=".form-control-sm example"
                                style="width: 400px">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal --}}

    <div class="hero">
        <div class="container">
            <!-- Alert Cuti -->
            <div id="stickyAlert" class="sticky-alert">
                @if (session('error'))
                    <div id="errorCuti" class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16"
                            role="img" aria-label="Warning:">
                            <path
                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                        <div>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
            </div>
            <!-- End Alert Cuti -->

            {{-- alert --}}
            @if ($errors->any() || session('success'))
                <div id="autoCloseAlert"
                    class="alert {{ $errors->any() ? 'alert-danger' : 'alert-success' }} d-flex align-items-center sticky-alert"
                    role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                        aria-label="Warning:">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <div>
                        <ul>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            @else
                                <li>{{ session('success') }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endif
            {{-- end alert --}}

            <p class="sapaan">Selamat Datang, {{ auth()->user()->name }}</p>
            <p class="motivasi">Silahkan untuk melakukan absensi kehadiran anda hari ini. Mari
                <br>bersama sama menjaga integritas dan
                profesionalitas KPU Kota Batu <br>dengan selalu tepat waktu dan disiplin dalam absensi
            </p>

            <img src="img/KPU_Logoo.png" alt="" class="logo">

            <div id="alertContainer"></div>

            {{-- Card Menu --}}
            <div class="scroll-container">
                <div class="row1" style="display: flex;">
                    <div class="col-md-2">
                        <a href="#" class="cardScan" id="qrcodeButton">
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
                <div class="row2" style="display: flex;">
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
                        <a href="#" id="generateQrCode" class="cardScan">
                            <div class="judul">
                                <p>Pulang</p>
                            </div>
                            <div class="icon">
                                <img src="{{ asset('img/riwayat.png') }}" alt="Pulang" width="90"
                                    height="92">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            {{-- end card menu --}}
        </div>
        <img src="img/peta.png" alt="" class="map">
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        // Menggunakan setTimeout untuk menutup alert setelah 3 detik
        setTimeout(function() {
            var autoCloseAlert = document.getElementById('autoCloseAlert');
            if (autoCloseAlert) {
                autoCloseAlert.classList.add('fade');
                setTimeout(function() {
                    autoCloseAlert.remove();
                }, 1000); // Menunggu efek fade selesai sebelum menghapus alert
            }
        }, 3000);
    </script>

    <script>
        document.getElementById('qrcodeButton').addEventListener('click', function(e) {
            e.preventDefault();

            fetch('{{ url('/dashboardPegawai/qrcode') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else if (data.success) {
                        showAlert('Success', data.success, 'alert-success');
                        setTimeout(() => {
                            window.location.href = '{{ url('/dashboardPegawai/codePegawai') }}';
                        }, 3000); // Berpindah halaman setelah 3 detik
                    } else {
                        showAlert('Error', data.error, 'alert-danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Error', 'An error occurred. Please try again.', 'alert-danger');
                });
        });

        function showAlert(title, message, alertType) {
            const alertContainer = document.getElementById('alertContainer');
            alertContainer.innerHTML = `
            <div class="alert ${alertType} d-flex align-items-center mb-4" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16"
                    role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <div>
                    <strong>${title}</strong>
                    <ul>
                        <li>${message}</li>
                    </ul>
                </div>
            </div>
        `;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
            $('#generateQrCode').click(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ url('/dashboardPegawai/qrcodepulang') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.message) {
                            alert(response.message);
                            window.location.href =
                                '{{ url('/dashboardPegawai/codePegawaiPulang') }}';
                        } else if (response.error) {
                            alert(response.error);
                        }
                    },
                    error: function(xhr) {
                        alert('Silahkan buat qr code datang dahulu');
                    }
                });
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $('#generateQrCode').click(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ url('/dashboardPegawai/qrcodepulang') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.message) {
                            showAlert('alert-primary', response.message);
                            setTimeout(function() {
                                window.location.href =
                                    '{{ url('/dashboardPegawai/codePegawaiPulang') }}';
                            }, 3000);
                        } else if (response.error) {
                            showAlert('alert-danger', response.error);
                        }
                    },
                    error: function(xhr) {
                        showAlert('alert-danger', 'Silahkan buat qr code datang dahulu');
                    }
                });
            });

            function showAlert(alertType, message) {
                var alertHTML = `
                    <div class="alert ${alertType} d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                        <div>${message}</div>
                    </div>
                `;
                $('#alertContainer').html(alertHTML);

                // Menghilangkan alert setelah 3 detik
                setTimeout(function() {
                    $('#alertContainer .alert').fadeOut(function() {
                        $(this).remove();
                    });
                }, 1500);
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Open the modal when the profile link is clicked
            var profileLink = document.querySelector('a.dropdown-item[href="#"]');
            profileLink.addEventListener('click', function(event) {
                event.preventDefault();
                $('#modal_profile').modal('show');
            });

            // Add event listener for form submission
            var profileForm = document.getElementById('profileForm');
            profileForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                var formData = new FormData(this); // Create FormData object from the form
                var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                $.ajax({
                    url: this.action, // The form action URL
                    method: 'POST', // Use POST method
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN // Set the CSRF token in headers
                    },
                    data: formData,
                    contentType: false, // Prevent jQuery from overriding content type
                    processData: false, // Prevent jQuery from processing data
                    success: function(data) {
                        if (data.success) {
                            $('#updateBerhasil').show();
                            setTimeout(function() {
                                $('#modal_profile').modal('hide');
                                location.reload();
                            }, 2000); // Optional delay before reload
                        } else {
                            $('#updateGagal').show();
                            setTimeout(function() {
                                $('#updateGagal').hide();
                            }, 2000); // Hide after 2 seconds
                            profileForm.reset();
                            console.error('Gagal memperbarui data');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#updateGagal').show();
                        setTimeout(function() {
                            $('#updateGagal').hide();
                        }, 2000); // Hide after 2 seconds
                        profileForm.reset();
                        console.error('Terjadi kesalahan:', error);
                        console.error('Status HTTP:', xhr.status);
                        console.error('Pesan Respons:', xhr.statusText);
                    }
                });
            });

            // Close the modal when the close button is clicked
            var closeModalButton = document.getElementById('closeModal');
            closeModalButton.addEventListener('click', function() {
                var modal = bootstrap.Modal.getInstance(document.getElementById('modal_profile'));
                modal.hide();
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var stickyAlert = document.getElementById('stickyAlert');
            if (stickyAlert) {
                setTimeout(function() {
                    stickyAlert.classList.add('fade-out');
                    setTimeout(function() {
                        stickyAlert.remove();
                    }, 500); // Tunggu sampai transisi selesai sebelum menghapus elemen
                }, 2000); // Mulai transisi setelah 5 detik
            }
        });
    </script>

</body>

</html>

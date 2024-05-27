<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="{{ asset('css/cekRekap.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">

    {{-- Logo Title Bar --}}
    <link rel="icon" href="img/KPU_Logo.png">

    <title>Dashboard</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container col-12">
            <a>ABSENSI & LAPORAN BULANAN PEGAWAI</a>
            <img src="{{ asset('img/KPU_Logo.png') }}" alt="" width="50" height="59"
                class="d-inline-block align-text-center">
            <a>KOMISI PEMILIHAN UMUM KOTA BATU
                <img src="{{ asset('img/profile.png') }}" alt="" width="50" height="50"
                    style="margin-left: 10px"></a>
        </div>
        <div class="container" style="color: black">
            <p style="padding-bottom: 0px; text-align: center; padding-top: 10px;">
                <a href="{{ url('dashboardKasubag') }}" class="btn btn-primary"
                    style="background-color: #C72B41;">Kembali</a>
            </p>
            <div class="container d-flex">
                <div class="container col-6" style="text-align: start; margin-top: 10px; font-size: 20px">
                    Data Seluruh Pegawai
                </div>
                @if (session('error'))
                    <div class="alert alert-danger" role="alert" id="error-alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="container col-6">
                    <div class="tgl" style="float: right">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value=""
                            style="background: #FFFFFF; margin-bottom: 10px">
                        <div style="position: absolute; right: 130px; display: flex">
                            <a href="{{ url('/dashboardKasubag/kepegawaian/laporan') }}">
                                <button type="submit" class="btn" style="width: 200px">Print Laporan</button>
                            </a>
                            <a href="{{ url('/dashboardKasubag/kepegawaian/create') }}" style="margin-left: 10px;">
                                <button type="submit" class="btn" style="width: 200px;">Tambah Pegawai</button>
                            </a>
                            <form action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="file">
                                    <input type="file" id="file" name="file">Import File User
                                </label>

                                <button type="submit">Submit</button>
                            </form>
                            {{-- dropdown --}}
                            <div class="dropdown" style="margin-left: 10px">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih Periode
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    @foreach ($periode as $p)
                                        <li><a class="dropdown-item" href="#"
                                                data-periode-id="{{ $p->id }}">{{ $p->periode_bulan }},
                                                {{ $p->periode_tahun }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- end dropdown --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                    <p style="margin-top: 40px; margin-left: 25px">PNS</p>
                    <thead>
                        <tr>
                            <th>Nomer</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>NIP</th>
                            <th>Pangkat</th>
                            <th>Golongan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <table class="table table-bordered" id="usersTablesatpam" width="100%" cellspacing="0">
                    <p style="margin-top: 40px; margin-left: 25px">Jagat Saksana (SATPAM)</p>
                    <thead>
                        <tr>
                            <th>Nomer</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>NIP</th>
                            <th>Pangkat</th>
                            <th>Golongan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <table class="table table-bordered" id="usersTablePPNPN" width="100%" cellspacing="0">
                    <p style="margin-top: 40px; margin-left: 25px">PPNPN</p>
                    <thead>
                        <tr>
                            <th>Nomer</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>NIP</th>
                            <th>Pangkat</th>
                            <th>Golongan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </nav>

    </div>
    <img src="img/peta.png" alt="" class="position-absolute end-0 bottom-0" width="1115">

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 3000); // 3000 ms = 3 detik
            }
        });
    </script>
    <script>
        var baseUrl = "{{ url('dashboardKasubag/kepegawaian/laporan') }}"
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownItems = document.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    var periodeId = item.getAttribute('data-periode-id');

                    if (periodeId) {
                        window.location.href = baseUrl + '/' + periodeId;
                    }
                });
            });
        });
    </script>


    {{-- PNS --}}
    {{-- <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/dashboardKasubag/kepegawaian/getPNS') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'pangkat',
                        name: 'pangkat',
                    },
                    {
                        data: 'golongan',
                        name: 'golongan',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#usersTable').on('click', 'a.delete-users', function(e) {
                e.preventDefault();
                var deleteUrl = $(this).data('url');

                if (confirm('Are you sure?')) {
                    fetch(deleteUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.warning) {
                                alert(data.warning);
                            } else {
                                // Handle success, e.g., reload the DataTable
                                $('#usersTable').DataTable().ajax.reload();
                                location.reload();
                            }
                        })
                        .catch(error => {
                            // Handle error
                            console.error(error);
                        });
                }
            });
            // kirim qr code PNS
            // Fungsi untuk mengirim QR code otomatis pada pukul 07.00 WIB
            $(document).ready(function() {
                // Fungsi untuk mengirim QR code otomatis pada pukul 23:16 WIB
                function sendQRCodeAutomatically() {
                    var now = new Date();
                    var hours = now.getHours();
                    var minutes = now.getMinutes();

                    // Atur waktu target untuk mengirim QR code (23:16 WIB)
                    var targetHours = 21;
                    var targetMinutes = 55;

                    // Periksa apakah waktu saat ini sudah mencapai waktu target
                    if (hours === targetHours && minutes === targetMinutes) {
                        // Lakukan fetch untuk mengirim QR code
                        fetch('{{ route('send.qr.code.all') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                            })
                            .then(response => {
                                if (response.status === 422) {
                                    return response.json().then(data => {
                                        throw new Error(data.error);
                                    });
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.error) {
                                    console.error(data.error);
                                } else if (data.success) {
                                    console.log(data.success);
                                    // Handle success, e.g., update UI
                                }
                            })
                            .catch(error => {
                                console.error(error.message);
                            });
                    }

                    // Lakukan pengecekan lagi setelah 1 menit
                    setTimeout(sendQRCodeAutomatically,
                        30000); // Panggil sendQRCodeAutomatically setelah 1 menit
                }

                // Panggil fungsi untuk pertama kali
                sendQRCodeAutomatically();
            });

            // send Pulang Qr Code PNS
            $('#usersTable').on('click', 'a.sendQr-pulang-users', function(e) {
                e.preventDefault();
                var pulang = $(this).data('url');

                if (confirm('Are you sure?')) {
                    fetch(pulang, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                        })
                        .then(response => {
                            if (response.status === 422) {
                                return response.json().then(data => {
                                    throw new Error(data.error);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.error) {
                                alert(data.error);
                            } else if (data.successs) {
                                alert(data.success);
                                // Handle success, e.g., reload the DataTable
                                $('#usersTable').DataTable().ajax.reload();
                                // location.reload();
                            }
                        })
                        .catch(error => {
                            // Show error popup
                            alert(error.message);

                            // Reload the page after 5 seconds
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        });
                }
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/dashboardKasubag/kepegawaian/getPNS') }}',
                columns: [{
                        data: null,
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'pangkat',
                        name: 'pangkat'
                    },
                    {
                        data: 'golongan',
                        name: 'golongan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#usersTable').on('click', 'a.delete-users', function(e) {
                e.preventDefault();
                var deleteUrl = $(this).data('url');
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                if (confirm('Are you sure?')) {
                    fetch(deleteUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(data => {
                                    throw new Error(data.message || 'Failed to delete user');
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            alert('Data Pegawai Berhasil Dihapus');
                            $('#usersTable').DataTable().ajax.reload();
                        })
                        .catch(error => {
                            alert(error.message);
                        });
                }
            });

            // Functions for sending QR codes are not related to the delete functionality
        });
    </script>

    <script>
        $(document).ready(function() {
            // edit satpam
            $('#usersTablesatpam').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/dashboardKasubag/kepegawaian/getSatpam') }}',
                columns: [{
                        data: null,
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'pangkat',
                        name: 'pangkat',
                    },
                    {
                        data: 'golongan',
                        name: 'golongan',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            // delete satpam
            $('#usersTablesatpam').on('click', 'a.delete-users', function(e) {
                e.preventDefault();
                var deleteUrl = $(this).data('url');

                if (confirm('Are you sure?')) {
                    fetch(deleteUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.warning) {
                                alert(data.warning);
                            } else {
                                // Handle success, e.g., reload the DataTable
                                $('#usersTable').DataTable().ajax.reload();
                                location.reload();
                            }
                        })
                        .catch(error => {
                            // Handle error
                            console.error(error);
                        });
                }
            });

            $(document).ready(function() {
                // Fungsi untuk mengirim QR code otomatis pada pukul 23:16 WIB
                function sendQRCodeAutomatically() {
                    var now = new Date();
                    var hours = now.getHours();
                    var minutes = now.getMinutes();

                    // Atur waktu target untuk mengirim QR code (23:16 WIB)
                    var targetHours = 21;
                    var targetMinutes = 55;

                    // Periksa apakah waktu saat ini sudah mencapai waktu target
                    if (hours === targetHours && minutes === targetMinutes) {
                        // Lakukan fetch untuk mengirim QR code
                        fetch('{{ route('send.qr.code.all') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                            })
                            .then(response => {
                                if (response.status === 422) {
                                    return response.json().then(data => {
                                        throw new Error(data.error);
                                    });
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.error) {
                                    console.error(data.error);
                                } else if (data.success) {
                                    console.log(data.success);
                                    // Handle success, e.g., update UI
                                }
                            })
                            .catch(error => {
                                console.error(error.message);
                            });
                    }

                    // Lakukan pengecekan lagi setelah 1 menit
                    setTimeout(sendQRCodeAutomatically,
                        30000); // Panggil sendQRCodeAutomatically setelah 1 menit
                }

                // Panggil fungsi untuk pertama kali
                sendQRCodeAutomatically();
            });
            // kirim pulang qr code satpam
            $('#usersTablesatpam').on('click', 'a.sendQr-pulang-users', function(e) {
                e.preventDefault();
                var pulang = $(this).data('url');

                if (confirm('Are you sure?')) {
                    fetch(pulang, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                        })
                        .then(response => {
                            if (response.status === 422) {
                                return response.json().then(data => {
                                    throw new Error(data.error);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.error) {
                                alert(data.error);
                            } else if (data.success) {
                                alert(data.success);
                                // Handle success, e.g., reload the DataTable
                                $('#usersTablesatpam').DataTable().ajax.reload();
                            }
                        })
                        .catch(error => {
                            // Show error popup
                            alert(error.message);

                            // Reload the page after 5 seconds
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // edit PPNPN
            $('#usersTablePPNPN').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/dashboardKasubag/kepegawaian/getPPNPN') }}',
                columns: [{
                        data: null,
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'pangkat',
                        name: 'pangkat',
                    },
                    {
                        data: 'golongan',
                        name: 'golongan',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            // delete PPNPN
            $('#usersTablePPNPN').on('click', 'a.delete-users', function(e) {
                e.preventDefault();
                var deleteUrl = $(this).data('url');

                if (confirm('Are you sure?')) {
                    fetch(deleteUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.warning) {
                                alert(data.warning);
                            } else {
                                // Handle success, e.g., reload the DataTable
                                $('#usersTable').DataTable().ajax.reload();
                                location.reload();
                            }
                        })
                        .catch(error => {
                            // Handle error
                            console.error(error);
                        });
                }
            });

            $(document).ready(function() {
                // Fungsi untuk mengirim QR code otomatis pada pukul 23:16 WIB
                function sendQRCodeAutomatically() {
                    var now = new Date();
                    var hours = now.getHours();
                    var minutes = now.getMinutes();

                    // Atur waktu target untuk mengirim QR code (23:16 WIB)
                    var targetHours = 21;
                    var targetMinutes = 55;

                    // Periksa apakah waktu saat ini sudah mencapai waktu target
                    if (hours === targetHours && minutes === targetMinutes) {
                        // Lakukan fetch untuk mengirim QR code
                        fetch('{{ route('send.qr.code.all') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                            })
                            .then(response => {
                                if (response.status === 422) {
                                    return response.json().then(data => {
                                        throw new Error(data.error);
                                    });
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.error) {
                                    console.error(data.error);
                                } else if (data.success) {
                                    console.log(data.success);
                                    // Handle success, e.g., update UI
                                }
                            })
                            .catch(error => {
                                console.error(error.message);
                            });
                    }

                    // Lakukan pengecekan lagi setelah 1 menit
                    setTimeout(sendQRCodeAutomatically,
                        30000); // Panggil sendQRCodeAutomatically setelah 1 menit
                }

                // Panggil fungsi untuk pertama kali
                sendQRCodeAutomatically();
            });
            //kirim pulang ppnn
            $('#usersTablePPNPN').on('click', 'a.sendQr-pulang-users', function(e) {
                e.preventDefault();
                var pulang = $(this).data('url');

                if (confirm('Are you sure?')) {
                    fetch(pulang, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                        })
                        .then(response => {
                            if (response.status === 422) {
                                return response.json().then(data => {
                                    throw new Error(data.error);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.error) {
                                alert(data.error);
                            } else if (data.success) {
                                alert(data.success);
                                // Handle success, e.g., reload the DataTable
                                $('#usersTablePPNPN').DataTable().ajax.reload();
                            }
                        })
                        .catch(error => {
                            // Show error popup
                            alert(error.message);

                            // Reload the page after 5 seconds
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        });
                }
            });
        });
    </script>
</body>

</html>

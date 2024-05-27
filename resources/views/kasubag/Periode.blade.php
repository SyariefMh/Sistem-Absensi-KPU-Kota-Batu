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
    <link rel="stylesheet" href="{{ asset('css/cekRekap.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">

    {{-- Logo Title Bar --}}
    <link rel="icon" href="img/KPU_Logo.png">

    <style>
        /* Gaya untuk elemen pencarian di DataTables */
        #usersTable_filter {
            text-align: right;
            margin-bottom: 10px;
        }

        #usersTable_filter label {
            font-weight: bold;
        }

        #usersTable_filter input {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 5px;
            width: 300px;
        }
    </style>

    <title>Dashboard</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container col-12">
            <a>KOMISI PEMILIHAN UMUM KOTA BATU</a>
            <img src="{{ asset('img/KPU_Logo.png') }}" alt="" width="50" height="59"
                class="d-inline-block align-text-center">
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false" style="color: #C72B41; font-weight:bold; background-color: #f0f0f0">
                    {{ auth()->user()->name }} <img src="{{ asset('img/profile.png') }}" alt="" width="45"
                        height="45" style="margin-left: 10px">
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ url('/logout') }}">Log out</a></li>
                </ul>
            </div>
        </div>
        <div class="container" style="color: black">
            <a href="{{ url('dashboardKasubag') }}" class="btn btn-primary"
                style="background-color: #C72B41;">Kembali</a>
            <div class="container d-flex">
                <div class="container col-6" style="text-align: start; margin-top: 10px; font-size: 20px">
                    Data Periode
                </div>
                <div id="message" class="status"></div>
                <div id="message-error" class="status-error"></div>
                <div class="container col-6">
                    <div class="tgl" style="float: right">
                        <div style="position: absolute; right: 130px;">
                            <a href="{{ url('/dashboardKasubag/periode/create') }}">
                                <button type="submit" class="btn" style="width: 200px">Tambah Periode</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- tabel --}}
            <div class="container">
                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomer</th>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Nama Sekretaris</th>
                            <th>NIP</th>
                            <th>Status</th>
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
        $(document).ready(function() {
            var table = $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/dashboardKasubag/periode/getdataperiode') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'periode_tahun',
                        name: 'periode_tahun'
                    },
                    {
                        data: 'periode_bulan',
                        name: 'periode_bulan'
                    },
                    {
                        data: 'nama_jabatan',
                        name: 'nama_jabatan'
                    },
                    {
                        data: 'nip_nama_jabatan',
                        name: 'nip_nama_jabatan',
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            var statusLabel = data == 1 ? 'Active' : 'Non-Active';
                            var badgeClass = data == 1 ? 'badge-success' : 'badge-danger';
                            return `
                        <select class="form-select update-status" data-id="${row.id}">
                            <option value="1" ${data == 1 ? 'selected' : ''}>Active</option>
                            <option value="0" ${data == 0 ? 'selected' : ''}>Non-Active</option>
                        </select>
                    `;
                        }
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
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.error) {
                                alert(data.error);
                            } else {
                                // Handle success, e.g., reload the DataTable
                                $('#usersTable').DataTable().ajax.reload();
                            }
                        })
                        .catch(error => {
                            // Handle error
                            console.error('There was a problem with the fetch operation:', error);
                        });
                }
            });

            // Event listener untuk perubahan status
            $('#usersTable').on('change', '.update-status', function() {
                var status = $(this).val();
                var id = $(this).data('id');

                $.ajax({
                    url: '{{ url('/dashboardKasubag/periode/updateStatus') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            table.ajax.reload(); // Reload DataTable
                            var message = '';
                            if (status == 1) {
                                message =
                                    '<div class="alert alert-success" role="alert">Data Status Periode telah di aktifkan</div>';
                            } else {
                                message =
                                    '<div class="alert alert-danger" role="alert">Data Status Periode telah nonaktifkan</div>';
                            }
                            $('#message').html(message);
                            setTimeout(function() {
                                $('#message').html(
                                    ''); // Hapus pesan setelah beberapa detik
                            }, 3000);
                        } else {
                            var message = '';
                            message =
                                '<div class="alert alert-danger" role="alert">Ada periode lain yang sudah aktif. Nonaktifkan terlebih dahulu.</div>';
                            $('#message-error').html(message);
                            setTimeout(function() {
                                $('#message-error').html(
                                    ''
                                ); // Hapus pesan setelah beberapa detik
                                location.reload();
                            }, 5000);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('An error occurred while updating status');
                    }
                });
            });
        });
    </script>

</body>

</html>

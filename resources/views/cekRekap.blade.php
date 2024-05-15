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
    {{-- data table --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">

    {{-- Logo Title Bar --}}
    <link rel="icon" href="{{ url('img/KPU_Logo.png') }}">

    <title>Dashboard</title>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container col-12">
            <a>ABSENSI & LAPORAN BULANAN PEGAWAI</a>
            <img src="{{ url('img/KPU_Logo.png') }}" alt="" width="50" height="59"
                class="d-inline-block align-text-center">
            <a>KOMISI PEMILIHAN UMUM KOTA BATU</a>
        </div>
        <div class="container" style="color: black">
            <p style="padding-bottom: 0px; text-align: center; padding-top: 10px;">
                <a href="{{ url('dashboardAdmin') }}" class="btn btn-primary"
                    style="background-color: #C72B41;">Kembali</a>
            </p>
            <div class="container d-flex">
                <div class="container col-6" style="text-align: start; margin-top: 10px; font-size: 20px">
                    Cek dan Rekap Absensi Pegawai
                </div>
                <div class="container col-6">
                    <div class="tgl" style="float: right">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value=""
                            style="background: #FFFFFF">
                    </div>
                </div>
            </div>
            {{-- tabel PNS --}}
            <div class="container">
                <table class="table table-bordered" id="usersTablePNS" width="100%" cellspacing="0">
                    <p style="margin-top: 40px; margin-left: 25px">PNS</p>
                    <thead>
                        <tr>
                            <th>Nomer</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Jam Datang</th>
                            <th>Jam Pulang</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                {{-- <div style="position: absolute; right: 130px; margin-top: 10px">
                    <button type="submit" class="btn" style="width: 200px">Print Rekap</button>
                </div> --}}
            </div>

            {{-- tabel Satpam --}}
            <div class="container">
                <table class="table table-bordered" id="usersTablesatpam" width="100%" cellspacing="0">
                    <p style="margin-top: 40px; margin-left: 25px">Satpam</p>
                    <thead>
                        <tr>
                            <th>Nomer</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Jam Datang</th>
                            <th>Jam Pulang</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>



                {{-- <div style="position: absolute; right: 130px;">
                    <button type="submit" class="btn" style="width: 200px;margin-top: 10px">Print Rekap</button>
                </div> --}}
            </div>

            {{-- tabel PPNPN --}}
            <div class="container">
                <table class="table table-bordered" id="usersTablePPNPN" width="100%" cellspacing="0">
                    <p style="margin-top: 40px; margin-left: 25px">PPNPN</p>
                    <thead>
                        <tr>
                            <th>Nomer</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Jam Datang</th>
                            <th>Jam Pulang</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>



                {{-- <div style="position: absolute; right: 130px;">
                    <button type="submit" class="btn" style="width: 200px;margin-top: 10px">Print Rekap</button>
                </div> --}}
            </div>
        </div>
        </div>
    </nav>

    </div>


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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    {{-- rekap PNS --}}
    <script>
        $(document).ready(function() {
            $('#usersTablePNS').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url('/dashboardAdmin/cekRekap/getPNS') }}',
                    data: function(d) {
                        d.tgl = $('#tanggal').val(); // Mengirim nilai tanggal ke server
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
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
                        data: 'jam_datang',
                        name: 'jam_datang',
                        render: function(data) {
                            return data ? data :
                                '-'; // Jika data tidak null, gunakan nilainya. Jika null, gunakan "belum absensi".
                        }
                    }, // Add columns according to your requirements
                    {
                        data: 'jam_pulang',
                        name: 'jam_pulang',
                        render: function(data) {
                            return data ? data :
                                '-'; // Jika data tidak null, gunakan nilainya. Jika null, gunakan "belum absensi".
                        }
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        render: function(data) {
                            return data.split('-').reverse().join('-');
                        }
                    },
                    {
                        data: 'Keterangan',
                        name: 'Keterangan'
                    },
                    {
                        data: 'Status',
                        name: 'Status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]

            });
            $('#tanggal').on('change', function() {
                $('#usersTablePNS').DataTable().ajax.reload();
            });

            $('#usersTablePNS').on('click', 'a.delete-users', function(e) {
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
                                $('#usersTablePNS').DataTable().ajax.reload();
                                location.reload();
                            }
                        })
                        .catch(error => {
                            // Handle error
                            console.error(error);
                        });
                }
            });
        });
    </script>

    {{-- Satpam --}}
    <script>
        $(document).ready(function() {
            $('#usersTablesatpam').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url('/dashboardAdmin/cekRekap/getSatpam') }}',
                    data: function(d) {
                        d.tgl = $('#tanggal').val(); // Mengirim nilai tanggal ke server
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
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
                        data: 'jam_datang',
                        name: 'jam_datang',
                        render: function(data) {
                            return data ? data :
                                '-'; // Jika data tidak null, gunakan nilainya. Jika null, gunakan "belum absensi".
                        }
                    }, // Add columns according to your requirements
                    {
                        data: 'jam_pulang',
                        name: 'jam_pulang',
                        render: function(data) {
                            return data ? data :
                                '-'; // Jika data tidak null, gunakan nilainya. Jika null, gunakan "belum absensi".
                        }
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        render: function(data) {
                            return data.split('-').reverse().join('-');
                        }
                    },
                    {
                        data: 'Keterangan',
                        name: 'Keterangan'
                    },
                    {
                        data: 'Status',
                        name: 'Status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]

            });
            $('#tanggal').on('change', function() {
                $('#usersTablesatpam').DataTable().ajax.reload();
            });

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
                                $('#usersTablesatpam').DataTable().ajax.reload();
                                location.reload();
                            }
                        })
                        .catch(error => {
                            // Handle error
                            console.error(error);
                        });
                }
            });
        });
    </script>

    {{-- PPNPN --}}
    <script>
        $(document).ready(function() {
            $('#usersTablePPNPN').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url('/dashboardAdmin/cekRekap/getPPNPN') }}',
                    data: function(d) {
                        d.tgl = $('#tanggal').val(); // Mengirim nilai tanggal ke server
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
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
                        data: 'jam_datang',
                        name: 'jam_datang',
                        render: function(data) {
                            return data ? data :
                                '-'; // Jika data tidak null, gunakan nilainya. Jika null, gunakan "belum absensi".
                        }
                    }, // Add columns according to your requirements
                    {
                        data: 'jam_pulang',
                        name: 'jam_pulang',
                        render: function(data) {
                            return data ? data :
                                '-'; // Jika data tidak null, gunakan nilainya. Jika null, gunakan "belum absensi".
                        }
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        render: function(data) {
                            return data.split('-').reverse().join('-');
                        }
                    },
                    {
                        data: 'Keterangan',
                        name: 'Keterangan'
                    },
                    {
                        data: 'Status',
                        name: 'Status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]

            });
            $('#tanggal').on('change', function() {
                $('#usersTablePPNPN').DataTable().ajax.reload();
            });

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
                                $('#usersTablePPNPN').DataTable().ajax.reload();
                                location.reload();
                            }
                        })
                        .catch(error => {
                            // Handle error
                            console.error(error);
                        });
                }
            });
        });
    </script>
</body>

</html>

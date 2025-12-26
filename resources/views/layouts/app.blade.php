<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warung Ziran</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('adminlte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <style>
        /* Mengatur tampilan background content agar lebih bersih */
        .content-wrapper {
            background-color: #f4f7fa !important;
        }

        /* Navbar Modern */
        .main-header {
            border-bottom: 1px solid #e9ecef !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .04);
        }

        /* Styling Breadcrumb */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 0;
        }

        /* Sidebar Styling */
        .main-sidebar {
            box-shadow: 4px 0 10px rgba(0, 0, 0, .05) !important;
        }

        /* Merapikan Dropdown User di Navbar */
        .navbar-nav .dropdown-toggle {
            font-weight: 600;
            color: #444;
        }

        .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .1);
            padding: 10px;
        }

        .dropdown-menu button {
            width: 100%;
            text-align: left;
            border-radius: 8px;
            margin-bottom: 5px;
            padding: 8px 15px;
        }

        /* Global Table & Card (Mempengaruhi semua halaman yield) */
        .card {
            border: none !important;
            border-radius: 15px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .05) !important;
        }

        .table thead th {
            border-top: none;
            border-bottom: 2px solid #f4f7fa;
            color: #6c757d;
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        /* Footer yang lebih clean */
        .main-footer {
            background: #fff;
            border-top: 1px solid #e9ecef;
            color: #868e96;
            font-size: 0.9rem;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    @include('sweetalert::alert')
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/dashboard" class="nav-link font-weight-bold">Home</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown px-3">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-user-circle mr-1"></i> {{ ucwords(auth()->user()->name) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <button type="button" class="btn btn-light" data-toggle="modal"
                            data-target="#formGantiPassword">
                            <i class="fas fa-key mr-2 text-muted"></i> Ganti Password
                        </button>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light text-danger">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <x-user.form-ganti-password />
        <x-admin.aside />

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 px-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 font-weight-bold text-dark" style="letter-spacing: -1px;">@yield('content_title')
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/dashboard text-primary">Home</a></li>
                                <li class="breadcrumb-item active">@yield('content_title')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Sistem Penjualan dan Inventori Warung Ziran
            </div>
            <strong>Copyright &copy; 2025 <a href="https://www.instagram.com/ziran.mr/" class="text-primary">M.Ziran M
                    R</a>.</strong>
        </footer>
    </div>

    <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>

    <script src="{{ asset('adminlte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>

    <script>
        $(function() {
            $("#t1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["pdf", "print"]
            }).buttons().container().appendTo('#t1_wrapper .col-md-6:eq(0)');

            $('#t2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
        });
    </script>
    @stack('script')
</body>

</html>

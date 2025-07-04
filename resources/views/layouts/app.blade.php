<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Monitoring Siswa')</title>

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        .modal-header {
            background: #007bff linear-gradient(180deg, #268fff, #007bff) repeat-x;
            margin: 2px;
            padding: 0.9rem;
        }

        h4.modal-title {
            font-size: 18px;
            color: #fff;
            padding: 0;
        }
    </style>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">

                    <h5 class="mt-2 ml-2">{{ config('app.name') }}</h5>

                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-left">

                        <!--  <a href="#" class="dropdown-item" id="ubah-password" data-username="">
                            <i id="ubah-password" data-username="" class="fas fa-key mr-2"></i> Ubah Password
                        </a> -->

                        <div class="dropdown-divider"></div>
                        <a href="{{ asset('logout') }}" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            {{-- <a href="{{ asset('') }}" class="brand-link">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">/span>
            </a> --}}

            <div class="sidebar">

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        {{-- Dashboard --}}
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @if (optional(Auth::user())->role === 'admin')
                            {{-- Mata Pelajaran --}}
                            <li class="nav-item">
                                <a href="{{ url('mapel') }}"
                                    class="nav-link {{ Request::is('mapel*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Mata Pelajaran</p>
                                </a>
                            </li>

                            {{-- Pengajar --}}
                            <li class="nav-item">
                                <a href="{{ url('pengajar') }}"
                                    class="nav-link {{ Request::is('pengajar*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                    <p>Pengajar</p>
                                </a>
                            </li>

                            {{-- Kelas --}}
                            <li class="nav-item">
                                <a href="{{ url('kelas') }}"
                                    class="nav-link {{ Request::is('kelas*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-door-open"></i>
                                    <p>Kelas</p>
                                </a>
                            </li>

                            {{-- Data Siswa --}}
                            <li class="nav-item">
                                <a href="{{ url('siswa') }}"
                                    class="nav-link {{ Request::is('siswa*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-graduate"></i>
                                    <p>Data Siswa</p>
                                </a>
                            </li>

                            {{-- Absensi --}}
                            <li class="nav-item">
                                <a href="{{ url('absensi') }}"
                                    class="nav-link {{ Request::is('absensi*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Absensi</p>
                                </a>
                            </li>

                            {{-- Nilai --}}
                            <li class="nav-item">
                                <a href="{{ url('nilai') }}"
                                    class="nav-link {{ Request::is('nilai*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book-open"></i>
                                    <p>Nilai</p>
                                </a>
                            </li>

                            {{-- Laporan PDF --}}
                            <li class="nav-item">
                                <a href="{{ url('laporan') }}"
                                    class="nav-link {{ Request::is('laporan*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-pdf"></i>
                                    <p>File Laporan</p>
                                </a>
                            </li>
                        @endif

                        @if (optional(Auth::user())->role === 'siswa')
                            {{-- Absensi Saya --}}
                            <li class="nav-item">
                                <a href="{{ url('absensi_siswa') }}"
                                    class="nav-link {{ Request::is('absensi_siswa') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Absensi Saya</p>
                                </a>
                            </li>
                            {{-- Nilai Saya --}}
                            <li class="nav-item">
                                <a href="{{ url('nilai_siswa') }}"
                                    class="nav-link {{ Request::is('nilai_siswa') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book-open"></i>
                                    <p>Nilai Saya</p>
                                </a>
                            </li>
                            {{-- Laporan --}}
                            <li class="nav-item">
                                <a href="{{ url('laporan_siswa') }}"
                                    class="nav-link {{ Request::is('laporan_siswa') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-pdf"></i>
                                    <p>Laporan</p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </nav>

            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">

            </div>
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <strong>Copyright &copy; <a href="#">2025</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

    @stack('scripts')
</body>

</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - Dnia Organizer</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayScrollbars@1.13.3/css/OverlayScrollbars.min.css">

    <style>
        :root {
            --dnia-gold: #c9a227;
            --dnia-dark-gold: #a67c00;
            --dnia-cream: #faf8f3;
        }

        .brand-link {
            background: linear-gradient(135deg, var(--dnia-gold), var(--dnia-dark-gold));
            color: #fff !important;
            font-weight: 700;
        }

        .brand-link .brand-text {
            font-weight: 700 !important;
        }

        .main-sidebar {
            background: #1f1f1f;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active,
        .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
            background: linear-gradient(135deg, var(--dnia-gold), var(--dnia-dark-gold));
            color: #fff;
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--dnia-gold), var(--dnia-dark-gold));
            border: none;
            color: #fff;
        }

        .btn-gold:hover {
            color: #fff;
            box-shadow: 0 6px 18px rgba(201, 162, 39, 0.35);
        }

        .text-gold {
            color: var(--dnia-dark-gold) !important;
        }

        .card-gold.card-outline {
            border-top: 3px solid var(--dnia-gold);
        }

        .bg-gold-custom,
        .small-box.bg-gold-custom {
            background: linear-gradient(135deg, var(--dnia-gold), var(--dnia-dark-gold));
            color: #fff;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .content-wrapper {
            background: var(--dnia-cream);
        }
    </style>

    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('home') }}" target="_blank" class="nav-link">Lihat Website</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-user-circle"></i> Admin
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('admin.logout') }}" class="dropdown-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
            <span class="brand-text">Dnia Organizer</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <i class="fa fa-user-circle fa-2x text-white"></i>
                </div>
                <div class="info">
                    <a href="#" class="d-block">Administrator</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-calendar-check-o"></i>
                            <p>Booking Acara</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-heart"></i>
                            <p>Layanan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-quote-right"></i>
                            <p>Testimoni</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.terms.index') }}" class="nav-link {{ request()->routeIs('admin.terms.*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-list-alt"></i>
                            <p>Syarat & Ketentuan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.packages.index') }}" class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-gift"></i>
                            <p>Paket</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.galleries.index') }}" class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-image"></i>
                            <p>Galeri</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('page_title', 'Dashboard')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                            <li class="breadcrumb-item active">@yield('page_title', 'Dashboard')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    <footer class="main-footer">
        <strong>&copy; {{ date('Y') }} Dnia Organizer.</strong> Admin Panel.
        <div class="float-right d-none d-sm-inline-block">
            Laravel 12 + AdminLTE 3
        </div>
    </footer>
</div>

@if(session('success'))
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel"><i class="fa fa-check-circle mr-1"></i> Berhasil</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ session('success') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
@endif

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmModalLabel"><i class="fa fa-exclamation-triangle mr-1"></i> Konfirmasi</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="confirmModalMessage">
                Apakah data ini ingin dihapus?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmModalYes">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gold-custom text-white">
                <h5 class="modal-title" id="infoModalLabel"><i class="fa fa-info-circle mr-1"></i> Informasi</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="infoModalMessage"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gold" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/overlayScrollbars@1.13.3/js/jquery.overlayScrollbars.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script>
    $(function () {
        @if(session('success'))
            $('#successModal').modal('show');
        @endif

        let formToSubmit = null;

        $(document).on('submit', 'form[data-confirm]', function (e) {
            e.preventDefault();
            formToSubmit = this;
            $('#confirmModalMessage').text($(this).data('confirm') || 'Apakah Anda yakin?');
            $('#confirmModal').modal('show');
        });

        $('#confirmModalYes').on('click', function () {
            if (formToSubmit) {
                const form = formToSubmit;
                formToSubmit = null;
                $('#confirmModal').modal('hide');
                form.submit();
            }
        });
    });

    function showInfoModal(message, title = 'Informasi') {
        $('#infoModalLabel').html('<i class="fa fa-info-circle mr-1"></i> ' + title);
        $('#infoModalMessage').html(String(message).replace(/\n/g, '<br>'));
        $('#infoModal').modal('show');
    }
</script>
@stack('scripts')
</body>
</html>

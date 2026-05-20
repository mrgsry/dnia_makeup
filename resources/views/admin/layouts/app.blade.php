<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - Dnia Organizer</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayScrollbars@1.13.3/css/OverlayScrollbars.min.css">

    <style>
        :root {
            --dnia-primary: #4a5568;
            --dnia-secondary: #2d3748;
            --dnia-accent: #667eea;
            --dnia-light: #f7fafc;
            --dnia-border: #e2e8f0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        /* Sidebar Modern */
        .main-sidebar {
            background: linear-gradient(180deg, var(--dnia-secondary) 0%, var(--dnia-primary) 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .brand-link {
            background: rgba(255,255,255,0.1);
            color: #fff !important;
            font-weight: 600;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding: 1.2rem 1rem;
        }

        .brand-link:hover {
            background: rgba(255,255,255,0.15);
        }

        .sidebar .nav-link {
            border-radius: 8px;
            margin: 4px 8px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            transform: translateX(4px);
        }

        .sidebar .nav-link.active {
            background: var(--dnia-accent) !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Navbar Modern */
        .main-header {
            border-bottom: 1px solid var(--dnia-border);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        /* Content Wrapper */
        .content-wrapper {
            background: var(--dnia-light);
        }

        /* Cards Modern */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
            transform: translateY(-2px);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid var(--dnia-border);
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
        }

        /* Small Box Modern */
        .small-box {
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .small-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .small-box .icon {
            font-size: 60px;
            opacity: 0.3;
        }

        .bg-primary-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        .bg-success-modern {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
        }

        .bg-info-modern {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important;
        }

        .bg-warning-modern {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%) !important;
        }

        /* Buttons Modern */
        .btn {
            border-radius: 8px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--dnia-accent);
            border: none;
        }

        .btn-primary:hover {
            background: #5a67d8;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
            transform: translateY(-2px);
        }

        /* Table Modern */
        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background: var(--dnia-accent);
            color: #fff;
            font-weight: 600;
            border: none;
        }

        .table-hover tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
        }

        /* User Panel */
        .user-panel {
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        /* Footer */
        .main-footer {
            border-top: 1px solid var(--dnia-border);
            background: #fff;
        }

        /* Breadcrumb */
        .breadcrumb {
            background: transparent;
            padding: 0;
        }

        .breadcrumb-item.active {
            color: var(--dnia-accent);
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
                        <a href="{{ route('admin.payments.index') }}" class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-credit-card"></i>
                            <p>Pembayaran</p>
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

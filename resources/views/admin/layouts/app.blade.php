<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - Dnia Organizer</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=JetBrains+Mono&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayScrollbars@1.13.3/css/OverlayScrollbars.min.css">

    @vite(['resources/css/app.css'])

    <style>
    :root {
        --brand-primary: #9146FF;
        --brand-primary-hover: #A970FF;
        --brand-secondary: #BF94FF;
        --brand-neutral: #ADADB8;
        --brand-bg: #FFFFFF;
        --brand-surface: #F8F9FA;
        --brand-surface-alt: #E9ECEF;
        --brand-surface-modal: #FFFFFF;
        --brand-text-primary: #212529;
        --brand-text-secondary: #6C757D;
        --brand-border: #DEE2E6;
        --brand-success: #00C853;
        --brand-warning: #FFCA28;
        --brand-error: #EB0400;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--brand-bg);
        color: var(--brand-text-primary);
        font-size: 13px;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: 700;
        color: var(--brand-text-primary);
    }

    /* Sidebar Redesign */
    .main-sidebar {
        background-color: #FFFFFF !important;
        border-right: 1px solid var(--brand-border);
        box-shadow: none !important;
    }

    .brand-link {
        background-color: #FFFFFF !important;
        color: var(--brand-text-primary) !important;
        font-weight: 700;
        border-bottom: 1px solid var(--brand-border) !important;
        padding: 13px 16px !important;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sidebar .nav-link {
        border-radius: 4px;
        margin: 2px 8px;
        color: var(--brand-text-primary) !important;
        font-weight: 600;
        font-size: 14px;
        padding: 8px 12px;
        transition: all 0.1s ease;
    }

    .sidebar .nav-link:hover {
        background-color: var(--brand-surface) !important;
    }

    .sidebar .nav-link.active {
        background-color: rgba(145, 70, 255, 0.1) !important;
        color: var(--brand-primary) !important;
        border-left: 2px solid var(--brand-primary);
        border-radius: 0;
        box-shadow: none !important;
    }

    .sidebar .nav-link i {
        color: inherit !important;
        margin-right: 12px;
    }

    /* Navbar Redesign */
    .main-header {
        background-color: #FFFFFF !important;
        border-bottom: 1px solid var(--brand-border) !important;
        height: 50px;
        padding: 0 16px;
    }

    .main-header .nav-link {
        color: var(--brand-text-primary) !important;
        font-weight: 600;
    }

    .main-header .nav-link:hover {
        color: var(--brand-primary) !important;
    }

    /* Content Wrapper */
    .content-wrapper {
        background-color: var(--brand-bg) !important;
    }

    .content-header h1 {
        font-size: 24px;
        letter-spacing: -0.02em;
    }

    /* Cards Redesign */
    .card {
        background-color: #FFFFFF !important;
        border: 1px solid var(--brand-border) !important;
        border-radius: 6px !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
        margin-bottom: 24px;
    }

    .card:hover {
        box-shadow: 0 4px 6px rgba(145, 70, 255, 0.1) !important;
        border-color: var(--brand-primary) !important;
        transform: none !important;
    }

    .card-header {
        background-color: transparent !important;
        border-bottom: 1px solid var(--brand-border) !important;
        padding: 12px 16px !important;
        font-weight: 700;
        color: var(--brand-text-primary) !important;
    }

    /* Small Box Redesign (Dashboard Widgets) */
    .small-box {
        background-color: #FFFFFF !important;
        border: 1px solid var(--brand-border);
        border-radius: 6px !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
        color: var(--brand-text-primary) !important;
    }

    .small-box:hover {
        transform: none !important;
        box-shadow: 0 4px 6px rgba(145, 70, 255, 0.1) !important;
        border-color: var(--brand-primary) !important;
    }

    .small-box .inner p {
        color: var(--brand-text-secondary);
        font-weight: 600;
    }

    .small-box .icon {
        color: var(--brand-primary) !important;
        opacity: 0.15 !important;
    }

    .bg-primary-modern,
    .bg-success-modern,
    .bg-info-modern,
    .bg-warning-modern {
        background: #FFFFFF !important;
    }

    /* Buttons Redesign */
    .btn {
        border-radius: 4px !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        text-transform: uppercase;
        letter-spacing: 0.02em;
        transition: all 0.1s ease !important;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 16px !important;
    }

    .btn-primary {
        background-color: var(--brand-primary) !important;
        border: none !important;
        color: #fff !important;
    }

    .btn-primary:hover {
        background-color: var(--brand-primary-hover) !important;
        transform: none !important;
        box-shadow: 0 2px 4px rgba(145, 70, 255, 0.2) !important;
    }

    .btn-outline-primary {
        border: 1px solid var(--brand-primary) !important;
        color: var(--brand-primary) !important;
        background: transparent !important;
    }

    .btn-outline-primary:hover {
        background-color: rgba(145, 70, 255, 0.05) !important;
        color: var(--brand-primary-hover) !important;
    }

    /* Table Redesign */
    .table {
        color: var(--brand-text-primary) !important;
        background-color: transparent !important;
    }

    .table thead th {
        background-color: var(--brand-surface) !important;
        color: var(--brand-text-secondary) !important;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.05em;
        border-bottom: 2px solid var(--brand-border) !important;
        padding: 12px 16px !important;
    }

    .table td {
        border-bottom: 1px solid var(--brand-border) !important;
        padding: 12px 16px !important;
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(145, 70, 255, 0.02) !important;
    }

    /* Forms Redesign */
    .form-control {
        background-color: #FFFFFF !important;
        border: 1px solid var(--brand-border) !important;
        border-radius: 4px !important;
        color: var(--brand-text-primary) !important;
        font-size: 13px !important;
        padding: 8px 10px !important;
    }

    .form-control:focus {
        border-color: var(--brand-primary) !important;
        box-shadow: 0 0 0 2px rgba(145, 70, 255, 0.1) !important;
    }

    /* Badges Redesign */
    .badge {
        border-radius: 2px !important;
        text-transform: uppercase;
        font-weight: 700 !important;
        font-size: 10px !important;
        padding: 4px 8px !important;
    }

    .badge-primary {
        background-color: var(--brand-primary) !important;
    }

    .badge-success {
        background-color: var(--brand-success) !important;
    }

    .badge-warning {
        background-color: var(--brand-warning) !important;
        color: #000 !important;
    }

    .badge-danger {
        background-color: var(--brand-error) !important;
    }

    /* User Panel */
    .user-panel {
        border-bottom: 1px solid var(--brand-border) !important;
    }

    .user-panel .info a {
        color: var(--brand-text-primary) !important;
        font-weight: 600;
    }

    .user-panel .image i {
        color: var(--brand-primary) !important;
    }

    /* Footer */
    .main-footer {
        background-color: #FFFFFF !important;
        border-top: 1px solid var(--brand-border) !important;
        color: var(--brand-text-secondary) !important;
        font-size: 12px;
    }

    /* Breadcrumb */
    .breadcrumb-item a {
        color: var(--brand-primary) !important;
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: var(--brand-text-secondary) !important;
    }

    /* Modals Redesign */
    .modal-content {
        background-color: #FFFFFF !important;
        border: 1px solid var(--brand-border) !important;
        border-radius: 8px !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .modal-header {
        border-bottom: 1px solid var(--brand-border) !important;
    }

    .modal-footer {
        border-top: 1px solid var(--brand-border) !important;
    }
    </style>

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand">
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
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar">
            <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
                <span class="brand-text">Dnia Organizer</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <i class="fa fa-user-circle fa-2x"></i>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Administrator</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.bookings.index') }}"
                                class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-calendar-check-o"></i>
                                <p>Booking Acara</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.services.index') }}"
                                class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-heart"></i>
                                <p>Layanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.testimonials.index') }}"
                                class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-quote-right"></i>
                                <p>Testimoni</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.terms.index') }}"
                                class="nav-link {{ request()->routeIs('admin.terms.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-list-alt"></i>
                                <p>Syarat & Ketentuan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.packages.index') }}"
                                class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-gift"></i>
                                <p>Paket</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.payments.index') }}"
                                class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-credit-card"></i>
                                <p>Pembayaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.galleries.index') }}"
                                class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
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
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
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

    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmModalLabel"><i class="fa fa-exclamation-triangle mr-1"></i>
                        Konfirmasi</h5>
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

    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel"
        aria-hidden="true">
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
    $(function() {
        @if(session('success'))
        $('#successModal').modal('show');
        @endif

        let formToSubmit = null;

        $(document).on('submit', 'form[data-confirm]', function(e) {
            e.preventDefault();
            formToSubmit = this;
            $('#confirmModalMessage').text($(this).data('confirm') || 'Apakah Anda yakin?');
            $('#confirmModal').modal('show');
        });

        $('#confirmModalYes').on('click', function() {
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
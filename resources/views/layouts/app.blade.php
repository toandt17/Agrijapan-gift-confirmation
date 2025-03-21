<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hệ Thống Voucher') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #006838; /* Màu xanh lá Agrijapan */
            --primary-dark: #00522c;
            --secondary-color: #f8fafc;
            --accent-color: #ED1C24; /* Màu đỏ Agrijapan */
            --success-color: #10b981;
            --danger-color: #ED1C24; /* Màu đỏ Agrijapan */
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --dark-color: #1e293b;
            --light-color: #ffffff;
            --muted-color: #94a3b8;
            --border-color: #e2e8f0;
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
            --border-radius: 0.5rem;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            color: var(--dark-color);
            min-height: 100vh;
            position: relative;
            padding-bottom: 60px;
        }

        .navbar {
            background: var(--primary-color);
            box-shadow: var(--shadow);
            padding: 0.75rem 0;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.25rem;
            letter-spacing: -0.025rem;
        }

        .card {
            border-radius: var(--border-radius);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow);
            background: var(--light-color);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: var(--light-color);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 1.25rem;
            font-weight: 600;
        }

        .btn {
            border-radius: 0.375rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-secondary {
            background-color: #f1f5f9;
            border-color: #e2e8f0;
            color: var(--dark-color);
        }

        .btn-secondary:hover {
            background-color: #e2e8f0;
            border-color: #cbd5e1;
            color: var(--dark-color);
        }

        .btn-success, .bg-success {
            background-color: var(--success-color) !important;
            border-color: var(--success-color) !important;
        }

        .btn-danger, .bg-danger {
            background-color: var(--danger-color) !important;
            border-color: var(--danger-color) !important;
        }

        .btn-warning, .bg-warning {
            background-color: var(--warning-color) !important;
            border-color: var(--warning-color) !important;
        }

        .btn-info, .bg-info {
            background-color: var(--info-color) !important;
            border-color: var(--info-color) !important;
            color: white;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .table {
            --bs-table-hover-bg: rgba(0, 104, 56, 0.02);
            --bs-table-hover-color: inherit;
            border-color: var(--border-color);
        }

        .table th {
            background-color: #f8fafc;
            font-weight: 600;
            color: var(--dark-color);
            font-size: 0.875rem;
            padding: 0.75rem 1rem;
        }

        .table td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
        }

        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 0.25rem;
            font-size: 0.75rem;
        }

        .alert {
            border-radius: var(--border-radius);
            padding: 1rem;
            border: none;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            border-left: 3px solid var(--success-color);
        }

        .alert-danger {
            background-color: rgba(237, 28, 36, 0.1);
            color: var(--danger-color);
            border-left: 3px solid var(--danger-color);
        }

        .form-control {
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--border-color);
            font-size: 0.875rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 104, 56, 0.15);
        }

        .img-thumbnail {
            border-radius: 0.375rem;
            border: 1px solid var(--border-color);
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.5rem 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            border-radius: 0.25rem;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .navbar-nav .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .footer {
            background-color: var(--light-color);
            padding: 1rem 0;
            border-top: 1px solid var(--border-color);
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        /* QR Code Styling */
        .qr-container {
            padding: 0.75rem;
            border-radius: 0.5rem;
            background-color: white;
            border: 1px solid var(--border-color);
            display: inline-block;
        }

        /* Code Display */
        .voucher-code {
            background-color: #f8fafc;
            border-radius: 0.5rem;
            padding: 1rem;
            text-align: center;
            font-weight: 600;
            letter-spacing: 0.05em;
            font-size: 1.25rem;
            border: 1px solid var(--border-color);
            color: var(--primary-color);
        }

        /* Agrijapan Color Theme */
        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
        }

        .text-primary {
            color: var(--primary-color) !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="https://agrijapanvn.com/">
                <div class="d-flex align-items-center">
                    <div class="bg-white rounded p-1 me-2">
                        <img src="{{ asset('build/assets/logo.png') }}" alt="Agrijapan Logo" width="40" height="40" class="d-inline-block">
                    </div>
                    <span>{{ config('app.name', 'Hệ Thống Voucher') }}</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.vouchers.*') ? 'active' : '' }}" href="{{ route('admin.vouchers.index') }}">
                            <i class="bi bi-card-list me-1"></i> Quản lý Voucher
                        </a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('voucher.verify') ? 'active' : '' }}" href="{{ route('voucher.verify') }}">
                            <i class="bi bi-qr-code-scan me-1"></i> Xác minh Voucher
                        </a>
                    </li>

                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Đăng nhập
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                                @if(Auth::user()->role === 'admin')
                                    <span class="badge bg-danger ms-1">Admin</span>
                                @else
                                    <span class="badge bg-info ms-1">Agent</span>
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-1"></i> Đăng xuất
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer text-center text-muted">
        <div class="container">
            <span>© {{ date('Y') }} Hệ Thống Quản Lý Voucher - Agrijapan</span>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Barokah Mart</title>
    
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.8rem 2rem;
        }
        .nav-link-custom {
            color: #4a5568;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .nav-link-custom:hover, .nav-link-custom.active {
            color: #2563eb;
            background-color: #eff6ff;
        }
        .dropdown-menu {
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>

    <!-- Header Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom mb-4 shadow-sm">
        <div class="container-fluid">
            
            <div class="collapse navbar-collapse d-flex justify-content-between align-items-center">
                <!-- Menu Kiri -->
                <ul class="navbar-nav d-flex align-items-center gap-2 mb-0">
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                           href="{{ route('dashboard') }}">Dashboard</a>
                    </li>

                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link-custom {{ request()->routeIs('categories.*') ? 'active' : '' }}" 
                               href="{{ route('categories.index') }}">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-custom {{ request()->routeIs('products.*') ? 'active' : '' }}" 
                               href="{{ route('products.index') }}">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-custom {{ request()->routeIs('report.*') ? 'active' : '' }}" 
                               href="{{ route('report.sales') }}">Laporan</a>
                        </li>
                    @endif

                    <!-- Menu Dropdown Transaksi (Admin & Kasir) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link-custom dropdown-toggle {{ request()->routeIs('pos.*') ? 'active' : '' }}" 
                           href="#" id="navbarDropdownPOS" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Transaksi
                        </a>
                        <ul class="dropdown-menu shadow-sm border-0" aria-labelledby="navbarDropdownPOS">
                            <li>
                                <a class="dropdown-item py-2 {{ request()->routeIs('pos.index') ? 'active' : '' }}" 
                                   href="{{ route('pos.index') }}">
                                    🛒 Layar Kasir (POS)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 {{ request()->routeIs('pos.history') ? 'active' : '' }}" 
                                   href="{{ route('pos.history') }}">
                                    📜 Riwayat Transaksi
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Bagian Kanan: User Login & Logout -->
                <div class="d-flex align-items-center gap-3">
                    <span class="fw-semibold text-secondary">
                        {{ auth()->user()->name ?? 'Admin Toko' }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline mb-0">
                        @csrf
                        <button type="submit" class="btn btn-link text-decoration-none text-danger p-0 fw-semibold">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </nav>

    <!-- Konten Halaman -->
    <main>
        @yield('content')
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
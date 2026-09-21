<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - POS Barokah Mart</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header/Navbar Navigation -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard POS Barokah Mart
            </h2>
            
            <!-- Area Menu Kanan -->
            <div class="flex items-center space-x-4">
                
                <!-- Menu Riwayat Transaksi Saya (Khusus Kasir) -->
                @auth
                    @if(auth()->user()->role === 'kasir')
                        <a href="{{ route('pos.history') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                            Riwayat Transaksi Saya
                        </a>
                    @endif
                @endauth

                <!-- Form Tombol Logout -->
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Ringkasan Card -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Ringkasan Hari Ini</h3>
                <p class="text-gray-600 mb-4">
                    Selamat datang, <strong class="text-gray-900">{{ auth()->user()->name ?? 'User' }}</strong>
                    <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2.5 py-0.5 rounded ml-2">
                        Role: {{ auth()->user()->role ?? 'Guest' }}
                    </span>
                </p>
                
                <!-- Contoh penggunaan komponen x-badge -->
<div class="mt-6 p-4 bg-gray-50 border rounded-md">
    <div class="flex space-x-3">
        <x-badge status="Aman" />
        <x-badge status="Menipis" />
        <x-badge status="Habis" />
    </div>
</div>>
            </div>
        </div>
    </main>
</body>
</html>
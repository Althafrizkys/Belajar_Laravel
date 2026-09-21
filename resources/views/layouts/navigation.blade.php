<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Menu Kiri -->
            <div class="flex space-x-8 items-center">
                <a href="{{ route('dashboard') }}" class="font-bold text-gray-800 text-lg">
                    POS Barokah Mart
                </a>
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                    Dashboard
                </a>
                <a href="{{ route('badge') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                    Komponen Badge
                </a>

                <!-- Menu khusus Kasir  -->
                @if (auth()->user()->role === 'kasir')
                    <a href="{{ route('pos.history') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                        Riwayat Transaksi Saya
                    </a>
                @endif
            </div>

            <!-- Menu Kanan (User & Logout POST) -->
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600 font-medium">
                    {{ auth()->user()->name }}
                </span>

                <!-- Form Logout POST -->
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="text-sm text-gray-500 hover:text-red-600 font-medium">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
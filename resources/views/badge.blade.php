<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Komponen Badge</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-card>
                <h3 class="text-lg font-semibold mb-4">Semua Varian Status</h3>
                <div class="flex gap-3">
                    <x-badge status="Aman" />
                    <x-badge status="Menipis" />
                    <x-badge status="Habis" />
                </div>
            </x-card>

            <x-card>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Tabel Produk</h3>

                    <!-- Tombol Akses CRUD Khusus Role Admin -->
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <div class="flex gap-2">
                                <a href="{{ route('categories.index') }}" class="bg-gray-800 hover:bg-gray-700 text-white text-xs font-semibold px-3 py-2 rounded-md transition">
                                    + Kelola Kategori
                                </a>
                                <a href="{{ route('products.index') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold px-3 py-2 rounded-md transition">
                                    + Kelola Produk
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>

                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Kode</th>
                            <th class="py-2">Produk</th>
                            <th class="py-2">Kategori</th>
                            <th class="py-2">Harga</th>
                            <th class="py-2">Stok</th>
                            <th class="py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-b">
                                <td class="py-2 font-mono text-xs">{{ $product->code }}</td>
                                <td class="py-2 font-medium">{{ $product->name }}</td>
                                <td class="py-2 text-gray-600">{{ $product->category->name ?? '-' }}</td>
                                <!-- Menggunakan Accessor formatted_price yang dibuat di Model Product -->
                                <td class="py-2">{{ $product->formatted_price }}</td>
                                <td class="py-2">{{ $product->stock }}</td>
                                <td class="py-2">
                                    <x-badge :status="$product->stock <= 0 ? 'Habis' : ($product->stock < 10 ? 'Menipis' : 'Aman')" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">
                                    Belum ada data produk di database.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </x-card>
        </div>
    </div>
</x-app-layout>
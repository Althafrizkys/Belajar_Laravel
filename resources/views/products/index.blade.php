<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Produk</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Semua Produk</h3>
                    <a href="{{ route('products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-3 py-2 rounded-md transition">
                        + Tambah Produk
                    </a>
                </div>

                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="py-2 px-3">Kode</th>
                            <th class="py-2 px-3">Nama Produk</th>
                            <th class="py-2 px-3">Kategori</th>
                            <th class="py-2 px-3">Harga</th>
                            <th class="py-2 px-3">Stok</th>
                            <th class="py-2 px-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-3 font-mono text-xs">{{ $product->code }}</td>
                                <td class="py-2 px-3 font-medium">{{ $product->name }}</td>
                                <td class="py-2 px-3 text-gray-600">{{ $product->category->name ?? '-' }}</td>
                                <td class="py-2 px-3">{{ $product->formatted_price }}</td>
                                <td class="py-2 px-3">{{ $product->stock }}</td>
                                <td class="py-2 px-3 flex gap-2">
                                    <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">Belum ada data produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Kategori</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Pesan Notifikasi Flash Data -->
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <x-card>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Master Data Kategori</h3>
                    <a href="{{ route('categories.create') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold px-3 py-2 rounded-md transition">
                        + Tambah Kategori
                    </a>
                </div>

                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="py-2 px-3">No</th>
                            <th class="py-2 px-3">Nama Kategori</th>
                            <th class="py-2 px-3">Deskripsi</th>
                            <th class="py-2 px-3">Dibuat Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $index => $category)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-3">{{ $categories->firstItem() + $index }}</td>
                                <td class="py-2 px-3 font-medium">{{ $category->name }}</td>
                                <td class="py-2 px-3 text-gray-600">{{ $category->description ?? '-' }}</td>
                                <td class="py-2 px-3 text-xs text-gray-500">{{ $category->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-500">Belum ada data kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
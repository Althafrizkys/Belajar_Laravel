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
                <h3 class="text-lg font-semibold mb-4">Tabel Produk</h3>
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Produk</th>
                            <th class="py-2">Stok</th>
                            <th class="py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $dummyProducts = [
                                ['name' => 'Indomie Goreng', 'stock' => 50],
                                ['name' => 'Beras 5kg', 'stock' => 7],
                                ['name' => 'Minyak Goreng 1L', 'stock' => 0],
                            ];
                        @endphp

                        @foreach ($dummyProducts as $product)
                            <tr class="border-b">
                                <td class="py-2">{{ $product['name'] }}</td>
                                <td class="py-2">{{ $product['stock'] }}</td>
                                <td class="py-2">
                                    <x-badge :status="$product['stock'] <= 0 ? 'Habis' : ($product['stock'] < 10 ? 'Menipis' : 'Aman')" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-card>
        </div>
    </div>
</x-app-layout>
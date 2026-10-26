@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Card Ringkasan Utama -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
        <h4 class="fw-bold mb-1">Ringkasan Hari Ini</h4>
        <p class="text-muted mb-3">
            Selamat datang, <strong class="text-dark">{{ auth()->user()->name }}</strong> 
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle ms-1 rounded-pill px-3">
                Role: {{ auth()->user()->role }}
            </span>
        </p>

        <!-- Kartu Statistik -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="p-3 border rounded-3 bg-light">
                    <span class="badge bg-success rounded-pill px-3 py-2 mb-2">Aman</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $stokAman }}</h3>
                    <small class="text-muted">Produk stok > 5</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 border rounded-3 bg-light">
                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2 mb-2">Menipis</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $stokMenipis }}</h3>
                    <small class="text-muted">Produk stok 1 - 5</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 border rounded-3 bg-light">
                    <span class="badge bg-danger rounded-pill px-3 py-2 mb-2">Habis</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $stokHabis }}</h3>
                    <small class="text-muted">Produk stok 0</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 border rounded-3 bg-light">
                    <span class="badge bg-info text-dark rounded-pill px-3 py-2 mb-2">Total Produk</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totalProduk }}</h3>
                    <small class="text-muted">Keseluruhan item</small>
                </div>
            </div>
        </div>

        <!-- Tabel Peringatan Produk Perlu Restock -->
        <div class="pt-2">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-danger mb-0">⚠️ Perhatian: Produk Perlu Restock</h5>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('products.index', ['stock_status' => 'menipis']) }}" class="btn btn-sm btn-outline-primary">
                        Kelola di Data Produk &rarr;
                    </a>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 border">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Sisa Stok</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produkPeringatan as $product)
                            <tr>
                                <td><code>{{ $product->code }}</code></td>
                                <td class="fw-semibold">{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td class="fw-bold">{{ $product->stock }} {{ $product->unit }}</td>
                                <td>
                                    @if ($product->stock <= 0)
                                        <span class="badge bg-danger">Habis</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Menipis</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-3 text-success fw-semibold">
                                    🎉 Semua stok produk saat ini dalam kondisi aman (> 5).
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
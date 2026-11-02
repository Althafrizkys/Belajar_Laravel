@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <!-- Header & Informasi Utama -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold mb-1">{{ $product->name }}</h3>
                <p class="text-muted mb-0">
                    <code>{{ $product->code }}</code> &middot; 
                    <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                        {{ $product->category->name ?? 'Tanpa Kategori' }}
                    </span>
                </p>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali ke Daftar</a>
        </div>

        <hr class="my-3">

        <!-- Grid Cards Ringkasan Stat Produk -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="bg-light rounded-3 p-3 text-center border">
                    <small class="text-muted d-block mb-1">Harga Jual</small>
                    <h5 class="fw-bold text-dark mb-0">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-light rounded-3 p-3 text-center border">
                    <small class="text-muted d-block mb-1">Stok Saat Ini</small>
                    <h5 class="fw-bold text-dark mb-0">{{ $product->stock }} {{ $product->unit }}</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-light rounded-3 p-3 text-center border">
                    <small class="text-muted d-block mb-1">Total Terjual</small>
                    <h5 class="fw-bold text-primary mb-0">{{ $totalTerjual }} {{ $product->unit }}</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-light rounded-3 p-3 text-center border">
                    <small class="text-muted d-block mb-1">Gambar Produk</small>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" height="40" class="img-thumbnail">
                    @else
                        <small class="text-muted">Tidak ada gambar</small>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tabel Riwayat Penjualan Terakhir -->
        <h5 class="fw-bold mb-3">Riwayat Penjualan Terakhir (10 Transaksi)</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 border">
                <thead class="table-light">
                    <tr>
                        <th>No. Invoice</th>
                        <th>Tanggal Transaksi</th>
                        <th class="text-end">Qty Terjual</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayat as $item)
                        <tr>
                            <td><code>{{ $item->transaction->invoice_number ?? '-' }}</code></td>
                            <td>{{ $item->transaction->created_at ? $item->transaction->created_at->format('d M Y H:i') : '-' }}</td>
                            <td class="text-end fw-semibold">{{ $item->qty }} {{ $product->unit }}</td>
                            <td class="text-end fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <em>Belum ada transaksi penjualan untuk produk ini.</em>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
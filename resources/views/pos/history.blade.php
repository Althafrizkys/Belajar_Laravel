@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <!-- Header Judul & Tombol + Transaksi Baru -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Riwayat Transaksi Penjualan</h4>
            <a href="{{ route('pos.index') }}" class="btn btn-primary fw-semibold px-3 py-2">
                + Transaksi Baru
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No. Invoice</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th class="text-end">Total Belanja</th>
                        <th class="text-end">Bayar</th>
                        <th class="text-end">Kembalian</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $trx)
                        <tr>
                            <td><code>{{ $trx->invoice_number }}</code></td>
                            <td>{{ $trx->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $trx->user->name ?? '-' }}</td>
                            <td class="text-end fw-bold">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($trx->pay, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($trx->change, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('pos.struk', $trx) }}" class="btn btn-sm btn-outline-primary">Struk</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-3 text-muted">Belum ada riwayat transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection
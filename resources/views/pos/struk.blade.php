@extends('layouts.app')

@section('content')
<style>
    @media print {
        /* Sembunyikan Navbar, Tombol, dan Elemen Luar saat dicetak */
        nav, .no-print, header {
            display: none !important;
        }
        body {
            background-color: white !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-center">
                <h4 class="fw-bold mb-1">POS Barokah Mart</h4>
                <p class="text-muted small mb-2">{{ $transaction->invoice_number }}</p>
                <p class="text-muted small mb-3">
                    {{ $transaction->created_at->format('d M Y H:i') }} &middot; Kasir: <strong>{{ $transaction->user->name }}</strong>
                </p>

                <hr class="my-2">

                <div class="text-start mb-3">
                    @foreach ($transaction->details as $detail)
                        <div class="d-flex justify-content-between text-sm py-1">
                            <span>{{ $detail->product->name }} x{{ $detail->qty }}</span>
                            <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <hr class="my-2">

                <div class="d-flex justify-content-between fw-bold fs-5 mb-1">
                    <span>Total</span>
                    <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between text-secondary mb-1">
                    <span>Bayar</span>
                    <span>Rp {{ number_format($transaction->pay, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between text-secondary mb-3">
                    <span>Kembali</span>
                    <span>Rp {{ number_format($transaction->change, 0, ',', '.') }}</span>
                </div>

                <!-- Tombol Aksi (Tidak Ikut Ter-print) -->
                <div class="d-grid gap-2 no-print">
                    <button onclick="window.print()" class="btn btn-success fw-bold">
                        🖨️ Cetak Struk
                    </button>
                    <a href="{{ route('pos.index') }}" class="btn btn-primary fw-bold">
                        + Transaksi Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
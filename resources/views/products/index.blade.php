@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Master Produk</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form Search & Filter (Pertemuan 10 + Latihan Opsional) -->
    <form method="GET" action="{{ route('products.index') }}" class="row g-2 mb-4">
        <div class="col-md-3">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama atau kode produk..." class="form-control">
        </div>

        <div class="col-md-3">
            <select name="category_id" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filter Status Stok (Latihan Pertemuan 10) -->
        <div class="col-md-2">
            <select name="stock_status" class="form-select">
                <option value="">Semua Stok</option>
                <option value="menipis" @selected(request('stock_status') == 'menipis')>Stok Menipis (<=5)</option>
                <option value="habis" @selected(request('stock_status') == 'habis')>Stok Habis (0)</option>
            </select>
        </div>

        <!-- Dynamic Pagination Per Page (Latihan Pertemuan 10) -->
        <div class="col-md-2">
            <select name="per_page" class="form-select" onchange="this.form.submit()">
                <option value="10" @selected(request('per_page') == '10')>10 per Halaman</option>
                <option value="25" @selected(request('per_page') == '25')>25 per Halaman</option>
                <option value="50" @selected(request('per_page') == '50')>50 per Halaman</option>
            </select>
        </div>

        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-indigo text-white bg-primary">Cari</button>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    <!-- Tabel Produk -->
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Gambar</th>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50" class="img-thumbnail">
                        @else
                            <span class="badge bg-secondary">Tidak ada</span>
                        @endif
                    </td>
                    <td><code>{{ $product->code }}</code></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'Tanpa Kategori' }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        @if ($product->stock <= 0)
                            <span class="badge bg-danger">Habis (0)</span>
                        @elseif ($product->stock <= 5)
                            <span class="badge bg-warning text-dark">{{ $product->stock }} (Menipis)</span>
                        @else
                            <span class="badge bg-success">{{ $product->stock }}</span>
                        @endif
                    </td>
                    <td>{{ $product->unit }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->name }}?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Data produk tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Navigasi -->
    <div class="d-flex justify-content-end">
        {{ $products->links() }}
    </div>
</div>
@endsection
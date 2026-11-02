@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-3" x-data="posCart({{ $products->toJson() }})">
    <div class="row g-3">
        
        <!-- Alert Error / Stok Kurang -->
        <div class="col-12" x-show="errorMessage || '{{ session('error') }}'">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        <!-- Kolom Kiri: Cari & Daftar Produk -->
        <div class="col-md-7 col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Pilih Produk</h5>
                    <input type="text" x-model="keyword" placeholder="Cari nama atau kode produk..." class="form-control w-50">
                </div>

                <div class="row g-2 overflow-y-auto" style="max-height: 520px;">
                    <template x-for="product in filteredProducts()" :key="product.id">
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <button type="button" @click="addItem(product)" 
                                    class="card h-100 w-100 text-start border rounded-3 p-3 bg-light hover-shadow btn text-dark">
                                <span class="fw-bold text-truncate d-block" x-text="product.name"></span>
                                <small class="text-muted d-block" x-text="'Kode: ' + product.code"></small>
                                <small class="text-muted d-block mb-2" x-text="'Stok: ' + product.stock + ' ' + product.unit"></small>
                                <span class="fw-bold text-primary" x-text="formatRupiah(product.price)"></span>
                            </button>
                        </div>
                    </template>
                    
                    <div x-show="filteredProducts().length === 0" class="text-center py-5 text-muted col-12">
                        Produk tidak ditemukan atau stok habis.
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Keranjang Belanja & Pembayaran -->
        <div class="col-md-5 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <h5 class="fw-bold mb-3">Keranjang Belanja</h5>

                <form action="{{ route('pos.store') }}" method="POST">
                    @csrf
                    
                    <!-- Item List -->
                    <div class="overflow-y-auto mb-3" style="max-height: 280px;">
                        <template x-for="(item, index) in cart" :key="item.id">
                            <div class="d-flex align-items-center justify-content-between p-2 mb-2 bg-light rounded-3 border">
                                <div class="me-2 flex-grow-1">
                                    <span class="fw-semibold d-block text-truncate style-name" x-text="item.name"></span>
                                    <small class="text-muted" x-text="formatRupiah(item.price)"></small>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <input type="number" min="1" :max="item.stock" x-model.number="item.qty" @input="clampQty(item)" 
                                           class="form-control form-control-sm text-center" style="width: 60px;">
                                    <button type="button" @click="removeItem(index)" class="btn btn-sm btn-outline-danger border-0">&times;</button>
                                </div>

                                <!-- Input Hidden untuk Kirim Array ke Controller -->
                                <input type="hidden" :name="'items[' + index + '][product_id]'" :value="item.id">
                                <input type="hidden" :name="'items[' + index + '][qty]'" :value="item.qty">
                            </div>
                        </template>

                        <div x-show="cart.length === 0" class="text-center py-4 text-muted border border-dashed rounded-3">
                            Keranjang kosong
                        </div>
                    </div>

                    <!-- Total & Bayar -->
                    <div class="border-top pt-3 space-y-2">
                        <div class="d-flex justify-content-between fw-bold fs-5 mb-2">
                            <span>Total</span>
                            <span class="text-primary" x-text="formatRupiah(total())"></span>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold small mb-1">Nominal Bayar (Rp)</label>
                            <input type="number" name="pay" x-model.number="pay" min="0" placeholder="0" class="form-control form-control-lg fw-bold">
                        </div>

                        <div class="d-flex justify-content-between fw-semibold text-secondary mb-3">
                            <span>Kembalian</span>
                            <span x-text="formatRupiah(change())"></span>
                        </div>
                    </div>

                    <button type="submit" :disabled="cart.length === 0 || pay < total()" class="btn btn-primary btn-lg w-100 fw-bold">
                        Simpan Transaksi
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function posCart(products) {
        return {
            products: products,
            cart: [],
            keyword: '',
            pay: 0,
            filteredProducts() {
                if (!this.keyword) return this.products;
                const k = this.keyword.toLowerCase();
                return this.products.filter(p =>
                    p.name.toLowerCase().includes(k) || p.code.toLowerCase().includes(k)
                );
            },
            addItem(product) {
                const existing = this.cart.find(i => i.id === product.id);
                if (existing) {
                    if (existing.qty < product.stock) existing.qty++;
                    return;
                }
                this.cart.push({ ...product, qty: 1 });
            },
            clampQty(item) {
                if (item.qty < 1 || isNaN(item.qty)) item.qty = 1;
                if (item.qty > item.stock) item.qty = item.stock;
            },
            removeItem(index) {
                this.cart.splice(index, 1);
            },
            total() {
                return this.cart.reduce((sum, i) => sum + (i.price * i.qty), 0);
            },
            change() {
                return Math.max(this.pay - this.total(), 0);
            },
            formatRupiah(value) {
                return 'Rp ' + Number(value || 0).toLocaleString('id-ID');
            }
        }
    }
</script>
@endsection
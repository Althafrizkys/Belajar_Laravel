<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk dengan Search, Filter Kategori, Filter Stok, dan Custom Pagination.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Fitur 1: Pencarian berdasarkan Nama atau Kode Produk (Praktikum 10)
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('code', 'like', "%{$keyword}%");
            });
        }

        // Fitur 2: Filter Kategori (Praktikum 10)
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Fitur Latihan Opsional Pertemuan 10: Filter Status Stok (Semua / Menipis / Habis)
        if ($request->filled('stock_status')) {
            if ($request->stock_status === 'menipis') {
                $query->where('stock', '>', 0)->where('stock', '<=', 5);
            } elseif ($request->stock_status === 'habis') {
                $query->where('stock', '<=', 0);
            }
        }

        // Fitur Latihan Opsional Pertemuan 10: Dynamic Items Per Page (10/25/50)
        $perPage = $request->input('per_page', 10);

        // Pagination dengan membawa seluruh query string di URL
        $products = $query->latest()->paginate($perPage)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        if (!$request->filled('code')) {
            $validated['code'] = 'PRD-' . time();
        }
        $validated['unit'] = $validated['unit'] ?? 'pcs';

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        // Catatan: Jika pakai SoftDelete, gambar jangan dihapus dulu dari storage agar tetap ada saat di-restore.
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
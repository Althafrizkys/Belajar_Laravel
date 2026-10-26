<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung angka ringkasan
        $stokAman = Product::where('stock', '>', 5)->count();
        $stokMenipis = Product::where('stock', '>', 0)->where('stock', '<=', 5)->count();
        $stokHabis = Product::where('stock', '<=', 0)->count();
        $totalProduk = Product::count();

        // Mengambil daftar produk yang stoknya menipis (1-5) atau habis (0)
        $produkPeringatan = Product::with('category')
            ->where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->get();

        return view('dashboard', compact(
            'stokAman', 
            'stokMenipis', 
            'stokHabis', 
            'totalProduk',
            'produkPeringatan'
        ));
    }
}
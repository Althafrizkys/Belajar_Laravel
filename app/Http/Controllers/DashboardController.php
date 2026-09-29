<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil produk dari database MySQL
        $products = Product::all(); 
        
        return view('dashboard', compact('products'));
    }
}
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return '<h1>Profil Toko</h1><p>Selamat datang di POS App. Kami menyediakan sistem kasir dan inventaris cepat, akurat, dan terpercaya untuk bisnis Anda.</p>';
});
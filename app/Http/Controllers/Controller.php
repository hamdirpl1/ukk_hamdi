<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;

class Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        $produks = Produk::with('toko', 'gambar')->get();
        return view('beranda.index', compact('kategoris', 'produks'));
    }
}

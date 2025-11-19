<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;

class Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        $produks = Produk::with('toko', 'gambar')->get();
        return view('beranda.index', compact('kategoris', 'produks'));
    }

    public function produk(Request $request)
    {
        $sort = $request->get('sort');

        $produks = Produk::with(['gambar', 'toko']);

        // Sorting berdasarkan dropdown
        if ($sort == 'terbaru') {
            $produks = $produks->orderBy('created_at', 'DESC');
        }
        elseif ($sort == 'termurah') {
            $produks = $produks->orderBy('harga', 'ASC');
        }
        elseif ($sort == 'termahal') {
            $produks = $produks->orderBy('harga', 'DESC');
        }
        elseif ($sort == 'terlaris') {
            $produks = $produks->orderBy('jumlah_terjual', 'DESC'); // sesuaikan kolommu
        }

        $produks = $produks->get();

        return view('beranda.produk', compact('produks'));
    }

    public function toko()
    {
        $tokos = Toko::with(['produk.gambar'])->get();

        return view('beranda.toko', compact('tokos'));
    }
}

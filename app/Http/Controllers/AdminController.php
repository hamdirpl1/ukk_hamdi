<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Toko;
use App\Models\Kategori;
use App\Models\Produk;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalTokos = Toko::count();
        $totalKategoris = Kategori::count();
        $totalProduks = Produk::count();

        $recentUsers = User::latest()->take(5)->get();
        $recentTokos = Toko::with('user')->latest()->take(5)->get();
        $recentProduks = Produk::with(['kategori', 'toko'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTokos',
            'totalKategoris',
            'totalProduks',
            'recentUsers',
            'recentTokos',
            'recentProduks'
        ));
    }
}

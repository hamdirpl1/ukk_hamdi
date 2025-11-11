<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Toko;
use App\Models\Produk;

class MemberController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $toko = $user->toko()->first();
        $totalProduks = $toko ? $toko->produk()->count() : 0;
        $recentProduks = $toko ? $toko->produk()->with('kategori')->latest()->take(5)->get() : collect();

        return view('member.dashboard', compact('toko', 'totalProduks', 'recentProduks'));
    }
}

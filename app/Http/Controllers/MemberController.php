<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Toko;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Produk;

class MemberController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalTokos = Toko::count();
        $totalKategoris = Kategori::count();
        $totalProduks = Produk::count();

        $recentTokos = Toko::with('user')->latest()->take(5)->get();
        $recentProduks = Produk::with(['kategori', 'toko'])->latest()->take(5)->get();

        return view('member.dashboard', compact(
            'totalUsers',
            'totalTokos',
            'totalKategoris',
            'totalProduks',
            'recentTokos',
            'recentProduks'
        ));
    }

    public function tokoView()
    {
        $user = Auth::user();
        $toko = $user->toko()->first(); // Ambil toko pertama (karena satu toko per user)

        $stats = [
            'totalProduk' => $toko ? $toko->produk()->count() : 0,
            'dilihat' => 0, // Placeholder, belum ada field
            'pesanan' => 0, // Placeholder, belum ada field
            'rating' => 0.0, // Placeholder, belum ada field
        ];

        return view('member.toko.index', compact('toko', 'stats'));
    }

    public function storeToko(Request $request)
    {
        $user = Auth::user();

        // Cek apakah user sudah punya toko
        if ($user->toko()->exists()) {
            return redirect()->route('member.toko.index')->with('error', 'Anda sudah memiliki toko.');
        }

        $request->validate([
            'nama_toko' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'kontak_toko' => 'required|string|max:13',
            'alamat' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('toko', 'public');
        }

        Toko::create([
            'nama_toko' => $request->nama_toko,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
            'id_user' => $user->id_user,
            'kontak_toko' => $request->kontak_toko,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('member.toko.index')->with('success', 'Toko berhasil dibuat.');
    }

    public function updateToko(Request $request)
    {
        $user = Auth::user();
        $toko = $user->toko()->first();

        if (!$toko) {
            return redirect()->route('member.toko.index')->with('error', 'Toko tidak ditemukan.');
        }

        $request->validate([
            'nama_toko' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'kontak_toko' => 'required|string|max:13',
            'alamat' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPath = $toko->gambar; // Tetap gunakan gambar lama jika tidak ada upload baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($toko->gambar && Storage::disk('public')->exists($toko->gambar)) {
                Storage::disk('public')->delete($toko->gambar);
            }
            $gambarPath = $request->file('gambar')->store('toko', 'public');
        }

        $toko->update([
            'nama_toko' => $request->nama_toko,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
            'kontak_toko' => $request->kontak_toko,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('member.toko.index')->with('success', 'Toko berhasil diperbarui.');
    }

}

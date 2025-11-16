<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Toko;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\GambarProduk;

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

    //produk
    public function produkView()
    {
        $user = Auth::user();
        $toko = $user->toko()->first();
        if (!$toko) {
            return redirect()->route('member.toko.index')->with('error', 'Anda harus membuat toko terlebih dahulu.');
        }
        $produks = Produk::where('id_toko', $toko->id_toko)->with('kategori')->get();
        return view('member.produk.index', compact('produks'));
    }

    public function createProduk()
    {
        $user = Auth::user();
        $toko = $user->toko()->first();
        if (!$toko) {
            return redirect()->route('member.toko.index')->with('error', 'Anda harus membuat toko terlebih dahulu.');
        }
        $kategoris = Kategori::all();
        return view('member.produk.create', compact('kategoris'));
    }

    public function storeProduk(Request $request)
    {
        $user = Auth::user();
        $toko = $user->toko()->first();
        if (!$toko) {
            return redirect()->route('member.toko.index')->with('error', 'Anda harus membuat toko terlebih dahulu.');
        }

        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
        ]);

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'tanggal_upload' => now()->toDateString(),
            'id_kategori' => $request->id_kategori,
            'id_toko' => $toko->id_toko,
        ]);

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function editProduk(Produk $produk)
    {
        $user = Auth::user();
        $toko = $user->toko()->first();
        if (!$toko || $produk->id_toko !== $toko->id_toko) {
            return redirect()->route('member.produk.index')->with('error', 'Produk tidak ditemukan.');
        }
        $kategoris = Kategori::all();
        return view('member.produk.edit', compact('produk', 'kategoris'));
    }

    public function updateProduk(Request $request, Produk $produk)
    {
        $user = Auth::user();
        $toko = $user->toko()->first();
        if (!$toko || $produk->id_toko !== $toko->id_toko) {
            return redirect()->route('member.produk.index')->with('error', 'Produk tidak ditemukan.');
        }

        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
        ]);

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'id_kategori' => $request->id_kategori,
        ]);

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function deleteProduk(Produk $produk)
    {
        $user = Auth::user();
        $toko = $user->toko()->first();
        if (!$toko || $produk->id_toko !== $toko->id_toko) {
            return redirect()->route('member.produk.index')->with('error', 'Produk tidak ditemukan.');
        }

        $produk->delete();

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil dihapus.');
    }


    //gambar produk
    public function gambarProdukView()
    {
        $user = Auth::user();
        $toko = $user->toko()->first();
        if (!$toko) {
            return redirect()->route('member.toko.index')->with('error', 'Anda harus membuat toko terlebih dahulu.');
        }
        $gambarProduks = GambarProduk::whereHas('produk', function($query) use ($toko) {
            $query->where('id_toko', $toko->id_toko);
        })->with('produk')->get();
        return view('member.gambarproduk.index', compact('gambarProduks'));
    }

    public function createGambarProduk()
    {
        $user = Auth::user();
        $toko = $user->toko()->first();
        if (!$toko) {
            return redirect()->route('member.toko.index')->with('error', 'Anda harus membuat toko terlebih dahulu.');
        }
        $produks = Produk::where('id_toko', $toko->id_toko)->get();
        return view('member.gambarproduk.create', compact('produks'));
    }

    public function storeGambarProduk(Request $request)
    {
        $user = Auth::user();
        $toko = $user->toko()->first();
        if (!$toko) {
            return redirect()->route('member.toko.index')->with('error', 'Anda harus membuat toko terlebih dahulu.');
        }

        $request->validate([
            'id_produk' => 'required|exists:produks,id_produk',
            'nama_gambar' => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Verify produk belongs to user's toko
        $produk = Produk::where('id_produk', $request->id_produk)
                        ->where('id_toko', $toko->id_toko)
                        ->first();
        if (!$produk) {
            return redirect()->route('member.gambarproduk.index')->with('error', 'Produk tidak ditemukan.');
        }

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar_produk', 'public');
        }

        GambarProduk::create([
            'id_produk' => $request->id_produk,
            'nama_gambar' => $request->nama_gambar,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('member.gambarproduk.index')->with('success', 'Gambar produk berhasil ditambahkan.');
    }

    public function editGambarProduk(GambarProduk $gambarProduk)
    {
        $user = Auth::user();
        $toko = $user->toko()->first();
        if (!$toko || !$gambarProduk->produk || $gambarProduk->produk->id_toko !== $toko->id_toko) {
            return redirect()->route('member.gambarproduk.index')->with('error', 'Gambar produk tidak ditemukan.');
        }
        $produks = Produk::where('id_toko', $toko->id_toko)->get();
        return view('member.gambarproduk.edit', compact('gambarProduk', 'produks'));
    }

    public function updateGambarProduk(Request $request, GambarProduk $gambarProduk)
    {
        $user = Auth::user();
        $toko = $user->toko()->first();
        if (!$toko || !$gambarProduk->produk || $gambarProduk->produk->id_toko !== $toko->id_toko) {
            return redirect()->route('member.gambarproduk.index')->with('error', 'Gambar produk tidak ditemukan.');
        }

        $request->validate([
            'id_produk' => 'required|exists:produks,id_produk',
            'nama_gambar' => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Verify produk belongs to user's toko
        $produk = Produk::where('id_produk', $request->id_produk)
                        ->where('id_toko', $toko->id_toko)
                        ->first();
        if (!$produk) {
            return redirect()->route('member.gambarproduk.index')->with('error', 'Produk tidak ditemukan.');
        }

        $gambarPath = $gambarProduk->gambar; // Tetap gunakan gambar lama jika tidak ada upload baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($gambarProduk->gambar && Storage::disk('public')->exists($gambarProduk->gambar)) {
                Storage::disk('public')->delete($gambarProduk->gambar);
            }
            $gambarPath = $request->file('gambar')->store('gambar_produk', 'public');
        }

        $gambarProduk->update([
            'id_produk' => $request->id_produk,
            'nama_gambar' => $request->nama_gambar,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('member.gambarproduk.index')->with('success', 'Gambar produk berhasil diperbarui.');
    }

    public function deleteGambarProduk(GambarProduk $gambarProduk)
    {
        $user = Auth::user();
        $toko = $user->toko()->first();
        if (!$toko || !$gambarProduk->produk || $gambarProduk->produk->id_toko !== $toko->id_toko) {
            return redirect()->route('member.gambarproduk.index')->with('error', 'Gambar produk tidak ditemukan.');
        }

        // Hapus gambar dari storage jika ada
        if ($gambarProduk->gambar && Storage::disk('public')->exists($gambarProduk->gambar)) {
            Storage::disk('public')->delete($gambarProduk->gambar);
        }

        $gambarProduk->delete();

        return redirect()->route('member.gambarproduk.index')->with('success', 'Gambar produk berhasil dihapus.');
    }


}

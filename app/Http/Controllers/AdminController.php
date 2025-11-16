<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Toko;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalTokos = Toko::count();
        $totalKategoris = Kategori::count();
        $totalProduks = Produk::count();

        $recentTokos = Toko::with('user')->latest()->take(5)->get();
        $recentProduks = Produk::with(['kategori', 'toko'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTokos',
            'totalKategoris',
            'totalProduks',
            'recentTokos',
            'recentProduks'
        ));
    }

    // User
    public function userView()
    {
        $users = User::all();
        return view('admin.user.user', compact('users'));
    }

    public function createUser()
    {
        return view('admin.user.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'required|string|max:13',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,member',
        ]);

        User::create([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.user.user')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function editUser(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        // Ambil user berdasarkan primary key kustom (id_user)
        $user = User::where('id_user', $id)->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'required|string|max:13',
            // validasi unique username, abaikan milik user saat ini (pk: id_user)
            'username' => 'required|unique:users,username,' . $user->id_user . ',id_user',
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:admin,member',
        ]);

        $data = [
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'username' => $request->username,
            'role' => $request->role,
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.user')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.user')->with('success', 'Pengguna berhasil dihapus.');
    }

    //toko
    public function tokoView()
    {
        $tokos = Toko::all();
        return view('admin.toko.index', compact('tokos'));
    }

    public function editToko(Toko $toko)
    {
        return view('admin.toko.edit', compact('toko'));
    }

    public function updateToko(Request $request, Toko $toko)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|string|max:100',
            'kontak_toko' => 'required|string|max:13',
            'alamat' => 'nullable|string',
        ]);

        $toko->update($request->only(['nama_toko', 'deskripsi', 'gambar', 'kontak_toko', 'alamat']));

        return redirect()->route('admin.toko.index')->with('success', 'Toko berhasil diperbarui.');
    }

    public function deleteToko(Toko $toko)
    {
        $toko->delete();

        return redirect()->route('admin.toko.index')->with('success', 'Toko berhasil dihapus.');
    }

    //produk
    public function produkView()
    {
        $produks = Produk::with(['kategori', 'toko'])->get();
        return view('admin.produk.index', compact('produks'));
    }

    public function createProduk()
    {
        $kategoris = Kategori::all();
        $tokos = Toko::all();
        return view('admin.produk.create', compact('kategoris', 'tokos'));
    }

    public function storeProduk(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'id_toko' => 'required|exists:tokos,id_toko',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'tanggal_upload' => 'required|date',
        ]);

        Produk::create($request->only(['nama_produk', 'id_kategori', 'id_toko', 'harga', 'stok', 'deskripsi', 'tanggal_upload']));

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function editProduk(Produk $produk)
    {
        $kategoris = Kategori::all();
        $tokos = Toko::all();
        return view('admin.produk.edit', compact('produk', 'kategoris', 'tokos'));
    }

    public function updateProduk(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'id_toko' => 'required|exists:tokos,id_toko',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'tanggal_upload' => 'required|date',
        ]);

        $produk->update($request->only(['nama_produk', 'id_kategori', 'id_toko', 'harga', 'stok', 'deskripsi', 'tanggal_upload']));

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroyProduk(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    // Kategori
    public function kategoriView()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function createKategori()
    {
        return view('admin.kategori.create');
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:50|unique:kategoris,nama_kategori',
        ]);

        Kategori::create($request->only(['nama_kategori']));

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function editKategori(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function updateKategori(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:50|unique:kategoris,nama_kategori,' . $kategori->id_kategori . ',id_kategori',
        ]);

        $kategori->update($request->only(['nama_kategori']));

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function deleteKategori(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

}

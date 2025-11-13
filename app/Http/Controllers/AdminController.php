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

    // public function destroyUser(User $user)
    // {
    //     // Cek jika user mencoba menghapus akun sendiri
    //     if (auth()->id_user() === $user->id_user) {
    //         return redirect()->route('admin.user.user')->with('error', 'Tidak dapat menghapus akun sendiri.');
    //     }

    //     // Cek jika user memiliki toko (jika ada relasi)
    //     if (method_exists($user, 'toko') && $user->toko()->exists()) {
    //         return redirect()->route('admin.user.user')->with('error', 'Tidak dapat menghapus pengguna yang memiliki toko.');
    //     }

    //     $user->delete();

    //     return redirect()->route('admin.user.user')->with('success', 'Pengguna berhasil dihapus.');
    // }
}
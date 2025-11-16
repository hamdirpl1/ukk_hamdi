<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('layouts.beranda');
});

//Register
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'Register'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'storeregis']);
// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/switch', [LoginController::class, 'showSwitch'])->name('switch');
Route::post('/switch', [LoginController::class, 'switch']);
// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // User Routes
    Route::get('/admin/user', [AdminController::class, 'userView'])->name('admin.user.user');
    Route::get('/admin/user/create', [AdminController::class, 'createUser'])->name('admin.user.create');
    Route::post('/admin/user', [AdminController::class, 'storeUser'])->name('admin.user.store');
    Route::get('/admin/user/{user}/edit', [AdminController::class, 'editUser'])->name('admin.user.edit');
    Route::patch('/admin/user/{user}', [AdminController::class, 'updateUser'])->name('admin.user.update');
    Route::delete('/admin/user/{user}', [AdminController::class, 'deleteUser'])->name('admin.user.destroy');

    // Toko Routes
    Route::get('/admin/toko', [AdminController::class, 'tokoView'])->name('admin.toko.index');
    Route::get('/admin/toko/{toko}/edit', [AdminController::class, 'editToko'])->name('admin.toko.edit');
    Route::patch('/admin/toko/{toko}', [AdminController::class, 'updateToko'])->name('admin.toko.update');
    Route::delete('/admin/toko/{toko}', [AdminController::class, 'deleteToko'])->name('admin.toko.destroy');

    // Produk Routes
    Route::get('/admin/produk', [AdminController::class, 'produkView'])->name('admin.produk.index');
    Route::get('/admin/produk/create', [AdminController::class, 'createProduk'])->name('admin.produk.create');
    Route::post('/admin/produk', [AdminController::class, 'storeProduk'])->name('admin.produk.store');
    Route::get('/admin/produk/{produk}/edit', [AdminController::class, 'editProduk'])->name('admin.produk.edit');
    Route::patch('/admin/produk/{produk}', [AdminController::class, 'updateProduk'])->name('admin.produk.update');
    Route::delete('/admin/produk/{produk}', [AdminController::class, 'destroyProduk'])->name('admin.produk.destroy');
    Route::delete('/admin/toko/{toko}', [AdminController::class, 'deleteToko'])->name('admin.toko.destroy');

    // Kategori Routes
    Route::get('/admin/kategori', [AdminController::class, 'kategoriView'])->name('admin.kategori.index');
    Route::get('/admin/kategori/create', [AdminController::class, 'createKategori'])->name('admin.kategori.create');
    Route::post('/admin/kategori', [AdminController::class, 'storeKategori'])->name('admin.kategori.store');
    Route::get('/admin/kategori/{kategori}/edit', [AdminController::class, 'editKategori'])->name('admin.kategori.edit');
    Route::patch('/admin/kategori/{kategori}', [AdminController::class, 'updateKategori'])->name('admin.kategori.update');
    Route::delete('/admin/kategori/{kategori}', [AdminController::class, 'deleteKategori'])->name('admin.kategori.destroy');

    //produk Routes
    Route::get('/admin/produk', [AdminController::class, 'produkView'])->name('admin.produk.index');
});

// Member Routes
Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');

    Route::get('/member/toko', [MemberController::class, 'tokoView'])->name('member.toko.index');
    Route::post('/member/toko', [MemberController::class, 'storeToko'])->name('member.toko.store');
    Route::patch('/member/toko', [MemberController::class, 'updateToko'])->name('member.toko.update');

    //produk Routes
    Route::get('/member/produk', [MemberController::class, 'produkView'])->name('member.produk.index');
    Route::get('/member/produk/create', [MemberController::class, 'createProduk'])->name('member.produk.create');
    Route::post('/member/produk', [MemberController::class, 'storeProduk'])->name('member.produk.store');
    Route::get('/member/produk/{produk}/edit', [MemberController::class, 'editProduk'])->name('member.produk.edit');
    Route::patch('/member/produk/{produk}', [MemberController::class, 'updateProduk'])->name('member.produk.update');
    Route::delete('/member/produk/{produk}', [MemberController::class, 'deleteProduk'])->name('member.produk.destroy');

    //gambar produk Routes
    Route::get('/member/gambarproduk', [MemberController::class, 'gambarProdukView'])->name('member.gambarproduk.index');
    Route::get('/member/gambarproduk/create', [MemberController::class, 'createGambarProduk'])->name('member.gambarproduk.create');
    Route::post('/member/gambarproduk', [MemberController::class, 'storeGambarProduk'])->name('member.gambarproduk.store');
    Route::get('/member/gambarproduk/{gambarProduk}/edit', [MemberController::class, 'editGambarProduk'])->name('member.gambarproduk.edit');
    Route::patch('/member/gambarproduk/{gambarProduk}', [MemberController::class, 'updateGambarProduk'])->name('member.gambarproduk.update');
    Route::delete('/member/gambarproduk/{gambarProduk}', [MemberController::class, 'deleteGambarProduk'])->name('member.gambarproduk.destroy');
});

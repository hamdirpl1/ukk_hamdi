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
    Route::delete('/admin/user/{user}', [AdminController::class, 'destroyUser'])->name('admin.user.destroy');
});

// Member Routes
Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');

    Route::get('/member/toko', [MemberController::class, 'tokoView'])->name('member.toko.index');
    Route::post('/member/toko', [MemberController::class, 'storeToko'])->name('member.toko.store');
    Route::patch('/member/toko', [MemberController::class, 'updateToko'])->name('member.toko.update');
});

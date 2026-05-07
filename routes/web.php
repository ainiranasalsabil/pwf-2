<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Route Public (tanpa login)
|--------------------------------------------------------------------------
*/

// Halaman awal (welcome)
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Route Setelah Login (Auth + Verified)
|--------------------------------------------------------------------------
*/

// Dashboard (hanya user login + email terverifikasi)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Halaman About
Route::get('/about', function () {
    return view('about');
})->middleware(['auth', 'verified'])->name('about');


/*
|--------------------------------------------------------------------------
| Route Profile (User Login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Menampilkan form edit profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update data profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Hapus akun user
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Route PRODUCT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Semua user login boleh akses product
    // Hak akses detail diatur di ProductPolicy (update & delete)
    Route::resource('product', ProductController::class);
});


/*
|--------------------------------------------------------------------------
| Route KATEGORI (KHUSUS ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'can:manage-category'])->group(function () {

    // Hanya admin yang bisa CRUD kategori
    Route::resource('kategoris', KategoriController::class);
});


/*
|--------------------------------------------------------------------------
| Auth Routes (Login, Register, dll)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SiswaController;
use Illuminate\Routing\RouteAction;

// menampilkan tampilan login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// pengecekan role dan proses login
Route::post('/login', [AuthController::class, 'login']);

// logout dari admin dan siswa
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin
Route::prefix('admin')->group(function (){    
    // menampilkan tampilan dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // menampilkan halaman kategori
    Route::resource('/kategori', KategoriController::class);
    
    // menampilkan detail aspirasi berdasarkan id aspirasi
    Route::get('/aspirasi/{id}', [AdminController::class, 'detailAspirasi'])->name('admin.aspirasi.detail');

    // route menambahkan feedback dari admin ke siswa
    Route::post('/aspirasi/{id}/feedback', [AdminController::class, 'addFeedback'])->name('admin.aspirasi.feedback');

    // route menambah update progres [dikirim/proses/selesai]
    Route::post('/aspirasi/{id}/progress', [AdminController::class, 'addProgress'])->name('admin.aspirasi.progress');
});

// Siswa
Route::prefix('siswa')->group(function(){
    // menampilkan tampilan dashboard
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');

    // menampilkan page tambah aspirasi
    Route::get('/aspirasi/create', [SiswaController::class, 'createAspirasi'])->name('siswa.aspirasi.create');

    // store / menyimpan aspirasi
    Route::post('/aspirasi', [SiswaController::class, 'storeAspirasi'])->name('siswa.aspirasi.store');

    // membuka detail aspirasi, feedback dan progress
    Route::get('/aspirasi/{id}', [SiswaController::class, 'detailAspirasi'])->name('siswa.aspirasi.detail');
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\Auth;

Route::get('/penjualan/search', [PenjualanController::class, 'search'])->name('penjualan.search')->middleware('auth');


// Semua route di bawah hanya bisa diakses jika sudah login
Route::middleware(['auth'])->group(function () {

    Route::get('/', [App\Http\Controllers\BerandaController::class, 'index'])->name('beranda');

    Route::resource('produk', ProdukController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('transaksi', PenjualanController::class);
    Route::resource('laporan', DetailPenjualanController::class);
    Route::resource('kasir', UserController::class);
    Route::resource('user', UserController::class);
    
    Route::get('user/{id}/reset-password', [UserController::class, 'resetPassword'])->name('user.reset-password');
    Route::get('/kasir', [UserController::class, 'index'])->name('kasir.index');

    //Route cetak data
    Route::get('/cetakProduk', [ProdukController::class, "cetakProduk"]);
    Route::get('/cetakLaporan', [DetailPenjualanController::class, "cetakLaporan"]);
    
    // Route::get('/penjualan/search', [PenjualanController::class, 'search'])->name('penjualan.search');
    
    Route::post('/penjualan/store', [PenjualanController::class, 'store'])->name('penjualan.store');

    Route::get('/transaksi/{id}/cetak', [PenjualanController::class, 'cetak'])->name('transaksi.cetak');
    Route::get('/transaksi/{id}', [PenjualanController::class, 'show'])->name('transaksi.show');
    
    Route::get('/laporan-transaksi', [DetailPenjualanController::class, 'laporan'])->name('laporan.transaksi');

    Route::get('produk/update-stok/{id}', [ProdukController::class, 'showUpdateStokForm'])->name('produk.update-stok');
    Route::post('produk/update-stok/{id}', [ProdukController::class, 'updateStok'])->name('produk.update-stok-post');
    Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');

    // Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('register', 'register')->name('register');
    Route::get('register', 'registerSave')->name('register.save');
});

Auth::routes();

// Route halaman utama setelah login
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

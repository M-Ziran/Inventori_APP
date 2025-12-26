<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerimaanBarangController;
use App\Http\Controllers\PengeluaranBarangController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'handleLogin'])->name('login')->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::prefix('get-data')->as('get-data.')->group(function(){
        Route::get('/produk', [App\Http\Controllers\ProductController::class, 'getData'])->name('produk');
        Route::get('cek-stok-produk', [App\Http\Controllers\ProductController::class, 'cekStok'])->name('cek-stok');
        Route::get('cek-harga-produk', [App\Http\Controllers\ProductController::class, 'cekHarga'])->name('cek-harga');
    });


    Route::prefix('users')->as('users.')->controller(App\Http\Controllers\UserController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::delete('/{id}/destroy', 'destroy')->name('destroy');
        Route::post('/ganti-password', 'gantiPassword')->name('ganti-password');
        Route::post('/reset-password', 'resetPassword')->name('reset-password');
    });

    Route::prefix('master-data')->as('master-data.')->group(function () {
        Route::prefix('kategori')->as('kategori.')->controller(KategoriController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::delete('/{id}/destroy', 'destroy')->name('destroy');
        });
        Route::prefix('product')->as('product.')->controller(ProductController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::delete('/{id}/destroy', 'destroy')->name('destroy');
        });
    });

    Route::prefix('penerimaan-barang')->as('penerimaan-barang.')->controller(App\Http\Controllers\PenerimaanBarangController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });

        Route::prefix('pengeluaran-barang')->as('pengeluaran-barang.')->controller(App\Http\Controllers\PengeluaranBarangController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });

    Route::prefix('laporan')->as('laporan.')->group(function(){
        Route::prefix('penerimaan-barang')->as('penerimaan-barang.')->controller(PenerimaanBarangController::class)->group(function(){
            Route::get('/laporan', 'laporan')->name('laporan');
            Route::get('/laporan/{nomor_penerimaan}/detail', 'detailLaporan')->name('detail-laporan');
            // Route::get('/cetak', 'cetak')->name('cetak');
        });
        Route::prefix('pengeluaran-barang')->as('pengeluaran-barang.')->controller(PengeluaranBarangController::class)->group(function(){
            Route::get('/laporan', 'laporan')->name('laporan');
            Route::get('/laporan/{nomor_pengeluaran}/detail', 'detailLaporan')->name('detail-laporan');
            // Route::get('/cetak', 'cetak')->name('cetak');
        });
    });
});
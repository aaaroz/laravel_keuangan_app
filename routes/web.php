<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/kategori', [HomeController::class, 'kategori'])->name('kategori');
Route::get('/kategori/tambah', [HomeController::class, 'kategori_tambah'])->name('kategori_tambah');
Route::post('/kategori/aksi', [HomeController::class, 'kategori_aksi'])->name('kategori_aksi');
Route::put('/kategori/edit/aksi/{id}', [HomeController::class, 'kategori_edit_aksi'])->name('kategori_edit_aksi');
Route::get('/kategori/edit/{id}', [HomeController::class, 'kategori_edit'])->name('kategori_edit');
Route::get('/kategori/hapus/{id}', [HomeController::class, 'kategori_hapus'])->name('kategori_hapus');
Route::get('/transaksi', [HomeController::class, 'transaksi'])->name('transaksi');
Route::get('/transaksi/tambah', [HomeController::class, 'transaksi_tambah'])->name('transaksi_tambah');
Route::post('/transaksi/aksi', [HomeController::class, 'transaksi_aksi'])->name('transaksi_aksi');
Route::get('/transaksi/edit/{id}', [HomeController::class, 'transaksi_edit'])->name('transaksi_edit');
Route::put('/transaksi/edit/aksi/{id}', [HomeController::class, 'transaksi_edit_aksi'])->name('transaksi_edit_aksi');
Route::get('/transaksi/hapus/{id}', [HomeController::class, 'transaksi_hapus'])->name('transaksi_hapus');
Route::get('/transaksi/cari', [HomeController::class, 'transaksi_cari'])->name('transaksi_cari');
Route::get('/laporan', [HomeController::class, 'laporan'])->name('laporan');
Route::get('/laporan/aksi', [HomeController::class, 'laporan_aksi'])->name('laporan_aksi');
Route::get('/laporan/print', [HomeController::class, 'laporan_print'])->name('laporan_print');
Route::get('/laporan/excel', [HomeController::class, 'laporan_excel'])->name('laporan_excel');
Route::get('/ganti_password', [HomeController::class, 'ganti_password'])->name('ganti_password');
Route::post('/ganti_password/aksi', [HomeController::class, 'ganti_password_aksi'])->name('ganti_password_aksi');

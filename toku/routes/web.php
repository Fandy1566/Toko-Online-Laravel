<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

use App\Http\Controllers\LogoutController;
Route::get('/logout', [LogoutController::class, "perform"])->name('logout.perform');
Route::get('/dashboard/logout', [LogoutController::class, "dashboard"])->name('logout.dashboard');

use App\Http\Controllers\AdmincustomerController;
Route::controller(AdmincustomerController::class)->group(function () {
    Route::get('/dashboard/customer', 'index')->name('customer.index');
    Route::post('/dashboard/customer/store', 'store')->name('customer.store');
    Route::get('/dashboard/customer/edit/{id}', 'edit');
    Route::patch('/dashboard/customer/update/{id}', 'update')->name('customer.update');
    Route::delete('/dashboard/customer/delete/{id}', 'destroy')->name('customer.delete');
});

use App\Http\Controllers\dashboardController;
Route::controller(dashboardController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});

use App\Http\Controllers\customerController;
Route::controller(customerController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/produk', 'product')->name('produk');
    Route::get('/produk/cari', 'cari')->name('produk.cari');
    Route::get('/history', 'history')->name('history');
    Route::get('/history/show/{id}', 'show_history')->name('history.show');
    Route::get('/pesanan', 'pesanan')->name('pesanan');
    Route::get('/pesanan/show/{id}', 'show_pemesanan')->name('pesanan.show');
    Route::get('/keranjang', 'cart')->name('cart');
    Route::get('/keranjang/add/{id}', 'add_item')->name('cart.add');
    Route::get('/keranjang/delete/{id}', 'delete_item')->name('cart.delete');
    Route::post('/keranjang/pesan', 'pesan')->name('cart.pesan');
    Route::get('/info', 'info');
});


use App\Http\Controllers\pegawaiController;
Route::controller(pegawaiController::class)->group(function () {
    Route::get('/dashboard/pegawai', 'index')->name('pegawai.index');
    Route::post('/dashboard/pegawai/store', 'store')->name('pegawai.store');
    Route::get('/dashboard/pegawai/edit/{id}', 'edit');
    Route::patch('/dashboard/pegawai/update/{id}', 'update')->name('pegawai.update');
    Route::delete('/dashboard/pegawai/delete/{id}', 'destroy')->name('pegawai.delete');
});

use App\Http\Controllers\ProductController;
Route::controller(ProductController::class)->group(function () {
    Route::get('/dashboard/produk', 'index')->name('produk.index');
    Route::get('/dashboard/produk/create', 'create')->name('produk.create');
    Route::post('/dashboard/produk/store', 'store')->name('produk.store');
    Route::get('/dashboard/produk/edit/{id}', 'edit');
    Route::patch('/dashboard/produk/update/{id}', 'update')->name('produk.update');
    Route::delete('/dashboard/produk/delete/{id}', 'destroy')->name('produk.delete');
});

use App\Http\Controllers\transaksiController;
Route::controller(transaksiController::class)->group(function () {
    Route::get('/dashboard/transaksi', 'index')->name('transaksi.index');
    Route::get('/dashboard/transaksi/{id}', 'show')->name('transaksi.show');
    Route::post('/dashboard/transaksi/store', 'store')->name('transaksi.store');
});

use App\Http\Controllers\pemesananController;
Route::controller(pemesananController::class)->group(function () {
    Route::get('/dashboard/pemesanan', 'index')->name('pemesanan.index');
    Route::get('/dashboard/pemesanan/show/brg/{id}', 'show')->name('pemesanan.show');
    Route::get('/dashboard/pemesanan/all', 'all')->name('pemesanan.all');
    Route::get('/dashboard/pemesanan/diterima', 'diterima')->name('pemesanan.diterima');
    Route::get('/dashboard/pemesanan/ditolak', 'ditolak')->name('pemesanan.ditolak');
    Route::post('/dashboard/pemesanan/store', 'store')->name('pemesanan.store');
    Route::post('/dashboard/pemesanan/terima/{id}', 'terima')->name('pemesanan.terima');
    Route::patch('/dashboard/pemesanan/tolak/{id}', 'tolak')->name('pemesanan.tolak');
});

use App\Http\Controllers\userController;
Route::controller(userController::class)->group(function () {
    Route::get('/dashboard/user', 'index')->name('user.index');
    Route::post('/dashboard/user/store', 'store')->name('user.store');
    Route::get('/dashboard/user/edit/{id}', 'edit');
    Route::patch('/dashboard/user/update/{id}', 'update')->name('user.update');
    Route::delete('/dashboard/user/delete/{id}', 'destroy')->name('user.delete');
});
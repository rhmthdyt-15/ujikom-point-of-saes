<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
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

Route::get('/', fn () => redirect()->route('login'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/kategori', KategoriController::class);

    //Produk
    Route::resource('/produk', ProdukController::class);
    Route::delete('/produk/delete/multiple', [ProdukController::class, 'deleteMultiple'])->name('produk.delete_multiple');
    Route::put('/produk/cetak/barcode', [ProdukController::class, 'cetakBarcode'])->name('produk.cetak_barcode');

    //Member
    Route::resource('/member', MemberController::class);
    Route::delete('/member/delete/multiple', [MemberController::class, 'deleteMultiple'])->name('member.delete_multiple');
    Route::get('/member/cetak/member', [MemberController::class, 'cetakMember'])->name('member.cetak_member');

    //supplier
    Route::resource('/supplier', SupplierController::class);

    //pengeluaran
    Route::resource('/pengeluaran', PengeluaranController::class);

    //pembeian
    Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
    Route::resource('/pembelian', PembelianController::class)
        ->except('create');

    Route::resource('/pembelian_detail', PembelianDetailController::class)
        ->except('create', 'show', 'edit');
});

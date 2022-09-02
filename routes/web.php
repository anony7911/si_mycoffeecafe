<?php

use App\Http\Livewire\Laporan;
use App\Http\Livewire\Pesan;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/meja', [App\Http\Controllers\MejaController::class, 'index'])->name('meja');
    Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu');
    Route::get('/pesanan', [App\Http\Controllers\PesananController::class, 'index'])->name('pesanan');
    Route::get('/laporan', Laporan::class)->name('laporan');
    Route::get('/cetak_laporan', [App\Http\Controllers\PdfexportController::class, 'export_pdf'])->name('cetak_laporan');
});

Route::get('/{no_meja}', Pesan::class);

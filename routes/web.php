<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogistikController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Models\SuratKeluar;

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

// ========== WELCOME LARAVEL ==========
// Route::get('/', function () {
//     return view('welcome');
// });

// ========== TEMPLATE ==========
Route::get('/master', function () {
    return view('layout.master');
});

// ========== DASHBOARD ==========
Route::get('/', function () {
    return view('dashboard.dashboard');
});

// ========== LOGISTIK ==========
Route::get('logistik/download', [LogistikController::class, 'download']);
Route::resource('logistik', LogistikController::class);

// ========== PENGUMUMAN ==========
Route::resource('pengumuman', PengumumanController::class);

// ========== SURAT MASUK ==========
Route::get('suratmasuk/download', [SuratMasukController::class, 'download']);
Route::resource('suratmasuk', SuratMasukController::class);

// ========== SURAT KELUAR ==========
Route::get('suratkeluar/download', [SuratKeluarController::class, 'download']);
Route::resource('suratkeluar', SuratKeluarController::class);

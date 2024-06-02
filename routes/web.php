<?php

use App\Http\Controllers\AnggotaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogistikController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuratKeteranganController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', function () {
    return view('welcome');
});

// ========== TEMPLATE ==========
// Route::get('/master', function () {
//     return view('layout.master');
// });

// ========== AUTH ==========
Route::get('/login', [AuthController::class, 'index']);
Route::post('/store', [AuthController::class, 'store']);
route::get('/logout', [AuthController::class, 'logout']);

// ========== MIDDLEWARE ==========
// Route::middleware(['auth'])->group(function () {
// });

// ========== DASHBOARD ==========
Route::get('/dashboard', function () {
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

// ========== AGGOTA ==========
Route::get('anggota/download', [AnggotaController::class, 'download']);
Route::resource('anggota', AnggotaController::class);

// ========== SURAT KETERANGAN ==========
Route::get('suratketerangan/download', [SuratKeteranganController::class, 'download']);
Route::resource('suratketerangan', SuratKeteranganController::class);

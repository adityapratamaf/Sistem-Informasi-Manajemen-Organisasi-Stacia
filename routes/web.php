<?php

use App\Http\Controllers\AnggotaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogistikController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuratKeteranganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\TugasController;
use App\Models\Laporan;
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
Route::get('/login', [AuthController::class, 'index'])->middleware('guest');
Route::post('/store', [AuthController::class, 'store']);
route::get('/logout', [AuthController::class, 'logout']);

// ========== MIDDLEWARE ==========
Route::group(['middleware' => 'auth'], function () {
    // ========== DASHBOARD ==========
    Route::resource('dashboard', DashboardController::class);

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

    // ========== PROFIL ==========
    Route::resource('profil', ProfilController::class);

    // ========== PENGURUS ==========
    Route::resource('pengurus', PengurusController::class);

    // ========== PROGRAM ==========
    Route::get('program/download', [ProgramController::class, 'download']);
    Route::resource('program', ProgramController::class);

    // ========== TUGAS ==========
    Route::get('/program/pekerjaan/{program_id}', [TugasController::class, 'index'])->name('program.pekerjaan');
    // Route::get('/tugas/create/{program_id}', [TugasController::class, 'create'])->name('tugas.create');
    Route::post('/tugas/store/{program_id}', [TugasController::class, 'store'])->name('tugas.store');
    // Route::get('/tugas/edit/{tugas}', [TugasController::class, 'edit'])->name('tugas.edit');
    Route::put('/tugas/update/{tugas}', [TugasController::class, 'update'])->name('tugas.update');
    Route::delete('/tugas/destroy/{tugas}', [TugasController::class, 'destroy'])->name('tugas.destroy');

    // ========== LAPORAN ==========
    Route::post('/laporan/store/{program_id}', [LaporanController::class, 'store'])->name('laporan.store');
    Route::put('/laporan/update/{laporan}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/destroy/{laporan}', [laporanController::class, 'destroy'])->name('laporan.destroy');
    Route::get('/laporan/file/{laporan_id}', [LaporanController::class, 'download'])->name('laporan.file');
}); // ========== MIDDLEWARE ==========

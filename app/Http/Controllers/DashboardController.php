<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Logistik;
use App\Models\SuratKeluar;
use App\Models\SuratKeterangan;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ===== Menampilkan Data

        // Model
        $user = User::find(Auth::id());
        $totalAnggota = Anggota::count();
        $totalLogistik = Logistik::count();
        $totalSuratMasuk = SuratMasuk::count();
        $totalSuratKeluar = SuratKeluar::count();
        $totalSuratKeterangan = SuratKeterangan::count();
        return view('dashboard.dashboard', compact('user', 'totalAnggota', 'totalLogistik', 'totalSuratMasuk', 'totalSuratKeluar', 'totalSuratKeterangan'));
    }
}

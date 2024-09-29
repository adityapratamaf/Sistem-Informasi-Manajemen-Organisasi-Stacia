<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Laporan;
use App\Models\Logistik;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\SuratKeluar;
use App\Models\SuratKeterangan;
use App\Models\SuratMasuk;
use App\Models\User;
use App\Models\Pengumuman;
use App\Models\Pengurus;
use App\Models\Program;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $dataPengumuman = Pengumuman::orderByRaw('created_at DESC')->limit(2)->get();
        $dataProgram = Program::count();
        $dataPengurus = Pengurus::count();
        $jumlahTugas = Tugas::count();
        $jumlahTugasSelesai = Tugas::where('status', 'Selesai')->count();
        $jumlahLaporan = Laporan::count();
        $jumlahLaporanSelesai = Laporan::where('status', 'Selesai')->count();
        $jumlahPemasukan = Pemasukan::sum('jumlah');
        $jumlahPengeluaran = Pengeluaran::sum('jumlah');

        // Mengambil jumlah program per status dan per bulan
        $programs = DB::table('program')
            ->select(
                DB::raw("DATE_FORMAT(tgl_mulai, '%M %Y') as bulan"),
                DB::raw("SUM(CASE WHEN status = 'Sukses' THEN 1 ELSE 0 END) as sukses"),
                DB::raw("SUM(CASE WHEN status = 'Batal' THEN 1 ELSE 0 END) as batal"),
                DB::raw("SUM(CASE WHEN status = 'Tunggu' THEN 1 ELSE 0 END) as tunggu"),
                DB::raw("COUNT(*) as total")
            )
            ->groupBy('bulan')
            ->orderBy('tgl_mulai', 'asc')
            ->get();

        $labels = [];
        $dataSukses = [];
        $dataBatal = [];
        $dataTunggu = [];

        foreach ($programs as $program) {
            $labels[] = $program->bulan;
            $dataSukses[] = $program->sukses;
            $dataBatal[] = $program->batal;
            $dataTunggu[] = $program->tunggu;
        }

        return view('dashboard.dashboard', compact('user', 'totalAnggota', 'totalLogistik', 'totalSuratMasuk', 'totalSuratKeluar', 'totalSuratKeterangan', 'dataPengumuman', 'dataProgram', 'dataPengurus', 'jumlahTugas', 'jumlahTugasSelesai', 'jumlahLaporan', 'jumlahLaporanSelesai', 'jumlahPemasukan', 'jumlahPengeluaran', 'labels', 'dataSukses', 'dataBatal', 'dataTunggu'));
    }
}

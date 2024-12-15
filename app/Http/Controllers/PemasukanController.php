<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Panitia;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File; // Hapus File Lama

class PemasukanController extends Controller
{

    public function index($program_id)
    {
        // ===== Daftar Data =====

        // Temukan Program Berdasarkan ID
        $program = Program::findOrFail($program_id);

        // Ambil Semua Pemasukan & Pengeluaran Yang Berelasi Dengan Program
        $pemasukan = Pemasukan::where('program_id', $program_id)->orderBy('created_at', 'DESC')->get();
        $pengeluaran = Pengeluaran::where('program_id', $program_id)->orderBy('created_at', 'DESC')->get();

        // Middleware Jika User Yang Login Adalah Panitia Dari Suatu Program
        // $isPanitia = \DB::table('panitia')
        //     ->where('users_id', Auth::id())
        //     ->where('program_id', $program_id)
        //     ->where('role', 'panitia')
        //     ->exists();

        // Middleware Jika User Yang Login Adalah Panitia Dari Suatu Program
        $isPanitia = Panitia::where('users_id', Auth::id())
            ->where('program_id', $program_id)
            ->where('role', 'panitia')
            ->exists();

        // Fungsi Untuk Mengitung Pemasukan & Pengeluaran
        $totalPemasukan = Pemasukan::where('program_id', $program_id)->sum('jumlah');
        $totalPengeluaran = Pengeluaran::where('program_id', $program_id)->sum('jumlah');
        $totalSaldo = $totalPemasukan - $totalPengeluaran;

        // Pengalihan Halaman
        return view('program.keuangan', compact('program', 'pemasukan', 'pengeluaran', 'isPanitia', 'totalPemasukan', 'totalPengeluaran', 'totalSaldo'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request, $program_id)
    {
        // ===== Request Tambah Data =====

        // Validasi Jika Form Tidak Di Isi
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'file' => 'required|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        // Mengambil Data Program
        $program = Program::findOrFail($program_id);

        // Unggah File
        $filePemasukan = time() . '.' . $request->file->extension();
        $request->file->move(public_path('pemasukan-file'), $filePemasukan);

        // Membuat Pemasukan Baru & Merelasikan Dengan Program
        $pemasukan = new Pemasukan([
            'nama' => $request->input('nama'),
            'tanggal' => $request->input('tanggal'),
            'jumlah' => $request->input('jumlah'),
            'file' => $filePemasukan,
            'program_id' => $program_id,
            'users_id' => Auth::id(),
        ]);

        // Menyimpan Data Ke Database
        $pemasukan->save();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DI SIMPAN',
            'alert' => 'success',
        ];

        // Pengalihan Halaman
        return redirect()->route('program.keuangan', $program_id)->with($notifikasi);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Pemasukan $pemasukan)
    {
        //

        // Validasi Jika Form Tidak Di Isi
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'file' => 'nullable|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        // ===== Fungsi Hapus & Ubah File =====
        if ($request->hasFile('file')) {
            $path = 'pemasukan-file/';

            // Hapus File Pemasukan Lama Jika Ada
            File::delete(public_path($path . $pemasukan->file));

            // Unggah File Pemasukan Baru
            $filePemasukan = time() . '.' . $request->file->extension();
            $request->file->move(public_path($path), $filePemasukan);

            $pemasukan->file = $filePemasukan;
        }

        // Update Data Pemasukan
        $pemasukan->nama = $request->nama;
        $pemasukan->tanggal = $request->tanggal;
        $pemasukan->jumlah = $request->jumlah;

        // Simpan
        $pemasukan->save();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DI UBAH',
            'alert' => 'success',
        ];

        // Pengalihan Halaman
        return redirect()->route('program.keuangan', $pemasukan->program_id)->with($notifikasi);
    }

    public function destroy(Pemasukan $pemasukan)
    {
        // ===== Hapus Data =====

        // Model Ambil Program ID Dari Tugas Yang Dihapus
        $program_id = $pemasukan->program_id;

        // Hapus File
        $path = 'pemasukan-file/';
        File::delete($path . $pemasukan->file);

        // Hapus Data
        $pemasukan->delete();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI HAPUS',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return redirect()->route('program.keuangan', $program_id)->with($notifikasi);
    }

    public function download($program_id)
    {
        // ===== Download PDF Data =====

        // Ambil Data Program Berdasarkan ID
        $program = Program::findOrFail($program_id);

        // Watermark User Login Model
        $user = Auth::user();
        $watermarknama = $user->nama;

        // Watermark Waktu
        $waktu = Carbon::now();
        $watermarkwaktu = $waktu->format('Y-m-d H:i:s');

        // Ambil Data Pemasukan Berdasarkan Program
        $pemasukan = Pemasukan::where('program_id', $program_id)
            ->orderBy('tanggal', 'asc')
            ->get();

        // Ambil Data Pengeluaran Berdasarkan Program
        $pengeluaran = Pengeluaran::where('program_id', $program_id)
            ->orderBy('tanggal', 'asc')
            ->get();

        // Hitung Total Pemasukan, Pengeluaran, dan Saldo
        $totalPemasukan = $pemasukan->sum('jumlah');
        $totalPengeluaran = $pengeluaran->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Gabungkan Data Menjadi Satu Array
        $laporan = [];

        foreach ($pemasukan as $item) {
            $laporan[] = [
                'tanggal' => $item->tanggal,
                'keterangan' => $item->nama,
                'debet' => $item->jumlah,
                'kredit' => 0,
            ];
        }

        foreach ($pengeluaran as $item) {
            $laporan[] = [
                'tanggal' => $item->tanggal,
                'keterangan' => $item->nama,
                'debet' => 0,
                'kredit' => $item->jumlah,
            ];
        }

        // Urutkan Data Berdasarkan Tanggal
        usort($laporan, function ($a, $b) {
            return strtotime($a['tanggal']) - strtotime($b['tanggal']);
        });

        // Hitung Saldo Per Baris
        $runningSaldo = 0;
        foreach ($laporan as &$row) {
            $runningSaldo += $row['debet'] - $row['kredit'];
            $row['saldo'] = $runningSaldo;
        }

        // Pengalihan Halaman
        return view('program.cetakkeuangan', [
            'program' => $program,
            'watermarknama' => $watermarknama,
            'watermarkwaktu' => $watermarkwaktu,
            'laporan' => $laporan,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo' => $saldo,
        ]);
    }
}

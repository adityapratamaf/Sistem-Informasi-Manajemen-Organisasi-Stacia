<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Panitia;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Hapus File Lama
use File;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($program_id)
    {
        // ===== Daftar Data =====

        // Temukan Program Berdasarkan ID
        $program = Program::findOrFail($program_id);

        // Ambil Semua Pemasukan Yang Berelasi Dengan Program
        $pemasukan = Pemasukan::where('program_id', $program_id)->orderBy('created_at', 'DESC')->get();

        // Middleware Jika User Yang Login Adalah Panitia Dari Suatu Program
        // $isPanitia = \DB::table('panitia')
        //     ->where('users_id', Auth::id())
        //     ->where('program_id', $program_id)
        //     ->where('role', 'panitia')
        //     ->exists();

        $isPanitia = Panitia::where('users_id', Auth::id())
            ->where('program_id', $program_id)
            ->where('role', 'panitia')
            ->exists();

        $totalPemasukan = Pemasukan::where('program_id', $program_id)->sum('jumlah');
        $totalPengeluaran = 1000000;
        $totalSaldo = $totalPemasukan - $totalPengeluaran;
        // Pengalihan Halaman
        return view('program.keuangan', compact('program', 'pemasukan', 'isPanitia', 'totalPemasukan', 'totalPengeluaran', 'totalSaldo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        // // Var Dump untuk Melihat Isi Data
        // var_dump($pemasukan->toArray());
        // die(); // Menghentikan eksekusi script untuk melihat hasil dump

        // Menyimpan Data Ke Database
        $pemasukan->save();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DI SIMPAN',
            'alert' => 'success',
        ];

        // Pengalihan halaman
        return redirect()->route('program.keuangan', $program_id)->with($notifikasi);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}

<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Hapus File Lama
use File;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($program_id)
    {
        // ===== Daftar Data =====

        // Tergabung Di Dalam Index Controller Pemasukan
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
            'tanggal' => 'required',
            'jumlah' => 'required',
            'file' => 'required|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        // Mengambil Data Program
        $program = Program::findOrFail($program_id);

        // Unggah File
        $filePengeluaran = time() . '.' . $request->file->extension();
        $request->file->move(public_path('pengeluaran-file'), $filePengeluaran);

        // Membuat Pengeluaran Baru & Merelasikan Dengan Program
        $pengeluaran = new Pengeluaran([
            'nama' => $request->input('nama'),
            'tanggal' => $request->input('tanggal'),
            'jumlah' => $request->input('jumlah'),
            'file' => $filePengeluaran,
            'program_id' => $program_id,
            'users_id' => Auth::id(),
        ]);

        // Menyimpan Data Ke Database
        $pengeluaran->save();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DI SIMPAN',
            'alert' => 'success',
        ];

        // Pengalihan Halaman
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
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        // ===== Request Ubah Data =====

        // Validasi Jika Form Tidak Di Isi
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'file' => 'nullable|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        // ===== Fungsi Hapus & Ubah File =====
        if ($request->hasFile('file')) {
            $path = 'pengeluaran-file/';

            // Hapus File Pengeluaran Lama Jika Ada
            File::delete(public_path($path . $pengeluaran->file));

            // Unggah File Pengeluaran Baru
            $filePengeluaran = time() . '.' . $request->file->extension();
            $request->file->move(public_path($path), $filePengeluaran);

            $pengeluaran->file = $filePengeluaran;
        }

        // Update Data Pengeluaran
        $pengeluaran->nama = $request->nama;
        $pengeluaran->tanggal = $request->tanggal;
        $pengeluaran->jumlah = $request->jumlah;

        // Simpan
        $pengeluaran->save();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DI UBAH',
            'alert' => 'success',
        ];

        // Pengalihan Halaman
        return redirect()->route('program.keuangan', $pengeluaran->program_id)->with($notifikasi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        // ===== Hapus Data =====

        // Model Ambil Program ID Dari Tugas Yang Dihapus
        $program_id = $pengeluaran->program_id;

        // Hapus File
        $path = 'pengeluaran-file/';
        File::delete($path . $pengeluaran->file);

        // Hapus Data
        $pengeluaran->delete();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI HAPUS',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return redirect()->route('program.keuangan', $program_id)->with($notifikasi);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Tugas;
use App\Models\Laporan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Hapus File Lama
use File;

class LaporanController extends Controller
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

        // Ambil Semua Tugas Yang Berelasi Dengan Program Tersebut
        $laporan = Laporan::where('program_id', $program_id)->orderBy('created_at', 'DESC')->get();

        // Pengalihan Halaman
        return view('program.pekerjaan', compact('program', 'laporan'));
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
            'deskripsi' => 'required',
            'status' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'file' => 'file|mimes:pdf,jpeg,png,jpg,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'tugas_id' => 'required|exists:tugas,id',
        ]);

        // Unggah File Laporan
        if ($request->hasFile('file')) {
            $fileLaporan = time() . '.' . $request->file->extension();
            $request->file->move(public_path('laporan-file'), $fileLaporan);
        } else {
            $fileLaporan = '';
        }

        // Mengambil Pekerjaan Program Berdasarkan ID
        $program = Program::findOrFail($program_id);

        // Membuat Laporan Baru & Merelasikan Dengan Program
        $laporan = new Laporan([
            'deskripsi' => $request->input('deskripsi'),
            'status' => $request->input('status'),
            'tgl_mulai' =>  $request->input('tgl_mulai'),
            'tgl_selesai' =>  $request->input('tgl_selesai'),
            'file' => $fileLaporan,
            'program_id' => $program_id,
            'tugas_id' => $request->input('tugas_id'),
            'users_id' => Auth::id(),
        ]);

        // Menyimpan Data Ke Database
        $laporan->save();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DI SIMPAN',
            'alert' => 'success',
        ];

        // Pengalihan halaman
        return redirect()->route('program.pekerjaan', $program_id)->with($notifikasi);
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
    public function update(Request $request, Laporan $laporan)
    {
        //

        // Validasi data yang diubah
        $request->validate([
            'deskripsi' => 'required',
            'status' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'file' => 'file|mimes:pdf,jpeg,png,jpg,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'tugas_id' => 'exists:tugas,id',
        ]);

        // ===== Fungsi Hapus & Ubah File =====
        if ($request->hasFile('file')) {
            $path = 'laporan-file/';

            // Hapus File Proposal Lama Jika Ada
            File::delete(public_path($path . $laporan->file));

            // Unggah File Proposal Baru
            $fileLaporan = time() . '.' . $request->file->extension();
            $request->file->move(public_path($path), $fileLaporan);

            $laporan->file = $fileLaporan;
        }

        // Update data laporan
        $laporan->deskripsi = $request->deskripsi;
        $laporan->status = $request->status;
        $laporan->tgl_mulai = $request->tgl_mulai;
        $laporan->tgl_selesai = $request->tgl_selesai;
        $laporan->tugas_id = $request->tugas_id;

        // Menyimpan perubahan
        $laporan->save();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DI UBAH',
            'alert' => 'success',
        ];

        // Pengalihan Halaman
        return redirect()->route('program.pekerjaan', $laporan->program_id)->with($notifikasi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        // ===== Hapus Data =====

        // Model Ambil Program ID Dari Tugas Yang Dihapus
        $program_id = $laporan->program_id;

        // Hapus File
        $path = 'laporan-file/';
        File::delete($path . $laporan->file);

        // Hapus Data
        $laporan->delete();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI HAPUS',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return redirect()->route('program.pekerjaan', $program_id)->with($notifikasi);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($laporan_id)
    {
        $laporan = Laporan::findOrFail($laporan_id);

        // Tentukan Lokasi File
        $filePath = public_path('laporan-file') . '/' . $laporan->file;

        // Set headers untuk file yang diunduh
        $headers = [
            'Content-Type' => 'application/pdf', // sesuaikan tipe konten dengan jenis file yang Anda simpan
        ];

        // Sekarang lakukan respons file untuk diunduh
        return response()->download($filePath, $laporan->file, $headers);
    }
}

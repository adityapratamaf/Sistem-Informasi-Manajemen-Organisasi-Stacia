<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
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
        $tugas = Tugas::where('program_id', $program_id)->orderBy('created_at', 'DESC')->get();
        $laporan = Laporan::where('program_id', $program_id)->orderBy('created_at', 'DESC')->get();

        // Middleware Jika User Yang Login Adalah Panitia Dari Suatu Program
        $isPanitia = \DB::table('panitia')
            ->where('users_id', Auth::id())
            ->where('program_id', $program_id)
            ->where('role', 'panitia')
            ->exists();

        // Pengalihan Halaman
        return view('program.pekerjaan', compact('program', 'tugas', 'laporan', 'isPanitia'));
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
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        // Mengambil Pekerjaan Program Berdasarkan ID
        $program = Program::findOrFail($program_id);

        // Membuat Tugas Baru & Merelasikan Dengan Program
        $tugas = new Tugas([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'status' => $request->input('status'),
            'program_id' => $program_id,
        ]);

        // Menyimpan Data Ke Database
        $tugas->save();

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
    public function update(Request $request, Tugas $tugas)
    {
        // ===== Request Ubah Data =====

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        $tugas->nama = $request->nama;
        $tugas->deskripsi = $request->deskripsi;
        $tugas->status = $request->status;
        $tugas->save();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DI UBAH',
            'alert' => 'success',
        ];

        // Pengalihan halaman
        return redirect()->route('program.pekerjaan', $tugas->program_id)->with($notifikasi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tugas $tugas)
    {
        // ===== Hapus Data =====

        // Model Ambil Program ID Dari Tugas Yang Dihapus
        $program_id = $tugas->program_id;

        // Hapus Data
        $tugas->delete();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI HAPUS',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return redirect()->route('program.pekerjaan', $program_id)->with($notifikasi);
    }
}

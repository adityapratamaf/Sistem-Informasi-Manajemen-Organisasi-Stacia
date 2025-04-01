<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{

    public function index($program_id)
    {
        // ===== Daftar Data =====

        // Temukan Program Berdasarkan ID 
        $program = Program::findOrFail($program_id);

        // Ambil Data Panitia Sesuai Program
        $pelaksana = $program->user;

        // Ambil Semua Tugas Yang Berelasi Dengan Program Tersebut
        $tugas = Tugas::where('program_id', $program_id)->orderBy('created_at', 'DESC')->get();
        $laporan = Laporan::where('program_id', $program_id)->orderBy('created_at', 'DESC')->get();

        // Middleware Jika User Yang Login Adalah Panitia Dari Suatu Program
        $isPanitia = \DB::table('panitia')
            ->where('users_id', Auth::id())
            ->where('program_id', $program_id)
            ->whereIn('role', ['Ketua', 'Sekretaris', 'Bendahara', 'Anggota'])
            ->exists();

        $isKetua = \DB::table('panitia')
            ->where('users_id', Auth::id())
            ->where('program_id', $program_id)
            ->where('role', 'Ketua')
            ->exists();

        $isSekretaris = \DB::table('panitia')
            ->where('users_id', Auth::id())
            ->where('program_id', $program_id)
            ->where('role', 'Sekretaris')
            ->exists();

        // Pengalihan Halaman
        return view('program.pekerjaan', compact('program', 'tugas', 'laporan', 'pelaksana', 'isPanitia', 'isKetua', 'isSekretaris'));
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
            'deskripsi' => 'required',
            'status' => 'required',
            'users_id' => 'required|exists:users,id',
        ]);

        // Mengambil Pekerjaan Program Berdasarkan ID
        $program = Program::findOrFail($program_id);

        // Membuat Tugas Baru & Merelasikan Dengan Program
        $tugas = new Tugas([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'status' => $request->input('status'),
            'users_id' => $request->input('users_id'),
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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

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
        $tugas->users_id = $request->users_id;
        $tugas->save();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DI UBAH',
            'alert' => 'success',
        ];

        // Pengalihan halaman
        return redirect()->route('program.pekerjaan', $tugas->program_id)->with($notifikasi);
    }

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

    public function download($program_id)
    {
        // ===== Download PDF Data =====

        // Ambil Data Program Berdasarkan ID
        $program = Program::findOrFail($program_id);

        // Ambil Semua Tugas Yang Berelasi Dengan Program Tersebut
        $tugas = Tugas::where('program_id', $program_id)->orderBy('created_at', 'DESC')->get();
        $laporan = Laporan::where('program_id', $program_id)->get();

        // Watermark User Login Model
        $user = Auth::user();
        $watermarknama = $user->nama;

        // Watermark Waktu
        $waktu = Carbon::now();
        $watermarkwaktu = $waktu->format('Y-m-d H:i:s');

        // Pengalihan Halaman
        return view('program.cetakpekerjaan', [
            'program' => $program,
            'tugas' => $tugas,
            'laporan' => $laporan,
            'watermarknama' => $watermarknama,
            'watermarkwaktu' => $watermarkwaktu,
        ]);
    }
}

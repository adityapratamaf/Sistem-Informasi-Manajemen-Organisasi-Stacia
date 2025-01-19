<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
use App\Models\Pengurus;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Hapus File Lama
use File;

class ProgramController extends Controller
{

    public function index()
    {
        // Model Data
        $program = Program::with('pengurus')->orderBy('created_at', 'DESC')->get();

        // Looping Untuk Setiap Program
        foreach ($program as $data) {
            // Ambil Semua Tugas Yang Terkait Dengan Setiap Program
            $tugas = Tugas::where('program_id', $data->id)->get();

            // Hitung Jumlah Tugas Yang Sudah Selesai
            $jumlahSelesai = $tugas->where('status', 'Selesai')->count();

            // Hitung Persentase Progres
            $totalTugas = $tugas->count();
            $persentaseProgres = ($totalTugas > 0) ? ($jumlahSelesai / $totalTugas) * 100 : 0;

            // Tambahkan Persentase Progres Ke Dalam Program Sebagai Atribut Baru
            $data->persentaseProgres = $persentaseProgres;
        }

        // Pengalihan Halaman
        return view('program.daftar', ['program' => $program]);
        // return view('program.daftar', compact('program'));
    }

    public function create()
    {
        // ===== Tambah Data =====
        $pengurus = Pengurus::all();
        $user = User::all();

        // Pengalihan Halaman
        return view('program.tambah', ['pengurus' => $pengurus, 'user' => $user]);
    }

    public function store(Request $request)
    {
        // ===== Request Tambah Data =====

        // Validasi Jika Form Tidak Di Isi
        $this->validate($request, [
            'nama'          => 'required',
            'deskripsi'     => 'required|string',
            'jenis'         => 'required',
            'status'        => 'required',
            'tgl_mulai'     => 'required',
            'tgl_selesai'   => 'required',
            'pengurus_id'   => 'required|exists:pengurus,id',
            'users_id'      => 'required|array',
            'users_id.*'    => 'exists:users,id',
            'proposal'      => 'file|mimes:pdf',
            'lpj'           => 'file|mimes:pdf',
        ]);

        // Unggah File Proposal
        if ($request->hasFile('proposal')) {

            // Pengecekan Ukuran File
            if ($request->file('proposal')->getSize() > 10 * 1024 * 1024) {
                // Notifikasi 
                $notifikasi = array(
                    'pesan' => 'UKURAN FILE MAKSIMAL 2 MB',
                    'alert' => 'error',
                );
                // Pengalihan Halaman
                return redirect()->back()->with($notifikasi);
            }

            // Unggah File
            $fileProposal = time() . '.' . $request->proposal->extension();
            $request->proposal->move(public_path('proposal-file'), $fileProposal);
        } else {
            $fileProposal = '';
        }

        // Unggah File LPJ
        if ($request->hasFile('lpj')) {

            // Pengecekan Ukuran File
            if ($request->file('lpj')->getSize() > 10 * 1024 * 1024) {
                // Notifikasi 
                $notifikasi = array(
                    'pesan' => 'UKURAN FILE MAKSIMAL 2 MB',
                    'alert' => 'error',
                );
                // Pengalihan Halaman
                return redirect()->back()->with($notifikasi);
            }

            // Unggah File
            $fileLpj = time() . '.' . $request->lpj->extension();
            $request->lpj->move(public_path('lpj-file'), $fileLpj);
        } else {
            $fileLpj = '';
        }

        // Hapus Tag HTML Summernote
        $deskripsi = strip_tags($request->deskripsi);

        // Simpan Data Ke Database
        $program = new Program();
        $program->nama = $request->nama;
        $program->deskripsi = $deskripsi;
        $program->jenis = $request->jenis;
        $program->status = $request->status;
        $program->tgl_mulai = $request->tgl_mulai;
        $program->tgl_selesai = $request->tgl_selesai;
        $program->pengurus_id = $request->pengurus_id;
        $program->proposal = $fileProposal;
        $program->lpj = $fileLpj;

        $program->save();

        // Simpan Data Ke Pivot Table
        $program->user()->sync($request->users_id);


        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI SIMPAN',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/program')->with($notifikasi);
    }

    public function show($id)
    {
        // ===== Detail Data =====

        // Ambil Data Berdasarkan ID Yang Di Pilih
        $program = Program::with('pengurus')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('program.detail', compact('program'));
    }

    public function edit($id)
    {
        // ===== Ubah Data =====

        // Model

        // Mengambil Data Program Berdasarkan ID
        $program = Program::with('user')->findOrFail($id);

        // Mengambil ID Pengurus (Tahun Periode) Saat Ini
        $pengurusId = $program->pengurus_id;

        // Mengambil Semua Data Pengurus (Tahun Periode)
        $pengurus = DB::table('pengurus')->get();

        // Mengambil Semua Data User Pengguna
        $user = User::all();

        // Mengambil ID Pengguna Yang Sudah Terhubung Dengan Program
        $panitia = $program->user->pluck('id')->toArray();

        // Pengalihan Halaman
        return view('program.ubah', [
            'pengurus'          => $pengurus,
            'user'              => $user,
            'program'           => $program,
            'pengurusId'        => $pengurusId,
            'panitia'           => $panitia,
        ]);
    }

    public function update(Request $request, $id)
    {
        // ===== Request Update Data =====

        // Validasi Jika Form Tidak Di Isi
        $this->validate($request, [
            'nama'          => 'required',
            'deskripsi'     => 'required',
            'jenis'         => 'required',
            'status'        => 'required',
            'tgl_mulai'     => 'required|date',
            'tgl_selesai'   => 'required|date',
            'pengurus_id'   => 'required|exists:pengurus,id',
            'users_id'      => 'required|array',
            'users_id.*'    => 'exists:users,id',
            'proposal'      => 'file|mimes:pdf',
            'lpj'           => 'file|mimes:pdf',
        ]);

        // Model
        $program = Program::find($id);
        // $program = Program::findOrFail($id);

        // ===== Fungsi Hapus & Ubah File Proposal =====
        if ($request->hasFile('proposal')) {
            $path = 'proposal-file/';

            // Hapus File Proposal Lama Jika Ada
            File::delete(public_path($path . $program->proposal));

            // Pengecekan Ukuran File
            if ($request->file('proposal')->getSize() > 10 * 1024 * 1024) {
                // Notifikasi 
                $notifikasi = array(
                    'pesan' => 'UKURAN FILE MAKSIMAL 2 MB',
                    'alert' => 'error',
                );
                // Pengalihan Halaman
                return redirect()->back()->with($notifikasi);
            }

            // Unggah File Proposal Baru
            $fileProposal = time() . '.' . $request->proposal->extension();
            $request->proposal->move(public_path($path), $fileProposal);

            $program->proposal = $fileProposal;
        }

        // ===== Fungsi Hapus & Ubah File LPJ =====
        if ($request->hasFile('lpj')) {
            $path = 'lpj-file/';

            // Hapus File LPJ Lama Jika Ada
            File::delete(public_path($path . $program->lpj));

            // Pengecekan Ukuran File
            if ($request->file('lpj')->getSize() > 10 * 1024 * 1024) {
                // Notifikasi 
                $notifikasi = array(
                    'pesan' => 'UKURAN FILE MAKSIMAL 2 MB',
                    'alert' => 'error',
                );
                // Pengalihan Halaman
                return redirect()->back()->with($notifikasi);
            }

            // Unggah File LPJ Baru
            $fileLpj = time() . '.' . $request->lpj->extension();
            $request->lpj->move(public_path($path), $fileLpj);

            $program->lpj = $fileLpj;
        }

        // Hapus Tag HTML Summernote
        $deskripsi = strip_tags($request['deskripsi']);

        // Simpan Data Ke Database
        $program->nama = $request['nama'];
        $program->deskripsi = $deskripsi;
        $program->jenis = $request['jenis'];
        $program->status = $request['status'];
        $program->tgl_mulai = $request['tgl_mulai'];
        $program->tgl_selesai = $request['tgl_selesai'];
        $program->pengurus_id = $request['pengurus_id'];
        $program->save();

        // Perbarui Data Di Pivot Table Dengan Sync
        $program->user()->sync($request->users_id);

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI SIMPAN',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/program')->with($notifikasi);
    }

    public function destroy($id)
    {
        // Mengambil Data Program Berdasarkan ID
        $program = Program::find($id);

        // Hapus File Proposal
        if ($program->proposal && file_exists(public_path('proposal-file/' . $program->proposal))) {
            File::delete(public_path('proposal-file/' . $program->proposal));
        }

        // Hapus File LPJ
        if ($program->lpj && file_exists(public_path('lpj-file/' . $program->lpj))) {
            File::delete(public_path('lpj-file/' . $program->lpj));
        }

        // Hapus Data Dari Pivot Table Panitia
        $program->user()->detach();

        // Hapus Data Program Dari Database
        $program->delete();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DIHAPUS',
            'alert' => 'success',
        ];

        // Pengalihan Halaman
        return redirect('/program')->with($notifikasi);
    }

    public function download()
    {
        // ===== Download PDF Data =====

        // Model
        $program = DB::table('program')->get();

        // Pengalihan Halaman
        return view('program.cetak', ['program' => $program]);
    }
}

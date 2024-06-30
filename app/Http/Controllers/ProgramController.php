<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Hapus File Lama
use File;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ===== Daftar Data =====

        // Model
        $program = DB::table('program')->orderBy('created_at', 'DESC')->get();
        $pengurus = DB::table('pengurus')->get();

        // Pengalihan Halaman
        return view('program.daftar', ['program' => $program, 'pengurus' => $pengurus]);

        // $program = Program::with('pengurus')->orderBy('created_at', 'DESC')->get();
        // return view('program.daftar', compact('program'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ===== Tambah Data =====
        $pengurus = Pengurus::all();
        $user = User::all();

        // Pengalihan Halaman
        return view('program.tambah', ['pengurus' => $pengurus, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ===== Request Tambah Data =====

        // Validasi Jika Form Tidak Di Isi
        $this->validate($request, [
            'nama'          => 'required',
            'deskripsi'     => 'required',
            'jenis'         => 'required',
            'status'        => 'required',
            'tgl_mulai'     => 'required',
            'tgl_selesai'   => 'required',
            'pengurus_id'   => 'required|exists:pengurus,id',
            'users_id'      => 'required|array',
            'users_id.*'    => 'exists:users,id',
            'proposal'      => 'file|mimes:pdf|max:2048',
            'lpj'           => 'file|mimes:pdf|max:2048',
        ]);

        // Unggah File Proposal
        if ($request->hasFile('proposal')) {
            $fileProposal = time() . '.' . $request->proposal->extension();
            $request->proposal->move(public_path('proposal-file'), $fileProposal);
        } else {
            $fileProposal = '';
        }

        // Unggah File LPJ
        if ($request->hasFile('lpj')) {
            $fileLpj = time() . '.' . $request->lpj->extension();
            $request->lpj->move(public_path('lpj-file'), $fileLpj);
        } else {
            $fileLpj = '';
        }

        // Simpan Data Ke Database
        $program = new Program();
        $program->nama = $request->nama;
        $program->deskripsi = $request->deskripsi;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ===== Detail Data =====

        // Ambil Data Berdasarkan ID Yang Di Pilih
        $program = Program::with('pengurus')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('program.detail', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            'proposal'      => 'file|mimes:pdf|max:2048',
            'lpj'           => 'file|mimes:pdf|max:2048',
        ]);

        // Model
        $program = Program::find($id);
        // $program = Program::findOrFail($id);

        // ===== Fungsi Hapus & Ubah File Proposal =====
        if ($request->hasFile('proposal')) {
            $path = 'proposal-file/';

            // Hapus File Proposal Lama Jika Ada
            File::delete(public_path($path . $program->proposal));

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

            // Unggah File LPJ Baru
            $fileLpj = time() . '.' . $request->lpj->extension();
            $request->lpj->move(public_path($path), $fileLpj);

            $program->lpj = $fileLpj;
        }

        // Simpan Data Ke Database
        $program->nama = $request['nama'];
        $program->deskripsi = $request['deskripsi'];
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}

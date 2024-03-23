<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PengumumanController extends Controller
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
        $pengumuman = DB::table('pengumuman')->get();

        // Pengalihan Halaman
        return view('pengumuman.tampil', ['pengumuman' => $pengumuman]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ===== Tambah Data =====

        // Pengalihan Halaman
        return view('pengumuman.tambah');
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
            'judul' => 'required',
            'isi' => 'required'
        ]);

        // Simpan Data Ke Database
        $pengumuman = new Pengumuman;
        $pengumuman->judul = $request->judul;
        $pengumuman->isi = $request->isi;
        $pengumuman->save();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DISIMPAN',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/pengumuman')->with($notifikasi);
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

        // Ambil Data Berdasarkan ID Yang Di Pilih
        $pengumuman = DB::table('pengumuman')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('pengumuman.ubah', ['pengumuman' => $pengumuman]);
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
        // ===== Request Ubah Data =====

        // Validasi Jika Form Tidak Di Isi
        $this->validate($request, [
            'judul' => 'required',
            'isi' => 'required'
        ]);

        // Model
        $pengumuman = Pengumuman::find($id);

        // Simpan Data Ke Database
        $pengumuman->judul = $request['judul'];
        $pengumuman->isi = $request['isi'];
        $pengumuman->save();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DIUBAH',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/pengumuman')->with($notifikasi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // // ===== Hapus Data =====

        // Model
        $pengumuman = Pengumuman::find($id);

        // Hapus Data
        $pengumuman->delete();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DIHAPUS',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/pengumuman')->with($notifikasi);
    }
}

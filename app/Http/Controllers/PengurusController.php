<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengurusController extends Controller
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
        $pengurus = DB::table('pengurus')->orderBy('created_at', 'DESC')->get();

        // Pengalihan Halaman
        return view('pengurus.daftar', ['pengurus' => $pengurus]);
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
        return view('pengurus.tambah');
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
            'tahun_periode' => 'required',
        ]);

        // Simpan Data Ke Database
        $pengurus = new Pengurus();
        $pengurus->tahun_periode = $request->tahun_periode;
        $pengurus->save();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DISIMPAN',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/pengurus')->with($notifikasi);
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
        // ===== Ubah Data =====

        // Ambil Data Berdasarkan ID Yang Di Pilih
        $pengurus = DB::table('pengurus')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('pengurus.ubah', ['pengurus' => $pengurus]);
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
            'tahun_periode' => 'required',
        ]);

        // Model
        $pengurus = Pengurus::find($id);

        // Simpan Data Ke Database
        $pengurus->tahun_periode = $request['tahun_periode'];
        $pengurus->save();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DIUBAH',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/pengurus')->with($notifikasi);
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
        $pengurus = Pengurus::find($id);


        //  // Jika Ada Relasi Yang Terkait, Data Tidak Dapat Dihapus
        // if ($pengurus->penggunaan()->exists()) {

        // Notifikasi
        //     $notifikasi = array(
        //         'pesan' => 'DATA GAGAL DIHAPUS',
        //         'alert' => 'danger',
        //     );

        //     // Pengalihan Halaman
        //     return redirect('/pengurus')->with($notifikasi);
        // }

        // public function penggunaan()
        // {
        //     return $this->hasMany(Penggunaan::class);
        // }


        // Jika Tidak Ada Relasi Yang Terkait, Data Dapat Dihapus
        $pengurus->delete();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DIHAPUS',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/pengurus')->with($notifikasi);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SuratMasukController extends Controller
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
        $suratmasuk = DB::table('surat_masuk')->get();

        // Pengalihan Halaman
        return view('suratmasuk.tampil', ['suratmasuk' => $suratmasuk]);
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
        return view('suratmasuk.tambah');
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
            'nomor' => 'required',
            'tanggal' => 'required',
            'perihal' => 'required',
            'asal' => 'required',
            'isi' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        // Unggah File
        $fileSurat = time() . '.' . $request->file->extension();
        $request->file->move(public_path('suratmasuk-file'), $fileSurat);

        // Simpan Data Ke Database
        $suratmasuk = new SuratMasuk;
        $suratmasuk->nomor = $request->nomor;
        $suratmasuk->tanggal = $request->tanggal;
        $suratmasuk->perihal = $request->perihal;
        $suratmasuk->asal = $request->asal;
        $suratmasuk->isi = $request->isi;
        $suratmasuk->file = $fileSurat;
        $suratmasuk->save();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI SIMPAN',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/suratmasuk')->with($notifikasi);
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
        $suratmasuk = DB::table('surat_masuk')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('suratmasuk.detail', ['suratmasuk' => $suratmasuk]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

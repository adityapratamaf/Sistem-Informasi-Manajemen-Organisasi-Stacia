<?php

namespace App\Http\Controllers;

use App\Models\SuratKeterangan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

// Hapus File Lama
use File;

class SuratKeteranganController extends Controller
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
        $suratketerangan = DB::table('surat_keterangan')->orderBy('created_at', 'DESC')->get();

        // Pengalihan Halaman
        return view('suratketerangan.daftar', ['suratketerangan' => $suratketerangan]);
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
        return view('suratketerangan.tambah');
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
            'isi' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        // Unggah File
        $fileSurat = time() . '.' . $request->file->extension();
        $request->file->move(public_path('suratketerangan-file'), $fileSurat);

        // Simpan Data Ke Database
        $suratkeluar = new SuratKeterangan();
        $suratkeluar->nomor = $request->nomor;
        $suratkeluar->tanggal = $request->tanggal;
        $suratkeluar->perihal = $request->perihal;
        $suratkeluar->isi = $request->isi;
        $suratkeluar->file = $fileSurat;
        $suratkeluar->save();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI SIMPAN',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/suratketerangan')->with($notifikasi);
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
        $suratketerangan = DB::table('surat_keterangan')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('suratketerangan.detail', ['suratketerangan' => $suratketerangan]);
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

        // Ambil Data Berdasarkan ID Yang Di PIlih
        $suratketerangan = DB::table('surat_keterangan')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('suratketerangan.ubah', ['suratketerangan' => $suratketerangan]);
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
            'nomor' => 'required',
            'tanggal' => 'required',
            'perihal' => 'required',
            'isi' => 'required',
            'file' => 'mimes:pdf|max:2048',
        ]);

        // Model
        $suratketerangan = SuratKeterangan::find($id);

        // Fungsi Hapus & Ubah File
        if ($request->has('file')) {
            $path = 'suratketerangan-file/';
            File::delete($path . $suratketerangan->file);

            // Unggah File
            $fileSurat = time() . '.' . $request->file->extension();
            $request->file->move(public_path('suratketerangan-file'), $fileSurat);

            $suratketerangan->file = $fileSurat;
            $suratketerangan->save;
        }

        // Simpan Data Ke Database
        $suratketerangan->nomor = $request['nomor'];
        $suratketerangan->tanggal = $request['tanggal'];
        $suratketerangan->perihal = $request['perihal'];
        $suratketerangan->isi = $request['isi'];
        $suratketerangan->save();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI UBAH',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/suratketerangan')->with($notifikasi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ===== Hapus Data =====

        // Model
        $suratketerangan = SuratKeterangan::find($id);

        // Hapus File
        $path = 'suratketerangan-file/';
        File::delete($path . $suratketerangan->file);

        // Hapus Data
        $suratketerangan->delete();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI HAPUS',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/suratketerangan')->with($notifikasi);
    }

    /**
     * Download a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        // ===== Download PDF Data =====

        // Model
        $suratkeluar = DB::table('surat_keluar')->get();

        // Pengalihan Halaman
        return view('suratkeluar.cetak', ['suratkeluar' => $suratkeluar]);
    }
}

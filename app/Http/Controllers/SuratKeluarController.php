<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

// Hapus File Lama
use File;

class SuratKeluarController extends Controller
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
        $suratkeluar = DB::table('surat_keluar')->orderBy('created_at', 'DESC')->get();

        // Pengalihan Halaman
        return view('suratkeluar.daftar', ['suratkeluar' => $suratkeluar]);
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
        return view('suratkeluar.tambah');
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
            'tujuan' => 'required',
            'isi' => 'required',
            'file' => 'required|mimes:pdf',
        ]);

        // Pengecekan Ukuran File
        if ($request->file('file')->getSize() > 2048 * 1024) {
            // Notifikasi 
            $notifikasi = array(
                'pesan' => 'UKURAN FILE MAKSIMAL 2 MB',
                'alert' => 'error',
            );
            // Pengalihan Halaman
            return redirect()->back()->with($notifikasi);
        }

        // Unggah File
        $fileSurat = time() . '.' . $request->file->extension();
        $request->file->move(public_path('suratkeluar-file'), $fileSurat);

        // Simpan Data Ke Database
        $suratkeluar = new SuratKeluar();
        $suratkeluar->nomor = $request->nomor;
        $suratkeluar->tanggal = $request->tanggal;
        $suratkeluar->perihal = $request->perihal;
        $suratkeluar->tujuan = $request->tujuan;
        $suratkeluar->isi = $request->isi;
        $suratkeluar->file = $fileSurat;
        $suratkeluar->save();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI SIMPAN',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/suratkeluar')->with($notifikasi);
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
        $suratkeluar = DB::table('surat_keluar')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('suratkeluar.detail', ['suratkeluar' => $suratkeluar]);
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
        $suratkeluar = DB::table('surat_keluar')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('suratkeluar.ubah', ['suratkeluar' => $suratkeluar]);
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
            'tujuan' => 'required',
            'isi' => 'required',
            'file' => 'mimes:pdf',
        ]);

        // Model
        $suratkeluar = SuratKeluar::find($id);

        // Fungsi Hapus & Ubah File
        if ($request->has('file')) {
            $path = 'suratkeluar-file/';
            File::delete($path . $suratkeluar->file);

            // Pengecekan Ukuran File
            if ($request->file('file')->getSize() > 2048 * 1024) {
                // Notifikasi 
                $notifikasi = array(
                    'pesan' => 'UKURAN FILE MAKSIMAL 2 MB',
                    'alert' => 'error',
                );
                // Pengalihan Halaman
                return redirect()->back()->with($notifikasi);
            }

            // Unggah File
            $fileSurat = time() . '.' . $request->file->extension();
            $request->file->move(public_path('suratkeluar-file'), $fileSurat);

            $suratkeluar->file = $fileSurat;
            $suratkeluar->save;
        }

        // Simpan Data Ke Database
        $suratkeluar->nomor = $request['nomor'];
        $suratkeluar->tanggal = $request['tanggal'];
        $suratkeluar->perihal = $request['perihal'];
        $suratkeluar->tujuan = $request['tujuan'];
        $suratkeluar->isi = $request['isi'];
        $suratkeluar->save();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI UBAH',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/suratkeluar')->with($notifikasi);
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
        $suratkeluar = SuratKeluar::find($id);

        // Hapus File
        $path = 'suratkeluar-file/';
        File::delete($path . $suratkeluar->file);

        // Hapus Data
        $suratkeluar->delete();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI HAPUS',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/suratkeluar')->with($notifikasi);
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

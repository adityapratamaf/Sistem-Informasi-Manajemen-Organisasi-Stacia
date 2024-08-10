<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

// Hapus File Lama
use File;

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
        $suratmasuk = DB::table('surat_masuk')->orderBy('created_at', 'DESC')->get();

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

        // Pengalihan Halaman TB
        // return redirect('/suratmasuk')->with('success', 'Data Tersimpan');
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
        // ===== Ubah Data =====

        // Ambil Data Berdasarkan ID Yang Di Pilih
        $suratmasuk = DB::table('surat_masuk')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('suratmasuk.ubah', ['suratmasuk' => $suratmasuk]);
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
            'asal' => 'required',
            'isi' => 'required',
            'file' => 'mimes:pdf',
        ]);

        // Model
        $suratmasuk = SuratMasuk::find($id);

        // Fungsi Hapus & Ubah File
        if ($request->has('file')) {
            $path = 'suratmasuk-file/';
            File::delete($path . $suratmasuk->file);

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
            $request->file->move(public_path('suratmasuk-file'), $fileSurat);

            $suratmasuk->file = $fileSurat;
            $suratmasuk->save;
        }

        // Simpan Data Ke Database
        $suratmasuk->nomor = $request['nomor'];
        $suratmasuk->tanggal = $request['tanggal'];
        $suratmasuk->perihal = $request['perihal'];
        $suratmasuk->asal = $request['asal'];
        $suratmasuk->isi = $request['isi'];
        $suratmasuk->save();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI UBAH',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/suratmasuk')->with($notifikasi);
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
        $suratmasuk = SuratMasuk::find($id);

        // Hapus File
        $path = 'suratmasuk-file/';
        File::delete($path . $suratmasuk->file);

        // Hapus Data
        $suratmasuk->delete();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI HAPUS',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/suratmasuk')->with($notifikasi);
    }

    /**
     * Download a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        // ===== Download PDF =====

        // Model
        $suratmasuk = DB::table('surat_masuk')->get();

        // Pengalihan Halaman
        return view('suratmasuk.cetak', ['suratmasuk' => $suratmasuk]);
    }
}

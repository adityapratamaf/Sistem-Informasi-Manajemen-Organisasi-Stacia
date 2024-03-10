<?php

namespace App\Http\Controllers;

use App\Models\Logistik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

// Hapus File Lama 
use File;

class LogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Halaman Index
        $logistik = DB::table('logistik')->get();
        return view('logistik.tampil', ['logistik' => $logistik]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ===== Daftar Data =====

        // Pengalihan Halaman
        return view('logistik.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ===== Tambah Data =====

        // Validasi Jika Tidak Di Isi
        $this->validate($request, [
            'nama' => 'required',
            'nomor' => 'required',
            'merek' => 'required',
            'tahun_pembelian' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
            'pemakaian' => 'required',
            'foto' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        // Unggah File
        $fileFoto   = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('logistik-foto'), $fileFoto);

        // Simpan Data Ke Database
        $logistik = new Logistik;
        $logistik->nama = $request->nama;
        $logistik->nomor = $request->nomor;
        $logistik->merek = $request->merek;
        $logistik->tahun_pembelian = $request->tahun_pembelian;
        $logistik->keterangan = $request->keterangan;
        $logistik->status = $request->status;
        $logistik->pemakaian = $request->pemakaian;
        $logistik->foto = $fileFoto;
        $logistik->save();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI SIMPAN',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/logistik')->with($notifikasi);
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
        $logistik = DB::table('logistik')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('logistik.detail', ['logistik' => $logistik]);
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
        $logistik = DB::table('logistik')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('logistik.ubah', ['logistik' => $logistik]);
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
        // ===== Ubah Data =====

        // Validasi Jika Tidak Di Isi
        $this->validate($request, [
            'nama' => 'required',
            'nomor' => 'required',
            'merek' => 'required',
            'tahun_pembelian' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
            'pemakaian' => 'required',
            'foto' => 'image|mimes:jpg,png,jpeg'
        ]);

        // Model
        $logistik = Logistik::find($id);

        // Fungsi Hapus & Ubah File 
        if ($request->has('foto')) {
            $path = 'logistik-foto/';
            File::delete($path . $logistik->foto);

            // Unggah File
            $fileFoto   = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('logistik-foto'), $fileFoto);

            $logistik->foto = $fileFoto;
            $logistik->save();
        }

        // Simpan Data Ke Database
        $logistik->nama = $request['nama'];
        $logistik->nomor = $request['nomor'];
        $logistik->merek = $request['merek'];
        $logistik->tahun_pembelian = $request['tahun_pembelian'];
        $logistik->keterangan = $request['keterangan'];
        $logistik->status = $request['status'];
        $logistik->pemakaian = $request['pemakaian'];
        $logistik->save();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI UBAH',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/logistik')->with($notifikasi);
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
        $logistik = Logistik::find($id);

        // Hapus File
        $path = 'logistik-foto/';
        File::delete($path . $logistik->foto);

        $logistik->delete();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI HAPUS',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/logistik')->with($notifikasi);
    }
}

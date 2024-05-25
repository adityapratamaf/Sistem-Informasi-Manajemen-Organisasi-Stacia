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
        //  ===== Daftar Data =====

        // Model
        $logistik = DB::table('logistik')->orderBy('created_at', 'DESC')->get();

        // Pengalihan Halaman
        return view('logistik.tampil', ['logistik' => $logistik]);
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
        // ===== Request Tambah Data =====

        // Validasi Jika Form Tidak Di Isi
        $this->validate($request, [
            'nama' => 'required',
            'nomor' => 'required',
            'merek' => 'required',
            'tahun_pembelian' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
            'pemakaian' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
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

        //     // Notifikasi Upload File > 2 MB
        //     } catch (\Illuminate\Validation\ValidationException $e) {
        //     // Tangkap kesalahan validasi dan siapkan pesan notifikasi
        //     $notifikasi = array(
        //         'pesan' => 'Ukuran foto tidak boleh lebih dari 2 MB.',
        //         'alert' => 'danger',
        //     );

        //     return Redirect('/logistik/create')->with($notifikasi);
        // }

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
        // ===== Request Ubah Data =====

        // Validasi Jika Form Tidak Di Isi
        $this->validate($request, [
            'nama' => 'required',
            'nomor' => 'required',
            'merek' => 'required',
            'tahun_pembelian' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
            'pemakaian' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,png|max:2048'
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

        // Hapus Data
        $logistik->delete();

        // Notifikasi
        $notifikasi = array(
            'pesan' => 'DATA BERHASIL DI HAPUS',
            'alert' => 'success',
        );

        // Pengalihan Halaman
        return Redirect('/logistik')->with($notifikasi);
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
        $logistik = DB::table('logistik')->get();

        // Pengalihan Halaman
        return view('logistik.cetak', ['logistik' => $logistik]);
    }
}

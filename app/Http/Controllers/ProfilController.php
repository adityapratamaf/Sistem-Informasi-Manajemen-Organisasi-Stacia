<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Anggota;
use App\Models\User;

// Hapus File Lama 
use File;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil Data Berdasarkan ID Yang Login
        $anggota = Auth::user()->anggota;

        // Pengalihan Halaman
        return view('profil.daftar', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        // Ambil Data Berdasarkan ID Yang Login
        $anggota = Auth::user()->anggota;

        // Pengalihan Halaman
        return view('profil.ubah', compact('anggota'));
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
        // ===== Request Tambah Data =====

        // Temukan Data Anggota & User Terkait
        $anggota = Anggota::find($id);
        $user = User::find($anggota->users_id);

        // Validasi Jika Form Tidak Di Isi
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'alamat' => 'required',
            'telepon' => 'required',
            'pengalaman' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Simpan Data Ke Database User 
        $user->email = $request->input('email');
        // Jika Form Di Isi Maka Menggunakan Data Password Baru, Jika Form Di Isi Maka Menggunakan Data Password Baru
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        // Fungsi Hapus & Ubah File 
        if ($request->hasFile('foto')) {
            $path = 'anggota-foto/';
            File::delete($path . $anggota->foto);

            // Unggah File
            $fileFoto   = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('anggota-foto'), $fileFoto);

            $anggota->foto = $fileFoto;
        }

        // Simpan Data Ke Database Anggota 
        $anggota->alamat = $request->input('alamat');
        $anggota->telepon = $request->input('telepon');
        $anggota->pengalaman = $request->input('pengalaman');
        $anggota->save();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DI SIMPAN',
            'alert' => 'success',
        ];

        // Pengalihan Halaman
        return redirect('/profil')->with($notifikasi);
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

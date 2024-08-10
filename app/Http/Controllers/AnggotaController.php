<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Anggota;

// Hapus File Lama 
use File;

class AnggotaController extends Controller
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
        $anggota = Anggota::with('user')->orderBy('created_at', 'DESC')->get();

        // Pengalihan Halaman
        return view('anggota.daftar', ['anggota' => $anggota]);
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
        return view('anggota.tambah');
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
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required',
            // 'password' => 'required',
            'role' => 'required',
            'status' => 'required',
            'nra' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'pengalaman' => 'required',
            'jenis_anggota' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        // Simpan Data Ke Database User 
        $user = new User();
        $user->nama = $request->input('nama');
        $user->username = $request->input('username');
        // Auto Generate Username By Nama
        // $nama = $request->input('nama');
        // $user->username = strtolower(str_replace(' ', '.', $nama));
        $user->email = $request->input('email');
        // $user->password = bcrypt($request->input('password')); // Password Baru (Non Auto Generate)
        $user->password = bcrypt($request->input('username')); // Auto Generate Password By Username
        $user->role = $request->input('role');
        $user->status = $request->input('status');
        $user->save();

        // Simpan ID User
        $userId = $user->id;

        // Pengecekan Ukuran File
        if ($request->file('foto')->getSize() > 2048 * 1024) {
            // Notifikasi 
            $notifikasi = array(
                'pesan' => 'UKURAN FILE MAKSIMAL 2 MB',
                'alert' => 'error',
            );
            // Pengalihan Halaman
            return redirect()->back()->with($notifikasi);
        }

        // Unggah File
        $fileFoto   = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('anggota-foto'), $fileFoto);

        // Simpan Data Ke Database Anggota 
        $anggota = new Anggota();
        $anggota->users_id = $userId;
        $anggota->nra = $request->input('nra');
        $anggota->tempat_lahir = $request->input('tempat_lahir');
        $anggota->tanggal_lahir = $request->input('tanggal_lahir');
        $anggota->alamat = $request->input('alamat');
        $anggota->telepon = $request->input('telepon');
        $anggota->pengalaman = $request->input('pengalaman');
        $anggota->jenis_anggota = $request->input('jenis_anggota');
        $anggota->foto = $fileFoto;
        $anggota->save();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DI SIMPAN',
            'alert' => 'success',
        ];

        // Pengalihan Halaman
        return redirect('/anggota')->with($notifikasi);
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
        $anggota = Anggota::with('user')->where('id', $id)->first();
        // $anggota = Anggota::with(['user.program'])->where('id', $id)->first();

        // // Pengalihan Halaman
        return view('anggota.detail', compact('anggota'));
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
        $anggota = Anggota::with('user')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('anggota.ubah', ['anggota' => $anggota]);
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
            'nama' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            // 'password' => 'required',
            'role' => 'required',
            'status' => 'required',
            'nra' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'pengalaman' => 'required',
            'jenis_anggota' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,png',
        ]);

        // Simpan Data Ke Database User 
        $user->nama = $request->input('nama');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        // $user->password = bcrypt($request->input('password'));
        // Jika Form Di Isi Maka Menggunakan Data Password Baru, Jika Form Di Isi Maka Menggunakan Data Password Baru
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->role = $request->input('role');
        $user->status = $request->input('status');
        $user->save();

        // Fungsi Hapus & Ubah File 
        if ($request->hasFile('foto')) {
            $path = 'anggota-foto/';
            File::delete($path . $anggota->foto);

            // Pengecekan Ukuran File
            if ($request->file('foto')->getSize() > 2048 * 1024) {
                // Notifikasi 
                $notifikasi = array(
                    'pesan' => 'UKURAN FILE MAKSIMAL 2 MB',
                    'alert' => 'error',
                );
                // Pengalihan Halaman
                return redirect()->back()->with($notifikasi);
            }

            // Unggah File
            $fileFoto   = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('anggota-foto'), $fileFoto);

            $anggota->foto = $fileFoto;
        }

        // Simpan Data Ke Database Anggota 
        $anggota->nra = $request->input('nra');
        $anggota->tempat_lahir = $request->input('tempat_lahir');
        $anggota->tanggal_lahir = $request->input('tanggal_lahir');
        $anggota->alamat = $request->input('alamat');
        $anggota->telepon = $request->input('telepon');
        $anggota->pengalaman = $request->input('pengalaman');
        $anggota->jenis_anggota = $request->input('jenis_anggota');
        $anggota->save();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DI SIMPAN',
            'alert' => 'success',
        ];

        // Pengalihan Halaman
        return redirect('/anggota')->with($notifikasi);
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

        // Temukan Data Anggota & User Terkait
        $anggota = Anggota::find($id);
        $user = User::find($anggota->users_id);

        // Hapus Foto
        $path = 'anggota-foto/';
        File::delete($path . $anggota->foto);

        // Hapus Data Anggota
        $anggota->delete();

        // Hapus Data User
        $user->delete();

        // Notifikasi
        $notifikasi = [
            'pesan' => 'DATA BERHASIL DI HAPUS',
            'alert' => 'success',
        ];

        // Pengalihan Halaman
        return redirect('/anggota')->with($notifikasi);
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
        $anggota = Anggota::with('user')->get();

        // Pengalihan Halaman
        return view('anggota.cetak', ['anggota' => $anggota]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Anggota;
use App\Models\Panitia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

// Hapus File Lama 
use File;

class AnggotaController extends Controller
{

    public function index(Request $request)
    {
        // Model Tunggal
        // $anggota = Anggota::with('user')->orderBy('created_at', 'DESC')->get();

        // Ambil Parameter Pencarian Data Dari Request
        $search         = $request->get('search');
        $status         = $request->get('status');
        $role           = $request->get('role');
        $jenis_anggota  = $request->get('jenis_anggota');

        // Model Jamak & Pencarian
        $anggota = Anggota::with('user')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('nama', 'LIKE', "%{$search}%"); // Pencarian Nama Tabel User
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->whereHas('user', function ($q) use ($status) {
                    $q->where('status', $status); // Filter Status Tabel User
                });
            })
            ->when($role, function ($query) use ($role) {
                $query->whereHas('user', function ($q) use ($role) {
                    $q->where('role', $role); // Filter Role Tabel User
                });
            })
            ->when($jenis_anggota, function ($query) use ($jenis_anggota) {
                $query->where('jenis_anggota', $jenis_anggota);
            })
            ->orderBy('created_at', 'DESC')
            ->get();

        // Pengalihan Halaman
        return view('anggota.daftar', [
            'anggota'   => $anggota,
            'search'    => $search,
            'status'    => $status,
            'role'      => $role,
        ]);
    }

    public function create()
    {
        // ===== Tambah Data =====

        // Pengalihan Halaman
        return view('anggota.tambah');
    }

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

    public function show($id)
    {
        // ===== Detail Data =====

        // Ambil Data Berdasarkan ID Yang Di Pilih
        $anggota = Anggota::with('user')->where('id', $id)->first();
        // $anggota = Anggota::with(['user.program'])->where('id', $id)->first();

        // // Pengalihan Halaman
        return view('anggota.detail', compact('anggota'));
    }

    public function edit($id)
    {
        // ===== Ubah Data =====

        // Ambil Data Berdasarkan ID Yang Di Pilih
        $anggota = Anggota::with('user')->where('id', $id)->first();

        // Pengalihan Halaman
        return view('anggota.ubah', ['anggota' => $anggota]);
    }

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

    public function destroy($id)
    {
        // ===== Hapus Data =====

        // Temukan Data Anggota & User Terkait
        $anggota = Anggota::find($id);
        $user = User::find($anggota->users_id);

        // Cek User Masih Terdaftar Dalam Panitia Program
        $isPanitia = DB::table('panitia')->where('users_id', $anggota->users_id)->exists();

        if ($isPanitia) {
            // Notifikasi
            $notifikasi = [
                'pesan' => 'ANGGOTA MASIH TERDAFTAR PANITIA',
                'alert' => 'error',
            ];

            return redirect('/anggota')->with($notifikasi);
        }

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

    public function download()
    {
        // ===== Download PDF Data =====

        // Model
        $anggota = Anggota::with('user')->get();

        $user = Auth::user();
        $watermarknama = $user->nama;

        $waktu = Carbon::now();
        $watermarkwaktu = $waktu->format('Y-m-d H:i:s');

        // Pengalihan Halaman
        // return view('anggota.cetak', ['anggota' => $anggota, 'watermarknama' => $watermarknama ?? null]);
        return view('anggota.cetak', [
            'anggota' => $anggota,
            'watermarknama' => $watermarknama,
            'watermarkwaktu' => $watermarkwaktu // Menyertakan watermarkwaktu
        ]);
    }

    public function login(User $user)
    {
        Auth::login($user);
        return redirect('/dashboard');
        // return redirect()->route('dashboard.dashboard');

        return redirect()->back()->with('error', 'Unauthorized');
    }
}

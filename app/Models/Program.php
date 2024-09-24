<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'program';

    protected $fillalbel = [
        'nama',
        'deskripsi',
        'jenis',
        'status',
        'tgl_mulai,',
        'tgl_selesai',
        'proposal',
        'lpj',
        'pengurus_id',
        'users_id'
    ];

    // Relasi Ke Tabel Pengurus
    public function pengurus()
    {
        return $this->belongsTo(Pengurus::class, 'pengurus_id');
    }

    // Relasi Ke Tabel Users
    public function user()
    {
        return $this->belongsToMany(User::class, 'panitia', 'program_id', 'users_id');
    }

    // Relasi Ke Tabel Anggota
    public function anggota()
    {
        return $this->belongsToMany(Anggota::class, 'panitia', 'program_id', 'users_id');
    }

    // Relasi Ke Tabel Tugas
    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'nama', 'deskripsi', 'status', 'program_id');
    }

    // Relasi Ke Tabel Laporan
    public function Laporan()
    {
        return $this->hasMany(Laporan::class, 'deskripsi', 'status', 'tgl_mulai', 'tgl_selesai', 'file', 'program_id', 'tugas_id', 'users_id');
    }

    // Role Panitia
    public function panitia()
    {
        return $this->belongsToMany(User::class, 'panitia')->withPivot('role');
    }
}

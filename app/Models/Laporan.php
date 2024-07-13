<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $fillable = ['deskripsi', 'status', 'tgl_mulai', 'tgl_selesai', 'file', 'program_id', 'tugas_id', 'users_id'];

    // Relasi Ke Tabel Program
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    // Relasi Ke Tabel Tugas
    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    // Relasi Ke Tabel User
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

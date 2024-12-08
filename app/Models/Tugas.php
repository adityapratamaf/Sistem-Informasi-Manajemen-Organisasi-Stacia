<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';

    protected $fillable = ['nama', 'deskripsi', 'status', 'users_id', 'program_id'];

    // Relasi Ke Tabel Program
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    // Relasi Ke Tabel Laporan
    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }

    // Relasi Ke Tabel User
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

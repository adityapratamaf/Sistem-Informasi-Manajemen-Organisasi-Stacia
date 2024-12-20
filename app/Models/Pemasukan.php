<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukan';

    protected $fillable = ['nama', 'tanggal', 'jumlah', 'file', 'program_id', 'users_id'];

    // Relasi Ke Tabel Program
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    // Relasi Ke Tabel User
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}

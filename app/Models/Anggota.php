<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';
    // protected $dates = ['tanggal_lahir'];

    protected $fillable = [
        'nra', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'telepon', 'pengalaman', 'jenis_anggota', 'foto', 'users_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

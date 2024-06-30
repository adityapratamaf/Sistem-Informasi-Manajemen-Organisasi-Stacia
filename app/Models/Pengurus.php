<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus';

    protected $fillable = ['tahun_periode'];

    public function program()
    {
        return $this->hasMany(Program::class, 'pengurus_id');
    }
}

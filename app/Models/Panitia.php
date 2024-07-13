<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panitia extends Model
{
    use HasFactory;

    protected $table = 'panitia';

    protected $fillable = ['users_id', 'program_id', 'role'];

    // Role Panitia
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Role Panitia
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

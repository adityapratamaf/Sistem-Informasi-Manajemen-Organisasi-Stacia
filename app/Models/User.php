<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $fillable = ['nama', 'username', 'email', 'password', 'role', 'status'];

    /**
     * The attributes that should be hidden for serialization.
     * php artisan make:controller PostController --resource
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi Ke Tabel Users
    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'users_id');
    }

    // Relasi Ke Tabel Program
    public function program()
    {
        return $this->belongsToMany(Program::class, 'panitia', 'users_id', 'program_id');
    }

    public function program_panitia()
    {
        return $this->belongsToMany(Program::class, 'panitia', 'users_id', 'program_id')
            ->withPivot('role')
            ->wherePivotIn('role', ['Ketua', 'Sekretaris', 'Bendahara', 'Anggota']);
    }

    // Role Panitia
    public function panitia()
    {
        return $this->belongsToMany(Program::class, 'panitia')->withPivot('role');
    }

    // Relasi Ke Tabel Tugas = 1 User Mempunyai Banyak Tugas
    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'nama', 'deskripsi', 'status', 'users_id');
    }
}

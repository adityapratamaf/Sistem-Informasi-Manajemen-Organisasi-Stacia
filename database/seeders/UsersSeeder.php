<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@stacia.org',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'role' => '1',
            'status' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

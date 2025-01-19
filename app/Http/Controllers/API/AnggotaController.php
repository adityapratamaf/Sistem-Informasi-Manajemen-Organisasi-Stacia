<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    // Menampilkan semua anggota
    public function index()
    {
        $anggota = Anggota::all();
        return response()->json($anggota);
    }

    // Menampilkan anggota berdasarkan ID
    public function show($id)
    {
        $anggota = Anggota::find($id);

        if (!$anggota) {
            return response()->json(['message' => 'Anggota not found'], 404);
        }

        return response()->json($anggota);
    }

    // Menghapus anggota
    public function destroy($id)
    {
        $anggota = Anggota::find($id);

        if (!$anggota) {
            return response()->json(['message' => 'Anggota not found'], 404);
        }

        $anggota->delete();
        return response()->json(['message' => 'Anggota deleted']);
    }
}

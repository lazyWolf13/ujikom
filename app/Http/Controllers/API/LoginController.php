<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari petugas berdasarkan username
        $petugas = Petugas::where('username', $request->username)->first();

        // Cek apakah username ditemukan dan password sesuai
        if (!$petugas || !Hash::check($request->password, $petugas->password)) {
            return response()->json([
                'message' => 'Login gagal. Username atau password salah.',
            ], 401);
        }

        // Hapus token yang sudah ada untuk user ini (opsional, jika Anda ingin satu sesi per pengguna)
        $petugas->tokens()->delete();

        // Buat token baru untuk pengguna
        $token = $petugas->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil.',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $petugas
        ]);
    }

    public function logout(Request $request)
    {
        // Hapus token saat ini
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil.'
        ]);
    }
}
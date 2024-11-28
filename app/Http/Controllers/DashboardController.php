<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $petugas = Auth::user(); // Mengambil data petugas yang sedang login

        // Pastikan petugas memiliki data petugas_id
        if (!$petugas) {
            return redirect()->route('login')->withErrors(['error' => 'Anda belum login sebagai petugas']);
        }

        return view('dashboard', compact('petugas')); // Kirim data petugas ke halaman dashboard
    }
}
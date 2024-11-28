<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    public function index()
    {
        // Menampilkan daftar petugas
        $petugas = Petugas::all();
        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
        // Menampilkan form tambah petugas
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Menyimpan petugas baru
        Petugas::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Menampilkan form edit petugas
        $petugas = Petugas::findOrFail($id);
        return view('petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $petugas = Petugas::findOrFail($id);
        $petugas->username = $request->username;

        if ($request->filled('password')) {
            $petugas->password = Hash::make($request->password);
        }

        $petugas->save();

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Menghapus petugas
        Petugas::findOrFail($id)->delete();

        // Mengatur ulang auto increment agar ID baru mengikuti ID terakhir
        $lastId = Petugas::max('id');  // Ambil ID terakhir dari data yang ada
        $newAutoIncrement = $lastId ? $lastId + 1 : 1;

        // Reset auto increment pada tabel petugas
        DB::statement("ALTER TABLE petugas AUTO_INCREMENT = {$newAutoIncrement}");

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus');
    }
}
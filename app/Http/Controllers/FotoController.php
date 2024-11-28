<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FotoController extends Controller
{
    public function index()
    {
        $fotos = Foto::with('galery')->get();
        return view('foto.index', compact('fotos'));
    }

    public function create()
    {
        $galeries = Galery::all(); // Fetch all galeries
        return view('foto.create', compact('galeries'));
    }

    public function store(Request $request)
{
    // Validasi input dari form
    $request->validate([
        'galery_id' => 'required|exists:galery,id',
        'judul' => 'required|string|max:255',
        'file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Membuat instansi baru Foto
    $foto = new Foto();
    $foto->galery_id = $request->galery_id;
    $foto->judul = $request->judul;

    // Menyimpan file jika ada
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('photos', 'public');
        $foto->file = $filePath;
    }

    // Simpan data foto
    $foto->save();

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('foto.index')->with('success', 'Foto berhasil disimpan!');
}



    public function show(Foto $foto)
    {
        return view('foto.show', compact('foto'));
    }

    public function edit(Foto $foto)
    {
        $galeries = Galery::all();
        return view('foto.edit', compact('foto', 'galeries'));
    }

    public function update(Request $request, Foto $foto)
{
    $request->validate([
        'galery_id' => 'required|exists:galery,id',
        'judul' => 'required|string|max:255',
        'file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $foto->galery_id = $request->galery_id;
    $foto->judul = $request->judul;

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('photos', 'public');
        $foto->file = $filePath;
    }

    $foto->save();

    return redirect()->route('foto.index')->with('success', 'Foto berhasil diperbarui!');
}

private function resetAutoIncrement()
{
    // Ambil ID terakhir yang ada setelah penghapusan
    $lastId = Foto::max('id');
    
    // Jika ada ID terakhir, reset AUTO_INCREMENT untuk mengikuti ID terakhir
    $newAutoIncrement = $lastId ? $lastId + 1 : 1;

    // Reset auto increment pada tabel foto
    DB::statement("ALTER TABLE foto AUTO_INCREMENT = {$newAutoIncrement}");
}

public function destroy($id)
{
    // Menghapus foto berdasarkan ID
    $foto = Foto::findOrFail($id);
    $foto->delete();

    // Reset auto increment
    $this->resetAutoIncrement();

    return redirect()->route('foto.index')->with('success', 'Foto berhasil dihapus');
}
}
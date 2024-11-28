<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Kategori::all();
        return view('kategori.index', compact('categories'));
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('kategori.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Menampilkan form edit kategori
    public function edit($id)
    {
        $category = Kategori::findOrFail($id);
        return view('kategori.edit', compact('category'));
    }

    // Mengupdate kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        $category = Kategori::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $category = Kategori::findOrFail($id);
        $category->delete();

        // Mengatur ulang AUTO_INCREMENT setelah penghapusan
        $this->resetAutoIncrement();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }

    // Fungsi untuk mengatur ulang AUTO_INCREMENT
    private function resetAutoIncrement()
    {
        // Ambil ID terakhir yang ada setelah penghapusan
        $lastId = Kategori::max('id');
        
        // Jika ada ID terakhir, reset AUTO_INCREMENT untuk mengikuti ID terakhir
        $newAutoIncrement = $lastId ? $lastId + 1 : 1;

        // Reset auto increment pada tabel kategori
        DB::statement("ALTER TABLE kategori AUTO_INCREMENT = {$newAutoIncrement}");
    }
}
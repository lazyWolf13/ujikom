<?php declare(strict_types=1); 

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Fungsi untuk menampilkan form tambah post
    public function create()
    {
        $kategori = Kategori::all();  // Ambil semua kategori
        return view('posts.create', compact('kategori'));  // Kirim data kategori ke form
    }

    // Fungsi untuk menyimpan post
    public function store(Request $request)
{
    // Ambil petugas_id dari pengguna yang sedang login
    $petugas_id = auth()->user()->id;

    // Validasi data yang diterima
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategori,id',
        'isi' => 'required|string',
        'status' => 'required|string|in:draft,published,archived',
    ]);

    // Menambahkan petugas_id sebelum menyimpan
    $validated['petugas_id'] = $petugas_id;

    // Simpan data post baru ke database
    Post::create($validated);

    // Redirect setelah berhasil menambah post
    return redirect()->route('posts.index')->with('success', 'Post berhasil dibuat');
}

    // Fungsi untuk menampilkan daftar post
    public function index(Request $request)
    {
        $query = Post::query();
        
        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $posts = $query->with(['kategori', 'petugas'])->get();
        
        return view('posts.index', compact('posts'));
    }

    // Fungsi untuk mengedit post
    public function edit(Post $post)
    {
        $kategori = Kategori::all(); // Ambil semua kategori
        return view('posts.edit', compact('post', 'kategori')); // Kirim data post dan kategori ke form
    }

    // Fungsi untuk memperbarui post
    public function update(Request $request, Post $post)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required|string',
            'status' => 'required|string|in:draft,published,archived',
        ]);

        // Update data post
        $post->update($validated);

        // Redirect setelah berhasil memperbarui post
        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui');
    }

    // Fungsi untuk menghapus post
    public function destroy(Post $post)
    {
        // Hapus post dari database
        $post->delete();

        // Redirect setelah berhasil menghapus post
        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus');
    }
    
    // PostController.php
public function informasiTerkini()
{
    $informasiPosts = Post::whereHas('kategori', function($query) {
        $query->where('judul', 'Informasi Terkini');
    })
    ->with(['galery.fotos'])  // Menambahkan galeri dan foto terkait
    ->get();

    return view('informasi-terkini', compact('informasiPosts'));
}

}
<?php declare(strict_types=1); 

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Foto;
use App\Models\Profile; // Tambahkan Profile model
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
{
    // Ambil informasi dari tabel Post
    $informasiPosts = Post::with('kategori')
        ->whereHas('kategori', function ($query) {
            $query->where('judul', 'Informasi Terkini');
        })
        ->where('status', 'published')
        ->get();

    // Ambil agenda dari tabel Post
    $agendaPosts = Post::with('kategori')
        ->whereHas('kategori', function ($query) {
            $query->where('judul', 'Agenda Sekolah');
        })
        ->where('status', 'published')
        ->get();

    // Ambil data galeri
    $galeries = Foto::with(['galery.post' => function ($query) {
        $query->where('status', 'published');
    }])
    ->get()
    ->groupBy('galery.post.judul');

    // Ambil data profile
    $profiles = Profile::all();  // Mengambil semua data profile

    // Kirim data ke view
    return view('welcome', compact('informasiPosts', 'agendaPosts', 'galeries', 'profiles'));
}

}
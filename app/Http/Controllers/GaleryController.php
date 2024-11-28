<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GaleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Galery::query();
        
        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $galeries = $query->with('post')->get();
        
        return view('galery.index', compact('galeries'));
    }

    public function create()
    {
        $posts = Post::all(); // Fetch all posts
        return view('galery.create', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'position' => 'required|integer',
            'status' => 'required|in:active,inactive',
        ]);

        Galery::create([
            'post_id' => $request->post_id,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        return redirect()->route('galery.index')->with('success', 'Galery created successfully!');
    }

public function edit($id)
{
    $galery = Galery::findOrFail($id);
    $posts = Post::all();
    return view('galery.edit', compact('galery', 'posts'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'post_id' => 'required|exists:posts,id',
        'position' => 'required|integer',
        'status' => 'required|in:active,inactive',
    ]);

    $galery = Galery::findOrFail($id);
    $galery->update([
        'post_id' => $request->post_id,
        'position' => $request->position,
        'status' => $request->status,
    ]);

    return redirect()->route('galery.index')->with('success', 'Galery updated successfully!');
}

private function resetAutoIncrement()
{
    // Ambil ID terakhir yang ada setelah penghapusan
    $lastId = Galery::max('id');
    
    // Jika ada ID terakhir, reset AUTO_INCREMENT untuk mengikuti ID terakhir
    $newAutoIncrement = $lastId ? $lastId + 1 : 1;

    // Reset auto increment pada tabel galery
    DB::statement("ALTER TABLE galery AUTO_INCREMENT = {$newAutoIncrement}");
}

public function destroy($id)
{
    // Menghapus galeri berdasarkan ID
    $galery = Galery::findOrFail($id);
    $galery->delete();

    // Reset auto increment
    $this->resetAutoIncrement();

    return redirect()->route('galery.index')->with('success', 'Galeri berhasil dihapus');
}


}
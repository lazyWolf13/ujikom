<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['kategori', 'petugas'])->get();
        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required|string',
            'petugas_id' => 'required|exists:petugas,id',
            'status' => 'required|in:draft,published,archived'
        ]);

        $post = Post::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'petugas_id' => $request->petugas_id,
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil ditambahkan',
            'data' => $post->load(['kategori', 'petugas'])
        ], 201);
    }

    public function show($id)
    {
        $post = Post::with(['kategori', 'petugas'])->find($id);
        
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required|string',
            'petugas_id' => 'required|exists:petugas,id',
            'status' => 'required|in:draft,published,archived'
        ]);

        $post->update([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'petugas_id' => $request->petugas_id,
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil diperbarui',
            'data' => $post->load(['kategori', 'petugas'])
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post tidak ditemukan'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dihapus'
        ]);
    }

    public function getByStatus($status)
    {
        $posts = Post::with(['kategori', 'petugas'])
                    ->where('status', $status)
                    ->get();

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    public function getByKategori($kategori_id)
    {
        $posts = Post::with(['kategori', 'petugas'])
                    ->where('kategori_id', $kategori_id)
                    ->get();

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }
} 
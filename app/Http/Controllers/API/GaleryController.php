<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    public function index()
    {
        $galeries = Galery::with('post')
                         ->orderBy('position', 'asc')
                         ->get();
        return response()->json([
            'success' => true,
            'data' => $galeries
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'position' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive'
        ]);

        // Cek apakah posisi sudah digunakan
        $existingPosition = Galery::where('position', $request->position)->first();
        if ($existingPosition) {
            // Geser posisi yang ada ke bawah
            Galery::where('position', '>=', $request->position)
                  ->increment('position');
        }

        $galery = Galery::create([
            'post_id' => $request->post_id,
            'position' => $request->position,
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil ditambahkan',
            'data' => $galery->load('post')
        ], 201);
    }

    public function show($id)
    {
        $galery = Galery::with('post')->find($id);
        
        if (!$galery) {
            return response()->json([
                'success' => false,
                'message' => 'Galeri tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $galery
        ]);
    }

    public function update(Request $request, $id)
    {
        $galery = Galery::find($id);

        if (!$galery) {
            return response()->json([
                'success' => false,
                'message' => 'Galeri tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'position' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive'
        ]);

        // Jika posisi berubah
        if ($request->position != $galery->position) {
            // Geser posisi yang ada
            if ($request->position > $galery->position) {
                Galery::whereBetween('position', [$galery->position + 1, $request->position])
                      ->decrement('position');
            } else {
                Galery::whereBetween('position', [$request->position, $galery->position - 1])
                      ->increment('position');
            }
        }

        $galery->update([
            'post_id' => $request->post_id,
            'position' => $request->position,
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil diperbarui',
            'data' => $galery->load('post')
        ]);
    }

    public function destroy($id)
    {
        $galery = Galery::find($id);

        if (!$galery) {
            return response()->json([
                'success' => false,
                'message' => 'Galeri tidak ditemukan'
            ], 404);
        }

        // Sesuaikan posisi setelah penghapusan
        Galery::where('position', '>', $galery->position)
              ->decrement('position');

        $galery->delete();

        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil dihapus'
        ]);
    }

    public function getByStatus($status)
    {
        $galeries = Galery::with('post')
                         ->where('status', $status)
                         ->orderBy('position', 'asc')
                         ->get();

        return response()->json([
            'success' => true,
            'data' => $galeries
        ]);
    }

    public function getByPost($post_id)
    {
        $galeries = Galery::with('post')
                         ->where('post_id', $post_id)
                         ->orderBy('position', 'asc')
                         ->get();

        return response()->json([
            'success' => true,
            'data' => $galeries
        ]);
    }
} 
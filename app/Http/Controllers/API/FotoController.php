<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function index()
    {
        $fotos = Foto::with('galery')->get();
        return response()->json([
            'success' => true,
            'data' => $fotos
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'galery_id' => 'required|exists:galery,id',
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'judul' => 'required|string|max:255'
        ]);

        // Upload file
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/fotos', $fileName);

        $foto = Foto::create([
            'galery_id' => $request->galery_id,
            'file' => $fileName,
            'judul' => $request->judul
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil ditambahkan',
            'data' => $foto->load('galery')
        ], 201);
    }

    public function show($id)
    {
        $foto = Foto::with('galery')->find($id);
        
        if (!$foto) {
            return response()->json([
                'success' => false,
                'message' => 'Foto tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $foto
        ]);
    }

    public function update(Request $request, $id)
    {
        $foto = Foto::find($id);

        if (!$foto) {
            return response()->json([
                'success' => false,
                'message' => 'Foto tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'galery_id' => 'required|exists:galery,id',
            'file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'judul' => 'required|string|max:255'
        ]);

        $updateData = [
            'galery_id' => $request->galery_id,
            'judul' => $request->judul
        ];

        // Jika ada file baru
        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::delete('public/fotos/' . $foto->file);

            // Upload file baru
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/fotos', $fileName);
            
            $updateData['file'] = $fileName;
        }

        $foto->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diperbarui',
            'data' => $foto->load('galery')
        ]);
    }

    public function destroy($id)
    {
        $foto = Foto::find($id);

        if (!$foto) {
            return response()->json([
                'success' => false,
                'message' => 'Foto tidak ditemukan'
            ], 404);
        }

        // Hapus file
        Storage::delete('public/fotos/' . $foto->file);
        
        $foto->delete();

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil dihapus'
        ]);
    }

    public function getByGalery($galery_id)
    {
        $fotos = Foto::with('galery')
                    ->where('galery_id', $galery_id)
                    ->get();

        return response()->json([
            'success' => true,
            'data' => $fotos
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        
        $fotos = Foto::with('galery')
                    ->where('judul', 'like', "%{$query}%")
                    ->get();

        return response()->json([
            'success' => true,
            'data' => $fotos
        ]);
    }
} 
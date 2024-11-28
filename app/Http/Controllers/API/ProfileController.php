<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return response()->json([
            'success' => true,
            'data' => $profiles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string'
        ]);

        $profile = Profile::create([
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil ditambahkan',
            'data' => $profile
        ], 201);
    }

    public function show($id)
    {
        $profile = Profile::find($id);
        
        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $profile
        ]);
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string'
        ]);

        $profile->update([
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil diperbarui',
            'data' => $profile
        ]);
    }

    public function destroy($id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile tidak ditemukan'
            ], 404);
        }

        $profile->delete();

        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil dihapus'
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        
        $profiles = Profile::where('judul', 'like', "%{$query}%")
                         ->orWhere('isi', 'like', "%{$query}%")
                         ->get();

        return response()->json([
            'success' => true,
            'data' => $profiles
        ]);
    }
}
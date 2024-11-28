<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::all();
        return response()->json([
            'success' => true,
            'data' => $petugas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:petugas',
            'password' => 'required'
        ]);

        $petugas = Petugas::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data petugas berhasil ditambahkan',
            'data' => $petugas
        ], 201);
    }

    public function show($id)
    {
        $petugas = Petugas::find($id);
        
        if (!$petugas) {
            return response()->json([
                'success' => false,
                'message' => 'Data petugas tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $petugas
        ]);
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::find($id);

        if (!$petugas) {
            return response()->json([
                'success' => false,
                'message' => 'Data petugas tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'username' => 'required|unique:petugas,username,'.$id,
            'password' => 'sometimes'
        ]);

        $petugas->username = $request->username;
        if ($request->password) {
            $petugas->password = Hash::make($request->password);
        }
        $petugas->save();

        return response()->json([
            'success' => true,
            'message' => 'Data petugas berhasil diperbarui',
            'data' => $petugas
        ]);
    }

    public function destroy($id)
    {
        $petugas = Petugas::find($id);

        if (!$petugas) {
            return response()->json([
                'success' => false,
                'message' => 'Data petugas tidak ditemukan'
            ], 404);
        }

        $petugas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data petugas berhasil dihapus'
        ]);
    }
}
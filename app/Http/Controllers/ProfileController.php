<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    // Display all profiles
    public function index()
    {
        $profiles = Profile::all();
        return view('profile.index', compact('profiles'));
    }

    // Show the form to create a new profile
    public function create()
    {
        return view('profile.create');
    }

    // Store a new profile in the database
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        Profile::create($request->all());

        return redirect()->route('profile.index')->with('success', 'Profile created successfully');
    }

    // Display a single profile
    public function show($id)
    {
        $profile = Profile::findOrFail($id);
        return view('profile.show', compact('profile'));
    }

    // Edit a profile
    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('profile.edit', compact('profile'));
    }

    // Update a profile
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $profile = Profile::findOrFail($id);
        $profile->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    }

    // Delete a profile
    public function destroy($id)
    {
        // Menghapus profil berdasarkan ID
        $profile = Profile::findOrFail($id);
        $profile->delete();

        // Mengatur ulang auto increment agar ID baru mengikuti ID terakhir
        $lastId = Profile::max('id');  // Ambil ID terakhir dari data yang ada
        $newAutoIncrement = $lastId ? $lastId + 1 : 1;

        // Reset auto increment pada tabel profile
        DB::statement("ALTER TABLE profile AUTO_INCREMENT = {$newAutoIncrement}");

        // Redirect ke halaman index profile dengan pesan sukses
        return redirect()->route('profile.index')->with('success', 'Profile berhasil dihapus');
    }
}
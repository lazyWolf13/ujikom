<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\ProfileController;
use App\Models\Profile;
use App\Models\Foto;
use App\Models\Galery;
use App\Models\Post;

// Route untuk halaman depan
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

// Route untuk login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->middleware('auth')->name('dashboard.stats');

// Route untuk kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

// Route untuk galeri
Route::get('/galery', [GaleryController::class, 'index'])->name('galery.index');
Route::get('/galery/create', [GaleryController::class, 'create'])->name('galery.create');
Route::post('/galery', [GaleryController::class, 'store'])->name('galery.store');
Route::get('/galery/{id}/edit', [GaleryController::class, 'edit'])->name('galery.edit');
Route::put('/galery/{id}', [GaleryController::class, 'update'])->name('galery.update');
Route::delete('/galery/{id}', [GaleryController::class, 'destroy'])->name('galery.destroy');

// Route untuk posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Route untuk petugas
Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');
Route::get('/petugas/{id}/edit', [PetugasController::class, 'edit'])->name('petugas.edit');
Route::put('/petugas/{id}', [PetugasController::class, 'update'])->name('petugas.update');
Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');

// Route untuk foto
Route::get('/foto', [FotoController::class, 'index'])->name('foto.index');
Route::get('/foto/create', [FotoController::class, 'create'])->name('foto.create');
Route::post('/foto', [FotoController::class, 'store'])->name('foto.store');
Route::get('/foto/{foto}/edit', [FotoController::class, 'edit'])->name('foto.edit');
Route::put('/foto/{foto}', [FotoController::class, 'update'])->name('foto.update');
Route::delete('/foto/{foto}', [FotoController::class, 'destroy'])->name('foto.destroy');

// route profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('profile/{profile}', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Route untuk detail galeri
Route::get('/galeri/{post}', function (Post $post) {
    $post->load(['galery' => function($query) {
        $query->where('status', 'active');
    }, 'galery.fotos']);
    
    return view('galeri.show', compact('post'));
});

// Hapus atau comment route ini
// Route::get('/tentang', function () {
//     $profiles = Profile::all();
//     return view('tentang', compact('profiles'));
// });
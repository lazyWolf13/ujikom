<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\PetugasController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\GaleryController;
use App\Http\Controllers\API\FotoController;
use App\Http\Controllers\API\ProfileController;

Route::get('/petugas', function (Request $request) {
    return $request->petugas();
});

Route::get('/login', function (Request $request) {
    return response()->json([
        'message' => 'API terhubung!',
        'status' => 'success'
    ]);
});
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('petugas')->group(function () {
    Route::get('/', [PetugasController::class, 'index']);
    Route::post('/', [PetugasController::class, 'store']);
    Route::get('/{id}', [PetugasController::class, 'show']);
    Route::put('/{id}', [PetugasController::class, 'update']);
    Route::delete('/{id}', [PetugasController::class, 'destroy']);
});

Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index']);
    Route::post('/', [KategoriController::class, 'store']);
    Route::get('/{id}', [KategoriController::class, 'show']);
    Route::put('/{id}', [KategoriController::class, 'update']);
    Route::delete('/{id}', [KategoriController::class, 'destroy']);
});

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::post('/', [PostController::class, 'store']);
    Route::get('/{id}', [PostController::class, 'show']);
    Route::put('/{id}', [PostController::class, 'update']);
    Route::delete('/{id}', [PostController::class, 'destroy']);
    Route::get('/status/{status}', [PostController::class, 'getByStatus']);
    Route::get('/kategori/{kategori_id}', [PostController::class, 'getByKategori']);
});

Route::prefix('galery')->group(function () {
    Route::get('/', [GaleryController::class, 'index']);
    Route::post('/', [GaleryController::class, 'store']);
    Route::get('/{id}', [GaleryController::class, 'show']);
    Route::put('/{id}', [GaleryController::class, 'update']);
    Route::delete('/{id}', [GaleryController::class, 'destroy']);
    Route::get('/status/{status}', [GaleryController::class, 'getByStatus']);
    Route::get('/post/{post_id}', [GaleryController::class, 'getByPost']);
});

Route::prefix('foto')->group(function () {
    Route::get('/', [FotoController::class, 'index']);
    Route::post('/', [FotoController::class, 'store']);
    Route::get('/{id}', [FotoController::class, 'show']);
    Route::post('/{id}', [FotoController::class, 'update']);
    Route::delete('/{id}', [FotoController::class, 'destroy']);
    Route::get('/galery/{galery_id}', [FotoController::class, 'getByGalery']);
    Route::get('/search/query', [FotoController::class, 'search']);
});

Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index']);
    Route::post('/', [ProfileController::class, 'store']);
    Route::get('/{id}', [ProfileController::class, 'show']);
    Route::put('/{id}', [ProfileController::class, 'update']);
    Route::delete('/{id}', [ProfileController::class, 'destroy']);
});
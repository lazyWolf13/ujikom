<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'galery';

    // Tentukan kolom yang boleh diisi
    protected $fillable = ['post_id', 'position', 'status'];

    // Relasi ke tabel Post (many-to-one)
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relasi ke tabel Foto (one-to-many)
    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
}
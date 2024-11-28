<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = ['judul', 'kategori_id', 'isi', 'petugas_id', 'status'];

    // Relasi dengan kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Relasi dengan petugas
    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    // Relasi dengan galery
    public function galery()
    {
        return $this->hasMany(Galery::class);
    }
}
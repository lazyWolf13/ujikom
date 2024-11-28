<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = ['judul'];

    // Relasi ke tabel Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
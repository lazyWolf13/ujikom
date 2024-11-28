<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            $table->text('isi');
            $table->foreignId('petugas_id')->constrained('petugas')->onDelete('cascade');
            $table->enum('status', ['draft', 'published', 'archived']);
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
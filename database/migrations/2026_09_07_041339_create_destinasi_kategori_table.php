<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destinasi_kategori', function (Blueprint $table) {
            $table->unsignedBigInteger('id_destinasi');
            $table->unsignedBigInteger('id_kategori');
            $table->primary(['id_destinasi', 'id_kategori']);
            $table->foreign('id_destinasi')->references('id_destinasi')->on('destinasi');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasi_kategori');
    }
};

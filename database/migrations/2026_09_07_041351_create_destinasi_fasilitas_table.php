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
        Schema::create('destinasi_fasilitas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_destinasi');
            $table->unsignedBigInteger('id_fasilitas');
            $table->primary(['id_destinasi', 'id_fasilitas']);
            $table->foreign('id_destinasi')->references('id_destinasi')->on('destinasi');
            $table->foreign('id_fasilitas')->references('id_fasilitas')->on('fasilitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasi_fasilitas');
    }
};

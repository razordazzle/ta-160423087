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
        Schema::create('pencarian_fasilitas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pencarian');
            $table->unsignedBigInteger('id_fasilitas');
            $table->primary(['id_pencarian','id_fasilitas']);
            $table->foreign('id_pencarian')->references('id_pencarian')->on('pencarian');
            $table->foreign('id_fasilitas')->references('id_fasilitas')->on('fasilitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencarian_fasilitas');
    }
};

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
        Schema::create('perbandingan_berpasangan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pencarian');
            $table->unsignedBigInteger('id_kriteria_baris');
            $table->unsignedBigInteger('id_kriteria_kolom');
            $table->float('nilai');
            $table->primary(['id_pencarian','id_kriteria_baris','id_kriteria_kolom']);
            $table->foreign('id_pencarian')->references('id_pencarian')->on('pencarian');
            $table->foreign('id_kriteria_baris')->references('id_kriteria')->on('kriteria');
            $table->foreign('id_kriteria_kolom')->references('id_kriteria')->on('kriteria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbandingan_berpasangan');
    }
};

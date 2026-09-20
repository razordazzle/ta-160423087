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
        Schema::create('hasil_rekomendasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pencarian');
            $table->unsignedBigInteger('id_destinasi');
            $table->float('nilai_preferensi');
            $table->primary(['id_pencarian','id_destinasi']);
            $table->foreign('id_pencarian')->references('id_pencarian')->on('pencarian');
            $table->foreign('id_destinasi')->references('id_destinasi')->on('destinasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_rekomendasi');
    }
};

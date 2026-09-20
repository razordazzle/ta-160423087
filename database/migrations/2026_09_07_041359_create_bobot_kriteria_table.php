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
        Schema::create('bobot_kriteria', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pencarian');
            $table->unsignedBigInteger('id_kriteria');
            $table->float('nilai_bobot');
            $table->primary(['id_pencarian', 'id_kriteria']);
            $table->foreign('id_pencarian')->references('id_pencarian')->on('pencarian');
            $table->foreign('id_kriteria')->references('id_kriteria')->on('kriteria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot_kriteria');
    }
};

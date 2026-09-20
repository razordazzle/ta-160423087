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
        Schema::create('pencarian', function (Blueprint $table) {
            $table->id('id_pencarian');
            $table->string('lokasi_awal');
            $table->float('latitude_awal');
            $table->float('longitude_awal');
            $table->dateTime('waktu_pencarian')->useCurrent();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencarian');
    }
};

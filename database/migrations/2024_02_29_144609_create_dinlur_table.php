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
        Schema::create('dinlurs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_absen')->default('dinlur');
            $table->string('tanggal');
            $table->time('jam_datang');
            $table->time('jam_pulang');
            $table->enum('Keterangan', ['Hadir']);
            $table->enum('Status', ['Tepat Waktu']);
            $table->string('latitude');
            $table->string('longitude');
            $table->string('file');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('periode_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('periode_id')->references('id')->on('periode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dinlur');
    }
};

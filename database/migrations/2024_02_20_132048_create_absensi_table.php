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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->time('jam_datang')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->date('tanggal');
            $table->enum('Keterangan', ['Hadir', 'Izin', 'Cuti'])->nullable();
            $table->string('lama_izin')->nullable();
            $table->string('lama_cuti')->nullable();
            $table->string('file')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};

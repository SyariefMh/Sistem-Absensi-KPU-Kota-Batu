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
        Schema::create('cutis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_absen')->default('cuti');
            $table->string('tanggal');
            $table->string('tanggal_awal');
            $table->string('tanggal_akhir');
            $table->time('jam_datang')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->enum('Keterangan', ['Tidak Hadir']);
            $table->enum('Status', ['Cuti']);
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
        Schema::dropIfExists('cuti');
    }
};

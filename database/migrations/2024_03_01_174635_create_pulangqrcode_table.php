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
        Schema::create('pulangqrcode', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->time('jam_datang')->nullable();
            $table->time('jam_pulang');
            $table->enum('Keterangan', ['Hadir']);
            $table->unsignedBigInteger('qrcode_id');
            $table->timestamps();
            $table->foreign('qrcode_id')->references('id')->on('qrcode_gens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pulangqrcode');
    }
};

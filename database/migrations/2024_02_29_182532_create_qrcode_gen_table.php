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
        Schema::create('qrcode_gens', function (Blueprint $table) {
            $table->id();
            $table->string('qrcode_datang');
            $table->string('qrcode_pulang')->nullable();
            $table->string('qrcodefilesDtg');
            $table->string('qrcodefilesPlg')->nullable();
            $table->date('tanggal');
            $table->date('tanggal_kirimDtg');
            $table->date('tanggal_kirimPlg')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: Not Active, 1: Active');
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
        Schema::dropIfExists('qrcode_gen');
    }
};

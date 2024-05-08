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
        Schema::create('nilai_b', function (Blueprint $table) {
            $table->id();
            $table->string('kriteria1_B');
            $table->string('kriteria2_B');
            $table->string('kriteria3_B');
            $table->string('kriteria4_B');
            $table->string('kriteria5_B');
            $table->integer('nilai1_B');
            $table->integer('nilai2_B');
            $table->integer('nilai3_B');
            $table->integer('nilai4_B');
            $table->integer('nilai5_B');
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
        Schema::dropIfExists('nilai_b');
    }
};

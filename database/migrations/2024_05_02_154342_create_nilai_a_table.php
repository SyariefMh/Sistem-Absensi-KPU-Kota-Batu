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
        Schema::create('nilai_a', function (Blueprint $table) {
            $table->id();
            $table->string('kriteria1_A');
            $table->string('kriteria2_A');
            $table->string('kriteria3_A');
            $table->string('kriteria4_A');
            $table->integer('nilai1_A');
            $table->integer('nilai2_A');
            $table->integer('nilai3_A');
            $table->integer('nilai4_A');
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
            $table->string('kriteria1_C');
            $table->string('kriteria2_C');
            $table->string('kriteria3_C');
            $table->string('kriteria4_C');
            $table->string('kriteria5_C');
            $table->integer('nilai1_C');
            $table->integer('nilai2_C');
            $table->integer('nilai3_C');
            $table->integer('nilai4_C');
            $table->integer('nilai5_C');
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
        Schema::dropIfExists('nilai_a');
    }
};

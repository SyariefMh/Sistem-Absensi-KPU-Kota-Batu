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
        Schema::create('nilai_c', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('nilai_c');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avg_perbandingan_kriterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kriteria_id1');
            $table->foreign('kriteria_id1')->references('id')->on('kriterias')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('kriteria_id2');
            $table->foreign('kriteria_id2')->references('id')->on('kriterias')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('avg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avg_perbandingan_kriterias');
    }
};

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
        Schema::create('avg_perbandingan_subkriterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subkriteria_id1');
            $table->foreign('subkriteria_id1')->references('id')->on('sub_kriterias')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('subkriteria_id2');
            $table->foreign('subkriteria_id2')->references('id')->on('sub_kriterias')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('avg_perbandingan_subkriterias');
    }
};

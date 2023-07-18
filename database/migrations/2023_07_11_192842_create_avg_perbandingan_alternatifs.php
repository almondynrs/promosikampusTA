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
        Schema::create('avg_perbandingan_alternatifs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alternatif_id1');
            $table->foreign('alternatif_id1')->references('id')->on('alternatifs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('alternatif_id2');
            $table->foreign('alternatif_id2')->references('id')->on('alternatifs')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('avg_perbandingan_alternatifs');
    }
};

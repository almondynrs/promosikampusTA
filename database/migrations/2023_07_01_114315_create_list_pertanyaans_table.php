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
        Schema::create('list_pertanyaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul_pertanyaan');
            $table->unsignedBigInteger('id_jenis_quisioner');

            $table->foreign('id_jenis_quisioner')->references('id')->on('jenis_quisioners')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('list_pertanyaans');
    }
};

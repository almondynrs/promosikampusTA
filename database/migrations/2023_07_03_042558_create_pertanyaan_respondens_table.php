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
        Schema::create('pertanyaan_respondens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_responden');
            $table->unsignedBigInteger('quisioner');
            $table->unsignedBigInteger('id_list');
            $table->unsignedBigInteger('k1')->default(0);
            $table->unsignedBigInteger('k2')->default(0);
            $table->unsignedBigInteger('s1')->default(0);
            $table->unsignedBigInteger('s2')->default(0);
            $table->unsignedBigInteger('a1')->default(0);
            $table->unsignedBigInteger('a2')->default(0);
            $table->unsignedBigInteger('selected');
            $table->decimal('value');


            $table->foreign('id_responden')->references('id')->on('respondens')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('id_list')->references('id')->on('list_pertanyaans')->cascadeOnUpdate()->cascadeOnDelete();

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
        Schema::dropIfExists('pertanyaan_respondens');
    }
};

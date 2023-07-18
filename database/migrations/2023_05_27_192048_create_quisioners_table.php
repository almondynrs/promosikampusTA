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
        Schema::create('quisioners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->set('for', ['Mahasiswa', 'Alumni', 'Calon Mahasiswa'])->default('Mahasiswa');
            $table->text('question');
            $table->set('status', ['0', '1'])->default('0');
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
        Schema::dropIfExists('quisioners');
    }
};

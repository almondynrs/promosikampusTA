<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        $sql = '
        CREATE VIEW view_hasil_perhitungan_kriteria AS
        SELECT k.nama_kriteria AS kriteria, s.nama_sub AS subkriteria, k.bobot * s.bobot AS hasil
        FROM kriterias k
        INNER JOIN sub_kriterias s ON k.id = s.kriteria_id
';
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sql = '
        DROP VIEW view_hasil_perhitungan
        ';
        DB::statement($sql);
    }
};

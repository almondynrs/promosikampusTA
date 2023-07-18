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
        CREATE VIEW view_hasil_akhir AS
        SELECT  k.id AS sub_kriteria_id, v.kriteria, v.subkriteria, a.nama_alternatif, v.hasil * a.bobot AS hasil_akhir
        FROM view_hasil_perhitungan_kriteria v
        JOIN sub_kriterias k ON v.subkriteria = k.nama_sub
        JOIN alternatifs a ON k.id = a.sub_kriteria_id
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
        DROP VIEW view_hasil_akhir
        ';
        DB::statement($sql);
    }
};

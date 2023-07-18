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
        CREATE VIEW view_ranking AS
        SELECT a.nama_alternatif, AVG(v.hasil_akhir) AS rata_rata_hasil
        FROM view_hasil_akhir v
        JOIN alternatifs a ON v.nama_alternatif = a.nama_alternatif
        GROUP BY a.nama_alternatif
        ORDER BY rata_rata_hasil DESC';
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
          DROP VIEW view_ranking
          ';
          DB::statement($sql);
    }
};

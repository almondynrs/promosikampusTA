<?php

namespace Database\Seeders;

use App\Models\SchoolDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SchoolDetail::insert([
            [
                'type' => 'SMA',
                'name' => 'SMAN 1 Subang',
                'address' => 'Subang',
                'phone_number' => '0853213123'
            ],
            [
                'type' => 'MA',
                'name' => 'MAN 1 Subang',
                'address' => 'Subang',
                'phone_number' => '089812381'
            ],
            [
                'type' => 'SMK',
                'name' => 'SMKN 1 Subang',
                'address' => 'Subang',
                'phone_number' => '081747128'
            ],
            // Tambahkan data detail sekolah lainnya sesuai kebutuhan
        ]);
    }
}

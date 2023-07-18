<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quisioner;

class QuisionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quisioner::insert(
            [
                [

                    'for' => 'Mahasiswa',
                    'question' => 'Pertanyaan 1',
                    'status' => '1'

                ],
                [

                    'for' => 'Alumni',
                    'question' => 'Pertanyaan 2',
                    'status' => '1'

                ],
                [

                    'for' => 'Calon Mahasiswa',
                    'question' => 'Pertanyaan 3',
                    'status' => '1'

                ],
            ]
        );
    }
}

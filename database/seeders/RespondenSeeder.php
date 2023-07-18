<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Responden;

class RespondenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Responden::insert(
            [
                [

                    'user' => '16',
                    'school' => '1',
                ], [

                    'user' => '17',
                    'school' => '2',
                ], [

                    'user' => '18',
                    'school' => '3',
                ],
            ]
        );
    }
}

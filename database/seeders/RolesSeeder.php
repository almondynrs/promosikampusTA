<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::insert(
            [
                [

                    'role' => 'Super Admin'
                ],
                [
                    'role' => 'Admin'
                ],
                [
                    'role' => 'Ketua PMB'
                ],
                [
                    'role' => 'Koordinator PMB'
                ],
                [
                    'role' => 'Bagian Umum'
                ],
                [
                    'role' => 'Pegawai'
                ],
                [
                    'role' => 'Mahasiswa'
                ],
                [
                    'role' => 'Alumni'
                ],
                [
                    'role' => 'Calon Mahasiswa'
                ]
            ]
        );
    }
}

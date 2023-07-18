<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        $this->call(PenggunaSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(RespondenSeeder::class);
        $this->call(QuisionerSeeder::class);
        $this->call(SchoolDetailsSeeder::class);
    }
}

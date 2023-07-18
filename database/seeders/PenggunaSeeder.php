<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;


class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            [
                [

                    'name' => 'Superadmin',
                    'email' => 'Superadmin@gmail.com',
                    'password' => hash::make('admin123'),
                    'email_verified_at' => now(),
                    'role' => 1,
                    'user_image' => 'user2-160x160.jpg',
                    'remember_token' => Str::random(10),

                ],
                [
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => hash::make('admin123'),
                    'email_verified_at' => now(),
                    'role' => 2,
                    'user_image' => 'user2-160x160.jpg',
                    'remember_token' => Str::random(10),
                ],
                [
                    'name' => 'Ketuapmb',
                    'email' => 'Ketuapmb@gmail.com',
                    'password' => hash::make('admin123'),
                    'email_verified_at' => now(),
                    'role' => 3,
                    'user_image' => 'user2-160x160.jpg',
                    'remember_token' => Str::random(10),
                ],
                [
                    'name' => 'Koordinator',
                    'email' => 'koordinator@gmail.com',
                    'password' => hash::make('admin123'),
                    'email_verified_at' => now(),
                    'role' => 4,
                    'user_image' => 'user2-160x160.jpg',
                    'remember_token' => Str::random(10),
                ], [
                    'name' => 'umum',
                    'email' => 'umum@gmail.com',
                    'password' => hash::make('admin123'),
                    'email_verified_at' => now(),
                    'role' => 5,
                    'user_image' => 'user2-160x160.jpg',
                    'remember_token' => Str::random(10),
                ],
                [
                    'name' => 'Pegawai1',
                    'email' => 'pegawai1@gmail.com',
                    'password' => hash::make('admin123'),
                    'email_verified_at' => now(),
                    'role' => 6,
                    'user_image' => 'user2-160x160.jpg',
                    'remember_token' => Str::random(10),
                ],
                [
                    'name' => 'Pegawai2',
                    'email' => 'pegawai2@gmail.com',
                    'password' => hash::make('admin123'),
                    'email_verified_at' => now(),
                    'role' => 6,
                    'user_image' => 'user2-160x160.jpg',
                    'remember_token' => Str::random(10),
                ],
                [
                    'name' => 'Pegawai3',
                    'email' => 'pegawai3@gmail.com',
                    'password' => hash::make('admin123'),
                    'email_verified_at' => now(),
                    'role' => 6,
                    'user_image' => 'user2-160x160.jpg',
                    'remember_token' => Str::random(10),
                ],
                [
                    'name' => 'Pegawai4',
                    'email' => 'pegawai4@gmail.com',
                    'password' => hash::make('admin123'),
                    'email_verified_at' => now(),
                    'role' => 6,
                    'user_image' => 'user2-160x160.jpg',
                    'remember_token' => Str::random(10),
                ],
                [
                    'name' => 'Pegawai5',
                    'email' => 'pegawai5@gmail.com',
                    'password' => hash::make('admin123'),
                    'email_verified_at' => now(),
                    'role' => 6,
                    'user_image' => 'user2-160x160.jpg',
                    'remember_token' => Str::random(10),
                ],
                [
                    'name' => 'mahasiswa',
                    'email' => 'mahasiswa@gmail.com',
                    'password' => hash::make('admin123'),
                    'email_verified_at' => now(),
                    'role' => 7,
                    'user_image' => 'user2-160x160.jpg',
                    'remember_token' => Str::random(10),
                ],
                [
                    'name' => 'alumni',
                    'email' => 'alumni@gmail.com',
                    'password' => hash::make('admin123'),
                    'email_verified_at' => now(),
                    'role' => 8,
                    'user_image' => 'user2-160x160.jpg',
                    'remember_token' => Str::random(10),
                ],
                [
                    'name' => 'Calon Mahasiswa',
                    'email' => 'responden@gmail.com',
                    'password' => hash::make('admin123'),
                    'email_verified_at' => now(),
                    'role' => 9,
                    'user_image' => 'user2-160x160.jpg',
                    'remember_token' => Str::random(10),
                ]
            ]
        );
    }
}

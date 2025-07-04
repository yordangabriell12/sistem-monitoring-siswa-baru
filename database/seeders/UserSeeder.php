<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat atau update akun Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Admin',
                'role'     => 'admin',
                'password' => Hash::make('admin'),
            ]
        );

        // Buat atau update akun untuk setiap siswa
        Siswa::all()->each(function (Siswa $siswa) {
            User::updateOrCreate(
                ['siswa_id' => $siswa->id],
                [
                    'name'     => $siswa->nama_lengkap,
                    'email'    => 'siswa'.$siswa->id.'@gmail.com',
                    'password' => Hash::make('12345'),
                    'role'     => 'siswa',
                    'siswa_id' => $siswa->id,
                ]
            );
        });
    }
}

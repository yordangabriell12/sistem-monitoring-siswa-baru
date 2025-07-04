<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Kelas;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $kelasIds = Kelas::pluck('id')->toArray();

        foreach (range(1, 20) as $i) {
            Siswa::create([
                'nama_lengkap' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'kelas_id' => $faker->randomElement($kelasIds),
                'nama_orangtua' => $faker->name,
                'no_telp_orangtua' => $faker->phoneNumber,
            ]);
        }
    }
}

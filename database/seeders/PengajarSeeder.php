<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengajar;
use App\Models\MataPelajaran;
use Faker\Factory as Faker;

class PengajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $mapelIds = MataPelajaran::pluck('id')->toArray();

        foreach (range(1, 5) as $i) {
            Pengajar::create([
                'nama_lengkap' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'mapel_id' => $faker->randomElement($mapelIds),
            ]);
        }
    }
}

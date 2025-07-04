<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Pengajar;
use Faker\Factory as Faker;

class KelasSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Faker::create('id_ID');
    $pengajarIds = Pengajar::pluck('id')->toArray();
    $kelasList = ['Kelas A', 'Kelas B', 'Kelas C', 'Kelas D'];

    foreach ($kelasList as $nama_kelas) {
      Kelas::create([
        'nama_kelas' => $nama_kelas,
        'pengajar_id' => $faker->randomElement($pengajarIds),
        'jadwal' => $faker->dayOfWeek . ', ' . $faker->time('H:i'),
      ]);
    }
  }
}

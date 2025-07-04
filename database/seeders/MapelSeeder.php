<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataPelajaran;
use Faker\Factory as Faker;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $mapelList = [
            ['kode_mapel' => 'MAPEL-001', 'nama_mapel' => 'Bahasa Indonesia'],
            ['kode_mapel' => 'MAPEL-002', 'nama_mapel' => 'Matematika'],
            ['kode_mapel' => 'MAPEL-003', 'nama_mapel' => 'Ilmu Pengetahuan Alam'],
            ['kode_mapel' => 'MAPEL-004', 'nama_mapel' => 'Ilmu Pengetahuan Sosial'],
            ['kode_mapel' => 'MAPEL-005', 'nama_mapel' => 'Bahasa Inggris'],
        ];
        foreach ($mapelList as $item) {
            MataPelajaran::create([
                'kode_mapel' => $item['kode_mapel'],
                'nama_mapel' => $item['nama_mapel'],
            ]);
        }
    }
}

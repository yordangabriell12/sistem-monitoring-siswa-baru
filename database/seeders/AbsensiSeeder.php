<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Pengajar;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $siswaIds = Siswa::pluck('id')->toArray();
        $pengajarIds = Pengajar::pluck('id')->toArray();
        $statusList = ['hadir', 'izin', 'sakit', 'alpa'];

        foreach ($siswaIds as $siswa_id) {
            foreach (range(1, 5) as $i) {
                DB::table('absensi')->insert([
                    'siswa_id' => $siswa_id,
                    'pengajar_id' => $faker->randomElement($pengajarIds),
                    'tanggal' => $faker->date(),
                    'status' => $faker->randomElement($statusList),
                    'keterangan' => $faker->optional()->sentence(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

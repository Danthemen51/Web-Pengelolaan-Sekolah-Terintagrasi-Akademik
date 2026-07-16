<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kuisioner;

class KuisionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Guru menjelaskan materi dengan jelas',
            'Guru datang tepat waktu',
            'Guru memberikan kesempatan bertanya',
            'Guru bersikap ramah kepada siswa',
            'Guru menguasai materi pelajaran',
        ];

        foreach ($data as $item) {
            Kuisioner::firstOrCreate(
                ['pertanyaan' => $item],
                ['kategori' => 'kinerja', 'is_active' => true]
            );
        }
    }
}

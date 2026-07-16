<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('nama');
            $table->timestamps();
        });

        DB::table('jurusan')->insert([
            [
                'kode' => 'bdp',
                'nama' => 'Bisnis Daring dan Pemasaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'tjkt',
                'nama' => 'Teknik Komputer Jaringan dan Telekomunikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'tbsm',
                'nama' => 'Teknik dan Bisnis Sepeda Motor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('jurusan');
    }
};

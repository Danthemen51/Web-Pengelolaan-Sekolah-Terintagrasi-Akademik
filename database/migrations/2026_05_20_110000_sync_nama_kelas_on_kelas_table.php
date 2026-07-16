<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('kelas', 'nama_kelas') || !Schema::hasColumn('kelas', 'nama')) {
            return;
        }

        DB::table('kelas')
            ->where(function ($query) {
                $query->whereNull('nama_kelas')->orWhere('nama_kelas', '');
            })
            ->whereNotNull('nama')
            ->where('nama', '!=', '')
            ->update(['nama_kelas' => DB::raw('nama')]);

        DB::table('kelas')
            ->where(function ($query) {
                $query->whereNull('nama')->orWhere('nama', '');
            })
            ->whereNotNull('nama_kelas')
            ->where('nama_kelas', '!=', '')
            ->update(['nama' => DB::raw('nama_kelas')]);
    }

    public function down(): void
    {
        //
    }
};

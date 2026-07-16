<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            if (!Schema::hasColumn('kelas', 'jurusan_id')) {
                $table->foreignId('jurusan_id')->nullable()->after('id')->constrained('jurusan')->nullOnDelete();
            }
            if (!Schema::hasColumn('kelas', 'tingkat')) {
                $table->unsignedTinyInteger('tingkat')->nullable()->after('jurusan_id');
            }
            if (!Schema::hasColumn('kelas', 'rombel')) {
                $table->string('rombel', 10)->nullable()->after('tingkat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            if (Schema::hasColumn('kelas', 'jurusan_id')) {
                $table->dropForeign(['jurusan_id']);
                $table->dropColumn('jurusan_id');
            }
            if (Schema::hasColumn('kelas', 'tingkat')) {
                $table->dropColumn('tingkat');
            }
            if (Schema::hasColumn('kelas', 'rombel')) {
                $table->dropColumn('rombel');
            }
        });
    }
};

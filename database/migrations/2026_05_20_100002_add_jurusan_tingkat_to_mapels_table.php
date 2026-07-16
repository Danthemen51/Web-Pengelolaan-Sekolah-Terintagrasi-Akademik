<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mapels', function (Blueprint $table) {
            if (!Schema::hasColumn('mapels', 'jurusan_id')) {
                $table->foreignId('jurusan_id')->nullable()->after('id')->constrained('jurusan')->nullOnDelete();
            }
            if (!Schema::hasColumn('mapels', 'tingkat')) {
                $table->unsignedTinyInteger('tingkat')->nullable()->after('jurusan_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('mapels', function (Blueprint $table) {
            if (Schema::hasColumn('mapels', 'jurusan_id')) {
                $table->dropForeign(['jurusan_id']);
                $table->dropColumn('jurusan_id');
            }
            if (Schema::hasColumn('mapels', 'tingkat')) {
                $table->dropColumn('tingkat');
            }
        });
    }
};

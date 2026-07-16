<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kuisioner', function (Blueprint $table) {
            if (!Schema::hasColumn('kuisioner', 'kategori')) {
                $table->string('kategori')->nullable();
            }

            if (!Schema::hasColumn('kuisioner', 'is_active')) {
                $table->boolean('is_active')->default(false);
            }

            if (!Schema::hasColumn('kuisioner', 'tahun_ajaran_id')) {
                $table->unsignedBigInteger('tahun_ajaran_id')->nullable();
                $table->foreign('tahun_ajaran_id')
                    ->references('id')
                    ->on('tahun_ajaran')
                    ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kuisioner', function (Blueprint $table) {
            if (Schema::hasColumn('kuisioner', 'tahun_ajaran_id')) {
                $table->dropForeign(['tahun_ajaran_id']);
                $table->dropColumn('tahun_ajaran_id');
            }

            if (Schema::hasColumn('kuisioner', 'is_active')) {
                $table->dropColumn('is_active');
            }

            if (Schema::hasColumn('kuisioner', 'kategori')) {
                $table->dropColumn('kategori');
            }
        });
    }
};

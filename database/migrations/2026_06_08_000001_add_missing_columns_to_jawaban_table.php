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
        Schema::table('jawaban', function (Blueprint $table) {
            if (!Schema::hasColumn('jawaban', 'tahun_ajaran_id')) {
                $table->unsignedBigInteger('tahun_ajaran_id')->nullable();
                $table->foreign('tahun_ajaran_id')
                    ->references('id')
                    ->on('tahun_ajaran')
                    ->onDelete('cascade');
            }

            if (!Schema::hasColumn('jawaban', 'siswa_id')) {
                $table->foreignId('siswa_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('siswas')
                    ->onDelete('cascade');
            }

            if (!Schema::hasColumn('jawaban', 'kuisioner_id')) {
                $table->unsignedBigInteger('kuisioner_id')->nullable();
                $table->foreign('kuisioner_id')
                    ->references('id')
                    ->on('kuisioner')
                    ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jawaban', function (Blueprint $table) {
            if (Schema::hasColumn('jawaban', 'tahun_ajaran_id')) {
                $table->dropForeign(['tahun_ajaran_id']);
                $table->dropColumn('tahun_ajaran_id');
            }

            if (Schema::hasColumn('jawaban', 'siswa_id')) {
                $table->dropForeign(['siswa_id']);
                $table->dropColumn('siswa_id');
            }

            if (Schema::hasColumn('jawaban', 'kuisioner_id')) {
                $table->dropForeign(['kuisioner_id']);
                $table->dropColumn('kuisioner_id');
            }
        });
    }
};

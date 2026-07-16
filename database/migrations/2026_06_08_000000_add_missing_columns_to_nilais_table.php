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
        Schema::table('nilais', function (Blueprint $table) {
            if (!Schema::hasColumn('nilais', 'semester')) {
                $table->enum('semester', ['ganjil', 'genap'])->nullable();
            }

            if (!Schema::hasColumn('nilais', 'tahun_ajaran_id')) {
                $table->unsignedBigInteger('tahun_ajaran_id')->nullable();
                $table->foreign('tahun_ajaran_id')
                    ->references('id')
                    ->on('tahun_ajarans')
                    ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            if (Schema::hasColumn('nilais', 'tahun_ajaran_id')) {
                $table->dropForeign(['tahun_ajaran_id']);
                $table->dropColumn('tahun_ajaran_id');
            }

            if (Schema::hasColumn('nilais', 'semester')) {
                $table->dropColumn('semester');
            }
        });
    }
};

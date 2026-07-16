<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pastikan nilais.mapping_id mengacu ke guru_mapel (bukan tabel yang sudah tidak dipakai).
     */
    public function up(): void
    {
        if (!Schema::hasColumn('nilais', 'mapping_id')) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->foreignId('mapping_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('guru_mapel')
                    ->cascadeOnDelete();
            });

            return;
        }

        $fkName = $this->foreignKeyName('nilais', 'mapping_id');
        if ($fkName) {
            Schema::table('nilais', function (Blueprint $table) use ($fkName) {
                $table->dropForeign($fkName);
            });
        }

        Schema::table('nilais', function (Blueprint $table) {
            $table->foreign('mapping_id')
                ->references('id')
                ->on('guru_mapel')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('nilais', 'mapping_id')) {
            return;
        }

        $fkName = $this->foreignKeyName('nilais', 'mapping_id');
        if ($fkName) {
            Schema::table('nilais', function (Blueprint $table) use ($fkName) {
                $table->dropForeign($fkName);
            });
        }
    }

    private function foreignKeyName(string $table, string $column): ?string
    {
        $database = Schema::getConnection()->getDatabaseName();

        $row = DB::selectOne(
            'SELECT CONSTRAINT_NAME AS name
             FROM information_schema.KEY_COLUMN_USAGE
             WHERE TABLE_SCHEMA = ?
               AND TABLE_NAME = ?
               AND COLUMN_NAME = ?
               AND REFERENCED_TABLE_NAME IS NOT NULL
             LIMIT 1',
            [$database, $table, $column]
        );

        return $row->name ?? null;
    }
};

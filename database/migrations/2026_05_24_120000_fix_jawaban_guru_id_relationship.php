<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fix jawaban.guru_id to reference users.id instead of guru.id
     * to maintain consistency with GuruMapel and Nilai models
     */
    public function up(): void
    {
        Schema::table('jawaban', function (Blueprint $table) {
            // Drop the old foreign key if it exists
            try {
                $table->dropForeign(['guru_id']);
            } catch (\Exception $e) {
                // Foreign key might not exist, that's okay
            }
            
            // Modify the guru_id column to reference users instead
            // First, we need to update existing values to match user_id
            DB::statement('UPDATE jawaban j 
                          INNER JOIN guru g ON j.guru_id = g.id 
                          SET j.guru_id = g.user_id 
                          WHERE g.user_id IS NOT NULL');
            
            // Now add the correct foreign key
            $table->foreign('guru_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jawaban', function (Blueprint $table) {
            // Drop the new foreign key
            try {
                $table->dropForeign(['guru_id']);
            } catch (\Exception $e) {
                // Foreign key might not exist
            }
        });
    }
};

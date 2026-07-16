<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_photos', function (Blueprint $table) {
            $table->id();
            $table->enum('jurusan', ['tjkt', 'bdp', 'tbsm']);
            $table->string('caption')->nullable();
            $table->string('foto'); // path ke file foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_photos');
    }
};
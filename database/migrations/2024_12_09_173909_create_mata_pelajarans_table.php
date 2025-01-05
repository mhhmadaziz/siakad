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
        Schema::create('mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('modul')->nullable();
            $table->foreignId('guru_id')->constrained('guru');
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->timestamps();
        });

        Schema::table('jadwal_mata_pelajaran', function (Blueprint $table) {
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_mata_pelajaran', function (Blueprint $table) {
            $table->dropConstrainedForeignId('mata_pelajaran_id');
        });
        Schema::dropIfExists('mata_pelajaran');
    }
};

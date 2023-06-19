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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('Nim', 20)->unique();
            $table->string('Nama', 50);
            $table->string('Kelas', 15);
            $table->string('Jurusan', 50);
            $table->string('No_Handphone', 20);
            $table->string('Email', 50);
            $table->string('Tanggal_Lahir', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};

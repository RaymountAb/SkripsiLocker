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
        Schema::create('rekap_penggunaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai')->constrained('m_pegawai');
            $table->foreignId('loker')->constrained('m_loker');
            $table->date('date');
            $table->integer('waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_penggunaan');
    }
};

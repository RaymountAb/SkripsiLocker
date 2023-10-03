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
        Schema::create('loghistory', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->foreignId('pegawai')->constrained('m_pegawai');
            $table->foreignId('loker')->constrained('m_loker');
            $table->tinyInteger('activity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loghistory');
    }
};

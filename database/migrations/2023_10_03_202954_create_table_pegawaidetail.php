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
        Schema::create('m_pegawaidetail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai')->constrained('m_pegawai');
            $table->tinyInteger('jenis_kelamin')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_pegawaidetail');
    }
};

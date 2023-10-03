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
        Schema::create('m_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('username',15)->unique();
            $table->string('nip', 20)->unique();
            $table->string('nama', 50);
            $table->string('password');
            $table->string('api_token', 50)->unique()->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_pegawai');
    }
};

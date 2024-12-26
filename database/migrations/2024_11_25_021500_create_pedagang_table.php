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
        Schema::create('pedagangs', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('nama_lengkap');
            $table->string('no_telpon');
            $table->string('lokasi_pasar');
            $table->string('blok_pasar')->nullable();
            $table->string('akun_sosmed');
            $table->string('bukti_sosmed')->nullable();
            $table->text('permintaan');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedagangs');
    }
};

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
        Schema::create('markets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('location');
            $table->string('jam_operasional');
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('image')->nullable();
            $table->string('image_content')->nullable();
            $table->string('image_tambah')->nullable();
            $table->integer('jumlah_pedagang')->nullable();
            $table->integer('luas_tanah')->nullable();
            $table->integer('luas_bangunan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markets');
    }
};

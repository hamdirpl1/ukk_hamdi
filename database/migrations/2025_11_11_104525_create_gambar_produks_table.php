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
        Schema::create('gambar_produks', function (Blueprint $table) {
            $table->id('id_gambar');
            $table->unsignedBigInteger('id_produk');
            $table->string('gambar', 100)->nullable();
            $table->string('nama_gambar', 50);
            $table->timestamps();

            $table->foreign('id_produk')->references('id_produk')->on('produks')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_produks');
    }
};

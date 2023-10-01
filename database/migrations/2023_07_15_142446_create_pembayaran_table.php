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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->integer('id_pembayaran')->autoIncrement();
            $table->dateTime('tgl_bayar');
            $table->string('bulan_dibayar', 8);
            $table->string('tahun_dibayar', 4);
            $table->integer('jumlah_bayar');

            // Membuat foreign pada laravel migration
            $table->integer('id_petugas');
            $table->foreign('id_petugas')->references('id_petugas')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nisn', 10);
            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_spp');
            $table->foreign('id_spp')->references('id_spp')->on('siswa')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};

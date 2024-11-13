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
        Schema::create('kasus', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_lapor');
            $table->string('nrp')->unique();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('pangkat_saat_terkena_kasus');
            $table->string('jabatan_saat_terkena_kasus');
            $table->string('satker_saat_terkena_kasus');
            $table->string('referensi')->nullable();
            $table->string('pasal')->nullable();
            $table->date('tanggal_putusan')->nullable();
            $table->string('nomor_putusan')->nullable();
            $table->date('tanggal_putusan_keberatan')->nullable();
            $table->string('nomor_putusan_keberatan')->nullable();
            $table->date('tanggal_dimulai_hukuman')->nullable();
            $table->date('tanggal_rps')->nullable();
            $table->string('no_rps')->nullable();
            $table->string('file_putusan_sidang')->nullable();
            $table->string('file_banding')->nullable();
            $table->string('file_rps')->nullable();
            $table->text('uraian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_kasuses');
    }
};

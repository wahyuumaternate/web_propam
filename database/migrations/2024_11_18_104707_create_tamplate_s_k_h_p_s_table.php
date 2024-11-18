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
        Schema::create('tamplate_skhp', function (Blueprint $table) {
            $table->id();
            $table->string('di_keluar_di'); // Di Keluarkan Di field
            $table->string('kabid_nama'); // Nama Kabid Propam
            $table->string('kabid_pangkat'); // Pangkat Kabid Propam
            $table->string('kabid_nrp'); // NRP Kabid Propam
            $table->string('kasubid_nama'); // Nama Kasubid Propam
            $table->string('kasubid_pangkat'); // Pangkat Kasubid Propam
            $table->string('kasubid_nrp'); // NRP Kasubid Propam
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamplate_skhp');
    }
};

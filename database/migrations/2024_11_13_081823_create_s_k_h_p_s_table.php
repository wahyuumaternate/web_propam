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
        Schema::create('skhp', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama
            $table->date('tanggal_lahir'); // Tempat dan Tanggal Lahir (date saja)
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Jenis Kelamin
            $table->string('agama'); // Agama
            $table->string('pangkat_nrp_nip'); // Pangkat / NRP / NIP
            $table->string('jabatan'); // Jabatan
            $table->string('kesatuan_instansi'); // Kesatuan / Instansi
            $table->string('alamat_kantor'); // Alamat Kantor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skhp');
    }
};

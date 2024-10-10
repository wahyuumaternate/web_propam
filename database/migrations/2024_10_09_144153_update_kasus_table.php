<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kasus', function (Blueprint $table) {
            // Tambahkan kolom foreign key yang berelasi
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('pangkat_id');
            $table->unsignedBigInteger('satker_satwil_id');
            $table->unsignedBigInteger('wilayah_kasus_id');
            $table->unsignedBigInteger('status_id');

            // Definisikan foreign key
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
            $table->foreign('pangkat_id')->references('id')->on('pangkat')->onDelete('cascade');
            $table->foreign('satker_satwil_id')->references('id')->on('satker_satwil')->onDelete('cascade');
            $table->foreign('wilayah_kasus_id')->references('id')->on('wilayah_kasus')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kasus', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropForeign(['pangkat_id']);
            $table->dropForeign(['satker_satwil_id']);
            $table->dropForeign(['wilayah_kasus_id']);
            $table->dropForeign(['status_id']);

            $table->dropColumn(['kategori_id', 'pangkat_id', 'satker_satwil_id', 'wilayah_kasus_id', 'status_id']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('skhp', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pangkat')->nullable();

            // Menambahkan foreign key jika diperlukan
            $table->foreign('id_pangkat')->references('id')->on('pangkat')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('skhp', function (Blueprint $table) {
            // Menghapus foreign key terlebih dahulu jika ada
            $table->dropForeign(['id_pangkat']);

            // Menghapus kolom 'id_pangkat'
            $table->dropColumn('id_pangkat');
        });
    }
};

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
        Schema::create('kasus_hukuman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daftar_kasus_id')
                ->references('id')
                ->on('kasus')
                ->onDelete('cascade');
            $table->foreignId('hukuman_id')
                ->references('id')
                ->on('hukuman')
                ->onDelete('cascade');
            $table->timestamps();
        
            // Menambahkan unique constraint untuk menghindari duplikasi
            $table->unique(['daftar_kasus_id', 'hukuman_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kasus_hukuman');
    }
};

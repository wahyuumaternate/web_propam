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
        Schema::table('kasus', function (Blueprint $table) {
            $table->unsignedBigInteger('hukuman_id')->nullable()->after('status_id');  // Gantilah 'existing_column' dengan kolom yang sudah ada
            $table->unsignedBigInteger('pelanggaran_id')->nullable()->after('hukuman_id');

            // Tambahkan foreign key constraints jika diperlukan
            $table->foreign('hukuman_id')->references('id')->on('hukuman')->onDelete('cascade');
            $table->foreign('pelanggaran_id')->references('id')->on('pelanggaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kasus', function (Blueprint $table) {
            $table->dropForeign(['hukuman_id']);
            $table->dropForeign(['pelanggaran_id']);
            $table->dropColumn(['hukuman_id', 'pelanggaran_id']);
        });
    }
};

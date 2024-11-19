<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tabel permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama permission
            $table->string('guard_name'); // Guard name (default: web)
            $table->timestamps();
        });

        // Tabel roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama role
            $table->string('guard_name'); // Guard name (default: web)
            $table->timestamps();
        });

        // Tabel pivot role_has_permissions
        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        // Tabel pivot model_has_roles
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->string('model_type'); // Tipe model (ex: App\Models\User)
            $table->unsignedBigInteger('model_id'); // ID dari model

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->primary(['role_id', 'model_id', 'model_type']);
        });

        // Tabel pivot model_has_permissions
        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->string('model_type'); // Tipe model (ex: App\Models\User)
            $table->unsignedBigInteger('model_id'); // ID dari model

            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

            $table->primary(['permission_id', 'model_id', 'model_type']);
        });

        // Index untuk mempercepat query
        Schema::table('roles', function (Blueprint $table) {
            $table->unique(['name', 'guard_name']);
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->unique(['name', 'guard_name']);
        });

        
    }

    public function down()
    {
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
    }
};

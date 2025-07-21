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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id')->primary();
            $table->string('kode_user',7)->unique()->nullable();
            $table->string('nama_user',100);
            $table->string('user_username')->unique();
            $table->string('user_email')->unique();
            $table->string('user_password');
            $table->enum('user_role',['user','seller']);
            $table->string('no_telp',12);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};

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
        //
        Schema::create('key',function(Blueprint $table)
        {
            $table->id('key_id');
            $table->string('kode_id',7)->unique()->nullable();
            $table->string('nama_key',50);
            $table->string('jenis_key',20);
            $table->integer('harga_key');
            $table->timestamps();

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('key');
    }
};

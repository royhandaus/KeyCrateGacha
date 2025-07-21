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
        Schema::create('boxes', function (Blueprint $table) {
            $table->id('box_id');
            $table->string('kode_box', 10)->unique()->nullable();   
            $table->string('jenis');                   
            $table->string('nama_box', 50);            
            $table->boolean('is_active')->default(true); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
         Schema::dropIfExists('boxes');
    }
};

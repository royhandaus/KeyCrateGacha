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
        schema::create('produk',function(Blueprint $table){
            $table->id('produk_id');
            $table->string('kode_produk',7)->unique()->nullable();
            $table->string('nama_produk', 50);
            $table->integer('stok_produk');
            $table->string('kode_redeem_produk')->nullable();
            $table->integer('rating')->default(0);
            $table->smallInteger('available_produk')->default(1);
            $table->timestamps();

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('produk');
    }
};

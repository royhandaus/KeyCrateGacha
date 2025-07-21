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
        Schema::create('cart_item',function(Blueprint $table){
            $table->id('cart_item_id');
            $table->unsignedBigInteger('cart_id'); 
            $table->unsignedBigInteger('key_id'); 
            $table->integer('quantity');
            $table->integer('harga_satuan');
           

            // Foreign Keys
            $table->foreign('cart_id')->references('cart_id')->on('cart')->onDelete('cascade');
            $table->foreign('key_id')->references('key_id')->on('key')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('cart_item');
    }
};

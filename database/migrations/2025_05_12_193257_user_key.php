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
        Schema::create('user_keys', function (Blueprint $table) {
            $table->id('user_key_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('key_id');
            $table->integer('jumlah')->default(1); 
            $table->timestamps(); 

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('key_id')->references('id')->on('shop_key')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

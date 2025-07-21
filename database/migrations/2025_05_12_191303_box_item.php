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
        Schema::create('box_items', function (Blueprint $table) {
        $table->id(); 
        $table->unsignedBigInteger('box_id');
        $table->unsignedBigInteger('produk_id');
        $table->integer('chance')->default(100);
        
        
        $table->foreign('box_id')->references('box_id')->on('boxes')->onDelete('cascade');
        $table->foreign('produk_id')->references('produk_id')->on('produk')->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    // Menghapus tabel 'box_items' setelah foreign key dihapus
    Schema::dropIfExists('box_items');
}

};

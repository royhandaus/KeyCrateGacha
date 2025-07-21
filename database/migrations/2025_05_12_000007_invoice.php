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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('invoices_id'); 
            $table->string('kode_invoice', 7)->unique()->nullable(); 
            $table->unsignedBigInteger('user_id'); 
            $table->decimal('total_price', 12, 2)->default(0); 
            $table->enum('status', ['unpaid', 'paid', 'cancelled', 'expired'])->default('unpaid'); 
            $table->timestamps();

            // Foreign Key
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('invoices');
    }
};

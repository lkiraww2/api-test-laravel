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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('status')->nullable();
            $table->date('billed_deted')->nullable();  // search in detetime please
            $table->date('paid_deted')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     
        Schema::dropIfExists('invoices');
    }
};

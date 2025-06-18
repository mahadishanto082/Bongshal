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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Cash on delivery', 'Bkash', 'Rocket', 'Nogod'])->default('Cash on delivery');
            $table->enum('status', ['hold', 'processing', 'done', 'canceled', 'failed'])->default('hold');
            $table->unsignedDecimal('amount');
            $table->longText('payment_gateway_response')->nullable();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->on('orders')->references('id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->unsignedDecimal('product_unit_price');
            $table->unsignedDecimal('product_buy_price');
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_fabrics')->nullable();
            $table->unsignedDecimal('discount')->default(0)
                ->comment('unit discount amount');
            $table->unsignedInteger('product_quantity')->default(1);
            $table->unsignedInteger('returned_quantity')->default(0)
                ->comment('if admin return');
            $table->unsignedInteger('final_quantity');
            $table->unsignedDecimal('sub_total')->default(0)
                ->comment('product_unit_price * quantity');
            $table->unsignedDecimal('total')->default(0)
                ->comment('sub_total - discount');
            $table->unsignedDecimal('returned_amount')->default(0)
                ->comment('if admin return');
            $table->unsignedDecimal('final_total')->default(0)
                ->comment('total - returned_amount');
            $table->unsignedBigInteger('product_id');
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
        Schema::dropIfExists('order_details');
    }
};

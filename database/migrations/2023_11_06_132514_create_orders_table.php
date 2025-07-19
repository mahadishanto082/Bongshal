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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedDecimal('sub_total')
                ->comment('sum of order_details total');
            $table->unsignedDecimal('discount')->default(0.00);
            $table->unsignedDecimal('total_shipping_charge')->default(0.00);
            $table->unsignedDecimal('total')
                ->comment('(sub_total + total_shipping_charge) - discount');
            $table->unsignedDecimal('total_returned')->default(0.00)
                ->comment('sum of order_details returned');
            $table->unsignedDecimal('final_total')->default(0.00)
                ->comment('sum of order_details final');
            $table->enum('status', ['Pending', 'In Progress', 'Ready to Ship', 'Shipped', 'Returned', 'Canceled', 'Delivered', 'Failed'])
                ->default('Pending');
            $table->timestamp('delivered_at')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('ref_agent_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

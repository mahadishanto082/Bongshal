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
        Schema::create('user_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('order_details_id')->nullable();
            $table->unsignedInteger('point')->default(0);
            $table->enum('flag', ['Earn', 'Withdraw'])->default('Earn');
            $table->text('notes')->nullable();
            $table->enum('type', ['Bkash', 'Nagad', 'Recharge'])->nullable();
            $table->string('payment_number', 15)->nullable();
            $table->enum('status', ['Pending', 'Complete', 'Failed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_points');
    }
};

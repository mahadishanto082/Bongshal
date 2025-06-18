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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id')->default(0);
            $table->unsignedBigInteger('writer_id')->default(0);
            $table->unsignedBigInteger('merchant_id')->default(0);
            $table->enum('type', ['Book', 'General']);
            $table->string('slug')->nullable()->unique();
            $table->string('name');
            $table->string('code')->unique();

            $table->decimal('buy_price', 8, 2)->default(0.00);
            $table->decimal('price', 8, 2)->default(0.00);
            $table->string('discount_type', 50)->nullable();
            $table->unsignedInteger('discount_value')->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->unsignedInteger('point')->default(0);

            $table->decimal('shipping_in_dhaka', 8, 2)->default(0.00);
            $table->decimal('shipping_out_dhaka', 8, 2)->default(0.00);

            $table->string('image')->nullable();
            $table->longText('description')->nullable();

            $table->string('first_release')->nullable();
            $table->string('language')->nullable();

            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('fabrics')->nullable();
            $table->string('weight')->nullable();
            $table->string('warranty')->nullable();

            $table->string('delivery_info')->nullable();
            $table->enum('feature', ['Yes', 'No'])->default('No');
            $table->unsignedInteger('sort')->default(0);
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

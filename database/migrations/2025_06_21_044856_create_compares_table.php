<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComparesTable extends Migration
{
    public function up()
    {
        Schema::create('compares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');      // user who owns the compare list
            $table->unsignedBigInteger('product_id');   // compared product
            $table->timestamps();

            // Foreign key constraints (optional, but recommended)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Make sure user can't add same product multiple times to compare
            $table->unique(['user_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('compares');
    }
}

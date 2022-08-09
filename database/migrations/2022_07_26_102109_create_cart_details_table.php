<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_details', function (Blueprint $table) {
            $table->id();
            $table->integer('qty');
            $table->float('price');
            $table->unsignedBigInteger('pro_id');
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('dis_id');
            $table->timestamps();
            $table->foreign('pro_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->foreign('cart_id')
                ->references('id')
                ->on('carts')
                ->onDelete('cascade');
            $table->foreign('dis_id')
                ->references('id')
                ->on('discounts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_details');
    }
};

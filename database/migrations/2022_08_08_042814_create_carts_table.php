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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cus_id');
            $table->unsignedBigInteger('pay_id');
            $table->unsignedBigInteger('member_id');
            $table->integer('active');
            $table->decimal('total');
            $table->timestamps();
            $table->foreign('cus_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
            $table->foreign('pay_id')
                ->references('id')
                ->on('Payment_methods')
                ->onDelete('cascade');
            $table->foreign('member_id')
                ->references('id')
                ->on('members')
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
        Schema::dropIfExists('carts');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
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
            $table->float('price');
            $table->enum('status',['new','progress','delivered','cancel'])->default('new');
            $table->integer('quantity');
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('CASCADE');
            // $table->foreignId('order_id')->references('id')->on('orders')->onDelete('CASCADE');
            $table->timestamps();
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
}

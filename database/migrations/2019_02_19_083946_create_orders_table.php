<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qty')->nullable();
            $table->integer('qty_m')->nullable();
            $table->integer('status')->default(0);
            $table->text('text')->nullable();
            $table->date('date')->nullable();
            $table->integer('sum')->nullable();
            $table->timestamps();
            $table->integer('user_id')->nullable()->unsigned();
            // $table->integer('orders_product_id')->nullable()->unsigned();
            // $table->integer('book_id')->nullable()->unsigned();
            // $table->integer('magazin_id')->nullable()->unsigned();
       
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
           // $table->foreign('orders_product_id')->references('id')->on('orders_products');
            // $table->foreign('book_id')->references('id')->on('books');
            // $table->foreign('magazin_id')->references('id')->on('magazins');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagazinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazins', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('category_id')->nullable();
            $table->string('slug')->default(0);
            $table->string('name')->default(0);
            $table->string('autor');
            $table->integer('number_per_year')->nullable();
            $table->integer('year')->nullable();
            $table->integer('number')->nullable();
            $table->integer('size');
            $table->float('price')->default(0);
            $table->float('sub_price')->default(0);
            $table->float('old_price')->default(0);
            $table->integer('status')->default(0);
            $table->string('img')->default('no_image.jpg');
            $table->integer('hit_magazin')->default(0);
            $table->timestamps();
            $table->integer('user_id')->nullable()->unsigned();  
            $table->integer('discont_global')->nullable();
           // $table->integer('discont_privat')->nullable(); 
        });

        Schema::table('magazins', function (Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magazins');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('md_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en');
            $table->string('name_fr');
            $table->string('description_en', 500)->nullable();
            $table->string('description_fr', 500)->nullable();
            $table->integer('state');
            $table->float('price','19', 4);
            $table->integer('id_category')->unsigned();
            $table->foreign('id_category')->references('id')->on('md_products_categories');
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
        Schema::dropIfExists('md_products');
    }
}

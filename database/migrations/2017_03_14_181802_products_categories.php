<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('md_products_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en');
            $table->string('name_fr');
            $table->string('description_en', 500)->nullable();
            $table->string('description_fr', 500)->nullable();
            $table->integer('state');
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
        Schema::dropIfExists('md_products_categories');
    }
}

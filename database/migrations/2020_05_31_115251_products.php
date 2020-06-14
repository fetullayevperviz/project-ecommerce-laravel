<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_color');
            $table->string('product_description');
            $table->double('product_price', 8, 2);
            $table->tinyInteger('gender')->default(2);
            $table->tinyInteger('chapter')->default(4);
            $table->string('image');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('featured_products')->default(0);
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
        Schema::dropIfExists('products');
    }
}

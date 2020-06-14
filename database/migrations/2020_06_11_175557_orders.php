<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('user_email',100);
            $table->string('name',100);
            $table->string('address');
            $table->string('city',100);
            $table->string('state',100);
            $table->string('pincode',20);
            $table->string('country',100);
            $table->string('mobile',20);
            $table->float('shipping_charges',8,2)->default(0);
            $table->string('coupon_code');
            $table->float('coupon_amount',8,2);
            $table->string('order_status');
            $table->string('payment_method');
            $table->float('grand_total',8,2);
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
        Schema::dropIfExists('orders');
    }
}

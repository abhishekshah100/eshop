<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('invoice_number',30)->unique();
            $table->bigInteger('customer_id')->unsigned();
            $table->string('customer_name',100);
            $table->bigInteger('customer_phone');
            $table->tinyInteger('payment_mode');
            $table->datetime('delivery_date')->nullable();
            $table->float('discount', 10, 2);
            $table->float('tax', 10 , 2);
            $table->float('total_invoice_amount', 10, 2);
            $table->string('shipping_address_full_name',100);
            $table->longText('shipping_address',255);
            $table->string('shipping_address_state',25);
            $table->bigInteger('shipping_address_pincode');
            $table->bigInteger('shipping_address_phone');
            $table->string('billing_address_full_name',100);
            $table->longText('billing_address',255);
            $table->string('billing_address_state',25);
            $table->bigInteger('billing_address_pincode');
            $table->bigInteger('billing_address_phone');
            $table->longText('order_description')->nullable();
            $table->tinyInteger('order_status')->default('1');
            $table->bigInteger('coupon_id')->unsigned()->nullable();
            $table->string('coupon_code',15)->nullable();
            $table->tinyInteger('discount_percentage')->nullable();
            $table->bigInteger('delivery_charges')->default(0);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('coupon_id')->references('id')->on('coupons');
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

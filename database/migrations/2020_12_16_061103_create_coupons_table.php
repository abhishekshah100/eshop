<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('discount_percentage');
            $table->bigInteger('discount_amount_upto');
            $table->string('coupon_code',15);
            $table->date('starting_date');
            $table->date('ending_date');
            $table->bigInteger('minimum_amount');
            $table->tinyInteger('coupon_status');
            $table->tinyInteger('use_per_customer');
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
        Schema::dropIfExists('coupons');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotdealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotdeals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->float('hot_deals_old_price', 10, 2)->nullable();
            $table->float('hot_deals_new_price', 10, 2);
            $table->float('hot_deals_discount', 10, 2)->nullable();
            $table->dateTime('hot_deals_expiry_date')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotdeals');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_product_prices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->float('old_price', 10, 2)->nullable();
            $table->float('new_price', 10, 2);
            $table->float('discount', 10, 2)->nullable();
            $table->bigInteger('product_stock');
            $table->bigInteger('remaining_stock');
            $table->tinyInteger('hot_deals')->default('0');
            $table->float('original_old_price' , 10, 2)->nullable();
            $table->float('original_new_price', 10, 2)->nullable();
            $table->float('original_discount',10, 2)->nullable();
            $table->dateTime('hot_deals_expiry_date')->nullable();
            $table->tinyInteger('vendor_product_status');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('vendor_id')->references('id')->on('admin_credentials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_product_prices');
    }
}

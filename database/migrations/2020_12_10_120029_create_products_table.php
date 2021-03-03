<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->bigInteger('vendor_id')->unsigned();
            $table->string('product_code',70)->unique();
            $table->string('product_name',255);
            $table->string('product_sku',100)->nullable();
            $table->bigInteger('product_category')->unsigned();
            $table->bigInteger('product_brand')->unsigned();
            $table->float('old_price', 10, 2)->nullable();
            $table->float('new_price', 10, 2);
            $table->float('discount', 10, 2)->nullable();
            $table->bigInteger('product_stock');
            $table->bigInteger('remaining_stock');
            $table->longText('feature_image');
            $table->longText('product_images');
            $table->longText('product_description');
            $table->string('metatitle',60)->unique()->nullable();
            $table->string('slug',60)->unique()->nullable();
            $table->longText('metakeywords')->nullable();
            $table->string('metadescription',160)->unique()->nullable();
            $table->tinyInteger('product_status');
            $table->tinyInteger('hot_deals')->default('0');
            $table->float('original_old_price' , 10, 2)->nullable();
            $table->float('original_new_price', 10, 2)->nullable();
            $table->float('original_discount',10, 2)->nullable();
            $table->dateTime('hot_deals_expiry_date')->nullable();
            $table->timestamps();

            $table->foreign('product_category')->references('id')->on('categories');
            $table->foreign('product_brand')->references('id')->on('brands');
            //$table->foreign('vendor_id')->references('id')->on('admin_credentials');
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

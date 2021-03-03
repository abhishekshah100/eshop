<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Brands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('brandname',60)->unique();
            $table->string('brand_logo',255);
            $table->tinyInteger('brand_status');
            $table->string('metatitle',60)->unique();
            $table->string('slug',60)->unique();
            $table->longText('metakeywords');
            $table->string('metadescription',160)->unique();
            $table->string('metacanonical',255)->unique();
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
        Schema::dropIfExists('brands');
    }
}

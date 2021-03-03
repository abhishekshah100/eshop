<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Categories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('categoryname',60)->unique();
            $table->tinyInteger('category_status');
            $table->string('metatitle',60)->unique();
            $table->string('slug',60)->unique();
            $table->longText('metakeywords');
            $table->string('metadescription',160)->unique();
            $table->string('metacanonical',255)->unique();
            $table->string('category_image',255);
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
        Schema::dropIfExists('categories');
    }
}

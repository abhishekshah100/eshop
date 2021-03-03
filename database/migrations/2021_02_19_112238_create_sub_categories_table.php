<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->string('sub_categoryname',60)->unique();
            $table->tinyInteger('sub_category_status');
            $table->string('metatitle',60)->unique();
            $table->string('slug',60)->unique();
            $table->longText('metakeywords');
            $table->string('metadescription',160)->unique();
            $table->string('metacanonical',255)->unique();
            $table->string('sub_category_image',255);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}

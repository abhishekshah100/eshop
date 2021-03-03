<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeslidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homesliders', function (Blueprint $table) {
            $table->id();
            $table->string('main_heading',40);
            $table->string('sub_heading',40);
            $table->string('sub_sub_heading',40);
            $table->string('link');
            $table->longText('slider_image');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('homesliders');
    }
}

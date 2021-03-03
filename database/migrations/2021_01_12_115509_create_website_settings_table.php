<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_name',255);
            $table->longText('website_logo');
            $table->string('website_email',100);
            $table->bigInteger('contactno');
            $table->longText('address',255)->nullable();
            $table->string('state',25)->nullable();
            $table->bigInteger('pincode')->nullable();
            $table->string('website_url',255)->nullable();
            $table->string('facebook_url',255)->nullable();
            $table->string('twitter_url',255)->nullable();
            $table->string('youtube_url',255)->nullable();
            $table->string('instagram_url',255)->nullable();
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
        Schema::dropIfExists('website_settings');
    }
}

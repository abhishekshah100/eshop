<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_birth')->nullable();
            $table->string('email')->unique();
            $table->string('provider_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->longText('address')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('city',30)->nullable();
            $table->string('state',30)->nullable();
            $table->bigInteger('pincode')->nullable();
            $table->string('verification_code',150)->nullable();
            $table->tinyInteger('user_status');
            $table->tinyInteger('newsletter_subscription')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

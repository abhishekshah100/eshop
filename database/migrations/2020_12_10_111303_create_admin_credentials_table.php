<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_credentials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name',150);
            $table->string('email',100)->unique();
            $table->string('password');
            $table->tinyInteger('role');
            $table->tinyInteger('company_type')->nullable();
            $table->tinyInteger('company_address')->nullable();
            $table->string('company_city',50)->nullable();
            $table->tinyInteger('company_pincode')->nullable();
            $table->string('company_country',50)->nullable();
            $table->string('company_state',50)->nullable();
            $table->bigInteger('company_phonenumber')->nullable();
            $table->tinyInteger('account_verify_status');
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
        Schema::dropIfExists('admin_credentials');
    }
}

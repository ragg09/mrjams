<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAsCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_as_customer', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('fname', 45)->nullable();
            $table->string('mname', 45)->nullable();
            $table->string('lname', 45)->nullable();
            $table->string('gender', 45)->nullable();
            $table->string('phone', 45)->nullable();
            $table->integer('age')->nullable();
            $table->integer('users_id')->index('fk_user_as_customer_details_users1_idx');
            $table->integer('user_address_id')->index('fk_user_as_customer_user_adress1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_as_customer');
    }
}

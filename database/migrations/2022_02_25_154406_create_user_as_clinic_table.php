<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAsClinicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_as_clinic', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 45);
            $table->string('phone', 45);
            $table->string('telephone', 45)->nullable();
            $table->integer('users_id')->index('fk_user_as_clinic_details_users1_idx');
            $table->integer('clinic_types_id')->index('fk_user_as_clinic_clinic_types1_idx');
            $table->integer('user_address_id')->index('fk_user_as_clinic_user_adress1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_as_clinic');
    }
}

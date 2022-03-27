<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicTimeAvailabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_time_availability', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_as_clinic_id')->index('fk_clinic_time_availabil_user_as_clinic1_idx');
            $table->text('summary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_time_availability');
    }
}

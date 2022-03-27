<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicServicesHasEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_services_has_equipments', function (Blueprint $table) {
            $table->integer('user_as_clinic_id')->index('fk_clinic_services_has_equipments_user_as_clinic1_idx');
            $table->integer('clinic_equipments_id')->index('fk_clinic_equipments_has_clinic_services_clinic_equipments1_idx');
            $table->integer('clinic_services_id')->index('fk_clinic_equipments_has_clinic_services_clinic_services1_idx');

            $table->primary(['clinic_equipments_id', 'clinic_services_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_services_has_equipments');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesHasClinicEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages_has_clinic_equipments', function (Blueprint $table) {
            $table->integer('packages_id')->index('fk_packages_has_clinic_equipments_packages1_idx');
            $table->integer('clinic_equipments_id')->index('fk_packages_has_clinic_equipments_clinic_equipments1_idx');
            $table->integer('user_as_clinic_id')->index('fk_packages_has_clinic_equipments_user_as_clinic1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages_has_clinic_equipments');
    }
}

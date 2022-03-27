<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesHasClinicServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages_has_clinic_services', function (Blueprint $table) {
            $table->integer('packages_id')->index('fk_packages_has_clinic_services_packages1_idx');
            $table->integer('clinic_services_id')->index('fk_packages_has_clinic_services_clinic_services1_idx');
            $table->integer('user_as_clinic_id')->index('fk_packages_has_clinic_services_user_as_clinic1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages_has_clinic_services');
    }
}

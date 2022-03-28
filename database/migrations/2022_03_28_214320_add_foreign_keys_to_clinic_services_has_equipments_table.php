<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClinicServicesHasEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinic_services_has_equipments', function (Blueprint $table) {
            $table->foreign(['clinic_services_id'], 'fk_clinic_equipments_has_clinic_services_clinic_services1')->references(['id'])->on('clinic_services')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['clinic_equipments_id'], 'fk_clinic_equipments_has_clinic_services_clinic_equipments1')->references(['id'])->on('clinic_equipments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_as_clinic_id'], 'fk_clinic_services_has_equipments_user_as_clinic1')->references(['id'])->on('user_as_clinic')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinic_services_has_equipments', function (Blueprint $table) {
            $table->dropForeign('fk_clinic_equipments_has_clinic_services_clinic_services1');
            $table->dropForeign('fk_clinic_equipments_has_clinic_services_clinic_equipments1');
            $table->dropForeign('fk_clinic_services_has_equipments_user_as_clinic1');
        });
    }
}

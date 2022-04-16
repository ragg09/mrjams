<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPackagesHasClinicEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages_has_clinic_equipments', function (Blueprint $table) {
            $table->foreign(['packages_id'], 'fk_packages_has_clinic_equipments_packages1')->references(['id'])->on('packages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['clinic_equipments_id'], 'fk_packages_has_clinic_equipments_clinic_equipments1')->references(['id'])->on('clinic_equipments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_as_clinic_id'], 'fk_packages_has_clinic_equipments_user_as_clinic1')->references(['id'])->on('user_as_clinic')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages_has_clinic_equipments', function (Blueprint $table) {
            $table->dropForeign('fk_packages_has_clinic_equipments_packages1');
            $table->dropForeign('fk_packages_has_clinic_equipments_clinic_equipments1');
            $table->dropForeign('fk_packages_has_clinic_equipments_user_as_clinic1');
        });
    }
}

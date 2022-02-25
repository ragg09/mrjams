<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPackagesHasClinicServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages_has_clinic_services', function (Blueprint $table) {
            $table->foreign(['user_as_clinic_id'], 'fk_packages_has_clinic_services_user_as_clinic1')->references(['id'])->on('user_as_clinic')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['packages_id'], 'fk_packages_has_clinic_services_packages1')->references(['id'])->on('packages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['clinic_services_id'], 'fk_packages_has_clinic_services_clinic_services1')->references(['id'])->on('clinic_services')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages_has_clinic_services', function (Blueprint $table) {
            $table->dropForeign('fk_packages_has_clinic_services_user_as_clinic1');
            $table->dropForeign('fk_packages_has_clinic_services_packages1');
            $table->dropForeign('fk_packages_has_clinic_services_clinic_services1');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClinicEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinic_equipments', function (Blueprint $table) {
            $table->foreign(['user_as_clinic_id'], 'fk_clinic_equipments_user_as_clinic1')->references(['id'])->on('user_as_clinic')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinic_equipments', function (Blueprint $table) {
            $table->dropForeign('fk_clinic_equipments_user_as_clinic1');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEquipmentInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipment_inventory', function (Blueprint $table) {
            $table->foreign(['clinic_equipments_id'], 'fk_equipment_inventory_clinic_equipments1')->references(['id'])->on('clinic_equipments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipment_inventory', function (Blueprint $table) {
            $table->dropForeign('fk_equipment_inventory_clinic_equipments1');
        });
    }
}

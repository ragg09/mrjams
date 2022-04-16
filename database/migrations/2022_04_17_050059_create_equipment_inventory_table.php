<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_inventory', function (Blueprint $table) {
            $table->integer('id', true);
            $table->timestamp('acquired')->nullable();
            $table->timestamp('expiration')->nullable();
            $table->string('quantity', 45)->nullable();
            $table->string('supplier', 45)->nullable();
            $table->string('notify', 45)->nullable();
            $table->integer('clinic_equipments_id')->index('fk_equipment_inventory_clinic_equipments1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_inventory');
    }
}

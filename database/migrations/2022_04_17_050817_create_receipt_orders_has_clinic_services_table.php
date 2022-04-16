<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptOrdersHasClinicServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_orders_has_clinic_services', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('receipt_orders_id')->index('fk_receipt_orders_has_clinic_services_receipt_orders1_idx');
            $table->integer('clinic_services_id')->index('fk_receipt_orders_has_clinic_services_clinic_services1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipt_orders_has_clinic_services');
    }
}

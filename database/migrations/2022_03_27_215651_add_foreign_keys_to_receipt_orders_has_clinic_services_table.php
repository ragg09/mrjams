<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToReceiptOrdersHasClinicServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receipt_orders_has_clinic_services', function (Blueprint $table) {
            $table->foreign(['clinic_services_id'], 'fk_receipt_orders_has_clinic_services_clinic_services1')->references(['id'])->on('clinic_services')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['receipt_orders_id'], 'fk_receipt_orders_has_clinic_services_receipt_orders1')->references(['id'])->on('receipt_orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receipt_orders_has_clinic_services', function (Blueprint $table) {
            $table->dropForeign('fk_receipt_orders_has_clinic_services_clinic_services1');
            $table->dropForeign('fk_receipt_orders_has_clinic_services_receipt_orders1');
        });
    }
}

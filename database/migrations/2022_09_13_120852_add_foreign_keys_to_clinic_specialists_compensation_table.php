<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClinicSpecialistsCompensationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinic_specialists_compensation', function (Blueprint $table) {
            $table->foreign(['receipt_order_id'], 'clinic_specialists_compensation_ibfk_2')->references(['id'])->on('receipt_orders');
            $table->foreign(['clinic_specialists_id'], 'clinic_specialists_compensation_ibfk_1')->references(['id'])->on('clinic_specialists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinic_specialists_compensation', function (Blueprint $table) {
            $table->dropForeign('clinic_specialists_compensation_ibfk_2');
            $table->dropForeign('clinic_specialists_compensation_ibfk_1');
        });
    }
}

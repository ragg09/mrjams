<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign(['receipt_orders_id'], 'fk_appointments_receipt_orders1')->references(['id'])->on('receipt_orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['appointment_status_id'], 'fk_appointments_appointment_status1')->references(['id'])->on('appointment_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign('fk_appointments_receipt_orders1');
            $table->dropForeign('fk_appointments_appointment_status1');
        });
    }
}

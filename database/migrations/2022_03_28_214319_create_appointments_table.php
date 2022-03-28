<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('created_at', 45)->nullable();
            $table->string('appointed_at', 45)->nullable();
            $table->string('time', 45)->nullable();
            $table->integer('receipt_orders_id')->index('fk_appointments_receipt_orders1_idx');
            $table->integer('appointment_status_id')->index('fk_appointments_appointment_status1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}

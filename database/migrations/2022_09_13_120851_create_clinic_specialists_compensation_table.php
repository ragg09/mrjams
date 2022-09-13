<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicSpecialistsCompensationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_specialists_compensation', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('clinic_specialists_id')->index('clinic_specialists_id');
            $table->integer('receipt_order_id')->index('receipt_order_id');
            $table->float('compensation', 10, 0);
            $table->integer('claim');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_specialists_compensation');
    }
}

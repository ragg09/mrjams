<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_services', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 45)->nullable();
            $table->text('description')->nullable();
            $table->integer('min_price');
            $table->integer('max_price')->nullable();
            $table->integer('user_as_clinic_id')->index('fk_clinic_services_user_as_clinic1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_services');
    }
}

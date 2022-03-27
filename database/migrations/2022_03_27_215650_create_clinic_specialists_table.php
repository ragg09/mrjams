<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicSpecialistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_specialists', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('fullname', 45)->nullable();
            $table->string('specialization')->nullable();
            $table->integer('user_as_clinic_id')->index('fk_clinic_personnels_user_as_clinic1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_specialists');
    }
}

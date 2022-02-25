<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_preferences', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('auto_fill_date', 45)->nullable();
            $table->string('auto_accept', 45)->nullable();
            $table->integer('max_accept_per_day')->nullable();
            $table->string('active_status', 45)->nullable();
            $table->integer('user_as_clinic_id')->index('fk_clinic_preferences_user_as_clinic1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_preferences');
    }
}

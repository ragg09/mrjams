<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClinicVaultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinic_vault', function (Blueprint $table) {
            $table->foreign(['user_as_clinic_id'], 'clinic_vault_ibfk_1')->references(['id'])->on('user_as_clinic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinic_vault', function (Blueprint $table) {
            $table->dropForeign('clinic_vault_ibfk_1');
        });
    }
}

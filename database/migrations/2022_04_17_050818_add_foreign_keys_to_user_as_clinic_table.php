<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserAsClinicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_as_clinic', function (Blueprint $table) {
            $table->foreign(['users_id'], 'fk_user_as_clinic_details_users1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['clinic_types_id'], 'fk_user_as_clinic_clinic_types1')->references(['id'])->on('clinic_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_address_id'], 'fk_user_as_clinic_user_adress1')->references(['id'])->on('user_address')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_as_clinic', function (Blueprint $table) {
            $table->dropForeign('fk_user_as_clinic_details_users1');
            $table->dropForeign('fk_user_as_clinic_clinic_types1');
            $table->dropForeign('fk_user_as_clinic_user_adress1');
        });
    }
}

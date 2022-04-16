<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserAsCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_as_customer', function (Blueprint $table) {
            $table->foreign(['user_address_id'], 'fk_user_as_customer_user_adress1')->references(['id'])->on('user_address')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['users_id'], 'fk_user_as_customer_details_users1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_as_customer', function (Blueprint $table) {
            $table->dropForeign('fk_user_as_customer_user_adress1');
            $table->dropForeign('fk_user_as_customer_details_users1');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCustomerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_logs', function (Blueprint $table) {
            $table->foreign(['user_as_customer_id'], 'fk_customer_logs_user_as_customer1')->references(['id'])->on('user_as_customer')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_logs', function (Blueprint $table) {
            $table->dropForeign('fk_customer_logs_user_as_customer1');
        });
    }
}

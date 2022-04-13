<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_logs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('message')->nullable();
            $table->string('remark', 45)->nullable();
            $table->string('time', 45)->nullable();
            $table->string('date', 45)->nullable();
            $table->integer('user_as_customer_id')->index('fk_customer_logs_user_as_customer1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_logs');
    }
}

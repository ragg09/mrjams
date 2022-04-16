<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_as_clinic_id')->index('fk_receipt_orders_user_as_clinic1_idx');
            $table->integer('user_as_customer_id')->index('fk_receipt_orders_user_as_customer1_idx');
            $table->text('patient_details');
            $table->text('patient_address');
            $table->integer('packages_id')->nullable()->index('fk_receipt_orders_packages1_idx');
            $table->integer('specialist_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipt_orders');
    }
}

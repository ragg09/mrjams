<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('total_paid')->nullable();
            $table->integer('balance')->nullable();
            $table->integer('receipt_orders_id')->index('fk_billings_receipt_orders1_idx');
            $table->integer('user_as_clinic_id')->index('fk_billings_user_as_clinic1_idx');
            $table->integer('user_as_customer_id')->index('fk_billings_user_as_customer1_idx');
            $table->integer('billing_status_id')->index('fk_billings_billing_status1_idx');
            $table->text('price_summary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billings');
    }
}

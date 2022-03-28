<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->foreign(['receipt_orders_id'], 'fk_billings_receipt_orders1')->references(['id'])->on('receipt_orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_as_customer_id'], 'fk_billings_user_as_customer1')->references(['id'])->on('user_as_customer')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['billing_status_id'], 'fk_billings_billing_status1')->references(['id'])->on('billing_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_as_clinic_id'], 'fk_billings_user_as_clinic1')->references(['id'])->on('user_as_clinic')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->dropForeign('fk_billings_receipt_orders1');
            $table->dropForeign('fk_billings_user_as_customer1');
            $table->dropForeign('fk_billings_billing_status1');
            $table->dropForeign('fk_billings_user_as_clinic1');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToReceiptOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receipt_orders', function (Blueprint $table) {
            $table->foreign(['packages_id'], 'fk_receipt_orders_packages1')->references(['id'])->on('packages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_as_customer_id'], 'fk_receipt_orders_user_as_customer1')->references(['id'])->on('user_as_customer')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_as_clinic_id'], 'fk_receipt_orders_user_as_clinic1')->references(['id'])->on('user_as_clinic')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receipt_orders', function (Blueprint $table) {
            $table->dropForeign('fk_receipt_orders_packages1');
            $table->dropForeign('fk_receipt_orders_user_as_customer1');
            $table->dropForeign('fk_receipt_orders_user_as_clinic1');
        });
    }
}

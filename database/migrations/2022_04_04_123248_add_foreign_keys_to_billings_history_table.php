<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBillingsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billings_history', function (Blueprint $table) {
            $table->foreign(['billings_id'], 'fk_billings_history_billings1')->references(['id'])->on('billings')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billings_history', function (Blueprint $table) {
            $table->dropForeign('fk_billings_history_billings1');
        });
    }
}

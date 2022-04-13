<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings_history', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('paid')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->integer('billings_id')->index('fk_billings_history_billings1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billings_history');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRepaymentAmountToTakeLoans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('take_loans', function (Blueprint $table) {
            $table->bigInteger('repayment_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('take_loans', function (Blueprint $table) {
            $table->dropIfExists('repayment_amount');
        });
    }
}

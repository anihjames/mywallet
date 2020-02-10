<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayLoanTakensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_loan_takens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('wallet_key');
            $table->integer('loan_pid');
            $table->string('payment_method');
            $table->bigInteger('amount_paid');
            $table->bigInteger('amount_left');
            $table->boolean('verified')->default(false);
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
        Schema::dropIfExists('pay_loan_takens');
    }
}

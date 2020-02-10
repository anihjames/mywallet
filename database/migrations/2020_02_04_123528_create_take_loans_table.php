<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTakeLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('take_loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('loan_pid');
            $table->integer('user_id');
            $table->bigInteger('loan_amount');
            $table->dateTime('loan_taken_date');
            $table->dateTime('payment_date');
            $table->string('loan_length');
            $table->string('wallet_key');
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
        Schema::dropIfExists('take_loans');
    }
}

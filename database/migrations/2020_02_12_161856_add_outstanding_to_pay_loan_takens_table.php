<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOutstandingToPayLoanTakensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_loan_takens', function (Blueprint $table) {
            $table->boolean('dere_outstanding')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pay_loan_takens', function (Blueprint $table) {
            $table->dropIfExists('dere_outstanding');
        });
    }
}

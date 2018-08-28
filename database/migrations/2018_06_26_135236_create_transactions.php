<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string("transfer_code_num")->unique();
            $table->integer("account_to_id")->unsigned();
            $table->timestamp("transfer_date");
            $table->text("transfer_desc");
            $table->float("transfer_amount");
            $table->integer("account_from_id")->unsigned()->default(null);
            $table->integer("customer_id")->unsigned()->default(null);
            $table->integer("invoice_id")->unsigned()->default(null);
            $table->integer("expense_type_id")->unsigned()->default(null);
            $table->integer("employee_id")->unsigned()->default(null);
            $table->string("transfer_num")->default(null);
            $table->string("payment_method_name",30)->default(null);
            $table->string("transfer_type");  // income - expense - transfer
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
        Schema::dropIfExists('transactions');
    }
}

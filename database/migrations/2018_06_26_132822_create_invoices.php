<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("customer_id")->unsigned();
            $table->string("invoice_status",20);
            $table->timestamp("invoice_date");
            $table->timestamp("next_invoice_pay");
            $table->string("invoice_payment_term",30);
            $table->string("invoice_code_num")->unique();
            $table->integer("discount_amount");
            $table->string("discount_type",20);
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
        Schema::dropIfExists('invoices');
    }
}

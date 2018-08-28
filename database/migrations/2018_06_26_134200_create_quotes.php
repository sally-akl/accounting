<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("customer_id")->unsigned();
            $table->string("quote_subject");
            $table->string("quote_status",20);
            $table->timestamp("quote_date");
            $table->timestamp("quote_expire_date")->nullable();
            $table->string("quote_code_num")->unique();
            $table->float("quote_discount_amount");
            $table->string("quote_discount_type",20);
            $table->text("quote_txt");
            $table->text("quote_customer_txt");
            $table->boolean("converted_to_invoce");
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
        Schema::dropIfExists('quotes');
    }
}

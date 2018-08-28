<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("service_id")->unsigned()->default(null);
            $table->integer("invoice_id")->unsigned()->default(null);
            $table->integer("quote_id")->unsigned()->default(null);
            $table->integer("tax_id")->unsigned()->default(null);
            $table->integer("qty")->unsigned();
            $table->float("price");
            $table->string("invoice_type",20); // invoice , quote
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
        Schema::dropIfExists('invoice_items');
    }
}

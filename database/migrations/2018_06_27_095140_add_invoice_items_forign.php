<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInvoiceItemsForign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('invoice_items', function(Blueprint $table)
       {
            $table->index('tax_id');
            $table->index('invoice_id');
            $table->index('service_id');
            $table->index('quote_id');

            $table->foreign('tax_id')->references('id')->on('taxes');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');

       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('invoice_items_tax_id_foreign');
        $table->dropIndex('invoice_items_tax_id_index');
        $table->dropColumn('tax_id');

        $table->dropForeign('invoice_items_invoice_id_foreign');
        $table->dropIndex('invoice_items_invoice_id_index');
        $table->dropColumn('invoice_id');

        $table->dropForeign('invoice_items_service_id_foreign');
        $table->dropIndex('invoice_items_service_id_index');
        $table->dropColumn('service_id');


        $table->dropForeign('invoice_items_quote_id_foreign');
        $table->dropIndex('invoice_items_quote_id_index');
        $table->dropColumn('quote_id');
    }
}

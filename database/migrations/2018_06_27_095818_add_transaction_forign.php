<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactionForign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('transactions', function(Blueprint $table)
       {
            $table->index('customer_id');
            $table->index('employee_id');
            $table->index('expense_type_id');
            $table->index('invoice_id');
            $table->index('account_to_id');
            $table->index('account_from_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('expense_type_id')->references('id')->on('expense_type')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('account_to_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('account_from_id')->references('id')->on('accounts')->onDelete('cascade');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      $table->dropForeign('transactions_customer_id_foreign');
      $table->dropIndex('transactions_customer_id_index');
      $table->dropColumn('customer_id');

      $table->dropForeign('transactions_employee_id_foreign');
      $table->dropIndex('transactions_employee_id_index');
      $table->dropColumn('employee_id');

      $table->dropForeign('transactions_expense_type_id_foreign');
      $table->dropIndex('transactions_expense_type_id_index');
      $table->dropColumn('expense_type_id');

      $table->dropForeign('transactions_invoice_id_foreign');
      $table->dropIndex('transactions_invoice_id_index');
      $table->dropColumn('invoice_id');


      $table->dropForeign('transactions_account_to_id_foreign');
      $table->dropIndex('transactions_account_to_id_index');
      $table->dropColumn('account_to_id');

      $table->dropForeign('transactions_account_from_id_foreign');
      $table->dropIndex('transactions_account_from_id_index');
      $table->dropColumn('account_from_id');

    }
}

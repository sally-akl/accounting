<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscountForign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('discount', function(Blueprint $table)
       {
            $table->index('emp_major_id');
            $table->foreign('emp_major_id')->references('id')->on('emplyee_majors')->onDelete('cascade');
       });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          $table->dropForeign('discount_emp_major_id_foreign');
          $table->dropIndex('discount_emp_major_id_index');
          $table->dropColumn('emp_major_id');

    }
}

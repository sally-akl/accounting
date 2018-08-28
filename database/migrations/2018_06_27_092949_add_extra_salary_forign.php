<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraSalaryForign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::table('extra_salary', function(Blueprint $table)
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

        $table->dropForeign('extra_salary_emp_major_id_foreign');
        $table->dropIndex('extra_salary_emp_major_id_index');
        $table->dropColumn('emp_major_id');
    }
}

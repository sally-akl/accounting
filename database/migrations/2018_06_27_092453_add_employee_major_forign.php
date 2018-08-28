<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmployeeMajorForign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('emplyee_majors', function(Blueprint $table)
         {
              $table->index('major_id');
              $table->index('emplyee_id');
              $table->foreign('major_id')->references('id')->on('major')->onDelete('cascade');
              $table->foreign('emplyee_id')->references('id')->on('employees')->onDelete('cascade');
         });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('emplyee_majors_major_id_foreign');
        $table->dropIndex('emplyee_majors_major_id_index');
        $table->dropColumn('major_id');

        $table->dropForeign('emplyee_majors_emplyee_id_foreign');
        $table->dropIndex('emplyee_majors_emplyee_id_index');
        $table->dropColumn('emplyee_id');



    }
}

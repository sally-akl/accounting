<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmplyeesMajors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emplyee_majors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("emplyee_id")->unsigned();
            $table->integer("major_id")->unsigned();
            $table->timestamp('join_date');
            $table->boolean("is_current");
            $table->float("current_salary");
            $table->string("employee_code")->unique();
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
        Schema::dropIfExists('emplyee_majors');
    }
}

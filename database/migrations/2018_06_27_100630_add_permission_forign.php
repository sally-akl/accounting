<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermissionForign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function(Blueprint $table)
         {
              $table->index('module_id');
              $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('permissions_module_id_foreign');
        $table->dropIndex('permissions_module_id_index');
        $table->dropColumn('module_id');


    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserRolesForign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users_roles', function(Blueprint $table)
       {
            $table->index('user_id');
            $table->index('role_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('users_roles_user_id_foreign');
        $table->dropIndex('users_roles_user_id_index');
        $table->dropColumn('user_id');

        $table->dropForeign('users_roles_role_id_foreign');
        $table->dropIndex('users_roles_role_id_index');
        $table->dropColumn('role_id');

    }
}

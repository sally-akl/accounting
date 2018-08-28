<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRolePermissionForign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('roles_permissions', function(Blueprint $table)
       {
            $table->index('role_id');
            $table->index('permission_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('roles_permissions_role_id_foreign');
        $table->dropIndex('roles_permissions_role_id_index');
        $table->dropColumn('role_id');

        $table->dropForeign('roles_permissions_permission_id_foreign');
        $table->dropIndex('roles_permissions_permission_id_index');
        $table->dropColumn('permission_id');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerCityForgin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('customers', function(Blueprint $table)
         {
              $table->index('city_id');
              $table->foreign('city_id')->references('id')->on('cities')->unsigned()->onDelete('cascade');
         });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          $table->dropForeign('customers_city_id_foreign');
          $table->dropIndex('customers_city_id_index');
          $table->dropColumn('city_id');
    }
}

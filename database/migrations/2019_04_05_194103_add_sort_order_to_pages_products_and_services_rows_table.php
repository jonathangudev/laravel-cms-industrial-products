<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSortOrderToPagesProductsAndServicesRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages_products_and_services_rows', function (Blueprint $table) {
            $table->integer('sort_order')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages_products_and_services_rows', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
}

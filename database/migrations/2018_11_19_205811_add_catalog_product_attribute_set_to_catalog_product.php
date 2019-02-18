<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCatalogProductAttributeSetToCatalogProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalog_products', function (Blueprint $table) {
            $table->unsignedInteger('attribute_set_id');
            $table->foreign('attribute_set_id')
                ->references('id')->on('catalog_product_attribute_sets')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalog_products', function (Blueprint $table) {
            $table->dropForeign(['attribute_set_id']);
            $table->dropColumn('attribute_set_id');
        });
    }
}

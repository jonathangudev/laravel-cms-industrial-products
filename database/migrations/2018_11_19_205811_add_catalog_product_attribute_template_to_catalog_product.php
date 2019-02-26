<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCatalogProductAttributeTemplateToCatalogProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalog_products', function (Blueprint $table) {
            $table->unsignedInteger('attribute_template_id')->nullable();
            $table->foreign('attribute_template_id')
                ->references('id')->on('catalog_product_attribute_templates');
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
            $table->dropForeign(['attribute_template_id']);
            $table->dropColumn('attribute_template_id');
        });
    }
}

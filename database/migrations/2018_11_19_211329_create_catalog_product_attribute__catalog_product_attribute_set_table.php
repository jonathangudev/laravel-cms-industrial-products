<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogProductAttributeCatalogProductAttributeSetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_product_attribute__catalog_product_attribute_set', function (Blueprint $table) {
            $table->unsignedInteger('attribute_set_id');
            $table->unsignedInteger('attribute_id');

            $table->foreign('attribute_set_id', 'catalog_product_attribute__attribute_set__set_id_foreign')
                ->references('id')->on('catalog_product_attribute_sets')
                ->onDelete('cascade');
            $table->foreign('attribute_id', 'catalog_product_attribute__attribute_set__attribute_id_foreign')
                ->references('id')->on('catalog_product_attributes')
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
        Schema::dropIfExists('catalog_product_attribute__catalog_product_attribute_set');
    }
}

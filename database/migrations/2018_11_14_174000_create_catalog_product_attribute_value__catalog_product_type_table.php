<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogProductAttributeValueCatalogProductTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_product_attribute_value__catalog_product_type', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type_id');
            $table->foreign('type_id', 'catalog_product_type_id_foreign')
                ->references('id')->on('catalog_product_types')
                ->onDelete('cascade');
            $table->unsignedInteger('value_id');
            $table->foreign('value_id', 'catalog_product_attribute_value_id_foreign')
                ->references('id')->on('catalog_product_attribute_values')
                ->onDelete('cascade');
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
        Schema::dropIfExists('catalog_product_type__catalog_attribute_value');
    }
}

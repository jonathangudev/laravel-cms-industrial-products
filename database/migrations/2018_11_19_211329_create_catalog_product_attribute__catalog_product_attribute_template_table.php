<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogProductAttributeCatalogProductAttributeTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_product_attribute__catalog_product_attribute_template', function (Blueprint $table) {
            $table->unsignedInteger('attribute_template_id');
            $table->unsignedInteger('attribute_id');

            $table->foreign('attribute_template_id', 'attribute__attribute_template__template_id_foreign')
                ->references('id')->on('catalog_product_attribute_templates')
                ->onDelete('cascade');
            $table->foreign('attribute_id', 'attribute__attribute_template__attribute_id_foreign')
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
        Schema::dropIfExists('catalog_product_attribute__catalog_product_attribute_template');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogProductAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_product_attribute_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('attribute_id');
            $table->unsignedInteger('company_id')->nullable();
            $table->boolean('is_hidden')->default(false);
            $table->text('value')->nullable();
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')->on('catalog_products')
                ->onDelete('cascade');
            $table->foreign('attribute_id')
                ->references('id')->on('catalog_product_attributes')
                ->onDelete('cascade');
            $table->foreign('company_id')
                ->references('id')->on('companies')
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
        Schema::dropIfExists('catalog_product_attribute_values');
    }
}

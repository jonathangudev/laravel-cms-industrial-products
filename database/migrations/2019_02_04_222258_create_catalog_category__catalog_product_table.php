<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogCategoryCatalogProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_category__catalog_product', function (Blueprint $table) {
            $table->unsignedInteger('category_id')->index();
            $table->unsignedInteger('product_id')->index();

            $table->foreign('category_id')
                ->references('id')->on('catalog_categories')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('catalog_products')
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
        Schema::dropIfExists('catalog_category__catalog_product');
    }
}

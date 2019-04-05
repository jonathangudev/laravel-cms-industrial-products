<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesProductsAndServicesContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_products_and_services_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('row_id');
            $table->timestamps();

            $table->foreign('row_id')
                ->references('id')
                ->on('pages_products_and_services_rows')
                ->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages_products_and_services_contents');
    }
}

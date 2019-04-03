<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutUsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_about_us_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content_block_1_title')->nullable();
            $table->text('content_block_1_text')->nullable();
            $table->string('content_block_2_title')->nullable();
            $table->text('content_block_2_text')->nullable();
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
        Schema::dropIfExists('pages_about_us_pages');
    }
}

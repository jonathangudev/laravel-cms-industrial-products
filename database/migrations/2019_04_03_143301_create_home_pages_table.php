<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_home_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subheading')->nullable();
            $table->string('about_us_title')->nullable();
            $table->text('about_us_text')->nullable();
            $table->string('our_products_title')->nullable();
            $table->text('our_products_text')->nullable();
            $table->string('contact_us_title')->nullable();
            $table->text('contact_us_text')->nullable();
            $table->string('footer_title')->nullable();
            $table->text('footer_text')->nullable();
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
        Schema::dropIfExists('pages_home_pages');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticMenuLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_menu_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('category_id');
            $table->string('url', 255);
            $table->string('title', 255);
            $table->boolean('open_in_new_tab')->default(false);
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
        Schema::dropIfExists('static_menu_links');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diets', function (Blueprint $table) {
            $table->id();
            $table->date('when')->nullable();
            $table->date('active_form')->nullable();
            $table->date('active_to')->nullable();
            $table->boolean('is_active')->default(false);
            $table->text('breakfast')->nullable();
            $table->string('breakfast_photo')->nullable();
            $table->text('diner')->nullable();
            $table->string('diner_photo')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('diets');
    }
}

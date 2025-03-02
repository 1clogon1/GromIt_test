<?php

use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('gromit_catalog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('wbs')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gromit_catalog_categories');
    }
}

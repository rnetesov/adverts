<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->index();
            $table->string('slug', 150);
            $table->unsignedInteger('parent_id')->nullable();
            $table->foreign('parent_id')
                ->references('id')
                ->on('regions')
                ->cascadeOnDelete();
            $table->unique(['parent_id', 'name']);
            $table->unique(['parent_id', 'slug']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('regions');
    }
}

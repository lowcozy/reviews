<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->float('lat');
            $table->float('lng');
            $table->integer('author_id');
            $table->integer('status');
            $table->integer('category_id');
            $table->string('city');
            $table->string('district');
            $table->string('phone');
            $table->string('website');
            $table->string('description');
            $table->string('open');
            $table->string('close');
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
         Schema::drop('places');
    }
}

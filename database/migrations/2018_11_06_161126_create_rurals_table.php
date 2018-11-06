<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRuralsTable extends Migration 
{
	public function up()
	{
		Schema::create('rurals', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('rurals');
	}
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCinemasTable extends Migration {
	public function up()
	{
		Schema::create('cinemas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('establishment_id')->nullable();
			$table->String('name',255)->nullable();
			$table->integer('seat_rows')->nullable();
			$table->integer('seat_columns')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cinemas');
	}
}

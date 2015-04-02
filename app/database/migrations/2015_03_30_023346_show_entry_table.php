<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShowEntryTable extends Migration {

	public function up()
	{
		Schema::create('entries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('establishment_id')->nullable();
			$table->integer('cinema_id')->nullable();
			$table->integer('show_id')->nullable();
			$table->datetime('start_timeslot')->nullable();
			$table->datetime('end_timeslot')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('entries');
	}
}

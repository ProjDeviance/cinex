<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration {
	public function up()
	{
		Schema::create('reservations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('entry_id')->nullable();
			$table->integer('establishment_id')->nullable();
			$table->integer('cinema_id')->nullable();
			$table->String('referenceCode',255)->nullable();
			$table->integer('seat_row')->nullable();
			$table->integer('seat_column')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('reservations');
	}

}

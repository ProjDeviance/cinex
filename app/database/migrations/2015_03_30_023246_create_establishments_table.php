<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstablishmentsTable extends Migration {

	public function up()
	{
		Schema::create('establishments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->String('name',255)->nullable();
			$table->String('address',255)->nullable();
			$table->double('longitude', 15,9)->nullable();
			$table->double('latitude', 15,9)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('establishments');
	}


}

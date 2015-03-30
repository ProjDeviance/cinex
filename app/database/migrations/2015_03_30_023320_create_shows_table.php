<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowsTable extends Migration {

	public function up()
	{
		Schema::create('shows', function(Blueprint $table)
		{
			$table->increments('id');
			$table->String('title',255)->nullable();
			$table->String('description',255)->nullable();
			$table->String('video_link',255)->nullable();
			$table->String('poster',255)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('establishments');
	}
}

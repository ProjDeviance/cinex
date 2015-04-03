<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTagTable extends Migration {

	public function up()
	{
		Schema::create('category_tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('show_id')->nullable();
			$table->integer('establishment_id')->nullable();
			$table->String('category',255)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('category_tags');
	}
}

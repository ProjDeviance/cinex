<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('email',255)->nullable();
			$table->String('password');
			$table->String('name',255)->nullable();
			$table->String('phoneNumber',255)->nullable();
			$table->integer('status')->nullable();
			$table->integer('establishment_id')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}

}

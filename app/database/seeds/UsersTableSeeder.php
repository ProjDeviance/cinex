<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		User::create([
			'email' => 'superadmin@gmail.com',
			'password' => Hash::make("superadmin"),
			'status' => 1,
			'name' => 'superadmin',
			'user_type' => 1,
			]);
	}
}
<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';

	public static function accountChecker($data) {
		$accountChecker = User::where('email', $data)->take(1)->get();
		if($accountChecker->isEmpty()) {
			return true;
		}
		else {
			return false;
		}
	}

	public static function deleteUsers($data) {
		$getUser = User::where('id', $data)->pluck('establishment_id');
		$deleteUser = User::where('id', $data)->delete();
		$deleteEstablish = Establishment::where('id', $getUser)->delete();

		if($deleteUser&&$deleteEstablish) {
			return true;
		}
		else {
			return false;
		}
	}

	public static function updateUsers($data, $status) {

		if($status<1) {
			$status = 1;
		}
		else {
			$status = 0;
		}

		$getUser = User::where('id', $data)->update(['status' => $status]);

		if($getUser) {
			return true;
		}
		else {
			return false;
		}
	}

	protected $hidden = array('password', 'remember_token');

}

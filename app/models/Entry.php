<?php

class Entry extends Eloquent{
	protected $table = 'entries';

	public static function getCinemaID($data){
		$getID = Cinema::where('name', $data)->pluck('id');
		return $getID;
	}

	public static function getShowID($data){
		$getID = Show::where('title', $data)->pluck('id');
		return $getID;
	}
}
<?php

class Show extends Eloquent{
	protected $table = 'shows';


	public static function entrySessions()
	{
        Session::put('cinema', Input::get('cinema'));
        Session::put('show', Input::get('show'));
        Session::put('price', Input::get('price'));
        Session::put('start_timeslot', Input::get('start_timeslot'));
        Session::put('end_timeslot', Input::get('end_timeslot'));
	}
}
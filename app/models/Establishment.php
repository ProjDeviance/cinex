<?php

class Establishment extends Eloquent{
	protected $table = 'establishments';

	public static function getEstablishmentID() {
		$getEstablishmentID = Establishment::orderBy('created_at', 'desc')->first();

		return $getEstablishmentID->id;
	}
}
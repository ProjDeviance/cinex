<?php

class Establishment extends Eloquent{
	protected $table = 'establiments';

	public static function getEstablishmentID() {
		$getEstablishmentID = Establishment::orderBy('created_at', 'desc')->first();

		return $getEstablishmentID->id;
	}
}
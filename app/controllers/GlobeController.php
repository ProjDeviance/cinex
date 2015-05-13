<?php
require_once(dirname(__FILE__).'/GlobeApi.php');


class GlobeController extends BaseController
{

	public function start()
	{	
		if(!Session::get('saved_entry_id'))
			return Redirect::to("/");
		

		$globe = new GlobeApi('1');
		
		$auth = $globe->auth(
    	'z9q8sEnRKpu4RTojKMiRaxuGz9r5sEep ',
    	'a076d3c7c28b2d4309f7eda8d96cd8fcfc7dc32193c0e7ba03a2a232f82a1633'
		);
		$loginUrl = $auth->getLoginUrl();
	
		return Redirect::to($loginUrl);
		
	}

	public function charge()
	{
		if(!Session::get('saved_entry_id'))
			return Redirect::to("/");

		$globe = new GlobeApi('1');
		

		$auth = $globe->auth(
    	'z9q8sEnRKpu4RTojKMiRaxuGz9r5sEep',
    	'a076d3c7c28b2d4309f7eda8d96cd8fcfc7dc32193c0e7ba03a2a232f82a1633'
		);
		
		$response = $auth->getAccessToken(Session::get('saved_code'));
		

		
		$charge = $globe->payment(
    	$response["access_token"],
    	$response["subscriber_number"]
		);

		$reservations_last = Reservation::orderBy('id', 'DESC')->first();
		$ref_no = "31161".str_pad($reservations_last->id+1 , 6, '0', STR_PAD_LEFT);

		$response = $charge->charge(
    	0,
    	$ref_no
		);


		if($response!=NULL)
		{
			$reservation = new Reservation;
			$entry = Entry::find(Session::get('saved_entry_id'));
			
			
			Session::put('msgsuccess', 'You have successfully purchased your ticket. Your reference no. will be sent via sms. Please present the message to the cinema. Thank you!');

			return Redirect::back();
		}
	
	}

	
}
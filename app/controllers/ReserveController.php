<?php

class ReserveController extends BaseController {

	public function reserve() {
      $displayShows = Show::where('establishment_id', Auth::user()->establishment_id)->paginate(10);
      $displayCinemas = Cinema::where('establishment_id', Auth::user()->establishment_id)->get();
      $displayEntries = Show::join('entries', 'shows.id', '=', 'entries.show_id')
                                                ->where('shows.establishment_id', Auth::user()->establishment_id)->get();                                    
      return View::make('manager.reserve', ['displayCinemas' => $displayCinemas, 'displayShows' => $displayShows, 'displayEntries' => $displayEntries]);
	}


	public function reservePOST() {

		if(Input::has('entry_id')) {
			$id = Input::get('entry_id');
		}

		$references = null;
		$amount = Input::get('amount');

		while($amount != 0) {

		$reserveCheck = Reservation::count();
		if($reserveCheck==0)
		{
		$ref_no = "31161".str_pad(1 , 6, '0', STR_PAD_LEFT);
		}
		else
		{
		$reservations_last = Reservation::orderBy('id', 'DESC')->first();
		$ref_no = "31161".str_pad($reservations_last->id+1 , 6, '0', STR_PAD_LEFT);
		}

		$reservation = new Reservation;
		$entry = Entry::find($id);


		$reservation->entry_id = $entry->id;
		$reservation->establishment_id=$entry->establishment_id;
		$reservation->cinema_id =$entry->cinema_id;
		$reservation->reference_code =$ref_no;
		$reservation->show_id =$entry->show_id;
		$reservation->save();

		$amount--;
		$references .= $ref_no . " ";

		}

		Session::put('msgsuccess', 'Entry has been reserved successfully. <br>References:<b>'. $references .'</b>');

		return Redirect::back();
	}
}
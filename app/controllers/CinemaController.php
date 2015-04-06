<?php
 

 
class CinemaController extends BaseController {
 
 
  public function add()
  {
    $rules = array(
      'name'    => 'required|min:1|max:50', 
      'seat_rows'    => 'required|numeric|min:1',
      'seat_columns'    => 'required|numeric|min:1',
    );
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) 
    {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withErrors($validator)
        ->withInput(); 
    } 
    else 
    {
   
      $cinema = new Cinema();
      $cinema->name = strip_tags(Input::get('name'));
      $cinema->seat_rows = strip_tags(Input::get('seat_rows'));
      $cinema->seat_columns = strip_tags(Input::get('seat_columns'));
      $cinema->establishment_id = Auth::user()->establishment_id;
      $cinema->save();

      Session::put('msgsuccess', 'Successfully added cinema.');
      return Redirect::back();

    }
  }
   
  public function edit($id)
  {
    $exist = Cinema::where('id', $id)->count();

    if($exist == 0)
    {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withInput(); 
    }
      

    $rules = array(
      'name'    => 'required|min:1|max:50', 
      'seat_rows'    => 'required|numeric|min:1',
      'seat_columns'    => 'required|numeric|min:1',
    );
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) 
    {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withErrors($validator)
        ->withInput(); 
    } 
    else 
    {
      $cinema = Cinema::find($id);
      $cinema->name = strip_tags(Input::get('name'));
      $cinema->seat_rows = strip_tags(Input::get('seat_rows'));
      $cinema->seat_columns = strip_tags(Input::get('seat_columns'));
      $cinema->save();
    
      Session::put('msgsuccess', 'Successfully edited cinema.');
      return Redirect::to("/manager/cinemas");
    }
  }

public function delete($id)
  {
    $exist = Cinema::where('id', $id)->count();

    if($exist == 0)
    {
      Session::put('msgfail', 'Failed to delete cinema.');
      return Redirect::back()
        ->withInput(); 
    }
      $entries = Entry::where("cinema_id", $id)->get();
      foreach ($entries as $entry) {
        Reservation::where("entry_id", $entry->id)->delete();
      }
      Entry::where("cinema_id", $id)->delete();
      Cinema::where('id',$id)->delete();
      Session::put('msgsuccess', 'Successfully deleted cinema.');
      
      return Redirect::back();
    
  }


}
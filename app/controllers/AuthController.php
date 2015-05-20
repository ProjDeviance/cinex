<?php

class AuthController extends BaseController {


  public function logout()
  {
    Auth::logout();
    Session::flush();
    return Redirect::to('/')->with('msgsuccess','You have logged out.');  
  }

  
  public function login()
  {
    $userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );

    if (Auth::Attempt($userdata)) 
    {
      $checkUser = User::find(Auth::id());
      if($checkUser->status==0)
      {
        Auth::logout();
        return Redirect::back()->withInput(Input::except('password'))->with( 'msgfail' , 'You account is not activated.' );
      }
      if($checkUser->user_type == 1)
      {
        
         return Redirect::to('/admin')->with( 'msgsuccess' , 'You have logged in successfully.');
      }

      return Redirect::to('/manager/cinemas')->with( 'msgsuccess' , 'You have logged in successfully.');

    }

    return Redirect::back()->withInput(Input::except('password'))->with( 'msgfail', 'Invalid credentials.');
  }

  

  public function register()
  {
    $rules = array( 
      'password'    => 'required|min:3|max:20|confirmed',
      'password_confirmation'    => 'required',
      'email'    => 'required|email|min:3|max:100|unique:users',
      'name'    => 'required|min:3|max:100',
      'contact_number'    => 'required|numeric',
      'establishment_name'    => 'required|min:3|max:100',
      'address'    => 'required|min:10|max:100',
    );
    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withErrors($validator)
        ->withInput(); 
    } 
    else {
 
      $user = new User;
      $user->name = strip_tags(Input::get('name'));
      $user->contact_number= strip_tags(Input::get('contact_number'));
      $user->email = strip_tags(Input::get('email'));
      $user->password = strip_tags(Hash::make(Input::get('password')));
      $user->user_type = 0;
      $user->save();

      $establishment = new Establishment;
      $establishment->establishment_name = strip_tags(Input::get('establishment_name'));
      $establishment->address = strip_tags(Input::get('address'));

      $establishment->latitude = 0;
      $establishment->longitude = 0;
      $establishment->save();

      $userUpdate = User::find($user->id);
      $userUpdate->establishment_id = $establishment->id;
      $userUpdate->save();

        $address = 'address='.Input::get('address');
        $address = preg_replace('/\s+/', '+', $address);
        
        $this->save_coordinates($address, $establishment->id);


        Session::put('msgsuccess', 'You have successfully registered.');
        return Redirect::to('/login');

    }
  }

   //Google Geocoding
    
    public function get_json( $endpoint)
    {
        $qryStr = $endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?' . $qryStr .'&key=AIzaSyDJZTMof34pQ-mg0w9kK_i8tYXk353o7yc'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, '3');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $content = trim(curl_exec($ch));
        curl_close($ch);
        return $content;
    }
    
    public function save_coordinates($input, $establishmentId)
    {
    try
    {
          $endpoint = $input;
          $data = $this->get_json($endpoint);

          $datax = json_decode($data);
         
          $results = $datax->results;
          $first = $results[0];
          $geometry = $first->geometry;
          $location = $geometry->location;
     
          $locationData = Establishment::find($establishmentId);
          $locationData->latitude = $location->lat;
          $locationData->longitude = $location->lng;
          $locationData->save();
    }
    catch( Exception $e )
    {
        $locationData = Establishment::where('userId', $userId )->first();
          $locationData->latitude =  0;
          $locationData->longitude = 0;
          $locationData->save();
    }

    }

    public function address_validator($input)
    {

      try
      {
        
          $endpoint = $input;
          $data = $this->get_json($endpoint);

          $datax = json_decode($data);

          $results = $datax->results;
      
          $first = $results[0];
          $types = $first->types;
      
        if(in_array("street_address", $types))
        {
            return true;
      }
      else
      {
        return false;
      }

        }
    catch( Exception $e )
    {
      return false;
      }
  }
    


}

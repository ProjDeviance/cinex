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

      return Redirect::to('/manager')->with( 'msgsuccess' , 'You have logged in successfully.');

    }

    return Redirect::back()->withInput(Input::except('password'))->with( 'msgfail', 'Invalid credentials.');
  }

  

  public function register()
  {
    $rules = array(
      'username'    => 'required|alphaNum|min:3|max:20|unique:users', 
      'password'    => 'required|min:3|max:20|confirmed',
      'password_confirmation'    => 'required',
      'email'    => 'required|email|min:3|max:100|unique:users',
      'name'    => 'required|min:3|max:100',
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
        $user->username = strip_tags(Input::get('username'));
        $user->email = strip_tags(Input::get('email'));
        $user->password = strip_tags(Hash::make(Input::get('password')));


      $defaultMemberType = MemberType::orderBy('borrow_limit', 'ASC')->first();
        $user->member_type_id = strip_tags($defaultMemberType->id);
        $user->save();

        

      
        Session::put('msgsuccess', 'You have successfully registered.');
        return Redirect::to('/login');

    }
  }

}

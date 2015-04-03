<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', function()
{

    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		
		$user = User::find(Auth::user()->id);

      	$entries =  DB::table('reference_entries')->where('holder_id', Auth::user()->id)->paginate(10);
		return View::make('members.home')->with('user', $user)->with('entries', $entries);
	}
});


Route::get('/home', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('home', 1);
		$user = User::find(Auth::user()->id);

      	$entries =  DB::table('reference_entries')->where('holder_id', Auth::user()->id)->paginate(10);
		return View::make('members.home')->with('user', $user)->with('entries', $entries);
	}
});


Route::get('/register', function()
{

	return View::make('register');

});
Route::post('register', array('uses' => 'AuthController@register', 'as'=>'register'));

Route::get('/login', function()
{
	 if(Auth::check())
    	return Redirect::to("/home");

	return View::make('login');
});

Route::post('login', array('uses' => 'AuthController@login', 'as'=>'login'));

Route::get('logout', array('uses' => 'AuthController@logout', 'as'=>'logout'));




Route::get('/register', function()
{

	return View::make('register');	
});
Route::post('/', function()
{
	if(Input::has('e-add')) {
		$email = Input::get('e-add');
		$password = Input::get('pass');
		return View::make('index')->with('emailPost', $email);
	}

	
});

//Registration function
Route::post('/register', function()
{

	$validator = Validator::make(
	    [
	        'name' => Input::get('name'),
	        'email' => Input::get('email'),
	        'cell_Number' => Input::get('cell_Number'),
	        'address' => Input::get('address'),
	        'account_Password' => Input::get('account_Password'),
	        'account_Password_Repeat' => Input::get('account_Password_Repeat')
	    ],
	    [
	        'name' => "required|min:5|max:50|regex:/^[\w\s]+$/",
	        'email' => "required|email",
	        'cell_Number' => "required|min:11|numeric",
	        'address' => "required|max:100",
	        'account_Password' => "required|min:6|max:15|same:account_Password_Repeat|regex:/^[\w\-\s]+$/",
	        'account_Password_Repeat' => "required|min:6|max:15|same:account_Password|regex:/^[\w\-\s]+$/"
	    ]
	);

	if($validator->fails())
	{
		return Redirect::back()->withInput()->withErrors($validator->messages());
	}

	else if(!User::accountChecker(Input::get('email'))) {
		return View::make('register', ['error' => 'Email Address has been taken already. Please use a different Email Address.']);
	}

	else {

	$establish = new Establishment;
	$establish->name = Input::get('name');
	$establish->address = Input::get('address');
	$establish->longitude = 0;
	$establish->latitude = 0;
	$establish->save();

	$insert = new User;
	$insert->name = Input::get('name');
	$insert->password = Hash::make(Input::get('account_Password'));
	$insert->email = Input::get('email');
	$insert->phoneNumber = Input::get('cell_Number');
	$insert->status = 1;
	$insert->user_Type = 0;
	$insert->establishment_id = Establishment::getEstablishmentID();
	$insert->save();

	return View::make('register', ['success' => 'Account has been registered!']);
	}
});


<<<<<<< HEAD
// Admin

Route::get('/manageUsers', 'AdminController@manageUsers');
Route::post('/manageUsers', 'AdminController@deleteUsers');
=======
>>>>>>> 938d84a9cdff90bcfa09d4f63501551aa6cc227a

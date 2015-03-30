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
	return View::make('index');	
});

Route::get('/Register', function()
{
	return View::make('Register');	
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
Route::post('/Reg', function()
{
	$email = Input::get('eadd');
	$username = Input::get('uname');
	$password = Input::get('pass');
	$cpnumber = Input::get('CellNum');
	$EsId = Input::get('EsId');
	
	$ValidateUser = User::where("email","=","$email")->first();
	if($email == $ValidateUser)
	{
		echo "User already exists!";
	}
	else
	{
		User::insert(
			array('email' => $email, 'password' => $password, 'name' => $username, 'phoneNumber' => $cpnumber,'status' => 0, 'establishment_id' => $EsId )
		);
		echo "$email Registered!";
	}
	return View::make('index');
});


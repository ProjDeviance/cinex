<?php

// Organized Code

Route::get('/', function()
{

    if(!Auth::check())
    {
    	$shows =  DB::table('shows')->get();
    	return View::make('index')->with('shows', $shows);
    }
	else
	{
		if(Auth::user()->user_type==0)
			return View::make('manager.index');
		else
			return View::make('admin.index');
	}
});
Route::get('/register', function()
{

    if(!Auth::check())
    {
    
    	return View::make('register');
    }
	else
	{
		return Redirect::to("/");
	}
});
Route::post('register', array('uses' => 'AuthController@register', 'as'=>'register'));

Route::get('/login', function()
{
    return Redirect::to("/");
});
Route::post('login', array('uses' => 'AuthController@login', 'as'=>'login'));

Route::group(['prefix' => 'manager'],  function() 
{	
	Route::get('/', function()
	{

    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		if(Auth::user()->user_type==0)
			return View::make('manager.index');
		else
			return View::make('admin.index');
	}
	});
});

Route::group(['prefix' => 'admin'],  function() 
{	
	Route::get('/', function()
	{

    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		if(Auth::user()->user_type==1)
			return View::make('admin.index');
		else
			return View::make('manager.index');
	}
	});
});
// End of Organized Code







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



// Admin

Route::get('/manageUsers', 'AdminController@manageUsers');
Route::post('/manageUsers', 'AdminController@deleteUsers');


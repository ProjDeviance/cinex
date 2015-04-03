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

Route::get('logout', array('uses' => 'AuthController@logout', 'as'=>'logout'));



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




// Admin

Route::get('/manageUsers', 'AdminController@manageUsers');
Route::post('/manageUsers', 'AdminController@deleteUsers');


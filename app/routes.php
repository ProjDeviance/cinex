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
			return Redirect::to("/manager");
		else
			return Redirect::to("/admin");
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
	Route::get('/', 'AdminController@manageUsers');
	Route::get('/activate/{id}', array('uses' => 'AdminController@activate'))->before('admin');
	Route::get('/deactivate/{id}', array('uses' => 'AdminController@deactivate'))->before('admin');


});
// End of Organized Code



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

	Route::group(array('before' => 'auth'), function(){
		//Show & Entries
		Route::get('/shows', 'ShowEntriesController@displayShowEntries');
		Route::post('/shows', 'ShowEntriesController@addShow');
		Route::get('/shows/edit/{id}', 'ShowEntriesController@editShow');
		Route::post('/shows/edit/{id}', 'ShowEntriesController@editShowPost');

		Route::get('/entries', 'ShowEntriesController@displayEntriesOnly');
		Route::post('/entries', 'ShowEntriesController@deleteEntry');
		Route::get('/entries/edit/{id}', 'ShowEntriesController@editEntry');
		Route::post('/entries/edit/{id}', 'ShowEntriesController@editEntryPost');
	});

	//Cinema
	Route::get('/cinemas/edit/{id}', function($id)
	{

    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		 $exist = Cinema::where('id', $id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit cinema.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$cinema = Cinema::find($id);
		return View::make('manager.edit_cinema')->with('cinema', $cinema);
	}
	})->before('manager');
	Route::post('/cinemas/edit/{id}', array('uses' => 'CinemaController@edit'))->before('manager');
	Route::get('/cinemas', function()
	{
    if(!Auth::check())
    	return Redirect::to("/");
	else
	{
		Session::put('management', 1);
		$cinemas = DB::table('cinemas')->where('establishment_id', Auth::user()->establishment_id)
	            ->paginate(10);
	
		return View::make('manager.cinemas')->with('cinemas', $cinemas);
	}
	})->before('manager');
	Route::post('cinemas', array('uses' => 'CinemaController@add', 'as'=>'cinemas'))->before('manager');
	Route::get('/cinemas/delete/{id}', array('uses' => 'CinemaController@delete'))->before('manager');
	//End Cinema
});

Route::group(['prefix' => 'admin'],  function() 
{	
	Route::get('/', 'AdminController@manageUsers');
	Route::get('/activate/{id}', array('uses' => 'AdminController@activate'))->before('admin');
	Route::get('/deactivate/{id}', array('uses' => 'AdminController@deactivate'))->before('admin');

});

// End of Organized Code
Route::post('/search', array('uses' => 'ShowEntriesController@search', 'as' =>'/search'));
Route::get('/lookforcinema/{id}', array('uses' => 'ShowEntriesController@lookCinema'));
Route::get('/search', function()
	{	
		
		return Redirect::to('/');
	});

Route::get('/geolocation', function()
	{	
		
		return View::make('geolocation');
	});


Route::get('/callback', function()
	{	
		Session::put('saved_code', Input::get("code"));
		return Redirect::to('/test/charge');
	});


Route::group(['prefix' => 'test'],  function() 
{	
	Route::get('/start', array('uses' => 'GlobeController@start'));
	
	Route::get('/charge', array('uses' => 'GlobeController@charge'));
});
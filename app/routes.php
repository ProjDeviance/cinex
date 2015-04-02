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


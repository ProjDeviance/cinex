<?php

class AdminController extends BaseController {


	public function manageUsers()
	{

    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		if(Auth::user()->user_type==1)
		{

			$displayUsers =  DB::table('users')->where('user_type', 0)->paginate(10);
		
			return View::make('admin.manageUsers', ['displayUsers' => $displayUsers]);
		}
		else
			return View::make('manager.index');
	}
		
	}

  public function deactivate($id)
  {

       $exist = User::where('id', $id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        $user = User::find($id);
      
        $user->status = 0;

        $user->save();

      
        Session::put('msgsuccess', 'Successfully deactivated user.');
       
        return Redirect::to("/admin");

    
  }


  public function activate($id)
  {

       $exist = User::where('id', $id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        $user = User::find($id);
      
        $user->status = 1;

        $user->save();

      
        Session::put('msgsuccess', 'Successfully activated user.');
       
        return Redirect::to("/admin");

    
  }

}

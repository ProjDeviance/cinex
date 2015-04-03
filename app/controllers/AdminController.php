<?php

class AdminController extends BaseController {


	public function manageUsers()
	{
		$displayUsers = User::join('establiments', 'establiments.id', '=', 'users.establishment_id')->get();
		return View::make('admin.manageUsers', ['displayUsers' => $displayUsers]);
	}

	public function deleteUsers()
	{
		if(Request::ajax()) {

			if(Input::has('delete_ID')) {
				$id = Input::get('delete_ID');

				if(User::deleteUsers($id)) {
					return Response::json(['success' => true]);
				}
				else {
					return Response::json(['success' => false]);
				}
			}

			else if(Input::has('update_ID')) {
				$id = Input::get('update_ID');
				$status = Input::get('status');
				
				if(User::updateUsers($id, $status)) {
					return Response::json(['success' => true]);
				}
				else {
					return Response::json(['success' => false]);
				}
			}
			
		}
	}

}

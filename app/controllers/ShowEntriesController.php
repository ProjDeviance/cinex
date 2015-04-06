<?php

class ShowEntriesController extends BaseController {

    public function displayShowEntries()
    {
      $displayShows = Show::paginate(10);
      return View::make('manager.show', ['displayShows' => $displayShows]);
    }

    public function addShow()
    {

      //ajax
      if(Request::ajax()) 
      {
        if(Input::has('delete_ID'))
        {
          $id = Input::get('delete_ID');
          Show::where('id', $id)->delete();
          return Response::json(['success' => true]);
        }
        
      }

      $validator = Validator::make(
          [
              'title' => Input::get('title'),
              'description' => Input::get('description'),
              'video_link' => Input::get('video_link'),
              'poster_link' => Input::get('poster_link')
          ],
          [
              'title' => "required|min:1|max:50",
              'description' => "required|min:15|max:250",
              'video_link' => "required",
              'poster_link' => "required"
          ]
      );

      if($validator->fails())
      {
        return Redirect::back()->withInput()->withErrors($validator->messages());
      }
      else
      {
        $insertShow = new Show;
        $insertShow->title = strip_tags(Input::get('title'));
        $insertShow->description= strip_tags(Input::get('description'));
        $insertShow->video_link = strip_tags(Input::get('video_link'));
        $insertShow->poster = strip_tags(Input::get('poster_link'));
        $insertShow->establishment_id = Auth::user()->establishment_id;
        $insertShow->save();

        $displayTitle = Input::get('title');
        Session::put('success', "Show <b>'".$displayTitle."'</b> has been added.");  

        $displayShows = Show::paginate(10);
        return View::make('manager.show', ['displayShows' => $displayShows]);
      }


    }

    public function editShow($id)
    {
      $showEdit = Show::where('id', $id)->get();
      return View::make('manager.edit_show', ['displayEditShows' => $showEdit]);
    }

    public function editShowPost($id)
    {
      $validator = Validator::make(
          [
              'title' => Input::get('title'),
              'description' => Input::get('description'),
              'video_link' => Input::get('video_link'),
              'poster_link' => Input::get('poster_link')
          ],
          [
              'title' => "required|min:1|max:50",
              'description' => "required|min:15|max:250",
              'video_link' => "required",
              'poster_link' => "required"
          ]
      );
      if($validator->fails())
      {
        return Redirect::back()->withInput()->withErrors($validator->messages());
      }
      else
      {
        $updateShow = [
          'title' => strip_tags(Input::get('title')),
          'description' => strip_tags(Input::get('description')),
          'video_link' => strip_tags(Input::get('video_link')),
          'poster' => strip_tags(Input::get('poster_link'))
        ];

        Show::where('id', $id)->update($updateShow);

        $displayTitle = Input::get('title');
        Session::put('success', "Show <b>'".$displayTitle."'</b> has been edited.");
        return Redirect::to('manager/showsentries');
      }
    }
}
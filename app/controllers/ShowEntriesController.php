<?php

class ShowEntriesController extends BaseController {

    public function displayShowEntries()
    {
      $displayShows = Show::where('establishment_id', Auth::user()->establishment_id)->paginate(10);
      $displayCinemas = Cinema::where('establishment_id', Auth::user()->establishment_id)->get();
      $displayEntries = Show::join('entries', 'shows.id', '=', 'entries.show_id')
                                                ->where('shows.establishment_id', Auth::user()->establishment_id)->get();                                    
      return View::make('manager.show', ['displayCinemas' => $displayCinemas, 'displayShows' => $displayShows, 'displayEntries' => $displayEntries]);
    }

    public function displayEntriesOnly()
    {
      $displayEntries = Show::join('entries', 'shows.id', '=', 'entries.show_id')
                                                ->where('shows.establishment_id', Auth::user()->establishment_id)->paginate(10);
      return View::make('manager.entry', ['displayEntries' => $displayEntries]); 
    }

    public function editEntry($id)
    {
      $displayShows = Entry::join('shows', 'entries.show_id', '=', 'shows.id')->where('entries.id', $id)->get();
      $displayCinemas = Entry::join('cinemas', 'entries.cinema_id', '=', 'cinemas.id')->where('entries.id', $id)->get();
      $displayCinemasRemaining = Cinema::where('establishment_id', Auth::user()->establishment_id)->get();
      $displayShowsRemaining = Show::where('establishment_id', Auth::user()->establishment_id)->get();   
      $entryEdit = Entry::where('id', $id)->get();

      return View::make('manager.edit_entry', ['displayEditEntries' => $entryEdit, 'displayCinemas' => $displayCinemas, 'displayShows' => $displayShows, 'displayShowsRemaining' => $displayShowsRemaining, 'displayCinemasRemaining' => $displayCinemasRemaining]);
    }

    public function editEntryPost($id)
    {
      $validator = Validator::make(
          [
              'cinema' => Input::get('cinema'),
              'show' => Input::get('show'),
              'price' => Input::get('price'),
              'start_timeslot' => Input::get('start_timeslot'),
              'end_timeslot' => Input::get('end_timeslot')
          ],
          [
              'cinema' => "required",
              'show' => "required",
              'price' => "required|numeric|min:1",
              'start_timeslot' => "required",
              'end_timeslot' => "required"
          ]
      );

      if($validator->fails())
      {
        return Redirect::back()->withInput()->withErrors($validator->messages());
      }
      else
      {
        $updateEntry = [
          'cinema_id' => Entry::getCinemaID(Input::get('cinema')),
          'show_id' => Entry::getShowID(Input::get('show')),
          'price' => Input::get('price'),
          'start_timeslot' => Input::get('start_timeslot'),
          'end_timeslot' => Input::get('end_timeslot')
        ];

        Entry::where('id', $id)->update($updateEntry);

        $displayTitle = Input::get('title');
        Session::put('success', "Entry has been edited.");
        return Redirect::to('manager/entries');
    }
  }

  public function deleteEntry()
  {
    if(Request::ajax()) 
    {
      if(Input::has('delete_ID'))
      {
        $id = Input::get('delete_ID');
        Entry::where('id', $id)->delete();
        return Response::json(['success' => true]);
      }
      
    }
  }

  public function addShow()
  {

    // Delete Show --- AJAX
    if(Request::ajax()) 
    {
      if(Input::has('delete_ID'))
      {
        $id = Input::get('delete_ID');
        Show::where('id', $id)->delete();
        return Response::json(['success' => true]);
      }
      
    }

    // Add Show
    if(Input::has('showSubmit')) {
      $validator = Validator::make(
          [
              'title' => Input::get('title'),
              'description' => Input::get('description'),
              'video_link' => Input::get('video_link'),
              'poster' => Input::file('poster')
          ],
          [
              'title' => "required|min:1|max:50",
              'description' => "required|min:15|max:1500",
              'video_link' => "required",
              'poster' => "required"
          ]
      );

      if($validator->fails())
      {
        return Redirect::back()->withInput()->withErrors($validator->messages());
      }
      else
      {
        if (Input::hasFile('poster'))
        {
          $file = Input::file('poster');
          $file->move('public/upload', $file->getClientOriginalName());

          $insertShow = new Show;
          $insertShow->title = strip_tags(Input::get('title'));
          $insertShow->description= strip_tags(Input::get('description'));
          $insertShow->video_link = strip_tags(Input::get('video_link'));
          $insertShow->poster = "../upload/" . $file->getClientOriginalName();
          $insertShow->establishment_id = Auth::user()->establishment_id;
          $insertShow->save();

        }
        $displayTitle = Input::get('title');
        Session::put('success', "Show <b>'".$displayTitle."'</b> has been added.");  
      }
    }

    // Add Entry
    else if(Input::has('entrySubmit')) {
      $validator = Validator::make(
          [
              'cinema' => Input::get('cinema'),
              'show' => Input::get('show'),
              'price' => Input::get('price'),
              'start_timeslot' => Input::get('start_timeslot'),
              'end_timeslot' => Input::get('end_timeslot')
          ],
          [
              'cinema' => "required",
              'show' => "required",
              'price' => "required|numeric|min:1",
              'start_timeslot' => "required",
              'end_timeslot' => "required"
          ]
      );

      if($validator->fails())
      {
        Session::put('entryActivePanel', 1);
        return Redirect::back()->withInput()->withErrors($validator->messages());
      }
      else
      {
        $insertEntry = new Entry;
        $insertEntry->establishment_id = Auth::user()->establishment_id;
        $insertEntry->cinema_id = Entry::getCinemaID(Input::get('cinema'));
        $insertEntry->show_id = Entry::getShowID(Input::get('show'));
        $insertEntry->price = Input::get('price');
        $insertEntry->start_timeslot = Input::get('start_timeslot');
        $insertEntry->end_timeslot = Input::get('end_timeslot');
        $insertEntry->save();

        $displayTitle = Input::get('show');
        Session::put('success', "Entry has been added to <b>'".$displayTitle."'</b>. show");  
      }
    }
    $displayShows = Show::where('establishment_id', Auth::user()->establishment_id)->paginate(10);
    $displayCinemas = Cinema::where('establishment_id', Auth::user()->establishment_id)->get();
    $displayEntries = Show::join('entries', 'shows.id', '=', 'entries.show_id')
                                              ->where('shows.establishment_id', Auth::user()->establishment_id)->get();

    return View::make('manager.show', ['displayCinemas' => $displayCinemas, 'displayShows' => $displayShows, 'displayEntries' => $displayEntries]);
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
            'poster' => Input::file('poster')
        ],
        [
            'title' => "required|min:1|max:50",
            'description' => "required|min:15|max:250",
            'video_link' => "required",
            'poster' => "required"
        ]
    );
    if($validator->fails())
    {
      return Redirect::back()->withInput()->withErrors($validator->messages());
    }
    else
    {

      if (Input::hasFile('poster'))
      {
        $file = Input::file('poster');
        $file->move('public/upload', $file->getClientOriginalName());
      }

      $updateShow = [
        'title' => strip_tags(Input::get('title')),
        'description' => strip_tags(Input::get('description')),
        'video_link' => strip_tags(Input::get('video_link')),
        'poster' => "../upload/" . $file->getClientOriginalName()
      ];

      Show::where('id', $id)->update($updateShow);

      $displayTitle = Input::get('title');
      Session::put('success', "Show <b>'".$displayTitle."'</b> has been edited.");
      return Redirect::to('manager/shows');
    }
  }

  public function search()
  {
    
      $term = Input::get('term');
      $displayShows =  DB::table('shows')->where('title', 'LIKE', "%$term%")->orWhere('description', 'LIKE', "%$term%")->groupBy('title')->paginate(10);
      return View::make('results')->with('displayShows', $displayShows);
    
  }

  public function lookCinema($id)
  {
      $lookShow = Show::find($id);
      $shows = DB::TABLE('shows')->where('title', $lookShow->title)->paginate(10);

      return View::make('lookcinema')->with('displayShows', $shows);
    
  }
  }
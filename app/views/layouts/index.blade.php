<!DOCTYPE html>

<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>CinEx</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/styles.css') }}
    {{ HTML::style('css/bootstrap-datetimepicker.css') }}
    <style>
    </style>
	</head>
	<body>
<!--template-->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container" style="">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">CinEx</a>
        </div>
        <div class="collapse navbar-collapse" style="">
            <ul class="nav navbar-nav">
             
              
              @if(!Auth::check())
              <li>
					     <a href="#myModal" data-toggle="modal" data-target="#myModal">Sign in</a>
              </li>
				
				      <li>
					     <a href="register">Register</a>
              </li>
              @endif

              @if(Auth::check())
                @if(Auth::user()->user_type==0)
                <li>
                  {{ HTML::link('manager/cinemas', 'Cinemas') }}
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Shows & Entries<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li>
                      <a href="{{ URL::to('manager/shows') }}"><i class='fa fa-film'></i> Manage Shows</a>
                      </li>
                    <li>
                      <a href="{{ URL::to('manager/entries') }}"><i class='fa fa-level-down'></i> Manage Entries</a>
                      </li>
                  </ul>
                </li>
                @endif

              <li>
               <a href="/logout">Log Out</a>
              </li>
              @endif
             
            </ul>

            <div align="right">

    

                  {{ Form::open(array( 'method'=> 'POST', 'action' => '/search')) }}
                           
                  <input type="text" class='form-control'  name ="term" placeholder="Search..." style="width: 150px;" >
       

                  {{ Form::close();}}
            
             
        
            </div>
        </div>



                
        <!--/.nav-collapse -->
    </div>
</div>
<div class="container">
  @if(Session::get('msgsuccess'))
      <div class="alert alert-success fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgsuccess') }}</center>
      </div>
      {{ Session::forget('msgsuccess') }}
    @endif
    @if(Session::get('msgfail'))
      <div class="alert alert-danger fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgfail') }}</center>
      </div>
      {{ Session::forget('msgfail') }}
    @endif
</div>

@yield('content')

@yield('modals')

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Log In</h4>
        </div>
        <div class="modal-body">
      <form method = "POST" action="/login">
          <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input name = 'email' class="form-control" id="exampleInputEmail1" placeholder="Enter email" type="email">
        </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
      <input name = 'password' class="form-control" id="exampleInputPassword1" placeholder="Password" type="password">
      </div>
          <p class="text-right"><a href="#">Forgot password?</a></p>
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
          <input type="submit" class="btn btn-primary" value="Login">
        </div>
    </form>
      </div>
    </div>
</div>
</div>

<br>
<br>
<br>




<hr>
<center>Project Deviance 2015</center>
  {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js') }}
  {{ HTML::script('js/bootstrap.min.js') }}
  {{ HTML::script('js/bootstrap-datetimepicker.js') }}
  <script>
    $('.datetimepicker').datetimepicker();
  </script>
  @yield('javascripts')

	</body>
</html>
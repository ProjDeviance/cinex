<!DOCTYPE html>

<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>CinEx</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}
    {{ HTML::style('css/styles.css') }}

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
              <li class="active">
                <a href="#" class="" style="">Search</a>
              </li>
              
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
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administrator <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li>
                      <a href="manageUsers">Manage Users</a>
                    </li>
                  </ul>
                </li>
                @endif

              <li>
               <a href="/logout">Log Out</a>
              </li>
              @endif
                
            </ul>
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


<br>
<br>
<br>

<!--Pang-inspire magcode-->
<center><audio src="z.mp3" controls="controls" autoplay="autoplay"></audio></center>
<!---->


<hr>
<center>Project Deviance 2015</center>
  {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js') }}
  {{ HTML::script('js/bootstrap.min.js') }}

  @yield('javascripts')

	</body>
</html>
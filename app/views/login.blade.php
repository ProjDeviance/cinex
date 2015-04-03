
@extends('layouts/title')



@section('content')

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

      <div id="login-page">
        <div class="container">
        
              <form class="form-login" action="/login" method ="POST">
                <h2 class="form-login-heading">sign in now</h2>
                <div class="login-wrap">
                            
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
         <div class="form-group @if ($errors->has('username')) has-error @endif">
         
                {{ Form::text('username', Session::get('username'), array('class' => 'form-control', 'placeholder' => 'Username','maxlength'=>'255')) }}
       
                @if ($errors->has('username')) 
                    <p class="help-block">{{ $errors->first('username') }}</p> 
                @endif
        </div>
         <div class="form-group @if ($errors->has('password')) has-error @endif">
         
               <input name="password" type="password" class="form-control" placeholder="Password" maxlength="255">

       
                @if ($errors->has('password')) 
                    <p class="help-block">{{ $errors->first('password') }}</p> 
                @endif
        </div>


                    <label class="checkbox">
                        <span class="pull-right">
                            <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>
        
                        </span>
                    </label>
                    <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
                    <hr>
                    
               
                    <div class="registration">
                        Don't have an account yet?<br/>
                        <a class="" href="/register">
                            Create an account
                        </a>
                    </div>
        
                </div>
        
              </form>     
                  <!-- Modal -->
                   <form  action="/resetpassword" method ="POST">
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title">Forgot Password ?</h4>
                              </div>
                              <div class="modal-body">
                                  <p>Enter your e-mail address below to reset your password.</p>
                                  <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
        
                              </div>
                              <div class="modal-footer">
                                  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                  <button class="btn btn-theme" type="button">Submit</button>
                              </div>
                          </div>
                      </div>
                  </div>
                </form>
                  <!-- modal -->
          
        
        </div>
      </div>


@stop
  
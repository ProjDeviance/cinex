@extends('layouts.index')

@section('content')
	<div class="container">
		<div class="col-lg-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-body">
				<h2 class="page-header"><i class='fa fa-users'></i> Register </h2>
					<i class='fa fa-exclamation-circle'></i> Register an account to access the CinEx features. <br><br>
				</div>
			</div>

			<div class='panel panel-default'>
	            <div class='panel-heading'>
	            	<i class='fa fa-edit'></i> Register Form
	            </div>
				<div class='panel-body'>
                     {{ Form::open(array('class' => 'registerAccount form-horizontal', 'role' => 'form')) }}

   
    	<div class="form-group @if ($errors->has('name')) has-error @endif">
         	<div class="col-lg-3 col-md-offset-1">
				{{ Form::label('name_Label', 'Full Name: ') }}
			</div>
			<div class="col-lg-6">
                {{ Form::text('name', Session::get('name'), array('class' => 'form-control', 'placeholder' => 'Name','maxlength'=>'255')) }}
       
                @if ($errors->has('name')) 
                    <p class="help-block">{{ $errors->first('name') }}</p> 
                @endif
            </div>
        </div>

        <div class="form-group @if ($errors->has('password')) has-error @endif">
       		<div class="col-lg-3 col-md-offset-1">
				{{ Form::label('password_Label', 'Password: ') }}
			</div>
			<div class="col-lg-6">
                <input name="password" type="password" class="form-control" placeholder="Password" maxlength="255">
           
                @if ($errors->has('password')) 
                    <p class="help-block">{{ $errors->first('password') }}</p> 
                @endif
            </div>
        </div>
      
        <div class="form-group @if ($errors->has('password')) has-error @endif">
          	<div class="col-lg-3 col-md-offset-1">
				{{ Form::label('password_confirmation_Label', 'Confirm Password: ') }}
			</div>
			<div class="col-lg-6">
                <input name="password_confirmation" type="password" class="form-control" placeholder="Retype Password" maxlength="255">
            </div>       
        </div>
       
        <div class="form-group @if ($errors->has('email')) has-error @endif">
         	<div class="col-lg-3 col-md-offset-1">
				{{ Form::label('email_Label', 'Email: ') }}
			</div>
			<div class="col-lg-6">
                {{ Form::email('email', Session::get('email'), array('class' => 'form-control', 'placeholder' => 'Email','maxlength'=>'255')) }}
       
                @if ($errors->has('email')) 
                    <p class="help-block">{{ $errors->first('email') }}</p> 
                @endif
             </div>
        </div>
        <div class="form-group @if ($errors->has('contact_number')) has-error @endif">
         	<div class="col-lg-3 col-md-offset-1">
				{{ Form::label('contact_number_label', 'Contact Number: ') }}
			</div>
			<div class="col-lg-6">
                {{ Form::text('contact_number', Session::get('contact_number'), array('class' => 'form-control', 'placeholder' => 'Contact Number','maxlength'=>'255')) }}
       
                @if ($errors->has('contact_number')) 
                    <p class="help-block">{{ $errors->first('contact_number') }}</p> 
                @endif
            </div>
        </div>
		<div class="form-group @if ($errors->has('establishment_name')) has-error @endif">
         	<div class="col-lg-3 col-md-offset-1">
				{{ Form::label('establishment_name_Label', 'Establishment Name: ') }}
			</div>
			<div class="col-lg-6">
                {{ Form::text('establishment_name', Session::get('establishment_name'), array('class' => 'form-control', 'placeholder' => 'Establishment Name','maxlength'=>'255')) }}
       
                @if ($errors->has('establishment_name')) 
                    <p class="help-block">{{ $errors->first('establishment_name') }}</p> 
                @endif
            </div>
        </div>
        <div class="form-group @if ($errors->has('address')) has-error @endif">
         	<div class="col-lg-3 col-md-offset-1">
				{{ Form::label('address_label', 'Establishment Address: ') }}
			</div>
			<div class="col-lg-6">
                {{ Form::text('address', Session::get('address'), array('class' => 'form-control', 'placeholder' => 'Establishment Address','maxlength'=>'255')) }}
       
                @if ($errors->has('address')) 
                    <p class="help-block">{{ $errors->first('address') }}</p> 
                @endif
            </div>
        </div>
		<div class="form-group">
			<div class="col-lg-7 col-md-offset-4">
			    {{ Form::submit('Register Account', ['class' => 'btn btn-default btn-primary']) }}
			    {{ Form::close() }}
			                <h5 class="alerts"> </h5>
			</div>
		</div>
		           
		           
	  	
		        
	
		     	 
			                     <hr>
		            <div align="center">
		                Already have an account?<br/>
		                <a class="" href="/login">
		                    Login Existing Account
		                </a>
		            </div>
							</div>
						</div>
                    </div>
            	</div>
            </div>
		</div>
	</div>
@stop
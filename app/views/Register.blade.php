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

			@if(isset($success))
			<div class="alert alert-success">
				<i class='fa fa-check'></i> {{ $success }}
			</div>
			@elseif(isset($error))
			<div class="alert alert-danger">
				<i class='fa fa-exclamation'></i> {{ $error }}
			</div>
			@endif

			<div class='panel panel-default'>
	            <div class='panel-heading'>
	            	<i class='fa fa-edit'></i> Register Form
	            </div>
				<div class='panel-body'>
                    {{ Form::open(array('method' => 'POST', 'url' => 'register', 'class' => 'registerAccount form-horizontal')) }}
						<!--Account Name-->
						<div class="form-group">
							<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('name_Label', 'Full Name: ') }}
							</div>
							<div class="col-lg-6">
								{{ Form::text('name', null, ['class' => 'name validatorRegister form-control', 'required' => '', 'placeholder' => 'Account Profile (minimum of 5 characters, maximum of 50)', 'autocomplete' => 'off']) }}
								<p class='text text-danger'>{{ $errors->first('name') }}</p>
							</div>
						</div>

						<!--Account Email-->
						<div class="form-group">
							<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('email_Label', 'Email: ') }}
							</div>
							<div class="col-lg-6">
								{{ Form::text('email', null, ['class' => 'email validatorRegister form-control', 'required' => '', 'placeholder' => "Valid Email Address (must contain '@')", 'autocomplete' => 'off', 'type' => 'email']) }}
								<p class='text text-danger'>{{ $errors->first('email') }}</p>
							</div>
						</div>	

						<!--Account Number-->
						<div class="form-group">
							<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('cell_Label', 'Cell Number (#): ') }}
							</div>
							<div class="col-lg-6">
								{{ Form::text('cell_Number', null, ['class' => 'cell_Number validatorRegister form-control', 'required' => '', 'placeholder' => "Cellphone Number (must contain 11 digits)", 'autocomplete' => 'off', 'type' => 'email']) }}
								<p class='text text-danger'>{{ $errors->first('cell_Number') }}</p>
							</div>
						</div>

						<!--Account Address-->
						<div class="form-group">
							<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('address_Label', 'Address: ') }}
							</div>
							<div class="col-lg-6">
								{{ Form::textarea('address', null, ['class' => 'address validatorRegister form-control', 'required' => '', 'size' => '30x4', 'placeholder' => 'Residence Address (maximum of 100 characters)', 'autocomplete' => 'off', 'style' => 'resize:none']) }}
								<p class='text text-danger'>{{ $errors->first('description') }}</p>
							</div>
						</div>

						<!--Account Password-->
						<div class="form-group">
							<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('password_Label', 'Password: ') }}
							</div>
							<div class="col-lg-6">
								{{ Form::password('account_Password', ['class' => 'account_Password validatorRegister form-control', 'required' => '', 'placeholder' => 'Account Password (minimum of 6 characters, maximum of 15)', 'autocomplete' => 'off']) }}
								<p class='text text-danger'>{{ $errors->first('account_Password') }}</p>
							</div>
						</div>

						<!--Account Password Repeat-->
						<div class="form-group">
							<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('account_Password_Label_Repeat', 'Re-type Password: ') }}
							</div>
							<div class="col-lg-6">
								{{ Form::password('account_Password_Repeat', ['class' => 'account_Password_Repeat validatorRegister form-control', 'required' => '', 'placeholder' => 'Re-type Password', 'autocomplete' => 'off']) }}
								<p class='text text-danger'>{{ $errors->first('account_Password_Repeat') }}</p>
							</div>
						</div>

						<!--Submit-->
						<div class="form-group">
							<div class="col-lg-7 col-md-offset-4">
			                    {{ Form::submit('Register Account', ['class' => 'btn btn-default btn-primary']) }}
			                    {{ Form::close() }}
			                    <h5 class="alerts"> </h5>
							</div>
						</div>
                    </div>
            	</div>
            </div>
		</div>
	</div>
@stop
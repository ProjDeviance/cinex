@extends('layouts.index')

@section('title')
    Cinemas Management
@stop

@section('content')

<div class="container">
<div class="row">
    
    {{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}
   

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Add Cinema
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
        
      

        <div class="form-group @if ($errors->has('name')) has-error @endif">
          	<div class="col-lg-3 col-md-offset-1">
				{{ Form::label('name_Label', 'Cinema Name: ') }}
			</div>
			<div class="col-lg-6">
                {{ Form::text('name', $cinema->name, array('class' => 'form-control  ', 'placeholder' => 'Cinema Name','maxlength'=>'255')) }}
          
            @if ($errors->has('name')) 
                <p class="help-block">{{ $errors->first('name') }}</p>  
            @endif
        	</div>
        </div>

        <div class="form-group @if ($errors->has('seat_rows')) has-error @endif">
        	<div class="col-lg-3 col-md-offset-1">
				{{ Form::label('seatr_Label', 'Seat Rows: ') }}
			</div>
			<div class="col-lg-6">
                {{ Form::number('seat_rows', $cinema->seat_rows, array('class' => 'form-control  ', 'placeholder' => 'Seats (No. of Rows)','maxlength'=>'255')) }}
           
            @if ($errors->has('seat_rows')) 
                <p class="help-block">{{ $errors->first('seat_rows') }}</p>  
            @endif
        	</div>

        </div>
        <div class="form-group @if ($errors->has('seat_columns')) has-error @endif">
      		<div class="col-lg-3 col-md-offset-1">
				{{ Form::label('seatc_Label', 'Seat Columns: ') }}
			</div>
			<div class="col-lg-6">
                {{ Form::number('seat_columns', $cinema->seat_columns, array('class' => 'form-control  ', 'placeholder' => 'Seats (No. of Columns)','maxlength'=>'255')) }}
           
            @if ($errors->has('seat_columns'));
                <p class="help-block">{{ $errors->first('seat_columns') }}</p>  
            @endif
        	</div>
        </div>

        <div class="col-lg-12" align="center">
            <input type="submit" class="btn btn-success left-sbs sbmt" value="Save">
      
     
        </div>
        {{ Form::close(); }}
   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@stop

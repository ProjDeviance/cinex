@extends('layouts.index')

@section('title')
    Cinemas Management
@stop

@section('content')

<div class="container">
<div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Cinemas
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">


    <div class="table-responsive">
    	<div class="dataTable_wrapper">
        <table class="table table-striped table-hover" id ="dataTables-example">
        <thead>
            <tr>
                <th>Name</th>
                <th>Seat Rows</th>
                <th>Seat Columns</th>
                <th>Action </th>

            </tr>
        </thead>
        <tbody>

     @if(Session::get('noresults'))
    <tr>
        <td colspan='6'>
        <center>{{ Session::get('noresults') }}</center>
        </td>
    </tr>
      {{ Session::forget('noresults') }}
    @endif

            @foreach($cinemas as $cinema)


                <tr >
                    <td>{{ $cinema->name  }}</td>
                    <td>{{ $cinema->seat_rows }}</td>
                    <td>{{ $cinema->seat_columns }}</td>
                    <td>
                        <a href="/manager/cinemas/edit/{{$cinema->id}}">
                              <button class="btn btn-primary" ><i class="fa fa-pencil-square-o"></i></button>
                        </a> 
               
                     
                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="{{ '#delete_' . $cinema->id }}"  data-toggle="tooltip" data-placement="top"  title="Delete Cinema"><i class="fa fa-times"></i></button>
                    </td>

                </tr>

            @endforeach
        </tbody>
    </table>
</div>

    <center>{{ $cinemas->links(); }}</center>
    </div>

   
</div>
</div>
</div>
</div>
</div>
    
    
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
                {{ Form::text('name',Session::get('name'), array('class' => 'form-control  ', 'placeholder' => 'Cinema Name','maxlength'=>'255')) }}
          
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
                {{ Form::number('seat_rows',Session::get('seat_rows'), array('class' => 'form-control  ', 'placeholder' => 'Seats (No. of Rows)','maxlength'=>'255')) }}
           
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
                {{ Form::number('seat_columns',Session::get('seat_columns'), array('class' => 'form-control  ', 'placeholder' => 'Seats (No. of Columns)','maxlength'=>'255')) }}
           
            @if ($errors->has('seat_columns'));
                <p class="help-block">{{ $errors->first('seat_columns') }}</p>  
            @endif
        	</div>
        </div>

        <div class="col-lg-12" align="center">
            <input type="submit" class="btn btn-success left-sbs sbmt" value="Add">
      
     
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

@section('modals')
@foreach($cinemas as $cinema)
    <?php 
        $modalName = "delete";
        $message = "Are you sure you want to delete cinema {$cinema->name} ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $cinema->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:black;">Delete Cinema</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/manager/cinemas/delete/{{$cinema->id}}" class="btn btn-warning" id="confirm">Delete Cinema </a>
                </div>
            </div>
        </div>
    </div>              
@endforeach
@stop
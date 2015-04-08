@extends('layouts.index')

@section('title')

@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-12">

			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Edit Entry
					</div>
					<div class="panel-body">
						@foreach($displayEditEntries as $displayEditEntry)
						<!--Cinema-->
						{{ Form::open(['type' => 'POST', 'url' => 'manager/entries/edit/'.$displayEditEntry->id, 'class' => 'form-horizontal']) }}
				        <div class="form-group">
				          	<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('cinema_Label', 'Cinema: ') }}
							</div>
							<div class="col-lg-6">
								<select name='cinema' class='form-control'>
									@foreach($displayCinemas as $displayCinema)
										<option value='{{ $displayCinema->name }}'>{{ $displayCinema->name }}</option>
										@foreach($displayCinemasRemaining as $displayCinemaRemaining)
											@if($displayCinemaRemaining->name != $displayCinema->name)
												<option value='{{ $displayCinemaRemaining->name }}'>{{ $displayCinemaRemaining->name }}</option>
											@endif
										@endforeach
									@endforeach
								</select>
				                <p class='text text-danger'>{{ $errors->first('cinema') }}</p>
				        	</div>
				        </div>
						<!--Show-->
				        <div class="form-group">
				          	<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('show_Label', 'Show: ') }}
							</div>
							<div class="col-lg-6">
								<select name='show' class='form-control' id='showSelect'>
									@foreach($displayShows as $displayShow)
										<option value='{{ $displayShow->title }}'>{{ $displayShow->title }}</option>
										@foreach($displayShowsRemaining as $displayShowRemaining)
											@if($displayShowRemaining->title != $displayShow->title)
												<option value='{{ $displayShowRemaining->title }}'>{{ $displayShowRemaining->title }}</option>
											@endif
										@endforeach
									@endforeach
								</select>
				                <p class='text text-danger'>{{ $errors->first('show') }}</p>
				        	</div>
				        </div>
				        <!--Price-->
				        <div class="form-group">
				      		<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('price_Label', 'Price: ') }}
							</div>
							<div class="col-lg-6">
								{{ Form::number('price', $displayEditEntry->price, ['class' => 'form-control', 'placeholder' => "Set a price for this show's entry", 'required' => '']) }}
				                <p class='text text-danger'>{{ $errors->first('price') }}</p>
				        	</div>
				        </div>
				        <!--Start TimeSlot-->
				        <div class="form-group">
				      		<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('start_Label', 'Start Time Slot: ') }}
							</div>
							<div class="col-lg-6">
								<div class="input-group date datetimepicker">
					                {{ Form::text('start_timeslot', $displayEditEntry->start_timeslot, ['class' => 'form-control', 'readonly' => '', 'data-datepicker' => 'datepicker', 'required' => '']) }}
					                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
				                </div>
				                <p class='text text-danger'>{{ $errors->first('start_timeslot') }}</p>
				        	</div>
				        </div>
				        <!--End TimeSlot-->
				        <div class="form-group">
				      		<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('start_Label', 'End Time Slot: ') }}
							</div>
							<div class="col-lg-6">
								<div class="input-group date datetimepicker">
					                {{ Form::text('end_timeslot', $displayEditEntry->end_timeslot, ['class' => 'form-control', 'readonly' => '', 'data-datepicker' => 'datepicker', 'required' => '']) }}
					                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>							                
				                </div>
				                <p class='text text-danger'>{{ $errors->first('end_timeslot') }}</p>
				        	</div>
				        </div>
				        @endforeach
				        <div class="col-lg-12" align="center">
				            <input type="submit" class="btn btn-warning left-sbs" name="entrySubmit" value="Edit Entry">
				        </div>
				        {{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop